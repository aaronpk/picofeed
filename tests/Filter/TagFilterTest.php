<?php

namespace PicoFeed\Filter;

use PHPUnit\Framework\TestCase;
use PicoFeed\Config\Config;

class TagFilterTest extends TestCase
{
    public function testAllowedTag()
    {
        $tag = new Tag(new Config());

        $this->assertTrue($tag->isAllowed('p', array('class' => 'test')));
        $this->assertTrue($tag->isAllowed('img', array('class' => 'test')));

        $this->assertFalse($tag->isAllowed('script', array('class' => 'test')));
        $this->assertFalse($tag->isAllowed('img', array('width' => '1', 'height' => '1')));
    }

    public function testHtml()
    {
        $tag = new Tag(new Config());

        $this->assertEquals('<p>', $tag->openHtmlTag('p'));
        $this->assertEquals('<img src="test" alt="truc"/>', $tag->openHtmlTag('img', 'src="test" alt="truc"'));
        $this->assertEquals('<img/>', $tag->openHtmlTag('img'));
        $this->assertEquals('<br/>', $tag->openHtmlTag('br'));

        $this->assertEquals('</p>', $tag->closeHtmlTag('p'));
        $this->assertEquals('', $tag->closeHtmlTag('img'));
        $this->assertEquals('', $tag->closeHtmlTag('br'));
    }
}
