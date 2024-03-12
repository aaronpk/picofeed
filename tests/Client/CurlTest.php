<?php

namespace PicoFeed\Client;


class CurlTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @group online
     */
    public function testDownload()
    {
        $client = new Curl();
        $client->setUrl('http://miniflux.net/');
        $result = $client->doRequest();

        $this->assertTrue(is_array($result));
        $this->assertEquals(200, $result['status']);
        $this->assertEquals('<!doc', substr($result['body'], 0, 5));
        $this->assertEquals('text/html; charset=utf-8', $result['headers']['Content-Type']);
    }

    /**
     * @runInSeparateProcess
     * @group online
     */
    public function testPassthrough()
    {
        $client = new Curl();
        $client->setUrl('https://miniflux.app//favicon.ico');

        ob_start();
        $client->enablePassthroughMode();
        $client->doRequest();

        $str = ob_get_contents();
        ob_end_clean();

        $this->assertEquals($str, file_get_contents(dirname(__FILE__) . '/../fixtures/miniflux_favicon.ico'));
    }

    /**
     * @group online
     */
    public function testSSL()
    {
        $client = new Curl();
        $this->expectException(\PicoFeed\Client\InvalidCertificateException::class);
        $client->setUrl('https://self-signed.badssl.com/');
        $client->doRequest();
    }


    public function testBadUrl()
    {
        $this->expectException(\PicoFeed\Client\InvalidUrlException::class);
        $client = new Curl();
        $client->setUrl('http://12345gfgfgf');
        $client->doRequest();
    }
}
