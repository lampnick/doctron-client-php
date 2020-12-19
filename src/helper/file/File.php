<?php

namespace lampnick\doctron\helper\file;

use lampnick\doctron\helper\curl\CurlRequestHelper;

class File
{

    /**
     * @param $url
     * @param $fullFilePath
     * @throws \Exception
     */
    public static function saveRemoteFile($url, $fullFilePath)
    {
        if (empty($url)) {
            throw new \Exception('must pass url');
        }
        $curl = CurlRequestHelper::get($url);
        if (file_put_contents($fullFilePath, $curl->response) === false) {
            throw new \Exception('saveRemoteFile err:' . json_encode(error_get_last()));
        }
    }

    /**
     * @param $url
     * @throws \Exception
     */
    public static function previewOnBrowser($url)
    {
        if (empty($url) || false === @fopen($url, 'rb')) {
            throw new \Exception('must pass url');
        }
        $header = get_headers($url, 1);
        if ('text/html' == $header['Content-Type'] || 'text/plain' == $header['Content-Type']) {
            header('Content-Type:text/html');
        } else if ('image/jpeg' == $header['Content-Type']) {
            header('Content-Type: image/jpeg');
        } else if ('image/png' == $header['Content-Type']) {
            header('Content-Type: image/png');
        } else if ('application/pdf' == $header['Content-Type']) {
            header('Content-Type: application/pdf');
        }
        header('Content-Length: ' . $header['Content-Length']);
        readfile($url);
        exit;
    }

}