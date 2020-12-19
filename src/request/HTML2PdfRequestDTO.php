<?php


namespace lampnick\doctron\request;

class HTML2PdfRequestDTO extends CommonRequestDTO
{

    public $landscape;                 // Paper orientation. core.Defaults to false.
    public $displayHeaderFooter;       // Display header and footer. core.Defaults to false.
    public $printBackground;           // Print background graphics. core.Defaults to false.
    public $scale;                     // Scale of the webpage rendering. core.Defaults to 1.
    public $paperWidth;                    // Paper width in inches. core.Defaults to 8.5 inches.
    public $paperHeight;                   // Paper height in inches. core.Defaults to 11 inches.
    public $marginTop;                    // Top margin in inches. core.Defaults to 1cm (~0.4 inches).
    public $marginBottom;                 // Bottom margin in inches. core.Defaults to 1cm (~0.4 inches).
    public $marginLeft;                   // Left margin in inches. core.Defaults to 1cm (~0.4 inches).
    public $marginRight;                  // Right margin in inches. core.Defaults to 1cm (~0.4 inches).
    public $pageRanges;                // Paper ranges to print, e.g., '1-5, 8, 11-13'. core.Defaults to the empty string, which means print all pages.
    public $ignoreInvalidPageRanges;   // Whether to silently ignore invalid but successfully parsed page ranges, such as '3-2'. core.Defaults to false.
    public $headerTemplate;            // HTML template for the print header. Should be valid HTML markup with following classes used to inject printing values into them: - date: formatted print date - title: document title - url: document location - pageNumber: current page number - totalPages: total pages in the document  For example, <span class=title></span> would generate span containing the title.
    public $footerTemplate;            // HTML template for the print footer. Should use the same format as the headerTemplate.
    public $preferCSSPageSize;         // Whether or not to prefer page size as defined by css. core.Defaults to false, in which case the content will be scaled to fit the paper size.


    // Paper orientation. defaults to false.
    const defaultLandscape = false;

    // Display header and footer. defaults to false.
    const defaultDisplayHeaderFooter = false;

    // Print background graphics. defaults to true.
    const defaultPrintBackground = true;

    // Scale of the webpage rendering. defaults to 1.
    const defaultScale = 1;

    // Paper width in inches. defaults to 8.5 inches.
    const defaultPaperWidth = 8.5;

    // Paper height in inches. defaults to 11 inches.
    const defaultPaperHeight = 11;

    // Top margin in inches. defaults to 1cm (~0.4 inches).
    const defaultMarginTop = 0.4;

    // Bottom margin in inches. defaults to 1cm (~0.4 inches).
    const defaultMarginBottom = 0.4;

    // Left margin in inches. defaults to 1cm (~0.4 inches).
    const defaultMarginLeft = 0.4;

    // Right margin in inches. defaults to 1cm (~0.4 inches).
    const defaultMarginRight = 0.4;

    // Paper ranges to print, e.g., '1-5, 8, 11-13'. defaults to the empty string, which means print all pages.
    const defaultPageRanges = "";

    // Whether to silently ignore invalid but successfully parsed page ranges, such as '3-2'. defaults to false.
    const defaultIgnoreInvalidPageRanges = false;

    // HTML template for the print header. Should be valid HTML markup with following classes used to inject printing values into them: - date: formatted print date - title: document title - url: document location - pageNumber: current page number - totalPages: total pages in the document  For example, <span class=title></span> would generate span containing the title.
    const defaultHeaderTemplate = "";

    // HTML template for the print footer. Should use the same format as the headerTemplate.
    const defaultFooterTemplate = "";

    // Whether or not to prefer page size as defined by css. defaults to false, in which case the content will be scaled to fit the paper size.
    const defaultPreferCSSPageSize = false;


    public static function NewDefaultHTML2PdfRequestDTO()
    {
        $request = new self();

        $request->landscape = self::defaultLandscape;
        $request->displayHeaderFooter = self::defaultDisplayHeaderFooter;
        $request->printBackground = self::defaultPrintBackground;
        $request->scale = self::defaultScale;
        $request->paperWidth = self::defaultPaperWidth;
        $request->paperHeight = self::defaultPaperHeight;
        $request->marginTop = self::defaultMarginTop;
        $request->marginBottom = self::defaultMarginBottom;
        $request->marginLeft = self::defaultMarginLeft;
        $request->marginRight = self::defaultMarginRight;
        $request->pageRanges = self::defaultPageRanges;
        $request->ignoreInvalidPageRanges = self::defaultIgnoreInvalidPageRanges;
        $request->headerTemplate = self::defaultHeaderTemplate;
        $request->footerTemplate = self::defaultFooterTemplate;
        $request->preferCSSPageSize = self::defaultPreferCSSPageSize;
        return $request;
    }
}
