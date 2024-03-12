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
        $this->assertEquals('<!DOC', substr($result['body'], 0, 5));
        $this->assertEquals('text/html; charset=UTF-8', $result['headers']['Content-Type']);
    }

    /**
     * @runInSeparateProcess
     * @group online
     */
    public function testPassthrough()
    {
        $client = new Curl();
        $client->setUrl('https://miniflux.net/favicon.ico');

        ob_start();
        $client->enablePassthroughMode();
        $client->doRequest();

        $str = ob_get_contents();
        ob_end_clean();

        $this->assertEquals($str, file_get_contents('tests/fixtures/miniflux_favicon.ico'));
    }

    /**
     * @group online
     */
    public function testSSL()
    {
        $client = new Curl();
        $this->expectException(\PicoFeed\Client\InvalidCertificateException::class);
        $client->setUrl('https://www.mjvmobile.com.br');
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
