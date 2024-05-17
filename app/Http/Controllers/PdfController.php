<?php

namespace App\Http\Controllers;

use App\Models\Schoolactivitiesmedicalcertificates;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use App\Models\Sickleavemedicalcertificates;

class PdfController extends Controller
{
    public function generateMedicalCertificate($id)
    {
        try {
            $certificate = Sickleavemedicalcertificates::findOrFail($id);
            $data = [
                'certificate' => $certificate,
                'content' => 'This is a test PDF document generated from an HTML file.'
            ];

            $html = View::make('pdf.sickLeaveCertificate', $data)->render();

            $pdf = PDF::loadHTML($html);
            return $pdf->stream(
                strtoupper(($certificate->patient->student->first_name ?? $certificate->patient->employee->first_name ?? '')) . '_' .
                    strtoupper(($certificate->patient->student->last_name ?? $certificate->patient->employee->last_name ?? '')) .
                    '_MEDICAL_CERTIFICATE.pdf'
            );
        } catch (\Exception $e) {
            throw $e;
        }
    }


    public function generateMedicalCertificateSchoolActivities($id)
    {
        try {
            $certificate = Schoolactivitiesmedicalcertificates::findOrFail($id);
            $data = [
                'certificate' => $certificate,
                'content' => 'This is a test PDF document generated from an HTML file.'
            ];

            $html = View::make('pdf.sickLeaveCertificate', $data)->render();

            $pdf = PDF::loadHTML($html);
            return $pdf->stream(
                strtoupper(($certificate->patient->student->first_name ?? $certificate->patient->employee->first_name ?? '')) . '_' .
                    strtoupper(($certificate->patient->student->last_name ?? $certificate->patient->employee->last_name ?? '')) .
                    '_MEDICAL_CERTIFICATE.pdf'
            );
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
