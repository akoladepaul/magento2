<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */
namespace Magento\Sales\Model\Resource\Order\Grid;

/**
 * Sales orders statuses option array
 */
class StatusesArray implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var \Magento\Sales\Model\Resource\Order\Status\CollectionFactory
     */
    protected $_statusCollectionFactory;

    /**
     * @param \Magento\Sales\Model\Resource\Order\Status\CollectionFactory $statusCollectionFactory
     */
    public function __construct(\Magento\Sales\Model\Resource\Order\Status\CollectionFactory $statusCollectionFactory)
    {
        $this->_statusCollectionFactory = $statusCollectionFactory;
    }

    /**
     * Return option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $statuses = $this->_statusCollectionFactory->create()->toOptionHash();
        return $statuses;
    }
}
