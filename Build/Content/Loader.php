<?php


declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Symfony\Component\Yaml\Yaml;

/**
 * Declares the page files under pages/ on the Seeder.
 *
 * The YAML is data. Everything a content file cannot express happens here:
 * references to records that do not exist yet, flexforms, crop variants, the
 * contact form, and the page header every page carries.
 */
final class Loader
{
    private const COLUMNS = [
        'main' => 0, 'left' => 1, 'right' => 2, 'border' => 3, 'main2' => 4,
        'before' => 8, 'after' => 9, 'footer1' => 10, 'footer2' => 11, 'footer3' => 12,
        'teaser1' => 20, 'teaser2' => 21, 'teaser3' => 22,
        'special1' => 30, 'special2' => 31, 'special3' => 32, 'special4' => 33,
        'special5' => 34, 'special6' => 35, 'special7' => 36, 'special8' => 37,
    ];

    /** Fields that want the bare uid of a page, not a link to it */
    private const UID_FIELDS = ['pages', 'shortcut', 'categories', 'selected_categories', 'records'];

    /** Everything else below the demo folder is an image */
    private const FILE_DIRS = ['audio', 'csv', 'icons', 'youtube'];

    private const ICON_BASE = 'EXT:bootstrap_package/Resources/Public/Images/Icons/';

    /** Which pair of fields carries an icon, per context */
    private const ICON_FIELDS = [
        'page' => ['nav_icon_set', 'nav_icon_identifier'],
        'texticon' => ['icon_set', 'icon'],
        'child' => ['icon_set', 'icon_identifier'],
    ];

    private const CONTACT_FORM = 'EXT:bootstrap_package/Resources/Private/Forms/Contact.form.yaml';

    /** The band a page header crops out of a 3:2 photo */
    private const BAND_HEIGHT = 0.6425;

    private const CROP_VARIANTS = ['default', 'xlarge', 'large', 'medium', 'small', 'extrasmall'];

    /** @var array<string, array> every page file, keyed by page key */
    private array $pages = [];

    public function __construct(private readonly Seeder $seeder)
    {
    }

    public function load(string $dir): void
    {
        foreach (glob($dir . '/*.yaml') as $file) {
            $name = basename($file, '.yaml');
            $data = Yaml::parseFile($file);
            if ($name === '_categories') {
                foreach ($data['categories'] ?? [] as $category) {
                    $this->seeder->category($category['key'], $category['en'], $category['de']);
                }
                continue;
            }
            if (($data['key'] ?? null) !== $name) {
                throw new RuntimeException(sprintf('%s declares the key "%s"', basename($file), $data['key'] ?? ''));
            }
            $this->pages[$name] = $data;
        }

        foreach ($this->treeOrder() as $key) {
            $this->declarePage($this->pages[$key]);
        }
        foreach ($this->treeOrder() as $key) {
            foreach ($this->pages[$key]['content'] ?? [] as $element) {
                $this->declareElement($element, $key);
            }
        }
        $this->declareHeaders();
    }

    /**
     * Parents before children, siblings by their sorting. The Seeder writes
     * records in the order it hears about them, and that is the order the tree
     * and every column gets.
     *
     * @return string[]
     */
    private function treeOrder(): array
    {
        $children = [];
        foreach ($this->pages as $key => $page) {
            $children[$page['parent'] ?? ''][] = $key;
        }
        foreach ($children as &$group) {
            usort($group, fn ($a, $b) => ($this->pages[$a]['sorting'] ?? 0) <=> ($this->pages[$b]['sorting'] ?? 0));
        }
        unset($group);

        $order = [];
        $walk = function (string $parent) use (&$walk, &$order, $children): void {
            foreach ($children[$parent] ?? [] as $key) {
                $order[] = $key;
                $walk($key);
            }
        };
        $walk('');
        if (count($order) !== count($this->pages)) {
            throw new RuntimeException('A page names a parent that no page file declares');
        }
        return $order;
    }

    private function declarePage(array $page): void
    {
        $key = $page['key'];
        [$en, $de, $files] = $this->split($page, ['key', 'parent', 'sorting', 'header', 'content'], 'page');
        $this->seeder->page($key, $page['parent'] ?? null, $en + ['files' => $files], $de);
    }

    private function declareElement(array $element, string $pageKey): void
    {
        $type = $element['type'];
        $column = $element['column'] ?? 0;
        $colPos = is_int($column) ? $column : (self::COLUMNS[$column] ?? throw new RuntimeException(sprintf('Unknown column "%s" on %s', $column, $element['key'])));

        $children = [];
        foreach ($element['children'] ?? [] as $child) {
            [$childEn, $childDe, $childFiles] = $this->split($child, [], 'child');
            $children[] = ['en' => $childEn, 'de' => $childDe, 'files' => $childFiles];
        }

        [$en, $de, $files] = $this->split($element, ['key', 'type', 'column', 'children'], $type);
        $this->seeder->el($element['key'], $pageKey, $colPos, $type, $en, $de, $children, $files);
    }

    /**
     * Splits a YAML row into the English fields, the German ones and the
     * files, expanding everything the loader owns on the way.
     *
     * @return array{0: array, 1: array, 2: array}
     */
    private function split(array $row, array $structural, string $context): array
    {
        $en = [];
        $de = [];
        $files = [];
        foreach ($row as $field => $value) {
            if (in_array($field, $structural, true)) {
                continue;
            }
            match (true) {
                $field === 'en' => $en += $this->values($value),
                $field === 'de' => $de += $this->values($value),
                $field === 'icon' => $en += $this->icon($value, $context),
                $field === 'options' => $en['pi_flexform'] = $this->flex($this->values($value)),
                $field === 'background_image_options' => $en['background_image_options'] = $this->flex($this->values($value)),
                $field === 'form' => $en += $this->form($value),
                is_array($value) && isset($value[0]['file']) => $files[$field] = array_map($this->file(...), $value),
                default => $en[$field] = $this->reference($value, $field),
            };
        }
        return [$en, $de, $files];
    }

    /** @return array<string, mixed> */
    private function values(array $fields): array
    {
        $out = [];
        foreach ($fields as $field => $value) {
            $out[$field] = $this->reference($value, $field);
        }
        return $out;
    }

    /**
     * "page:about" becomes a link to that page, or its bare uid where the field
     * wants one; "record:" and "category:" always become the bare uid. None of
     * them exists while the content is being declared, so what comes back is a
     * closure the Seeder resolves once every record is written.
     */
    private function reference(mixed $value, string $field): mixed
    {
        if (is_array($value)) {
            if ($value === array_filter($value, static fn ($v) => is_string($v) && str_starts_with($v, 'page:'))) {
                $keys = array_map(static fn (string $v) => substr($v, 5), $value);
                return $this->seeder->later(fn (array $ids) => implode(',', array_map(static fn (string $k) => $ids[$k], $keys)));
            }
            return $value;
        }
        if (!is_string($value) || !preg_match('/(page|record|category):[a-z0-9_]+/', $value)) {
            return $value;
        }
        $bare = in_array($field, self::UID_FIELDS, true);
        return $this->seeder->later(function (array $ids) use ($value, $bare) {
            return preg_replace_callback('/(page|record|category):([a-z0-9_]+)/', function (array $match) use ($ids, $bare) {
                if (!isset($ids[$match[2]])) {
                    throw new RuntimeException(sprintf('No record is declared under the key "%s"', $match[2]));
                }
                return $match[1] === 'page' && !$bare ? 't3://page?uid=' . $ids[$match[2]] : (string)$ids[$match[2]];
            }, $value);
        });
    }

    private function flex(array $flat): array|Closure
    {
        $build = static fn (array $values) => ['data' => ['sDEF' => ['lDEF' => array_map(static fn ($v) => ['vDEF' => is_bool($v) ? (int)$v : $v], $values)]]];
        $deferred = array_filter($flat, static fn ($v) => $v instanceof Closure);
        if ($deferred === []) {
            return $build($flat);
        }
        return $this->seeder->later(function (array $ids, array $childIds) use ($flat, $build) {
            foreach ($flat as $name => $value) {
                if ($value instanceof Closure) {
                    $flat[$name] = $value($ids, $childIds);
                }
            }
            return $build($flat);
        });
    }

    /** @return array<string, mixed> */
    private function icon(string $name, string $context): array
    {
        $set = self::ICON_BASE . (str_contains($name, '/') ? dirname($name) : 'Ionicons') . '/';
        [$setField, $nameField] = self::ICON_FIELDS[$context] ?? self::ICON_FIELDS['child'];
        return [$setField => $set, $nameField => $set . basename($name) . '.svg'];
    }

    /**
     * The contact form element. Its flexform names one sheet per finisher, and
     * a sheet is identified by a hash over the form definition, so the values
     * cannot be written down by hand.
     */
    private function form(array $form): array
    {
        $definition = $form['definition'] ?? self::CONTACT_FORM;
        $sheet = static fn (string $finisher) => md5($definition . 'standard' . 'contactform' . $finisher);
        $flexform = [
            'sDEF' => ['lDEF' => [
                'settings.persistenceIdentifier' => ['vDEF' => $definition],
                'settings.overrideFinishers' => ['vDEF' => 1],
            ]],
            $sheet('EmailToReceiver') => ['lDEF' => [
                'settings.finishers.EmailToReceiver.subject' => ['vDEF' => $form['subject']],
                'settings.finishers.EmailToReceiver.recipients' => ['el' => ['1' => ['_arrayContainer' => ['el' => [
                    'email' => ['vDEF' => $form['recipient']],
                    'name' => ['vDEF' => $form['recipientName']],
                ]]]]],
                'settings.finishers.EmailToReceiver.senderAddress' => ['vDEF' => '{email}'],
                'settings.finishers.EmailToReceiver.senderName' => ['vDEF' => '{fullname}'],
            ]],
            $sheet('Redirect') => ['lDEF' => [
                'settings.finishers.Redirect.pageUid' => ['vDEF' => 'pages_' . substr($form['thanks'], 5)],
                'settings.finishers.Redirect.additionalParameters' => ['vDEF' => ''],
            ]],
        ];
        $thanks = substr($form['thanks'], 5);
        return [
            'pi_flexform' => ['data' => ['sDEF' => $flexform['sDEF']]],
            'pi_flexform@later' => $this->seeder->later(function (array $ids) use ($flexform, $thanks) {
                $flexform[array_key_last($flexform)]['lDEF']['settings.finishers.Redirect.pageUid']['vDEF'] = 'pages_' . $ids[$thanks];
                return ['data' => $flexform];
            }),
        ];
    }

    /** @return array<string, mixed> */
    private function file(array $spec): array
    {
        $path = $spec['file'];
        $out = ['file' => in_array(explode('/', $path)[0], self::FILE_DIRS, true) ? $path : 'images/' . $path];
        foreach (['alt' => 'alternative', 'title' => 'title', 'description' => 'description', 'link' => 'link'] as $from => $to) {
            if (isset($spec[$from])) {
                $out[$to] = $spec[$from];
            }
            if (isset($spec[$from . '.de'])) {
                $out[$to . '_de'] = $spec[$from . '.de'];
            }
        }
        if (isset($spec['crop'])) {
            $out['crop'] = $this->crop($spec['crop']);
        }
        return $out;
    }

    /**
     * A crop is the same area for every variant unless a page header narrows
     * the phone variants; "band-top" and "band-bottom" are the two a header
     * normally wants out of a 3:2 photo.
     */
    private function crop(string|array $crop): string
    {
        if (is_string($crop) && !str_starts_with($crop, '{')) {
            $crop = ['band' => ['offset' => $crop === 'band-top' ? 0 : 1]];
        }
        if (is_string($crop)) {
            return $crop;
        }
        $band = $crop['band'];
        $height = $band['height'] ?? self::BAND_HEIGHT;
        $area = [
            'x' => $band['x'] ?? 0,
            'y' => round(($band['offset'] ?? 0) * (1 - $height), 4),
            'width' => $band['width'] ?? 1,
            'height' => $height,
        ];
        return json_encode(array_fill_keys(self::CROP_VARIANTS, ['cropArea' => $area, 'selectedRatio' => 'NaN', 'focusArea' => null]));
    }

    /**
     * Narrows the phone variants of a header photo to the half its title sits
     * on, so the quiet area of the picture stays under the text where the band
     * is too tall to keep it.
     */
    private function sideCrop(array $spec, string $side): array
    {
        if ($side === 'center') {
            return $spec;
        }
        $full = ['cropArea' => ['x' => 0, 'y' => 0, 'width' => 1, 'height' => 1], 'selectedRatio' => 'NaN', 'focusArea' => null];
        $crop = isset($spec['crop']) ? json_decode($spec['crop'], true) : array_fill_keys(self::CROP_VARIANTS, $full);
        foreach (['small', 'extrasmall'] as $variant) {
            $area = &$crop[$variant]['cropArea'];
            $area['width'] = round($area['width'] / 2, 4);
            if ($side === 'right') {
                $area['x'] = round($area['x'] + $area['width'], 4);
            }
            unset($area);
        }
        $spec['crop'] = json_encode($crop);
        return $spec;
    }

    /**
     * Every page carries a page header in the border column: a small carousel
     * with one header item. A photo header puts the title on the quiet side of
     * the picture; a plain one is a band of colour, which is what the layout
     * pages want so their columns stay the picture.
     */
    private function declareHeaders(): void
    {
        foreach ($this->treeOrder() as $key) {
            $page = $this->pages[$key];
            $header = $page['header'] ?? [];
            if ($header === 'none') {
                continue;
            }
            $photo = $header['photo'] ?? $page['thumbnail'][0] ?? null;
            $plain = ($header['plain'] ?? false) || $photo === null;

            $item = [
                'item_type' => 'header',
                'header' => $page['en']['title'],
                'header_layout' => '1',
                'header_position' => $header['side'] ?? '',
                'subheader' => $page['en']['subtitle'] ?? '',
                'subheader_layout' => '3',
            ];
            $files = [];
            if ($plain) {
                $item['layout'] = 'light';
            } else {
                $item += ['layout' => 'custom', 'text_color' => $header['color'] ?? '#2A2725', 'background_color' => '#E7E3DB'];
                $files = ['background_image' => [$this->sideCrop($this->file($photo), $item['header_position'])]];
            }

            $this->seeder->el(
                'hero_' . $key,
                $key,
                self::COLUMNS['border'],
                'carousel_small',
                ['header' => $page['en']['title'], 'header_layout' => 100, 'frame_class' => 'none', 'pi_flexform' => $this->flex(['interval' => 0, 'transition' => 'fade', 'wrap' => 0, 'autoplay' => 0])],
                ['header' => $page['de']['title'] ?? $page['en']['title']],
                [[
                    'en' => $item,
                    'de' => ['header' => $page['de']['title'] ?? $page['en']['title'], 'subheader' => $page['de']['subtitle'] ?? ($page['en']['subtitle'] ?? '')],
                    'files' => $files,
                ]],
            );
        }
    }
}
