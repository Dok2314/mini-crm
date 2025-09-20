<?php

namespace App\Services;

use App\Repositories\DownloadFileRepository;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Exception;

class DownloadFileService
{
    public function __construct(private readonly DownloadFileRepository $repository) {}

    /**
     * @throws Exception
     */
    public function getMediaForDownload(int $mediaId, ?int $ticketId = null): Media
    {
        $media = $this->repository->findById($mediaId);

        if (!$media) {
            throw new Exception('Файл не найден');
        }

        if ($ticketId && !$this->repository->belongsToTicket($mediaId, $ticketId)) {
            throw new Exception('Файл не принадлежит данной заявке');
        }

        return $media;
    }
}
