<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */

namespace Magento\Framework\Translate\Inline;

class Provider implements ProviderInterface
{
    /**
     * @var \Magento\Framework\Translate\InlineInterface
     */
    protected $inlineTranslate;

    /**
     * @param \Magento\Framework\Translate\InlineInterface $inlineTranslate
     */
    public function __construct(\Magento\Framework\Translate\InlineInterface $inlineTranslate)
    {
        $this->inlineTranslate = $inlineTranslate;
    }

    /**
     * Return instance of inline translate class
     *
     * @return \Magento\Framework\Translate\InlineInterface
     */
    public function get()
    {
        return $this->inlineTranslate;
    }
}
