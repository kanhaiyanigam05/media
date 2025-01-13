<?php

namespace Media\Http\Controllers;

use Media\Models\Media;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('media');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpeg,png,jpg,gif,webp,svg,mp4',
        ]);

        try {
            $file = $request->file('file');
            $fileData = $this->storeFile($file);
            $fileData->created_at_formatted = $fileData->created_at->format('d F Y');
            $fileData->url = asset($fileData->file);
            return response()->json([
                'success' => true,
                'file' => $fileData,
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Upload failed',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $image = Media::findOrFail($id);
        $image->image = $image->image;
        $image->created_at = $image->created_at->format('Y-m-d H:i');
        $image->updated_at = $image->updated_at->format('Y-m-d H:i');
        return response()->json($image);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $media = Media::findOrFail($id);

        try {
            // Update the file details
            $this->updateFile($media, $request); // Assume it updates and persists changes to $media

            // Prepare the formatted response
            $media->created_at_formatted = $media->created_at?->format('d F Y');
            $media->url = asset($media->image);

            return response()->json([
                'success' => true,
                'message' => 'Media updated successfully.',
                'data' => $media,
            ], 200);
        } catch (Exception $e) {
            Log::error('Media Update Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Media update failed. Please try again.',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $image = Media::findOrFail($id);
        if (unlink(public_path($image->image))) {
            // File deleted successfully
        }
        $image->delete();
        return redirect()->back()->with('success', 'Image deleted successfully');
    }
    public function uploadUrl(Request $request)
    {
        $mediaFiles = [];
        // Split URLs from the textarea into an array
        $urls = explode("\n", $request->input('media'));

        foreach ($urls as $i => $url) {
            $url = trim($url); // Remove any extra spaces or commas

            if (filter_var($url, FILTER_VALIDATE_URL)) {
                try {
                    // Download the content from the URL
                    $response = Http::get($url);

                    if ($response->successful()) {
                        // Generate a unique file name
                        $filename = uniqid() . '-' . basename($url);

                        // Store the file in the 'uploads' directory
                        Storage::put("uploads/$filename", $response->body());

                        // Extract the file name without the extension
                        $nameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);

                        // Determine the file type (image, video, other)
                        $fileType = str_contains(mime_content_type(Storage::path("uploads/$filename")), 'image') ? 'image' : (str_contains(mime_content_type(Storage::path("uploads/$filename")), 'video') ? 'video' : 'other');

                        // Store the image data in the database
                        $imageData = Media::create([
                            'image' => "uploads/$filename",
                            'alt' => $nameWithoutExtension,
                            'title' => $nameWithoutExtension,
                            'type' => $fileType
                        ]);
                        // Format the data for returning to the client
                        // $mediaFiles[] = $imageData;
                        $mediaFiles[] = $imageData;
                    }
                } catch (\Exception $e) {
                    // Handle error
                    return response()->json(['error' => "Failed to download file from $url"]);
                }
            } else {
                return response()->json(['error' => "Invalid URL: $url"]);
            }
        }

        return response()->json(['files' => $mediaFiles, 'message' => 'Files uploaded successfully!']);
    }

    private function storeFile($image)
    {
        $mimeType = $image->getMimeType();
        $fileType = str_contains($mimeType, 'image') ? 'image' : (str_contains($mimeType, 'video') ? 'video' : 'other');
        $originalName = $image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        $nameWithoutExtension = pathinfo($originalName, PATHINFO_FILENAME);
        $slugName = str()->slug(strtolower($nameWithoutExtension));
        $uniqueId = uniqid();
        $newImageName = $slugName . '-' . $uniqueId . '.' . $extension;
        $image->move(public_path('uploads/'), $newImageName);
        $imageData = Media::create([
            'image' => "uploads/$newImageName",
            'alt' => $nameWithoutExtension,
            'title' => $nameWithoutExtension,
            'type' => $fileType
        ]);
        return $imageData;
    }
    private function updateFile($media, $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $mimeType = $image->getMimeType();
            $fileType = str_contains($mimeType, 'image') ? 'image' : (str_contains($mimeType, 'video') ? 'video' : 'other');
            $originalName = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $nameWithoutExtension = pathinfo($originalName, PATHINFO_FILENAME);
            $slugName = str()->slug(strtolower($nameWithoutExtension));
            $uniqueId = uniqid();
            $newImageName = "$slugName-$uniqueId.$extension";
            $image->move(public_path('uploads/'), $newImageName);


            $media->image = "uploads/$newImageName";
            $media->type = $fileType;
        }
        $media->alt = $request->input('alt');
        $media->title = $request->input('title');
        $media->update();

        return $media;
    }
}