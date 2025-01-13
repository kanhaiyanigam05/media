<?php

use Media\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;

Route::post('upload/url', [MediaController::class, 'uploadUrl'])->name('media.upload.url');
Route::post('media-item', [MediaController::class, 'mediaItem'])->name('media.item');
Route::resource('media', MediaController::class);


Route::post('media-item', function (HttpRequest $request) {
    $media = (object) $request->input('media');
    if (isset($media->created_at)) {
        $media->created_at = Carbon::parse($media->created_at);
    }
    return response()->json([
        'html' => view('components.media-item', compact('media'))->render(),
    ]);
})->name('media.item');
