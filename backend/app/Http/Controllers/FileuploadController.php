<?php

namespace App\Http\Controllers;

use App\Http\Resources\FileUpload as ResourcesFileUpload;
use App\Http\Resources\FileUploadCollection;
use App\Models\Fileupload;
use App\Models\User;
use App\Notifications\FileScanned;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Image;
use Illuminate\View\View;

class FileuploadController extends Controller
{
    //
    public function index()
    {
    }
    public function create()
    {
    }
    public function storeToken(Request $request, $token)
    {
        $user = User::where('api_token', $token)->first();
        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $image = Image::load($request->file);

        $filenamewithextension = $request->file('file')->getClientOriginalName();

        //get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

        //get file extension
        $extension = $request->file('file')->getClientOriginalExtension();

        //filename to store
        $filenametostore = $filename . '_' . time() . '.' . $extension;

        // Upload File to s3
        // Storage::put($filenametostore, fopen($request->file('file'), 'r+'), 'public');
        // $url = Storage::url($filenametostore);
        // create new fileupload model with filename
        $fileupload = new Fileupload();
        $fileupload->user_id = $user->id;
        $fileupload->filename = $filenametostore;
        $fileupload->height = $image->getHeight();
        $fileupload->width = $image->getWidth();
        $fileupload->addMediaFromRequest('file')->toMediaCollection('default', 's3');
        $fileupload->save();
        logger($fileupload);
        $user->notify((new FileScanned($fileupload))->afterCommit());
        return response()->json([
            'message' => 'Image uploaded successfully',
            // 'filename' => $fileupload->getFirstMedia()->getTemporaryUrl(now()->addMinutes(5)),
            'images' => $fileupload->media()->get()->toArray()
        ]);
    }
    public function store(Request $request)
    {

        //get filename with extension
        $filenamewithextension = $request->file('file')->getClientOriginalName();

        //get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

        //get file extension
        $extension = $request->file('file')->getClientOriginalExtension();

        //filename to store
        $filenametostore = $filename . '_' . time() . '.' . $extension;

        //Upload File to s3
        Storage::put($filenametostore, fopen($request->file('file'), 'r+'), 'public');
        // create new fileupload model with filename
        $fileupload = new Fileupload();
        $fileupload->filename = $filenametostore;
        $fileupload->addMediaFromRequest('file')->toMediaCollection();
        $fileupload->save();
        //Store $filenametostore in the database

        return response()->json([
            'message' => 'Image uploaded successfully',
            'filename' => Storage::temporaryUrl($filenametostore, now()->addMinutes(5))
        ]);

        // $originalName = $request->file('file')->getClientOriginalName();
        // $imageName = time() . '_' . $originalName;
        // $path = $request->file->store(
        //     $imageName,
        //     's3'
        // );
        // dd(Storage::put('images/' . $imageName, $request->file('file')));
        // // $image = Image::make(public_path('images/' . $imageName));
        // $fileupload = new Fileupload();
        // $fileupload->filename = $path;
        // $fileupload->save();
        // Run steghide on the image to check to see if it's possible
        // $fileupload->runSteghide();

    }
    public function destroy($id)
    {
        // delete media with id
        $fileupload = Fileupload::find($id);
        $media = $fileupload->getMedia();
        $media->each->delete();
        $fileupload->delete();
        return Redirect::route('media',)->with('status', 'deleted-success');
    }

    public function list(Request $request)
    {
        $user = Auth::user();
        $media = $user->fileUploads()->paginate(10);
        return view('media', ['media' => $media]);
    }

    public function show(Request $request, $id)
    {
        return view('media-single', [
            'id' => $id,
            'media' => Fileupload::find($id),
        ]);
    }
    public function delete($id)
    {
        $fileupload = Fileupload::find($id);
        Storage::delete('images/' . $fileupload->filename);
        $fileupload->delete();
        return response()->json([
            'message' => 'Image deleted successfully',
            'filename' => $fileupload->filename
        ]);
    }

    public function steg($id)
    {
        $fileupload = Fileupload::find($id);
        $output = $fileupload->runSteghide();
        return response()->json([
            'message' => 'Image steghide',
            'data' => $output
        ]);
    }
}
