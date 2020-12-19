<?php

use PHPUnit\Framework\TestCase;

require 'vendor/autoload.php';


/**
 * Class DoctronHtml2ImageTest
 * phpunit --bootstrap src/Doctron.php tests/DoctronHtml2ImageTest.php
 */
class DoctronHtml2ImageTest extends TestCase
{
    const domain = "http://47.52.25.206:8080";
    const defaultUsername = "doctron";
    const defaultPassword = "lampnick";
    const pathPrefix = "./tests/data/";
    
    public function testHtml2Image()
    {
        $requestDTO = \lampnick\doctron\request\HTML2ImageRequestDTO::NewDefaultHTML2ImageRequestDTO();
        $requestDTO->url = "http://doctron.lampnick.com/doctron.html";
        $doctron = new \lampnick\doctron\Doctron(self::domain, self::defaultUsername, self::defaultPassword);
        $localFileFullPath = self::pathPrefix . "html2image.png";
        $doctron->html2Image($localFileFullPath, $requestDTO);
        //need ulink file manually.
    }


    public function testHtml2ImageAndUpload()
    {
        $requestDTO = \lampnick\doctron\request\HTML2ImageRequestDTO::NewDefaultHTML2ImageRequestDTO();
        $requestDTO->url = "http://doctron.lampnick.com/doctron.html";
        $requestDTO->uploadKey = "test.png";
        $doctron = new \lampnick\doctron\Doctron(self::domain, self::defaultUsername, self::defaultPassword);
        $commonResponse = $doctron->html2ImageAndUpload($requestDTO);
        $this->assertEquals(
            "https://qjhdqx-prod.oss-cn-zhangjiakou.aliyuncs.com/test.png",
            $commonResponse->data
        );

    }

}