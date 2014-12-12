<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */
namespace Magento\Catalog\Block\Product\View;

class TabsTest extends \PHPUnit_Framework_TestCase
{
    public function testAddTab()
    {
        $tabBlock = $this->getMock('Magento\Framework\View\Element\Template', [], [], '', false);
        $tabBlock->expects($this->once())->method('setTemplate')->with('template')->will($this->returnSelf());

        $layout = $this->getMock('Magento\Framework\View\Layout', [], [], '', false);
        $layout->expects($this->once())->method('createBlock')->with('block')->will($this->returnValue($tabBlock));

        $helper = new \Magento\TestFramework\Helper\ObjectManager($this);
        $block = $helper->getObject('Magento\Catalog\Block\Product\View\Tabs', ['layout' => $layout]);
        $block->addTab('alias', 'title', 'block', 'template', 'header');

        $expectedTabs = [['alias' => 'alias', 'title' => 'title', 'header' => 'header']];
        $this->assertEquals($expectedTabs, $block->getTabs());
    }
}
