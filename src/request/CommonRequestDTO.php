<?php


namespace lampnick\doctron\request;


class CommonRequestDTO implements DoctronRequestInterface
{
    public $url = "";
    public $uploadKey = "";

    public function getQueryString()
    {
        if (empty($this->url)) {
            throw new \Exception('convert url required');
        }
        return http_build_query($this);
    }

    public function needDoctronUpload()
    {
        return $this->uploadKey !== "";
    }
}