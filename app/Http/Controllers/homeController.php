<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homeController extends Controller
{
    //
    public function index(Request $request){
        $data = $request->session()->get("data");

        return view("home")->with("data", $data);
    }

    public function importFile(Request $request)
    {
        $file = $request->file('upload_file');
        $this->validate($request, [
            'upload_file' => 'required|mimes:csv,xlsx'
        ]);

        if ($file) {
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension(); //Get extension of uploaded file
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize(); //Get size of uploaded file in bytes

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
                    $importData_arr[$i][] = $filedata[$c];
                }
                $i++;
            }
            fclose($file); //Close after reading
            // return view('index')->with('data', $importData_arr);
            return redirect("/")->with("data", $importData_arr);





            // $j = 0;
            // foreach ($importData_arr as $importData) {
            //     $name = $importData[1]; //Get user names
            //     $email = $importData[3]; //Get the user emails
            //     $j++;
            //     try {
            //         DB::beginTransaction();
            //         Player::create([
            //             'name' => $importData[1],
            //             'club' => $importData[2],
            //             'email' => $importData[3],
            //             'position' => $importData[4],
            //             'age' => $importData[5],
            //             'salary' => $importData[6]
            //         ]);
            //         //Send Email
            //         $this->sendEmail($email, $name);
            //         DB::commit();
            //     } catch (\Exception $e) {
            //         //throw $th;
            //         DB::rollBack();
            //     }
            // }
            // return response()->json([
            //     'message' => "$j records successfully uploaded"
            // ]);
        }
    }
}
