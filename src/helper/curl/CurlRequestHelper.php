<?php

namespace lampnick\doctron\helper\curl;

use Curl\Curl;


/**
 * Class CurlRequestHelper
 * @package helpers\curl
 */
class CurlRequestHelper
{

    /**
     * @param $url
     * @param null $queryArray
     * @return Curl
     * @throws \Exception
     */
    public static function get($url, $queryArray = null)
    {
        if (!empty($queryArray) && (is_object($queryArray) || is_array($queryArray))) {
            $queryString = http_build_query($queryArray);
            if (strpos($url, '?') === false) {
                $url .= '?' . $queryString;
            } else {
                $url .= '&' . $queryString;
            }
        }
        $curl = new Curl();
        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
        $curl->setOpt(CURLOPT_SSL_VERIFYHOST, false);
        $curl->get($url);
        if ($curl->error) {
            throw new \Exception('curl err: ' . $curl->errorCode . ',msg: ' . $curl->errorMessage);
        }

        return $curl;
    }


}
