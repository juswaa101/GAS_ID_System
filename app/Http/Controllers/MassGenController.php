<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

class MassGenController extends Controller
{
    //
    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new Fpdf('L', 'mm', array(60, 60));
    }

    public function index(Request $request)
    {
        return view("mass-generate");
    }

    public function readJSON(Request $request)
    {
        try {
            $path = storage_path() . "/json/gasid.json";

            // $data = json_decode(file_get_contents($path), true);
            $data = json_decode(file_get_contents($path));
            return response()->json(['status' => 200, 'msg' => 'Success', 'data' => $data]);
        } catch (\Exception $e) {
            abort(500, 'Something Went Wrong');
        }
    }

    public function generatePDF(Request $request){




        define("pageWidth", "54.2378");
        define("pageHeight", "86.1");
        $this->fpdf->AddFont('calibri light', '', 'calibril.php');

        $path = storage_path() . "/json/gasid.json";

        $data = json_decode(file_get_contents($path), true);

        $selected = $request->get("checked");

        foreach($selected as $key_selected => $select){
            foreach($data as $key_data => $record){
                if($record["employee_id"] == $select){
                    $signature = public_path($record["signature"]);
                    $profile = public_path($record["profile"]);

                    $fontStyle = "Calibri Light";
                    $IDNumber = $record["employee_id"];
                    $fullName = iconv('UTF-8', 'windows-1252', html_entity_decode($record["name"]));
                    $designation = $record["designation"];
                    $contactPerson =  iconv('UTF-8', 'windows-1252', html_entity_decode($record["contact_person"]));
                    $contactNumber = $record["contact_person_number"];

                    // Front Template of ID
                    $imageFront = public_path('template/FRONT.png');
                    $this->fpdf->SetFont($fontStyle, '', 20);
                    $this->fpdf->SetTextColor(255, 255, 255);
                    $this->fpdf->AddPage("P", [pageWidth, pageHeight]);

                    //Image
                    if (file_exists(public_path($record["profile"]))) {
                        $this->fpdf->Image($profile, 5.5, 16.7, 45, 35); //new
                    }

                    // $this->fpdf->Image($profile, -5, 17, 60, 50);
                    $this->fpdf->Image($imageFront, 0, 0, pageWidth, pageHeight);

                    //ID
                    $this->fpdf->SetTextColor(29, 85, 108);
                    $this->fpdf->SetFont($fontStyle, '', 6.77); // Regular style
                    $this->fpdf->Text(27, 15.8, $IDNumber);

                    //Name
                    $this->fpdf->SetFont($fontStyle, '', $this->setFontSize(mb_strlen($fullName)));
                    $this->fpdf->SetTextColor(255, 255, 255);
                    $this->fpdf->SetY(55);
                    $this->fpdf->SetX(0);
                    $this->fpdf->Cell(pageWidth, 5, strtoupper($fullName), 0, 0, 'C');


                    //Designation
                    $check_designation = strtolower($designation);
                    if ($check_designation != "data entry specialist") {
                        $this->fpdf->SetFont($fontStyle, '', $this->setFontSize(mb_strlen($fullName)) - 1);
                        $this->fpdf->SetTextColor(255, 255, 255);
                        $this->fpdf->SetY(60);
                        $this->fpdf->SetX(0);
                        $this->fpdf->Cell(pageWidth, 5, strtoupper($designation), 0, 0, 'C');
                    }

                    //Signature
                    $this->fpdf->SetFillColor(255, 255, 255);

                    // $this->fpdf->Image($signature, 18, 67, 20, 20);
                    if (file_exists(public_path($record["signature"]))) {
                        $this->fpdf->Image($signature, 11, 67.35, 0, 12);
                    }
                    $this->fpdf->SetFont($fontStyle, '', 12);

                    // Back Template Of ID
                    $imageBack = public_path('template/BACK.jpg');
                    $this->fpdf->SetFont($fontStyle, '', 12);
                    $this->fpdf->SetTextColor(0, 0, 0);
                    $this->fpdf->AddPage("P", [pageWidth, pageHeight]);
                    $this->fpdf->Image($imageBack, 0, 0, pageWidth, pageHeight);
                    $this->fpdf->Ln(15);

                    //Contact Person
                    $this->fpdf->SetFont($fontStyle, '', $this->setFontSize_back(mb_strlen($contactPerson)));
                    $this->fpdf->SetTextColor(29, 85, 108);

                    $this->fpdf->SetY(6);
                    $this->fpdf->SetX(0);
                    $this->fpdf->Cell(pageWidth, 5, strtoupper($contactPerson), 0, 0, 'C');

                    //Contact Number
                    $this->fpdf->SetFont($fontStyle, '', $this->setFontSize_back(mb_strlen($contactPerson)));
                    $this->fpdf->SetTextColor(29, 85, 108);
                    $this->fpdf->SetY(9);
                    $this->fpdf->SetX(0);
                    $this->fpdf->Cell(pageWidth, 6, $contactNumber, 0, 0, 'C');

                    break;
                }
            }
        }

        $this->fpdf->Output();
    }

    public function setFontSize(int $length)
    {
        if ($length >= 20 && $length <= 24) {
            return 11;
        } elseif ($length >= 25 && $length <= 29) {
            return 10;
        } elseif ($length >= 30) {
            return 9;
        } else {
            return 12;
        }
    }

    public function setFontSize_back(int $length)
    {
        if ($length >= 20 && $length <= 24) {
            return 10;
        } elseif ($length >= 25 && $length <= 29) {
            return 8;
        } elseif ($length >= 30) {
            return 7;
        } else {
            return 9;
        }
    }
}
