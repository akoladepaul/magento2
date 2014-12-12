<?php
/**
 * \Magento\Payment\Model\Config\Converter
 *
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */
namespace Magento\Payment\Model\Config;

class ConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Magento\Payment\Model\Config\Converter
     */
    protected $_model;

    /** @var  array */
    protected $_targetArray;

    public function setUp()
    {
        $this->_model = new \Magento\Payment\Model\Config\Converter();
    }

    public function testConvert()
    {
        $dom = new \DOMDocument();
        $xmlFile = __DIR__ . '/_files/payment.xml';
        $dom->loadXML(file_get_contents($xmlFile));

        $expectedResult = [
            'credit_cards' => ['SO' => 'Solo', 'SM' => 'Switch/Maestro'],
            'groups' => ['any_payment' => 'Any Payment'],
            'methods' => ['checkmo' => ['allow_multiple_address' => 1, 'allow_multiple_with_3dsecure' => 1]],
        ];
        $this->assertEquals($expectedResult, $this->_model->convert($dom), '', 0, 20);
    }
}
