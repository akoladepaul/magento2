<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */
namespace Magento\Catalog\Model\Indexer\Product\Price\Plugin;

class Website
{
    /**
     * @var \Magento\Catalog\Model\Indexer\Product\Price\Processor
     */
    protected $_processor;

    /**
     * @param \Magento\Catalog\Model\Indexer\Product\Price\Processor $processor
     */
    public function __construct(\Magento\Catalog\Model\Indexer\Product\Price\Processor $processor)
    {
        $this->_processor = $processor;
    }

    /**
     * Invalidate price indexer
     *
     * @param \Magento\Store\Model\Resource\Website $subject
     * @param \Magento\Store\Model\Resource\Website $result
     * @return \Magento\Store\Model\Resource\Website
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterDelete(\Magento\Store\Model\Resource\Website $subject, $result)
    {
        $this->_processor->markIndexerAsInvalid();
        return $result;
    }
}
