<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Service;

use TYPO3\CMS\Core\Resource\Event\AfterFileProcessingEvent;
use TYPO3\CMS\Core\Resource\ProcessedFile;

/**
 * Collects the files processed during the request, keyed by their public
 * URL, so a template can ask for the dimensions behind an image URI.
 */
final class ImageInfoService
{
    /**
     * @var array<string, ProcessedFile>
     */
    private array $processedFiles = [];

    public function __invoke(AfterFileProcessingEvent $event): void
    {
        $processedFile = $event->getProcessedFile();
        $publicUrl = $processedFile->getPublicUrl();
        if ($publicUrl !== null) {
            $this->processedFiles[$publicUrl] = $processedFile;
        }
    }

    /**
     * The URI a template holds may carry a prefix, so the match is by
     * containment rather than by equality.
     */
    public function findByUri(string $uri): ?ProcessedFile
    {
        foreach ($this->processedFiles as $publicUrl => $processedFile) {
            if (str_contains($uri, $publicUrl)) {
                return $processedFile;
            }
        }

        return null;
    }
}
