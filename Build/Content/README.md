# Demo content

`Initialisation/` ships a complete bilingual website: the page tree,
the content on it, the images it references and the site
configuration. TYPO3 imports it as the last step of its own setup, so
a fresh installation renders the whole frontend without an editor
touching anything.

This directory writes that website. `/Build` is `export-ignore`d, so
nothing here reaches a release archive.

```
pages/<key>.yaml   one file per page — the content
Loader.php         turns the page files into records
Seeder.php         writes them through the DataHandler, in both languages
seed.php           the entry point
```

## The source is the page files

`Initialisation/data.xml` is generated. Three consequences:

* Never edit `data.xml` by hand. The next export overwrites it.
* Never edit records in the backend and export them. The change is
  lost the next time somebody seeds, and nobody can see what you
  changed.
* The development installation is a scratch pad. `reset.sh` empties
  it without asking.

A change to the content is a change to a file under `pages/`, and the
artifact is what falls out at the end.

## The loop

```bash
ddev exec bash Build/Content/reset.sh          # empty the installation
ddev exec php Build/Content/seed.php           # write the content
ddev exec .build/bin/typo3 cache:flush
```

`seed.php` prints what it wrote — pages, elements, deferred values,
translations. It writes `var/demo-content-ids.json`, the map from the
key you gave a record to the uid it got. Use it to look a record up
in the backend.

Then look at the result (see *Seeing it*). Only when the content is
right:

```bash
rm -rf .build/public/fileadmin/user_upload/_temp_/importexport
ddev exec .build/bin/typo3 impexp:export --type=xml --pid=1 --levels=999 \
    --table=tt_content \
    --table=sys_file_reference \
    --table=sys_category \
    --table=sys_file_collection \
    --table=tx_bootstrappackage_accordion_item \
    --table=tx_bootstrappackage_card_group_item \
    --table=tx_bootstrappackage_carousel_item \
    --table=tx_bootstrappackage_icon_group_item \
    --table=tx_bootstrappackage_tab_item \
    --table=tx_bootstrappackage_timeline_item \
    --include-related=sys_file \
    --include-related=sys_file_metadata \
    --include-related=sys_category \
    --save-files-outside-export-file \
    --title='Bootstrap Package' \
    --description='Demo content shipped with the Bootstrap Package sitepackage.' \
    --dependency=bootstrap_package \
    --dependency=impexp \
    --dependency=rte_ckeditor \
    data

rm -rf Initialisation/data.xml Initialisation/data.xml.files
mv .build/public/fileadmin/user_upload/_temp_/importexport/data.xml Initialisation/
mv .build/public/fileadmin/user_upload/_temp_/importexport/data.xml.files Initialisation/
```

Every table the tree holds has to be named — one nobody named is
left out without a word. The command keeps only the basename of the
filename argument and writes below
`fileadmin/user_upload/_temp_/importexport/`, which is why the files
move afterwards. `--pid` is the uid of the site root, which
`seed.php` prints.

Seed and export are reproducible: a run that changes no content
produces an artifact that differs only in `<created>` and in a
`SYS_LASTCHANGED` field. Everything else in a `git diff` of
`data.xml` is something you changed. Line endings are noise of their
own — see *Traps*.

## A page file

```yaml
key: f_design                   # the filename, and how everything else names this page
parent: features                # another page's key
sorting: 20                     # position among its siblings; leave gaps of ten
categories: category:cat_feature
icon: wand                      # Ionicons; another set is written Glyphicons/leaf

header:                         # the page header, see below
  photo: { file: features/design-theming.jpg, crop: band-bottom }
  side: right

en:
  title: Design & Theming
  subtitle: Colours, fonts, variables
  abstract: Colours, fonts and every Bootstrap variable are site settings.
  keywords: design, scss, colors, fonts
de:
  title: Design & Theming
  subtitle: Farben, Schriften, Variablen
  abstract: Farben, Schriften und jede Bootstrap-Variable sind Site Settings.

thumbnail:
  - file: features/design-theming.jpg
    alt: Painted wooden boards fanned out like colour swatches
    alt.de: Bemalte Holzbretter, aufgefächert wie Farbmuster

content:
  - key: design_pic
    type: textpic
    header_layout: 2
    imageorient: 125
    imagewidth: 560
    space_after_class: large
    image:
      - file: features/design-theming.jpg
        alt: Painted wooden boards fanned out like colour swatches
        alt.de: Bemalte Holzbretter, aufgefächert wie Farbmuster
    en:
      header: The palette of this site
      subheader: Built from the 2026 colours of the year
      bodytext: |-
        <p>Pantone's Cloud Dancer is the page background …</p>
    de:
      header: Die Palette dieser Site
      subheader: Gebaut aus den Trendfarben 2026
      bodytext: |-
        <p>Pantones Cloud Dancer ist der Seitenhintergrund …</p>
```

Anything outside `en:`, `de:` and the structural keys is a field of
the record, written under its TCA name. `doktype`, `nav_hide`,
`backend_layout` and the rest go straight on the page; `frame_class`,
`space_before_class`, `background_color_class` and the rest straight
on an element. Which fields a content element offers is not
guesswork:

```bash
ddev exec php Build/Content/options-dump.php
```

It prints every content element with its fields, their type and the
values a select takes, read from the installation's own TCA.

**Write HTML as a literal block** (`|-`). Nothing inside it needs
escaping, which is the point: an apostrophe stays an apostrophe.

**Elements render in the order they are listed.** To move one, move
it in the file. `sorting` orders pages among their siblings only.

## Columns

An element without a `column:` sits in the main column.

| `column` | Where it renders |
| --- | --- |
| `main` | the main column |
| `left`, `right` | the side columns |
| `border` | above everything, where the page header sits |
| `main2` | the second main column of the feature layout |
| `before`, `after` | full width, before and after the columns |
| `footer1`–`footer3` | the footer, written once on `root` and inherited |
| `teaser1`–`teaser3` | the three teasers of the start layout |
| `special1`–`special8` | the eight teasers of the feature layout |

## Children

Accordion, card group, carousel, icon group, tab and timeline carry
child records. The loader picks the right table from the type:

```yaml
  - key: ia_accordion
    type: accordion
    options: { default_element: 1 }
    children:
      - en: { header: Is it free?, bodytext: '<p>MIT licensed.</p>' }
        de: { header: Ist es kostenlos?, bodytext: '<p>MIT-lizenziert.</p>' }
      - mediaorient: right
        imagecols: 1
        icon: ios-bolt
        media:
          - { file: gallery/material-oak.jpg, alt: Oiled oak, alt.de: Geölte Eiche }
        en: { header: Can I use my own templates? }
        de: { header: Kann ich eigene Templates nutzen? }
```

## Files

Every file field takes a list. `file:` is a path below the demo
folder in the file list; the sources live in `Build/Images/Demo` and
`Build/Files/Demo`. A path under `audio/`, `csv/`, `icons/` or
`youtube/` is taken as it stands, everything else is an image.

```yaml
    image:
      - file: stairs/spiral.jpg
        alt: A spiral staircase seen from above
        alt.de: Eine Wendeltreppe von oben
        title: Spiral
        crop: band-top
```

`alt`, `title` and `description` each take a `.de` sibling for the
German value.

## References

A page uid does not exist while the content is being read, so the
loader writes a closure and the Seeder resolves it once every record
exists. In the YAML a reference is a string:

```yaml
    link: page:features                    # becomes t3://page?uid=…
    pages: [page:e_text, page:e_media]     # a menu's source pages, as uids
    categories: category:cat_feature
    en:
      bodytext: |-
        <p><a href="page:about">About the project</a></p>
```

`page:` becomes a link, except in `pages`, `shortcut`, `categories`,
`selected_categories` and `records`, which want the bare uid.
`category:` and `record:` are always the bare uid. A key nothing
declares is an error, not a silent empty field.

## The page header

Every page carries one: a small carousel in the border column with a
single header item.

```yaml
header:
  photo: { file: horizon/field-fog.jpg, crop: band-top }
  side: right          # the side the title sits on; omit for the left
  color: '#FFFFFF'     # for a dark photo; the default is the body colour
```

* Leave `header:` out and the page thumbnail becomes the photo.
* `header: { plain: true }` gives a band of colour instead of a
  photo. The layout pages use it, so their columns stay the picture.
* `header: none` leaves the page without one. The start page and the
  Interactive page bring their own; a shortcut, a spacer and a
  sysfolder have no frontend to put one on.

The loader narrows the phone variants of the photo to the half the
title sits on, so the quiet area of the picture stays under the text
where the band is too tall to keep it.

## Crops

The site renders one upload at several widths, each with its own
crop.

* `crop: band-top` and `crop: band-bottom` take a wide band out of a
  3:2 photo — what a page header normally wants.
* `crop: { band: { offset: 0, x: 0.25, width: 0.75 } }` narrows it
  sideways as well. `offset` 0 is the top edge, 1 the bottom;
  `height` defaults to the band height.
* A raw crop JSON string still works, for the six hand-made variants
  the responsive images page demonstrates.

A photo that carries a title needs a quiet area on the side the
title is on. Check it at both widths; a crop that works at 1440 px
can put the headline on a tree at 390 px.

The layout schematics under `Build/Images/Demo/layouts/` are drawn,
not photographed:

```bash
ddev exec php Build/Content/layout-thumbs.php
```

It writes the same bytes every run, so it only shows up in `git
status` when a layout actually changed.

## The contact form

The form element's flexform names one sheet per finisher, and a
sheet is identified by a hash over the form definition, so it cannot
be written down by hand. Declare what it does instead:

```yaml
  - key: ct_form
    type: form_formframework
    form:
      definition: EXT:bootstrap_package/Resources/Private/Forms/Contact.form.yaml
      subject: 'Contact form: {subject}'
      recipient: demo@example.com
      recipientName: Demo recipient
      thanks: page:c_thanks
```

## German

Both languages come from the same declaration, and the German record
is a connected translation of the English one.

What you leave out of `de:` is inherited from `en:`: `header`,
`subheader`, `bodytext`, `teaser`, `quote_source`, `button_text`,
`nav_title`, `link_title`, `table_caption` and the other text fields
on an element; `subtitle`, `nav_title`, `abstract`, `description`
and `keywords` on a page. Every other field is the English one by
definition, because a translation is not supposed to change it.

That inheritance is why no `[Translate to Deutsch:]` ever reaches
the artifact — and why an untranslated headline ships English
without looking broken. When you add English text, add the German in
the same edit.

German slugs are generated from the German title, so a renamed page
changes its URL in both languages.

## Working in parallel

One page is one file, so two agents on two pages do not collide.
What is shared:

* `Loader.php` and `Seeder.php` — behaviour, not content. A change
  here affects every page.
* `pages/_categories.yaml`.
* `root.yaml` carries the footer, which every page inherits.
* `sorting` within one parent. Leave gaps of ten so a page can be
  inserted without renumbering its siblings.

Say which pages you are taking before you start, and re-run the
whole seed before you export — a page you did not touch can still
break, because menus, sitemaps and category listings are built from
the tree.

## The grammar this site follows

The site is a demo of the package, so an agent optimizing one page
can quietly break the whole. These are the rules the content follows
today. Change them deliberately and everywhere, or not at all.

**Page headers.** The photo at full opacity, the title on its quiet
side. No `fade` — it drops a photo to one eighth opacity and turns
every page into the same green block.

**Backgrounds.** The page background is the normal case. `light`
groups a section, `quaternary` carries a statement or a call to
action. Those two are all that appears, at most once each per page,
and never two coloured bands in a row. `tertiary` appears exactly
twice, as the embedded box the frames page demonstrates. `dark`,
`primary` and `secondary` are not used as element backgrounds — the
footer is already dark.

**Alignment.** Left is the default. Centred text appears inside a
coloured band and in a page header, nowhere else.

**Section openers.** A section opens with an H2 and a lead
paragraph, and pulls the element after it up by sharing its
background: the opener carries `space_before_class` and the element
after it carries `space_after_class`, with nothing between them. The
opener centres itself inside a coloured band and stays left on the
page background.

**Endings.** A page does not end with the same call to action as
every other. An element page ends with its options accordion, a
feature page with a link to the next one, an overview page with the
quote.

**Explaining.** An element is shown in a situation a real site would
have, with one line saying what it is. The reference belongs in the
options accordion at the end of the page, not in a panel beside
every element, and configuration instructions belong in the manual.

## Traps

**The import runs once.** TYPO3 remembers it in the registry, so a
changed artifact does not reach an installation that already ran the
import. Only an installation that has never seen the package can
judge the artifact.

**The core does not import this artifact as it stands.** `impexp`
hands relations to the DataHandler as `sys_file_reference_6`, and
the localization pass tries to synchronize the translations of file
fields, cannot resolve that string and writes a child record with no
`pid`. The setup dies with

```
DataHandler::addDefaultPermittedLanguageIfNotSet():
Argument #3 ($pageId) must be of type int, null given
```

This reproduces with the artifact from `master` too, so it is not
something the content did. The installation in `.build/vendor` is
patched by hand to skip that pass while importing; the repository
carries no patch, and a `composer install` that reinstalls the core
removes it. Check before trusting a fresh-installation run:

```bash
grep -n 'isImporting' .build/vendor/typo3/cms-core/Classes/DataHandling/DataHandler.php
```

**Four-byte characters are lost.** The setup command opens its
database connection before the charset is configured, so a record
with an emoji in it disappears during the import without a word.
Stay inside the Basic Multilingual Plane.

**A shortcut may not name a page by uid.** Anything the import has
to remap is a risk; a shortcut to the parent page (`shortcut_mode`
3) names nothing and survives. The German start page was a 404 for
exactly that reason.

**Line endings.** The export writes CRLF inside RTE text; git
normalizes `*.xml` to LF. A fresh export therefore differs from the
committed artifact in about 180 lines that carry no change. Compare
with `tr -d '\r'` before reading a diff.

**The files beside the artifact are content-addressed** by sha1 and
marked binary in `.gitattributes`. A rewritten byte breaks the
checksum and the file is lost on import.

**YAML reads bare words as values.** `no`, `yes`, `on`, `off` and
`null` become booleans; a value with a leading zero or a colon
followed by a space needs quotes. When in doubt, quote it, or use a
literal block.

## Seeing it

The installation runs at `https://bootstrap-package.ddev.site`.
Look at a change in a real browser before exporting: a full-page
screenshot at 1440 px and at 390 px, scrolled once to the bottom so
the lazy images load. Write screenshots to `var/`, which git
ignores. A browser in a container reaches the site on the
`ddev_default` network and does not trust the DDEV certificate —
the `any/testing/browser-check` rule of the dev companion has the
invocation.

Read a rendered page, not the YAML: a headline that reads well in a
file can collide with the photo behind it.

## What proves a change

1. `ddev exec php Build/Content/seed.php` writes without a
   DataHandler error. It exits on the first one.
2. The pages you touched render, in both languages, at both widths.
3. The artifact is exported and
   `ddev exec .build/bin/phpunit -c Build/phpunit-functional.xml
   Tests/Functional/Initialisation/DataImportTest.php` passes. It
   imports the artifact and compares what arrives with what the file
   declares — one root page, translations below their parent, one
   file on disk per referenced file.
4. `ddev composer cgl:ci` passes.
5. For a change to the shape of the artifact rather than its words:
   an installation that has never seen the package comes up with
   `typo3 setup` alone, the site answers on `/` and `/de/`, and
   every routable page and referenced asset answers 200.

Report which of these you ran. A seed that wrote without errors is
not evidence that a page renders.
