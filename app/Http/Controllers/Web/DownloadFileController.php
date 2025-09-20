<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\DownloadFileService;

class DownloadFileController extends Controller
{
    public function __construct(private readonly DownloadFileService $downloadFileService) {}

    /**
     * @throws \Exception
     */
    public function downloadFile($ticketId, $mediaId)
    {
        $media = $this->downloadFileService->getMediaForDownload((int)$mediaId, $ticketId);
        return response()->download($media->getPath(), $media->file_name);
    }
}
