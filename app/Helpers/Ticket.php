<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class Ticket
{

    /**
     * @param Request $request
     * @param int $id
     * @return array
     */
    public static function filesStore(Request $request, int $id): array
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
    public static function setAttachamentLinks(array $files): array
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
}
