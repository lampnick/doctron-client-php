<?php

namespace lampnick\doctron;

use lampnick\doctron\helper\curl\CurlRequestHelper;
use lampnick\doctron\helper\file\File;
use lampnick\doctron\request\DoctronRequestInterface;
use lampnick\doctron\request\HTML2ImageRequestDTO;
use lampnick\doctron\request\HTML2PdfRequestDTO;
use lampnick\doctron\request\PdfWatermarkRequestDTO;
use lampnick\doctron\response\CommonResponse;


class Doctron
{
    private $domain;
    private $username;
    private $password;

    const relativePathHTML2Pdf = "/convert/html2pdf";
    const relativePathHTML2Image = "/convert/html2image";
    const relativePathPdfAddWatermark = "/convert/pdfAddWatermark";
    const separator = "/";

    public function __construct($domain, $username, $password)
    {
        $this->domain = $domain;
        $this->username = $username;
        $this->password = $password;
    }


    /**
     * html convert to pdf, save locally
     * @param $localFileFullPath
     * @param HTML2PdfRequestDTO $requestDTO
     */
    public function html2Pdf($localFileFullPath, HTML2PdfRequestDTO $requestDTO)
    {
        $this->convert($localFileFullPath, self::relativePathHTML2Pdf, $requestDTO);
    }

    /**
     * html convert to pdf and preview
     * @param HTML2PdfRequestDTO $requestDTO
     */
    public function html2PdfAndPreview(HTML2PdfRequestDTO $requestDTO)
    {
        $this->preview(self::relativePathHTML2Pdf, $requestDTO);
    }

    /**
     *  html convert to pdf and upload
     * @param HTML2PdfRequestDTO $requestDTO
     * @return CommonResponse
     */
    public function html2PdfAndUpload(HTML2PdfRequestDTO $requestDTO)
    {
        return $this->convertAndUpload(self::relativePathHTML2Pdf, $requestDTO);
    }

    /**
     * html convert to image, save locally
     * @param $localFileFullPath
     * @param HTML2ImageRequestDTO $requestDTO
     */
    public function html2Image($localFileFullPath, HTML2ImageRequestDTO $requestDTO)
    {
        $this->convert($localFileFullPath, self::relativePathHTML2Image, $requestDTO);
    }

    /**
     * html convert image pdf and preview
     * @param HTML2ImageRequestDTO $requestDTO
     */
    public function html2ImageAndPreview(HTML2ImageRequestDTO $requestDTO)
    {
        $this->preview(self::relativePathHTML2Image, $requestDTO);
    }

    /*
     *  html convert to image and upload
     */
    public function html2ImageAndUpload(HTML2ImageRequestDTO $requestDTO)
    {
        return $this->convertAndUpload(self::relativePathHTML2Image, $requestDTO);
    }

    /**
     * pdf add watermark, save locally
     * @param $localFileFullPath
     * @param PdfWatermarkRequestDTO $requestDTO
     */
    public function pdfAddWatermark($localFileFullPath, PdfWatermarkRequestDTO $requestDTO)
    {
        $this->convert($localFileFullPath, self::relativePathPdfAddWatermark, $requestDTO);
    }

    /**
     * pdf add watermark and preview
     * @param PdfWatermarkRequestDTO $requestDTO
     */
    public function pdfAddWatermarkAndPreview(PdfWatermarkRequestDTO $requestDTO)
    {
        $this->preview(self::relativePathPdfAddWatermark, $requestDTO);
    }

    /**
     * pdf add watermark and upload
     * @param PdfWatermarkRequestDTO $requestDTO
     * @return CommonResponse
     */
    public function pdfAddWatermarkAndUpload(PdfWatermarkRequestDTO $requestDTO)
    {
        return $this->convertAndUpload(self::relativePathPdfAddWatermark, $requestDTO);
    }


    /**
     * save locally
     * @param $relativePath
     * @param DoctronRequestInterface $doctronRequest
     * @param $localFileFullPath
     * @throws \Exception
     */
    private function convert($localFileFullPath, $relativePath, DoctronRequestInterface $doctronRequest)
    {
        if ($doctronRequest->needDoctronUpload()) {
            throw new \Exception("convert can't pass uploadKey");
        }
        if (empty($localFileFullPath)) {
            throw new \Exception("local save file path required");
        }
        File::saveRemoteFile($this->getFullURL($relativePath, $doctronRequest), $localFileFullPath);
    }

    /**
     * preview
     * @param $relativePath
     * @param DoctronRequestInterface $doctronRequest
     * @throws \Exception
     */
    private function preview($relativePath, DoctronRequestInterface $doctronRequest)
    {
        if ($doctronRequest->needDoctronUpload()) {
            throw new \Exception("convert can't pass uploadKey");
        }

        File::previewOnBrowser($this->getFullURL($relativePath, $doctronRequest));
    }


    /**
     * uploaded to oss storage
     * @param $relativePath
     * @param DoctronRequestInterface $doctronRequest
     * @return CommonResponse
     * @throws \Exception
     */
    private function convertAndUpload($relativePath, DoctronRequestInterface $doctronRequest)
    {
        try {
            if (!$doctronRequest->needDoctronUpload()) {
                throw new \Exception("uploadKey required when convert and upload");
            }
            $curl = CurlRequestHelper::get($this->getFullURL($relativePath, $doctronRequest));
            $ct = isset($curl->responseHeaders["Content-Type"]) ? $curl->responseHeaders["Content-Type"] : "";

            //if json format, judge response code
            if (false === strpos($ct, 'application/json')) {
                throw new \Exception('Doctron server return none josn format. return:' . $ct);
            }
            $res = json_decode($curl->getRawResponse(), true);
            $commonResponse = new CommonResponse();
            $commonResponse->data = isset($res['data']) ? $res['data'] : '';
            $commonResponse->code = isset($res['code']) ? $res['code'] : '';
            $commonResponse->message = isset($res['message']) ? $res['message'] : '';
            if ($commonResponse->code != CommonResponse::responseCodeOK) {
                throw new \Exception('Doctron server return err. code:' . $commonResponse->code . ',message:' . $commonResponse->message);
            }
            return $commonResponse;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    private function getURIWithAuth($relativePath)
    {
        $this->domain = trim($this->domain, self::separator);
        if (strpos($relativePath, self::separator) !== 0) {
            $relativePath = self::separator . $relativePath;
        }
        $relativePath = rtrim($relativePath, self::separator);
        return $this->domain . $relativePath . "?u=" . $this->username . "&p=" . $this->password;
    }

    private function getFullURL($relativePath, DoctronRequestInterface $doctronRequest)
    {
        return $this->getURIWithAuth($relativePath) . "&" . $doctronRequest->getQueryString();
    }
}