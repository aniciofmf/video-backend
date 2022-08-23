<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\FileShare;
use Illuminate\Support\Str;
use App\Http\Resources\FileResource;
use Illuminate\Support\Facades\Storage;


class FileShareController extends Controller
{
    public function __construct() {
        $this->middleware(['auth:sanctum'])->only('createShareURL');
    }

    public function createShareURL(Request $request, File $file) {
        $this->authorize('create-link', $file);
        
        $token = hash_hmac('sha256', Str::random(40), $file->uuid);
        
        $shareLink = $file->link()->firstOrCreate([], [
            'token' => $token
        ]);

        
        return [
            'data' => [
                'url' => config('app.client_url') . "/download/" . $file->uuid . '?token=' . $shareLink->token 
            ]
        ];        
    }

    public function downloadFile(Request $request, File $file) {
        $fileShare = FileShare::where('token', $request->token)
            ->where('file_id', $file->id)
            ->firstOrFail();

        return (new FileResource($file))->additional([
            'metadata' => [
                'url' => Storage::disk('s3')->temporaryUrl(
                    $file->path, 
                    now()->addHours(24), 
                    ['ResponseContentDisposition' => 'attachment; filename=' . $file->name]
                )
            ]
        ]);
    }
}
