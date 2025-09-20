<?php

namespace App\Repositories;

use App\Models\Ticket;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DownloadFileRepository
{
    public function findById(int $mediaId): ?Media
    {
        return Media::find($mediaId);
    }

    public function belongsToTicket(int $mediaId, int $ticketId): bool
    {
        $media = $this->findById($mediaId);
        return $media && $media->model_type === Ticket::class && $media->model_id === $ticketId;
    }
}
