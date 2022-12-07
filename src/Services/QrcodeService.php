<?php

namespace App\Services;
use Endroid\QrCode\Builder\BuilderInterface;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Encoding\Encoding;
class QrcodeService
{
    /**
     * @var BuilderInterface
     */
    protected $builder;
    public function __construct(BuilderInterface $builder)
    {
        $this->builder=$builder;
    }
    public function qrcode($query){
        $url ='https://www.google.com/search?q=';
        $objDateTime =new \DateTime('NOW');
        $dateString = $objDateTime->format('d-m-Y H:i:s');
        //set qr-code
        $resultat =$this ->builder
            ->data($query)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(400)
            ->margin(10)
            ->labelText($dateString)
            ->build()
        ;
        //generate name
        $namePng =uniqid('','') . '.png';

        //save img png
        $resultat->saveToFile((\dirname(__DIR__,2).'/public/assets/qr-code'.$namePng));

        return $resultat->getDataUri();
    }

}