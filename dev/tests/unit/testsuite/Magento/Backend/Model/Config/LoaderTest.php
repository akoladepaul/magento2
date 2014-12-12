<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */
namespace Magento\Backend\Model\Config;

class LoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Magento\Backend\Model\Config\Loader
     */
    protected $_model;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $_configValueFactory;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $_configCollection;

    protected function setUp()
    {
        $this->_configValueFactory = $this->getMock(
            'Magento\Framework\App\Config\ValueFactory',
            ['create', 'getCollection'],
            [],
            '',
            false
        );
        $this->_model = new \Magento\Backend\Model\Config\Loader($this->_configValueFactory);

        $this->_configCollection = $this->getMock(
            'Magento\Core\Model\Resource\Config\Data\Collection',
            [],
            [],
            '',
            false
        );
        $this->_configCollection->expects(
            $this->once()
        )->method(
            'addScopeFilter'
        )->with(
            'scope',
            'scopeId',
            'section'
        )->will(
            $this->returnSelf()
        );

        $configDataMock = $this->getMock('Magento\Framework\App\Config\Value', [], [], '', false);
        $this->_configValueFactory->expects(
            $this->once()
        )->method(
            'create'
        )->will(
            $this->returnValue($configDataMock)
        );
        $configDataMock->expects(
            $this->any()
        )->method(
            'getCollection'
        )->will(
            $this->returnValue($this->_configCollection)
        );

        $this->_configCollection->expects(
            $this->once()
        )->method(
            'getItems'
        )->will(
            $this->returnValue(
                [new \Magento\Framework\Object(['path' => 'section', 'value' => 10, 'config_id' => 20])]
            )
        );
    }

    protected function tearDown()
    {
        unset($this->_configValueFactory);
        unset($this->_model);
        unset($this->_configCollection);
    }

    public function testGetConfigByPathInFullMode()
    {
        $expected = ['section' => ['path' => 'section', 'value' => 10, 'config_id' => 20]];
        $this->assertEquals($expected, $this->_model->getConfigByPath('section', 'scope', 'scopeId', true));
    }

    public function testGetConfigByPath()
    {
        $expected = ['section' => 10];
        $this->assertEquals($expected, $this->_model->getConfigByPath('section', 'scope', 'scopeId', false));
    }
}
