<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */
namespace Magento\Multishipping\Block\Checkout;

/**
 * Multishipping cart link
 */
class Link extends \Magento\Framework\View\Element\Template
{
    /**
     * Multishipping helper
     *
     * @var \Magento\Multishipping\Helper\Data
     */
    protected $helper;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Multishipping\Helper\Data $helper
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Multishipping\Helper\Data $helper,
        array $data = []
    ) {
        $this->helper = $helper;
        parent::__construct($context, $data);
        $this->_isScopePrivate = true;
    }

    /**
     * @return string
     */
    public function getCheckoutUrl()
    {
        return $this->getUrl('multishipping/checkout', ['_secure' => true]);
    }

    /**
     * @return \Magento\Sales\Model\Quote
     */
    public function getQuote()
    {
        return $this->helper->getQuote();
    }

    /**
     * @return string
     */
    public function _toHtml()
    {
        if (!$this->helper->isMultishippingCheckoutAvailable()) {
            return '';
        }
        return parent::_toHtml();
    }
}
