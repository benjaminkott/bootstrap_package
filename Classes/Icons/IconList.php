<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Icons;

/**
 * IconList
 */
class IconList
{
    /**
     * @var IconInterface[] $icons
     */
    protected $icons = [];

    /**
     * @return IconInterface[]
     */
    public function getIcons(): array
    {
        return $this->icons;
    }

    /**
     * @param IconInterface $icon
     * @return self
     */
    public function addIcon(IconInterface $icon): self
    {
        $this->icons[$icon->getIdentifier()] = $icon;
        return $this;
    }

    /**
     * @param IconInterface $icon
     * @return self
     */
    public function removeIcon(IconInterface $icon): self
    {
        if (isset($this->icons[$icon->getIdentifier()])) {
            unset($this->icons[$icon->getIdentifier()]);
        }
        return $this;
    }

    /**
     * @param string $identifier
     * @return IconInterface|null
     */
    public function getIcon(string $identifier): ?IconInterface
    {
        return $this->icons[$identifier] ?? null;
    }
}
