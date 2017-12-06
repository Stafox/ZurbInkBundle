<?php

namespace Stafox\ZurbInkBundle\Service;

use voku\CssToInlineStyles\CssToInlineStyles;

class InlineCss
{
    /**
     * @var CssToInlineStyles
     */
    protected $cssToInlineStyles;

    protected $copiedInliner;

    /**
     * InlineCss constructor.
     * @param CssToInlineStyles $cssToInlineStyles
     */
    public function __construct($cssToInlineStyles)
    {
        $this->cssToInlineStyles = $cssToInlineStyles;
    }


    public function setCss($css)
    {
        $this->getCssToInlineStyles()->setCSS($css);
    }

    public function setHtml($html)
    {
        $this->getCssToInlineStyles()->setHTML($html);
    }

    public function convert()
    {
        $html = $this->getCssToInlineStyles()->convert();
        // reset the whole InlineStyles Object (it does not reset the parsed css-rules after ::convert())
        $this->copiedInliner = null;

        return $html;
    }

    /**
     *
     * @return CssToInlineStyles
     */
    protected function getCssToInlineStyles()
    {
        if ($this->copiedInliner === null) {
            $this->copiedInliner = clone $this->cssToInlineStyles;
        }

        return $this->copiedInliner;
    }
}
