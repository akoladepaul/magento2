<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */
namespace Magento\Reports\Block\Adminhtml\Sales\Refunded;

/**
 * Adminhtml refunded report grid block
 *
 * @author     Magento Core Team <core@magentocommerce.com>
 */
class Grid extends \Magento\Reports\Block\Adminhtml\Grid\AbstractGrid
{
    /**
     * @var string
     */
    protected $_columnGroupBy = 'period';

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setCountTotals(true);
    }

    /**
     * @return string
     */
    public function getResourceCollectionName()
    {
        return $this->getFilterData()->getData(
            'report_type'
        ) ==
            'created_at_refunded' ? 'Magento\Sales\Model\Resource\Report\Refunded\Collection\Refunded' : 'Magento\Sales\Model\Resource\Report\Refunded\Collection\Order';
    }

    /**
     * @return \Magento\Backend\Block\Widget\Grid\Extended
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'period',
            [
                'header' => __('Interval'),
                'index' => 'period',
                'sortable' => false,
                'period_type' => $this->getPeriodType(),
                'renderer' => 'Magento\Reports\Block\Adminhtml\Sales\Grid\Column\Renderer\Date',
                'totals_label' => __('Total'),
                'html_decorators' => ['nobr'],
                'header_css_class' => 'col-period',
                'column_css_class' => 'col-period'
            ]
        );

        $this->addColumn(
            'orders_count',
            [
                'header' => __('Refunded Orders'),
                'index' => 'orders_count',
                'type' => 'number',
                'total' => 'sum',
                'sortable' => false,
                'header_css_class' => 'col-qty',
                'column_css_class' => 'col-qty'
            ]
        );

        if ($this->getFilterData()->getStoreIds()) {
            $this->setStoreIds(explode(',', $this->getFilterData()->getStoreIds()));
        }
        $currencyCode = $this->getCurrentCurrencyCode();
        $rate = $this->getRate($currencyCode);

        $this->addColumn(
            'refunded',
            [
                'header' => __('Total Refunded'),
                'type' => 'currency',
                'currency_code' => $currencyCode,
                'index' => 'refunded',
                'total' => 'sum',
                'sortable' => false,
                'rate' => $rate,
                'header_css_class' => 'col-ref-total',
                'column_css_class' => 'col-ref-total'
            ]
        );

        $this->addColumn(
            'online_refunded',
            [
                'header' => __('Online Refunds'),
                'type' => 'currency',
                'currency_code' => $currencyCode,
                'index' => 'online_refunded',
                'total' => 'sum',
                'sortable' => false,
                'rate' => $rate,
                'header_css_class' => 'col-ref-online',
                'column_css_class' => 'col-ref-online'
            ]
        );

        $this->addColumn(
            'offline_refunded',
            [
                'header' => __('Offline Refunds'),
                'type' => 'currency',
                'currency_code' => $currencyCode,
                'index' => 'offline_refunded',
                'total' => 'sum',
                'sortable' => false,
                'rate' => $rate,
                'header_css_class' => 'col-ref-offline',
                'column_css_class' => 'col-ref-offline'
            ]
        );

        $this->addExportType('*/*/exportRefundedCsv', __('CSV'));
        $this->addExportType('*/*/exportRefundedExcel', __('Excel XML'));

        return parent::_prepareColumns();
    }
}
