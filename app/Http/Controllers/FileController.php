<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\FilesystemInterface;
use Laravel\Lumen\Routing\Controller as BaseController;

use App\Http\Requests\UploadRequest;

class FileController extends BaseController
{
    public function writeFile () 
    {
    	$storagePath = Storage::disk('local')->put('file.txt', 'Hello Suni Chauhan2');
    	$storageName = basename($storagePath);

    	var_dump($storageName);
    }

    public function readFile ($filename) 
    {
    	$data = Storage::disk('local')->get($filename);
    	echo $data;
    }

    public function store (Request $request, FilesystemInterface $filesystem) 
    {
    	$file = $request->file('upload');
        $stream = fopen($file->getRealPath(), 'r+');
        $filesystem->writeStream(
            'uploads/'.$file->getClientOriginalName(),
            $stream
        );
        fclose($stream);
    }

    public function uploadForm ()
    {
    	return view('upload_form');
    }

    public function uploadSubmit (Request $request) 
    {
    	$file = $request->file('upload');
        $stream = fopen($file->getRealPath(), 'r+');
        $filesystem->writeStream(
            'uploads/'.$file->getClientOriginalName(),
            $stream
        );
        fclose($stream);
    }


    public function upload (UploadRequest $request)
    {
        //$product = Product::create($request->all());
        foreach ($request->photos as $photo) {
            $filename = $photo->store('beaches');
            // ProductsPhoto::create([
            //     'product_id' => $product->id,
            //     'filename' => $filename
            // ]);
        }
        return 'Upload successful!';
    }

}
