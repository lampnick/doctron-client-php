<?php

use PHPUnit\Framework\TestCase;

require 'vendor/autoload.php';


/**
 * Class DoctronHtml2PdfTest
 * phpunit --bootstrap src/Doctron.php tests/DoctronHtml2PdfTest.php
 */
class DoctronHtml2PdfTest extends TestCase
{
    const domain = "http://47.52.25.206:8080";
    const defaultUsername = "doctron";
    const defaultPassword = "lampnick";
    const pathPrefix = "./tests/data/";

    public function testHtml2Pdf()
    {
        $requestDTO = \lampnick\doctron\request\HTML2PdfRequestDTO::NewDefaultHTML2PdfRequestDTO();
        $requestDTO->url = "http://doctron.lampnick.com/doctron.html";
        $doctron = new \lampnick\doctron\Doctron(self::domain, self::defaultUsername, self::defaultPassword);
        $localFileFullPath = self::pathPrefix . "html2pdf.pdf";
        $doctron->html2Pdf($localFileFullPath, $requestDTO);
        //need ulink file manually.
    }


    public function testHtml2PdfAndUpload()
    {
        $requestDTO = \lampnick\doctron\request\HTML2PdfRequestDTO::NewDefaultHTML2PdfRequestDTO();
        $requestDTO->url = "http://doctron.lampnick.com/doctron.html";
        $requestDTO->uploadKey = "test.pdf";
        $doctron = new \lampnick\doctron\Doctron(self::domain, self::defaultUsername, self::defaultPassword);
        $commonResponse = $doctron->html2PdfAndUpload($requestDTO);
        $this->assertEquals(
            "https://qjhdqx-prod.oss-cn-zhangjiakou.aliyuncs.com/test.pdf",
            $commonResponse->data
        );

    }

}