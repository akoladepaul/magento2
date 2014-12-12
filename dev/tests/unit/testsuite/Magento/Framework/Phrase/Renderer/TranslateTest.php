<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */
namespace Magento\Framework\Phrase\Renderer;

class TranslateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Magento\Framework\Translate|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $_translator;

    /**
     * @var \Magento\Framework\Phrase\Renderer\Translate
     */
    protected $_renderer;

    protected function setUp()
    {
        $this->_translator = $this->getMock('Magento\Framework\TranslateInterface', [], [], '', false);

        $objectManagerHelper = new \Magento\TestFramework\Helper\ObjectManager($this);
        $this->_renderer = $objectManagerHelper->getObject(
            'Magento\Framework\Phrase\Renderer\Translate',
            ['translator' => $this->_translator]
        );
    }

    public function testRender()
    {
        $text = 'text';
        $translatedText = 'translated text';
        $translate = 'translate';

        $this->_translator->expects($this->exactly(2))
            ->method('getData')
            ->will($this->returnValue([$translatedText => $translate]));

        $this->assertEquals($translate, $this->_renderer->render([$translatedText], []));
        $this->assertEquals($text, $this->_renderer->render([$text], []));
    }
}
