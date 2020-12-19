<?php


namespace lampnick\doctron\request;

class HTML2ImageRequestDTO extends CommonRequestDTO
{
    public $format; // Image compression format (defaults to png).
    public $quality; // Compression quality from range [0..100] (jpeg only).
    public $customClip; //if set this value, the below clip will work,otherwise not work!
    public $clipX; // Capture the screenshot of a given region only.X offset in device independent pixels (dip).
    public $clipY; // Capture the screenshot of a given region only.Y offset in device independent pixels (dip).
    public $clipWidth; // Capture the screenshot of a given region only.Rectangle width in device independent pixels (dip).
    public $clipHeight; // Capture the screenshot of a given region only.Rectangle height in device independent pixels (dip).
    public $clipScale; // Capture the screenshot of a given region only.Page scale factor.
    public $fromSurface; // Capture the screenshot from the surface, rather than the view. defaults to true.


    // Image compression format (defaults to png).
    const formatPng = "png";
    const formatJpeg = "jpeg";

    // Compression quality from range [0..100] (jpeg only).
    const defaultQuality = 0;

    // Capture the screenshot from the surface, rather than the view. defaults to true.
    const defaultFromSurface = true;

    // Capture the screenshot of a given region only.
    // X offset in device independent pixels (dip).
    const defaultViewportX = 0;

    // Y offset in device independent pixels (dip).
    const defaultViewportY = 0;

    // Rectangle width in device independent pixels (dip).
    const defaultViewportWidth = 996;

    // Rectangle height in device independent pixels (dip).
    const defaultViewportHeight = 996;

    // Page scale factor.
    const defaultViewportScale = 1;



    public static function NewDefaultHTML2ImageRequestDTO()
    {
        $request = new self();
        $request->format = self::formatPng;
        $request->quality = self::defaultQuality;
        $request->customClip = false;
        $request->clipX = self::defaultViewportX;
        $request->clipY = self::defaultViewportY;
        $request->clipWidth = self::defaultViewportWidth;
        $request->clipHeight = self::defaultViewportHeight;
        $request->clipScale = self::defaultViewportScale;
        $request->fromSurface = self::defaultFromSurface;
        return $request;
    }
}
