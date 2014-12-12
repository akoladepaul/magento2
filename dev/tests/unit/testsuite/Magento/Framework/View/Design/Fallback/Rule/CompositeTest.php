<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */
namespace Magento\Framework\View\Design\Fallback\Rule;

/**
 * Composite Test
 *
 */
class CompositeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Each item should implement the fallback rule interface
     */
    public function testConstructException()
    {
        new Composite([new \stdClass()]);
    }

    public function testGetPatternDirs()
    {
        $inputParams = ['param_one' => 'value_one', 'param_two' => 'value_two'];

        $ruleOne = $this->getMockForAbstractClass('\Magento\Framework\View\Design\Fallback\Rule\RuleInterface');
        $ruleOne->expects(
            $this->once()
        )->method(
            'getPatternDirs'
        )->with(
            $inputParams
        )->will(
            $this->returnValue(['rule_one/path/one', 'rule_one/path/two'])
        );

        $ruleTwo = $this->getMockForAbstractClass('\Magento\Framework\View\Design\Fallback\Rule\RuleInterface');
        $ruleTwo->expects(
            $this->once()
        )->method(
            'getPatternDirs'
        )->with(
            $inputParams
        )->will(
            $this->returnValue(['rule_two/path/one', 'rule_two/path/two'])
        );

        $object = new Composite([$ruleOne, $ruleTwo]);

        $expectedResult = ['rule_one/path/one', 'rule_one/path/two', 'rule_two/path/one', 'rule_two/path/two'];
        $this->assertEquals($expectedResult, $object->getPatternDirs($inputParams));
    }
}
