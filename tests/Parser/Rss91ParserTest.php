<?php

namespace PicoFeed\Parser;

use PHPUnit\Framework\TestCase;

class Rss91ParserTest extends TestCase
{
    public function testFormatOk()
    {
        $parser = new Rss91(file_get_contents('tests/fixtures/rss_0.91.xml'));
        $feed = $parser->execute();

        $this->assertNotFalse($feed);
        $this->assertNotEmpty($feed->items);

        $this->assertEquals('WriteTheWeb', $feed->getTitle());
        $this->assertEquals('', $feed->getFeedUrl());
        $this->assertEquals('http://writetheweb.com/', $feed->getSiteUrl());
        $this->assertEquals('http://writetheweb.com/', $feed->getId());
        $this->assertEquals(time(), $feed->getDate()->getTimestamp(), '', 1);
        $this->assertEquals(6, count($feed->items));

        $this->assertEquals('Giving the world a pluggable Gnutella', $feed->items[0]->getTitle());
        $this->assertEquals('http://writetheweb.com/read.php?item=24', $feed->items[0]->getUrl());
        $this->assertEquals('085a9133a75542f878fa73ee2afbb6a2350b6c4fb125e6d8ca09478c47702111', $feed->items[0]->getId());
        $this->assertEquals(time(), $feed->items[0]->getDate()->getTimestamp(), '', 1);
        $this->assertEquals('editor@writetheweb.com', $feed->items[0]->getAuthor());
        $this->assertTrue(strpos($feed->items[1]->getContent(), '<p>After a period of dormancy') === 0);
    }
}
