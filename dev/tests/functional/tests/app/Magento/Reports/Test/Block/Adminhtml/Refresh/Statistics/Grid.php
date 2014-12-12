<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */

namespace Magento\Reports\Test\Block\Adminhtml\Refresh\Statistics;

use Magento\Backend\Test\Block\Widget\Grid as AbstractGrid;
use Mtf\Client\Element\Locator;

/**
 * Class Grid
 * Refresh statistics grid
 */
class Grid extends AbstractGrid
{
    /**
     * An element locator which allows to select entities in grid
     *
     * @var string
     */
    protected $selectItem = '//tr[td[contains(@class,"col-report") and normalize-space(.)="%s"]]//input';

    /**
     * Search for item and select it
     *
     * @param array $filter
     * @throws \Exception
     * @return void
     */
    public function searchAndSelect(array $filter)
    {
        $selectItem = $this->_rootElement->find(sprintf($this->selectItem, $filter['report']), Locator::SELECTOR_XPATH);
        if ($selectItem->isVisible()) {
            $selectItem->click();
        } else {
            throw new \Exception('Searched item was not found.');
        }
    }
}
