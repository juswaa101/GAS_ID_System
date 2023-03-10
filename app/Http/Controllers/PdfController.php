<?php

namespace App\Http\Controllers;

use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PdfController extends Controller
{
    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new Fpdf('L', 'mm', array(60, 60));
    }

    public function index(Request $request)
    {
        $signature = public_path($this->convertSignature($request));
        $profile = public_path($this->convertImage($request));
        $this->fpdf->AddFont('Calibril', '', 'calibril.php');

        // $width = '54.2378';
        // $height = '86.1';

        define("pageWidth", "54.2378");
        define("pageHeight", "86.1");

        $fontStyle = 'Calibril';

        $IDNumber = $request->employee_id;
        $fullName = $request->name;
        $designation = $request->designate;
        $contactPerson = $request->person_emergency;
        $contactNumber = $request->contact_person;


        // $this->fpdf->Image(file, x, y, width, height);

        // Front Template of ID
        $imageFront = public_path('template/FRONT.png');
        $this->fpdf->SetFont($fontStyle, '', 20);
        $this->fpdf->SetTextColor(255, 255, 255);
        $this->fpdf->AddPage("P", [pageWidth, pageHeight]);
        $this->fpdf->Image($profile, -4.5, 5, 65, 50);
        $this->fpdf->Image($imageFront, 0, 0, pageWidth, pageHeight);

        //ID
        $this->fpdf->SetTextColor(0, 0, 0);
        $this->fpdf->SetFont('Calibril', '', 6.77); // Regular style
        $this->fpdf->Text(27, 15.9, $IDNumber);

        //Name
        $this->fpdf->SetFont($fontStyle, '', 12);
        $this->fpdf->SetTextColor(255, 255, 255);
        $this->fpdf->Text(10, 59, $fullName);


        //Designation
        $this->fpdf->SetFont($fontStyle, '', 11);
        $this->fpdf->SetTextColor(255, 255, 255);
        $this->fpdf->Text(20, 63.5, $designation);

        //Signature
        $this->fpdf->SetFillColor(255, 255, 255);
        $this->fpdf->Image($signature, 18, 67, 20, 20);
        $this->fpdf->SetFont($fontStyle, '', 12);

        // Back Template Of ID
        $imageBack = public_path('template/BACK.jpg');
        $this->fpdf->SetFont($fontStyle, '', 12);
        $this->fpdf->SetTextColor(0, 0, 0);
        $this->fpdf->AddPage("P", [pageWidth, pageHeight]);
        $this->fpdf->Image($imageBack, 0, 0, pageWidth, pageHeight);
        $this->fpdf->Ln(15);


        //Contact Person
        $this->fpdf->SetFont($fontStyle, '', 9);
        $this->fpdf->SetTextColor(0, 0, 0);
        $this->fpdf->Text(16, 9, $contactPerson);

        //Contact Number
        $this->fpdf->SetTextColor(0, 0, 0);
        $this->fpdf->Text(19, 13, $contactNumber);

        // // Contact Name
        // $this->fpdf->Cell(0, 0, "Joshua Yaacoub", 0, 0, 'C');
        // $this->fpdf->Ln(10);

        // // Contact Number
        // // $this->fpdf->Cell(width, height, text, border, ln, align);
        // // $this->fpdf->Cell(0, 0, "09053748742", 0, 0, 'C');

        // $this->fpdf->Cell(0, 0, "09053748742", 0, 0, 'T');
        // $this->fpdf->SetFont($fontStyle, 'B', 12);
        return response($this->fpdf->Output(), 200)->header('Content-type', 'application/pdf');
    }

    public function convertImage($request)
    {
        $imgCamera = $request->image;

        $folderPathCamera = "upload/profile/";

        $imagePartsCamera = explode(";base64,", $imgCamera);

        $imageTypeAux = explode("image/", $imagePartsCamera[0]);

        $imageType = $imageTypeAux[1];

        $image_base64 = base64_decode($imagePartsCamera[0]);

        $fileName = $request->employee_id . '.' . $imageType;

        $file = $folderPathCamera . $fileName;

        return $file;
    }

    public function convertSignature($request)
    {
        $folderPath = 'upload/e-signature/';

        $image_parts = explode(";base64,", $request->signature);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[0]);

        $file = $folderPath . $request->employee_id . '.' . $image_type;

        return $file;
    }
}
