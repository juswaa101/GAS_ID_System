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
        $imageFront = asset('template/FRONT.png');

        // Front Template of ID
        $this->fpdf->SetFont('Arial', 'B', 20);
        $this->fpdf->SetTextColor(255, 255, 255);
        $this->fpdf->AddPage("P", ['168', '270']);
        $this->fpdf->Image($profile, 30, 40, 150, 150);
        $this->fpdf->Image($imageFront, 0, 0, 0, 0);

        // Employee Name and Signature
        $this->fpdf->SetTextColor(0, 0, 0);
        $this->fpdf->Text(85, 50, "ID-0101", 0, 0);

        $this->fpdf->SetTextColor(255, 255, 255);
        $this->fpdf->Text(55, 185, "JOSHUA YAACOUB", 0, 0);
        $this->fpdf->Image($signature, 30, 200, 0, 0);
        $this->fpdf->SetFont('Arial', 'B', 25);

        // Back Template Of ID
        $imageBack = asset('template/BACK.jpg');
        $this->fpdf->SetFont('Arial', 'B', 20);
        $this->fpdf->SetTextColor(0, 0, 0);
        $this->fpdf->AddPage("P", ['168', '270']);
        $this->fpdf->Image($imageBack, 0, 0, 0, 0);
        $this->fpdf->Ln(15);

        // Contact Name
        $this->fpdf->Cell(0, 0, "Joshua Yaacoub", 0, 0, 'C');
        $this->fpdf->Ln(10);

        // Contact Number
        $this->fpdf->Cell(0, 0, "09053748742", 0, 0, 'C');
        $this->fpdf->SetFont('Arial', 'B', 25);
        return view($this->fpdf->Output());
    }
}
