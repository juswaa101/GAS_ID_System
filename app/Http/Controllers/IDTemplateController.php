<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IDTemplateController extends Controller
{
    //
    public function getIDTemplate()
    {
        try {
            return view('id-template');
        } catch (\Exception $e) {
            abort(404);
        }
    }


    public function upload(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'employee_id' => 'required',
                'designate' => 'required',
                'rfid' => 'required',
                'name' => 'required',
                'font_style' => 'required',
                'font_size' => 'required',
                'person_emergency' => 'required',
                'contact_person' => 'required|max:11',
                'signature' => 'required',
                'image' => 'required'
            ]);

            if ($validate->fails()) {
                return response()->json(['status' => 400, 'error' => $validate->getMessageBag()]);
            } else {
                try {
                    // upload signature from textarea after saving
                    $this->uploadSignature($request);

                    // upload photo from camera after saving
                    $this->uploadCamera($request);

                    return response()->json(['status' => 200, 'msg' => 'Uploaded Successfully!']);
                } catch (\Exception $e) {
                    abort(500, 'Server Error');
                }
            }
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function uploadCamera($request)
    {
        $imgCamera = $request->image;
        $folderPathCamera = "upload/profile/";

        $imagePartsCamera = explode(";base64,", $imgCamera);
        $imageTypeAux = explode("image/", $imagePartsCamera[0]);
        $imageType = $imageTypeAux[1];

        $image_base64 = base64_decode($imagePartsCamera[1]);
        $fileName = $request->employee_id . '.' . $imageType;

        $file = $folderPathCamera . $fileName;
        file_put_contents($file, $image_base64);
    }

    public function uploadSignature($request)
    {
        $folderPath = public_path('upload/e-signature/');

        $image_parts = explode(";base64,", $request->signature);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);

        $file = $folderPath . $request->employee_id . '.' . $image_type;
        file_put_contents($file, $image_base64);
    }
}
