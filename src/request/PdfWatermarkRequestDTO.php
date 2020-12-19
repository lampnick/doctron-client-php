<?php

namespace lampnick\doctron\request;

class PdfWatermarkRequestDTO extends CommonRequestDTO
{
    public $watermarkType;//watermark type will support soon
    public $imageUrl;//watermark image url

    public function getQueryString()
    {
        if (empty($this->url)) {
            throw new \Exception('convert url required');
        }
        if (empty($this->imageUrl)) {
            throw new \Exception('watermark image url required');
        }
        return http_build_query($this);
    }

    public static function NewDefaultHTML2ImageRequestDTO()
    {
        $request = new self();
        $request->watermarkType = 0;
        $request->imageUrl = "";

        return $request;
    }
}
