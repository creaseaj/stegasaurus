<?php

namespace App\Http\Controllers;

use App\Models\Fileupload;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class FileuploadController extends Controller
{
    //
    public function index()
    {
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time() . '.' . $request->file->extension();
        $request->file->move(public_path('images'), $imageName);
        $image = Image::make(public_path('images/' . $imageName));
        $image->save();
        $fileupload = new Fileupload();
        $fileupload->filename = $imageName;
        $fileupload->save();
        return response()->json([
            'message' => 'Image uploaded successfully',
            'filename' => $imageName
        ]);
    }
    public function list()
    {
        $fileuploads = Fileupload::all();
        return response()->json([
            'message' => 'Image list',
            'data' => $fileuploads
        ]);
    }
    public function show($id)
    {
        return response()->json([
            'message' => 'Image show',
            'data' => Fileupload::find($id)
        ]);
    }
    // public function store(Request $request)
    // {
    //     if ($request->get('file')) {
    //         logger($request);
    //         $image = $request->get('file');
    //         $name = time() . '.' . 'test';

    //         // explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
    //         Image::make($request->get('file'))->save(public_path('images/') . $name);
    //         $fileupload = new Fileupload();
    //         $fileupload->filename = $name;
    //         $fileupload->save();
    //         return response()->json('Successfully added');
    //     }
    // }
    // public function list()
    // {
    //     $fileuploads = Fileupload::all();
    //     return response()->json($fileuploads);
    // }
}
