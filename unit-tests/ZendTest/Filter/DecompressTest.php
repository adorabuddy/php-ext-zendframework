<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ZendTest\Filter;

use Zend\Filter\Decompress as DecompressFilter;

/**
 * @group      Zend_Filter
 */
class DecompressTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        if (!extension_loaded('bz2')) {
            $this->markTestSkipped('This filter is tested with the bz2 extension');
        }
    }

    public function tearDown()
    {
        if (file_exists(__DIR__ . '/../_files/compressed.bz2')) {
            unlink(__DIR__ . '/../_files/compressed.bz2');
        }
    }

    /**
     * Basic usage
     *
     * @return void
     */
    public function testBasicUsage()
    {
        $filter  = new DecompressFilter('bz2');

        $text       = 'compress me';
        $compressed = $filter->compress($text);
        $this->assertNotEquals($text, $compressed);

        $decompressed = $filter($compressed);
        $this->assertEquals($text, $decompressed);
    }

    /**
     * Setting Archive
     *
     * @return void
     */
    public function testCompressToFile()
    {
        $filter   = new DecompressFilter('bz2');
        $archive = __DIR__ . '/../_files/compressed.bz2';
        $filter->setArchive($archive);

        $content = $filter->compress('compress me');
        $this->assertTrue($content);

        $filter2  = new DecompressFilter('bz2');
        $content2 = $filter2($archive);
        $this->assertEquals('compress me', $content2);

        $filter3 = new DecompressFilter('bz2');
        $filter3->setArchive($archive);
        $content3 = $filter3(null);
        $this->assertEquals('compress me', $content3);
    }

    /**
     * Basic usage
     *
     * @return void
     */
    public function testDecompressArchive()
    {
        $filter   = new DecompressFilter('bz2');
        $archive = __DIR__ . '/../_files/compressed.bz2';
        $filter->setArchive($archive);

        $content = $filter->compress('compress me');
        $this->assertTrue($content);

        $filter2  = new DecompressFilter('bz2');
        $content2 = $filter2($archive);
        $this->assertEquals('compress me', $content2);
    }

    public function testFilterMethodProxiesToDecompress()
    {
        $filter   = new DecompressFilter('bz2');
        $archive = __DIR__ . '/../_files/compressed.bz2';
        $filter->setArchive($archive);

        $content = $filter->compress('compress me');
        $this->assertTrue($content);

        $filter2  = new DecompressFilter('bz2');
        $content2 = $filter2->filter($archive);
        $this->assertEquals('compress me', $content2);
    }

    public function returnUnfilteredDataProvider()
    {
        return array(
            array(null),
            array(new \stdClass()),
            array(array(
                'decompress me',
                'decompress me too, please'
            ))
        );
    }

    /**
     * @dataProvider returnUnfilteredDataProvider
     * @return void
     */
    public function testReturnUnfiltered($input)
    {
        $filter = new DecompressFilter('bz2');

        $this->assertEquals($input, $filter($input));
    }
}