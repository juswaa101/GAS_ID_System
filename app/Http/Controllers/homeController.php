<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homeController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = $request->session()->get("data");

        return view("home")->with("data", $data);
    }

    public function importFile(Request $request)
    {
        $file = $request->file('upload_file');

        // check if file is not empty
        if ($file) {
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension(); //Get extension of uploaded file

            // check if file is csv or excel file
            if (!in_array($extension, array("csv", "xlsx", "xls"))) {
                return response()->json(['error' => '.csv, .xlsx, .xls are only file extension that is allowed', 'status' => 400]);
            }

            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize(); //Get size of uploaded file in bytes

            // check if file is greater than 10mb
            if ($fileSize > 10000000) {
                return response()->json(['error' => 'File is too big, please upload less than 10mb', 'status' => 400]);
            }

            //Where uploaded file will be stored on the server
            $location = 'files'; //Created an "uploads" folder for that
            // Upload file
            $file->move($location, $filename);

            // In case the uploaded file path is to be stored in the database
            $filepath = public_path($location . "/" . $filename);

            // Reading file
            $file = fopen($filepath, "r");
            $importData_arr = array(); // Read through the file and store the contents as an array
            $i = 0;
            //Read the contents of the uploaded file
            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                $num = count($filedata);

                // Skip first row (Remove below comment if you want to skip the first row)
                if ($i == 0) {
                    $i++;
                    continue;
                }
                for ($c = 0; $c < $num; $c++) {
                    $importData_arr[$i][] = mb_convert_encoding($filedata[$c], 'UTF-8', 'ISO-8859-1');
                }
                $i++;
            }

            //Close after reading
            fclose($file);

            return response()->json(['data' => $importData_arr, 'status' => 200]);
        } else {
            return response()->json(['error' => 'Upload File is Required', 'status' => 400]);
        }
    }
}
