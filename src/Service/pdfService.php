<?php

namespace App\Service;

use Dompdf\Dompdf;

class pdfService
{
    private $domPdf;

    public function __construct()
    {
        $this->domPdf = new Dompdf();
        $pdfOption = new Option();

        $pdfOption->set('defaultFont','Garamond');
        $this->domPdf->setOptions($pdfOption);
    }
    public function showPdfFile($html){
        $this->domPdf->loadHtml($html);
        $this->domPdf->render();
        $this->domPdf->stream("details.pdf",['Attachement'=> false]);
    }
    public function generateBinaryPDF($html){
        $this->domPdf->loadHtml($html);
        $this->domPdf->render();
        $this->domPdf->output( );
    }
}