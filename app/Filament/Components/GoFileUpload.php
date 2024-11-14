<?php

namespace App\Filament\Components;

use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Arr;
use League\Flysystem\UnableToCheckFileExistence;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Throwable;

class GoFileUpload extends FileUpload
{
    protected function setUp(): void
    {
        parent::setUp();

        // Removed file existance check from here
        $this->afterStateHydrated(static function (BaseFileUpload $component, string | array | null $state): void {

            if (blank($state)) {
                $component->state([]);

                return;
            }

            $files = collect(Arr::wrap($state))
                ->filter(static function (string $file): bool {
                    if (blank($file)) {
                        return false;
                    }

                    return true;
                })
                ->mapWithKeys(static fn(string $file): array => [((string) Str::uuid()) => $file])
                ->all();

            $component->state($files);
        });

        // Returning url if it stored as url or it stored from go server. And substr our files indicator prefix
        $this->getUploadedFileUsing(static function (BaseFileUpload $component, string $file, string | array | null $storedFileNames): ?array {
            // just plain urls
            if (Str::isUrl($file)) {
                return [
                    'name' => basename($file),
                    'size' => 0,
                    'type' =>  null,
                    'url' => $file,
                ];
            }

            // for files uploaded from golang service
            if (!Str::startsWith($file, 'laravel://')) {
                $goServiceUrl = config('services.go-service.url');
                $url = $goServiceUrl . '/images/' . $file;

                return [
                    'name' => basename($url),
                    'size' => 5120,
                    'type' => "image/jpg",
                    'url' => $url,
                ];
            }

            // For local files
            if (Str::startsWith($file, 'laravel://')) {
                $file = Str::substr($file, Str::length('laravel://'));
            }

            /** @var FilesystemAdapter $storage */
            $storage = $component->getDisk();

            $shouldFetchFileInformation = $component->shouldFetchFileInformation();

            if ($shouldFetchFileInformation) {
                try {
                    if (! $storage->exists($file)) {
                        return null;
                    }
                } catch (UnableToCheckFileExistence $exception) {
                    return null;
                }
            }

            $url = null;

            if ($component->getVisibility() === 'private') {
                try {
                    $url = $storage->temporaryUrl(
                        $file,
                        now()->addMinutes(5),
                    );
                } catch (Throwable $exception) {
                    // This driver does not support creating temporary URLs.
                }
            }

            $url ??= $storage->url($file);

            return [
                'name' => ($component->isMultiple() ? ($storedFileNames[$file] ?? null) : $storedFileNames) ?? basename($file),
                'size' => $shouldFetchFileInformation ? $storage->size($file) : 0,
                'type' => $shouldFetchFileInformation ? $storage->mimeType($file) : null,
                'url' => $url,
            ];
        });

        // Prepending our files indicator
        $this->saveUploadedFileUsing(static function (BaseFileUpload $component, TemporaryUploadedFile $file): ?string {
            try {
                if (! $file->exists()) {
                    return null;
                }
            } catch (UnableToCheckFileExistence $exception) {
                return null;
            }

            if (
                $component->shouldMoveFiles() &&
                ($component->getDiskName() == (fn(): string => $this->{"disk"})->call($file))
            ) {
                $newPath = trim($component->getDirectory() . '/' . $component->getUploadedFileNameForStorage($file), '/');

                $component->getDisk()->move((fn(): string => $this->{"path"})->call($file), $newPath);

                return $newPath;
            }

            $storeMethod = $component->getVisibility() === 'public' ? 'storePubliclyAs' : 'storeAs';

            return "laravel://" . $file->{$storeMethod}(
                $component->getDirectory(),
                $component->getUploadedFileNameForStorage($file),
                $component->getDiskName(),
            );
        });
    }

    /**
     * Gets proper image url from path or url.
     * Including go server as default if not.
     */
    public static function getImageUrl(?string $image)
    {
        if (Str::isUrl($image)) {
            return $image;
        }

        if (Str::startsWith($image, 'laravel://')) {
            $path = Str::substr($image, Str::length('laravel://'));
            return asset('storage/' . $path);
        }

        return config('services.go-service.url') . '/images/' . $image;
    }
}
