<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class IDTemplateController extends Controller
{
    //
    public function getIDTemplate(Request $request, $id = "", $name = "", $designation = "", $contact_name = "", $contact_number = "")
    {
        $params = [
            "id" => $id,
            "name" => $name,
            "designation" => $designation,
            "contact_name" => $contact_name,
            "contact_number" => $contact_number,
        ];
        try {
            return view('stepper', $params);
        } catch (\Exception $e) {
            abort(404);
        }
    }


    public function upload(Request $request)
    {
        if ($request->get("form_position") == "0") {
            try {
                $validate = Validator::make($request->all(), [
                    'employee_id' => 'required|numeric',
                    'name' => 'required',
                    'person_emergency' => 'required',
                    'contact_person' => 'required|numeric|digits:11|starts_with:09|bail',
                ]);

                if ($validate->fails()) {
                    return response()->json(['status' => 400, 'error' => $validate->getMessageBag()]);
                } else {
                    try {
                        return response()->json(['status' => 200, 'msg' => 'Validated', 'pos' => 0]);
                    } catch (\Exception $e) {
                        abort(500, 'Something Went Wrong');
                    }
                }
            } catch (\Exception $e) {
                abort(500, 'Something Went Wrong');
            }
        } else if ($request->get("form_position") == "1") {
            try {
                $validate = Validator::make($request->all(), [
                    'signature' => 'required',
                ]);

                if ($validate->fails()) {
                    return response()->json(['status' => 400, 'error' => $validate->getMessageBag()]);
                } else {
                    try {
                        return response()->json(['status' => 200, 'msg' => 'Validated', 'pos' => 0]);
                    } catch (\Exception $e) {
                        abort(500, 'Something Went Wrong');
                    }
                }
            } catch (\Exception $e) {
                abort(500, 'Something Went Wrong');
            }
        } else if ($request->get("form_position") == "2") {


            try {
                $validate = Validator::make($request->all(), [
                    'employee_id' => 'required|numeric',
                    'name' => 'required',
                    'font_style' => 'required',
                    'font_size' => 'required',
                    'person_emergency' => 'required',
                    'contact_person' => 'required|numeric|digits:11|starts_with:09|bail',
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

                        $contactInfo = Storage::disk('local')->exists('/json/gasid.json') ? json_decode(Storage::disk('local')->get('/json/gasid.json'), true) : [];

                        $name = $request->name;
                        $employee_id = $request->employee_id;
                        $designate = $request->designate;
                        $person_emergency = $request->person_emergency;
                        $contact_person = $request->contact_person;
                        $format_contactNumber = substr($contact_person, 0, 4) . "-" . substr($contact_person, 4, 3) . "-" . substr($contact_person, 7);
                        $profile = "upload/profile/" . $request->employee_id . ".jpeg";
                        $signature = "upload/e-signature/" . $request->employee_id . ".png";

                        $data = [
                            "employee_id" => $employee_id,
                            "name" => $name,
                            "designation" => $designate,
                            "contact_person" => $person_emergency,
                            "contact_person_number" => $format_contactNumber,
                            "profile" => $profile,
                            "signature" => $signature,
                            "created_at" => date('Y-m-d H:i:s')
                        ];

                        $isExists = false;
                        $contactIndex = 0;

                        foreach ($contactInfo as $key => $contact) {
                            if ($contact["employee_id"] == $data["employee_id"]) {
                                $isExists = true;
                                $contactIndex = $key;
                            }
                        }

                        if (!$isExists) {
                            array_push($contactInfo, $data);
                        } else {
                            $contactInfo[$contactIndex] = $data;
                        }

                        Storage::disk('local')->put('/json/gasid.json', json_encode($contactInfo));



                        return response()->json(['status' => 200, 'msg' => 'Uploaded Successfully!']);
                    } catch (\Exception $e) {
                        abort(500, 'Something Went Wrong');
                    }
                }
            } catch (\Exception $e) {
                abort(500, 'Something Went Wrong');
            }
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
