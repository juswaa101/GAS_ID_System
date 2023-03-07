<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignaturePadController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function upload(Request $request)
    {
        $this->validate($request, [
            'signed' => 'required',
            'image' => 'required',
        ]);

        // upload signature from textarea after saving
        $this->uploadSignature($request);

        // upload photo from camera after saving
        $this->uploadCamera($request);

        return back()->with('success', 'Uploaded Successfully');
    }

    public function uploadCamera($request)
    {
        $imgCamera = $request->image;
        $folderPathCamera = "upload/profile/";

        $imagePartsCamera = explode(";base64,", $imgCamera);
        $imageTypeAux = explode("image/", $imagePartsCamera[0]);
        $imageType = $imageTypeAux[1];

        $image_base64 = base64_decode($imagePartsCamera[1]);
        $fileName = uniqid() . '.png';

        $file = $folderPathCamera . $fileName;
        file_put_contents($file, $image_base64);
    }

    public function uploadSignature($request)
    {
        $folderPath = public_path('upload/e-signature/');

        $image_parts = explode(";base64,", $request->signed);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);

        $file = $folderPath . uniqid() . '.' . $image_type;
        file_put_contents($file, $image_base64);
    }
}
