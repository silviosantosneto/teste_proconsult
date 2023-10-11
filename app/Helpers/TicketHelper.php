<?php

namespace App\Helpers;

use App\Http\Requests\StoreRequest;
use App\Models\TicketReply;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class TicketHelper
{

    /**
     * @param StoreRequest $request
     * @param int $id
     * @return array
     */
    public static function storeFiles(StoreRequest $request, int $id): array
    {
        $files = [];
        if ($request->hasFile('files')) {
            $requestFiles = $request->files->get('files');
            foreach ($requestFiles as $key => $file) {
                $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $fileNameToStore = $filename . '_' . time() . '.' . $file->getClientOriginalExtension();
                $request->file('files')[$key]->storeAs($id . '/', $fileNameToStore, 'public');
                $files[] = $id . '/' . $fileNameToStore;
            }
        }
        return $files;
    }

    /**
     * @param array $files
     * @return array
     */
    public static function setAttachmentLinks(array $files): array
    {
        $links = [];
        foreach ($files as $key => $file) {
            $links[] = [
                'name' => 'Anexo ' . $key + 1,
                'url' => env('APP_URL') . '/storage/' . ($file)
            ];
        }
        return $links;
    }

    /**
     * @param int $id
     * @return Collection
     */
    public static function getTicketReplies(int $id): Collection
    {
        $replies = TicketReply::where('ticket_id', $id)->get();
        foreach ($replies as $reply) {
            if ($reply->files !== []) {
                $reply->links = self::setAttachmentLinks($reply->files);
            }
        }
        return $replies;
    }
}
