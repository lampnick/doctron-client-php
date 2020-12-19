<?php

use PHPUnit\Framework\TestCase;

require 'vendor/autoload.php';


/**
 * Class DoctronPdfWatermarkTest
 * phpunit --bootstrap src/Doctron.php tests/DoctronPdfWatermarkTest.php
 */
class DoctronPdfWatermarkTest extends TestCase
{
    const domain = "http://47.52.25.206:8080";
    const defaultUsername = "doctron";
    const defaultPassword = "lampnick";
    const pathPrefix = "./tests/data/";
    const pdfUrl = "https://qjhdqx-prod.oss-cn-zhangjiakou.aliyuncs.com/test.pdf";
    const imageUrl = "https://www.tencent.com/img/index/menu_logo.png";

    public function testPdfWatermark()
    {
        $requestDTO = \lampnick\doctron\request\PdfWatermarkRequestDTO::NewDefaultHTML2ImageRequestDTO();
        $requestDTO->url = self::pdfUrl;
        $requestDTO->imageUrl = self::imageUrl;
        $doctron = new \lampnick\doctron\Doctron(self::domain, self::defaultUsername, self::defaultPassword);
        $localFileFullPath = self::pathPrefix . "html2pdf.pdf";
        $doctron->pdfAddWatermark($localFileFullPath, $requestDTO);
        //need ulink file manually.
    }


    public function testPdfWatermarkAndUpload()
    {
        $requestDTO = \lampnick\doctron\request\PdfWatermarkRequestDTO::NewDefaultHTML2ImageRequestDTO();
        $requestDTO->url = self::pdfUrl;
        $requestDTO->uploadKey = "pdfWatermark.pdf";
        $requestDTO->imageUrl = self::imageUrl;
        $doctron = new \lampnick\doctron\Doctron(self::domain, self::defaultUsername, self::defaultPassword);
        $commonResponse = $doctron->pdfAddWatermarkAndUpload($requestDTO);
        $this->assertEquals(
            "https://qjhdqx-prod.oss-cn-zhangjiakou.aliyuncs.com/pdfWatermark.pdf",
            $commonResponse->data
        );

    }

}