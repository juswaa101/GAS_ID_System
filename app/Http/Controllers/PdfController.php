<?php

namespace App\Http\Controllers;

use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new Fpdf('L', 'mm', array(60, 60));
    }

    public function index()
    {
        $signature = asset('upload/e-signature/64081f6d9c184.png');
        $profile = asset('upload/profile/64081f6d9cb5a.jpeg');
        $profile2 = asset('upload\profile\640825a7ced1e.jpeg');

        // $pageWidth = '168';
        // $pageHeight = '270';

        $width = '67.5';
        $height = '86.35';

        // $this->fpdf->Image(file, x, y, width, height);

        // Front Template of ID
        $imageFront = asset('template/FRONT.png');
        $this->fpdf->SetFont('Arial', 'B', 20);
        $this->fpdf->SetTextColor(255, 255, 255);
        $this->fpdf->AddPage("P", [$width, $height]);
        $this->fpdf->Image($profile2, 2, 5, 65, 50);
        $this->fpdf->Image($imageFront, 0, 0, $width, $height);

        // Employee Name and Signature
        $this->fpdf->SetTextColor(0, 0, 0);
        $this->fpdf->SetFont('Arial', 'B', 7);
        $this->fpdf->Text(33, 16, "ID-0101");

        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->SetTextColor(255, 255, 255);
        $this->fpdf->Text(17, 58, "JOSHUA YAACOUB");
        $this->fpdf->Image($signature, 25, 65, 20, 20);
        $this->fpdf->SetFont('Arial', 'B', 12);

        // Back Template Of ID
        $imageBack = asset('template/BACK.jpg');
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->SetTextColor(0, 0, 0);
        $this->fpdf->AddPage("P", [$width, $height]);
        $this->fpdf->Image($imageBack, 0, 0, $width, $height);
        $this->fpdf->Ln(15);


        //Contact Name
        $this->fpdf->SetFont('Arial', 'B', 8);

        $this->fpdf->SetTextColor(0,0,0);
        $this->fpdf->Text(20, 10, "JOSHUA YAACOUB");
        $this->fpdf->SetTextColor(0,0,0);
        $this->fpdf->Text(26, 13, "09053748742");

        // // Contact Name
        // $this->fpdf->Cell(0, 0, "Joshua Yaacoub", 0, 0, 'C');
        // $this->fpdf->Ln(10);

        // // Contact Number
        // // $this->fpdf->Cell(width, height, text, border, ln, align);
        // // $this->fpdf->Cell(0, 0, "09053748742", 0, 0, 'C');

        // $this->fpdf->Cell(0, 0, "09053748742", 0, 0, 'T');
        // $this->fpdf->SetFont('Arial', 'B', 12);
        return view($this->fpdf->Output());
    }
}
