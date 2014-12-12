<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */
namespace Magento\Tools\Di\Definition;

/**
 * Class CollectionTest
 * @package Magento\Tools\Di\Definition
 */
class CollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Magento\Tools\Di\Definition\Collection
     */
    private $model;

    /**
     * @var \Magento\Tools\Di\Definition\Collection | \PHPUnit_Framework_MockObject_MockObject
     */
    private $collectionMock;

    /**
     * Instance name
     */
    const INSTANCE_1 = 'Class_Name_1';

    /**
     * Instance name
     */
    const INSTANCE_2 = 'Class_Name_2';

    /**
     * Returns initialized argument data
     *
     * @return array
     */
    private function getArgument()
    {
        return ['argument' => ['configuration', 'array', true, null]];
    }

    /**
     * Returns initialized expected definitions for most cases
     *
     * @return array
     */
    private function getExpectedDefinition()
    {
        return [self::INSTANCE_1 => $this->getArgument()];
    }

    protected function setUp()
    {
        $this->collectionMock = $this->getMockBuilder('\Magento\Tools\Di\Definition\Collection')
            ->setMethods([])->getMock();
        $this->model = new \Magento\Tools\Di\Definition\Collection();
    }

    public function testAddDefinition()
    {
        $this->model->addDefinition(self::INSTANCE_1, $this->getArgument());
        $this->assertEquals($this->getExpectedDefinition(), $this->model->getCollection());
    }

    public function testInitialize()
    {
        $this->model->initialize([self::INSTANCE_1 => $this->getArgument()]);
        $this->assertEquals($this->getExpectedDefinition(), $this->model->getCollection());
    }

    public function testHasInstance()
    {
        $this->model->addDefinition(self::INSTANCE_1, $this->getArgument());
        $this->assertTrue($this->model->hasInstance(self::INSTANCE_1));
    }

    public function testGetInstancesNamesList()
    {
        $this->model->addDefinition(self::INSTANCE_1, $this->getArgument());
        $this->assertEquals([self::INSTANCE_1], $this->model->getInstancesNamesList());
    }

    public function testGetInstanceArguments()
    {
        $this->model->addDefinition(self::INSTANCE_1, $this->getArgument());
        $this->assertEquals($this->getArgument(), $this->model->getInstanceArguments(self::INSTANCE_1));
    }

    public function testAddCollection()
    {
        $this->model->addDefinition(self::INSTANCE_1, $this->getArgument());
        $this->collectionMock->expects($this->any())->method('getCollection')
            ->willReturn([self::INSTANCE_2 => $this->getArgument()]);
        $this->model->addCollection($this->collectionMock);
        $this->assertEquals(
            [self::INSTANCE_1 => $this->getArgument(), self::INSTANCE_2 => $this->getArgument()],
            $this->model->getCollection());
    }
}
