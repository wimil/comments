<?php

namespace Wimil\Comments\Helpers\UrlLinker;

interface UrlLinkerInterface
{
    /**
     * @param string $text
     * @return string
     */
    public function linkUrlsAndEscapeHtml($text);
    /**
     * @param string $html
     * @return string
     */
    public function linkUrlsInTrustedHtml($html);
}
