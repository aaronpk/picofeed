<?php

namespace PicoFeed\Parser;

use DOMDocument;
use PHPUnit\Framework\TestCase;

class XmlParserTest extends TestCase
{
    public function testEmpty()
    {
        $this->assertFalse(XmlParser::getDomDocument(''));
        $this->assertFalse(XmlParser::getSimpleXml(''));
        $this->assertNotFalse(XmlParser::getHtmlDocument(''));
    }

    public function testGetEncodingFromMetaTag()
    {
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1"/>'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta http-equiv=\'Content-Type\' content=\'text/html;charset=iso-8859-1\'/>'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta http-equiv=\'Content-Type\' content=\'text/html;charset=iso-8859-1\' />'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta http-equiv=Content-Type content=text/html;charset=iso-8859-1/>'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta http-equiv=Content-Type content=text/html;charset=iso-8859-1 />'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" >'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta http-equiv=\'Content-Type\' content=\'text/html;charset=iso-8859-1\'>'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta http-equiv=\'Content-Type\' content=\'text/html;charset=iso-8859-1\' >'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta http-equiv=Content-Type content=text/html;charset=iso-8859-1>'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta http-equiv=Content-Type content=text/html;charset=iso-8859-1 >'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta http-equiv="Content-Type" content="text/html;charset=\'iso-8859-1\'">'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta http-equiv="Content-Type" content="\'text/html;charset=iso-8859-1\'">'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta http-equiv="Content-Type" content="\'text/html\';charset=\'iso-8859-1\'">'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta http-equiv=\'Content-Type\' content=\'text/html;charset="iso-8859-1"\'>'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta http-equiv=\'Content-Type\' content=\'"text/html;charset=iso-8859-1"\'>'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta http-equiv=\'Content-Type\' content=\'"text/html";charset="iso-8859-1"\'>'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta http-equiv="Content-Type" content="text/html;;;charset=iso-8859-1">'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta http-equiv="Content-Type" content="text/html;;;charset=\'iso-8859-1\'">'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta http-equiv="Content-Type" content="\'text/html;;;charset=iso-8859-1\'">'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta http-equiv="Content-Type" content="\'text/html\';;;charset=\'iso-8859-1\'">'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta http-equiv=\'Content-Type\' content=\'text/html;;;charset=iso-8859-1\'>'));
        $this->assertEquals('windows-1251', XmlParser::getEncodingFromMetaTag('<meta http-equiv=\'Content-Type\' content=\'text/html;;;charset="windows-1251"\'>'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta http-equiv=\'Content-Type\' content=\'"text/html;;;charset=iso-8859-1"\'>'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta http-equiv=\'Content-Type\' content=\'"text/html";;;charset="iso-8859-1"\'>'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta  http-equiv  =  Content-Type  content  =  text/html;charset=iso-8859-1  >'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta  content  =  text/html;charset=iso-8859-1  http-equiv  =  Content-Type  >'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta  http-equiv  =  Content-Type  content  =  text/html  ;  charset  =  iso-8859-1  >'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta  content  =  text/html  ;  charset  =  iso-8859-1  http-equiv  =  Content-Type  >'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta  http-equiv  =  Content-Type  content  =  text/html  ;;;  charset  =  iso-8859-1  >'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta  content  =  text/html  ;;;  charset  =  iso-8859-1  http-equiv  =  Content-Type  >'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta  http-equiv  =  Content-Type  content  =  text/html  ;  ;  ;  charset  =  iso-8859-1  >'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta  content  =  text/html  ;  ;  ;  charset  =  iso-8859-1  http-equiv  =  Content-Type  >'));
        $this->assertEquals('utf-8', XmlParser::getEncodingFromMetaTag('<meta charset="uTf-8"/>'));
        $this->assertEquals('utf-8', XmlParser::getEncodingFromMetaTag('<meta charset="utf-8" />'));
        $this->assertEquals('utf-8', XmlParser::getEncodingFromMetaTag('<meta charset=\'Utf-8\'/>'));
        $this->assertEquals('utf-8', XmlParser::getEncodingFromMetaTag('<meta charset=\'utf-8\' />'));
        $this->assertEquals('utf-8', XmlParser::getEncodingFromMetaTag('<meta charset=utf-8/>'));
        $this->assertEquals('utf-8', XmlParser::getEncodingFromMetaTag('<meta charset=utf-8 />'));
        $this->assertEquals('utf-8', XmlParser::getEncodingFromMetaTag('<meta charset="utf-8">'));
        $this->assertEquals('utf-8', XmlParser::getEncodingFromMetaTag('<meta charset="utf-8" >'));
        $this->assertEquals('utf-8', XmlParser::getEncodingFromMetaTag('<meta charset=\'utf-8\'>'));
        $this->assertEquals('utf-8', XmlParser::getEncodingFromMetaTag('<meta charset=\'utf-8\' >'));
        $this->assertEquals('utf-8', XmlParser::getEncodingFromMetaTag('<meta charset=utf-8>'));
        $this->assertEquals('utf-8', XmlParser::getEncodingFromMetaTag('<meta charset=utf-8 >'));
        $this->assertEquals('utf-8', XmlParser::getEncodingFromMetaTag('<meta  charset  =  "  utf-8  "  >'));
        $this->assertEquals('utf-8', XmlParser::getEncodingFromMetaTag('<meta  charset  =  \'  utf-8  \'  >'));
        $this->assertEquals('utf-8', XmlParser::getEncodingFromMetaTag('<meta  charset  =  "  utf-8  \'  >'));
        $this->assertEquals('utf-8', XmlParser::getEncodingFromMetaTag('<meta  charset  =  \'  utf-8  "  >'));
        $this->assertEquals('utf-8', XmlParser::getEncodingFromMetaTag('<meta  charset  =  "  utf-8     >'));
        $this->assertEquals('utf-8', XmlParser::getEncodingFromMetaTag('<meta  charset  =  \'  utf-8     >'));
        $this->assertEquals('utf-8', XmlParser::getEncodingFromMetaTag('<meta  charset  =     utf-8  \'  >'));
        $this->assertEquals('utf-8', XmlParser::getEncodingFromMetaTag('<meta  charset  =     utf-8  "  >'));
        $this->assertEquals('utf-8', XmlParser::getEncodingFromMetaTag('<meta  charset  =     utf-8     >'));
        $this->assertEquals('utf-8', XmlParser::getEncodingFromMetaTag('<meta  charset  =     utf-8    />'));
        $this->assertEquals('utf-8', XmlParser::getEncodingFromMetaTag('<meta name="title" value="charset=utf-8 — is it really useful (yep)?">'));
        $this->assertEquals('utf-8', XmlParser::getEncodingFromMetaTag('<meta value="charset=utf-8 — is it really useful (yep)?" name="title">'));
        $this->assertEquals('utf-8', XmlParser::getEncodingFromMetaTag('<meta name="title" content="charset=utf-8 — is it really useful (yep)?">'));
        $this->assertEquals('utf-8', XmlParser::getEncodingFromMetaTag('<meta name="charset=utf-8" content="charset=utf-8 — is it really useful (yep)?">'));
        $this->assertEquals('utf-8', XmlParser::getEncodingFromMetaTag('<meta content="charset=utf-8 — is it really useful (nope, not here, but gotta admit pretty robust otherwise)?" name="title">'));
        $this->assertEquals('iso-8859-1', XmlParser::getEncodingFromMetaTag('<meta http-equiv="Content-Type" content="text/html;charset=iSo-8859-1"/><meta charset="invalid" />'));
    }

    public function testGetEncodingFromXmlTag()
    {
        $this->assertEquals('utf-8', XmlParser::getEncodingFromXmlTag("<?xml version='1.0' encoding='UTF-8'?><?xml-stylesheet"));
        $this->assertEquals('utf-8', XmlParser::getEncodingFromXmlTag('<?xml version="1.0" encoding="UTF-8"?><feed xml:'));
        $this->assertEquals('windows-1251', XmlParser::getEncodingFromXmlTag('<?xml version="1.0" encoding="Windows-1251"?><rss version="2.0">'));
        $this->assertEquals('', XmlParser::getEncodingFromXmlTag("<?xml version='1.0'?><?xml-stylesheet"));
    }

    public function testScanForXEE()
    {
        $this->expectException(XmlEntityException::class);
        $xml = <<<XML
<?xml version="1.0"?>
<!DOCTYPE results [<!ENTITY harmless "completely harmless">]>
<results>
    <result>This result is &harmless;</result>
</results>
XML;

        XmlParser::getDomDocument($xml);
    }

    public function testScanForXXE()
    {
        $this->expectException(XmlEntityException::class);
        $xml = <<<XML
<?xml version="1.0"?>
<!DOCTYPE root
[
<!ENTITY foo SYSTEM "file://test">
]>
<results>
    <result>&foo;</result>
</results>
XML;

        XmlParser::getDomDocument($xml);
    }

    public function testScanSimpleXML()
    {
        return <<<XML
<?xml version="1.0"?>
<results>
    <result>test</result>
</results>
XML;
        $result = XmlParser::getSimpleXml($xml);
        $this->assertTrue($result instanceof SimpleXMLElement);
        $this->assertEquals($result->result, 'test');
    }

    public function testScanDomDocument()
    {
        return <<<XML
<?xml version="1.0"?>
<results>
    <result>test</result>
</results>
XML;
        $result = XmlParser::getDomDocument($xml);
        $this->assertTrue($result instanceof DOMDocument);
        $node = $result->getElementsByTagName('result')->item(0);
        $this->assertEquals($node->nodeValue, 'test');
    }

    public function testScanInvalidXml()
    {
        $xml = <<<XML
<foo>test</bar>
XML;

        $this->assertFalse(XmlParser::getDomDocument($xml));
        $this->assertFalse(XmlParser::getSimpleXml($xml));
    }

    public function testScanXmlWithDTD()
    {
        $xml = <<<XML
<?xml version="1.0"?>
<!DOCTYPE results [
<!ELEMENT results (result+)>
<!ELEMENT result (#PCDATA)>
]>
<results>
    <result>test</result>
</results>
XML;

        $result = XmlParser::getDomDocument($xml);
        $this->assertTrue($result instanceof DOMDocument);
        $this->assertTrue($result->validate());
    }

    public function testReplaceXPathPrefixWithNamespaceURI()
    {
        $ns = array('lorem' => 'https://en.wikipedia.org/wiki/Lorem');
        $query = '//lorem:title';
        $expected = '//*[namespace-uri()="https://en.wikipedia.org/wiki/Lorem" and local-name()="title"]';
        $this->assertEquals($expected, XmlParser::replaceXPathPrefixWithNamespaceURI($query, $ns));

        $ns = array('lorem' => 'https://en.wikipedia.org/wiki/Lorem', 'ipsum' => 'https://en.wikipedia.org/wiki/Ipsum');
        $query = '//lorem:title/ipsum:name';
        $expected = '//*[namespace-uri()="https://en.wikipedia.org/wiki/Lorem" and local-name()="title"]/*[namespace-uri()="https://en.wikipedia.org/wiki/Ipsum" and local-name()="name"]';
        $this->assertEquals($expected, XmlParser::replaceXPathPrefixWithNamespaceURI($query, $ns));

        $ns = array('lorem' => 'https://en.wikipedia.org/wiki/Lorem', 'ipsum' => 'https://en.wikipedia.org/wiki/Ipsum');
        $query = '//lorem:title/ipsum:name/@xml:lang';
        $expected = '//*[namespace-uri()="https://en.wikipedia.org/wiki/Lorem" and local-name()="title"]/*[namespace-uri()="https://en.wikipedia.org/wiki/Ipsum" and local-name()="name"]/@xml:lang';
        $this->assertEquals($expected, XmlParser::replaceXPathPrefixWithNamespaceURI($query, $ns));
    }
}
