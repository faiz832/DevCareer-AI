<?php

namespace App\Services;

use PDF; // Use the alias if registered

class PdfService
{
    public static function generateFromHTML($html, $filePath)
    {
        $pdf = PDF::loadHTML($html);
        $pdf->save($filePath);
    }
}
