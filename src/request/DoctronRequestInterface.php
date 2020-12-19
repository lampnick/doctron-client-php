<?php

namespace lampnick\doctron\request;


interface DoctronRequestInterface
{
    public function needDoctronUpload();

    public function getQueryString();

}