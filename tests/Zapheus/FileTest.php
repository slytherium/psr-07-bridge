<?php

namespace Zapheus\Bridge\Psr\Zapheus;

use Zapheus\Bridge\Psr\UploadedFile;

/**
 * File Test
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class FileTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $file;

    /**
     * @var \Zapheus\Http\Message\UploadedFileInterface
     */
    protected $uploaded;

    /**
     * Sets up the uploaded file instance.
     *
     * @return void
     */
    public function setUp()
    {
        $file = $this->file = __DIR__ . '/../Fixture/Views/PopPop.php';

        $this->uploaded = $this->instance($file);
    }

    /**
     * Tests UploadedFileInterface::name.
     *
     * @return void
     */
    public function testNameMethod()
    {
        $expected = basename($this->file);

        $result = $this->uploaded->name();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests UploadedFileInterface::type.
     *
     * @return void
     */
    public function testTypeMethod()
    {
        $expected = mime_content_type($this->file);

        $result = $this->uploaded->type();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests UploadedFileInterface::error.
     *
     * @return void
     */
    public function testErrorMethod()
    {
        $expected = UPLOAD_ERR_OK;

        $result = $this->uploaded->error();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests UploadedFileInterface::getSize.
     *
     * @return void
     */
    public function testSizeMethod()
    {
        $expected = filesize($this->file);

        $result = $this->uploaded->size();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests UploadedFileInterface::getStream.
     *
     * @return void
     */
    public function testStreamMethod()
    {
        $expected = 'Zapheus\Http\Message\StreamInterface';

        $result = $this->uploaded->stream();

        $this->assertInstanceof($expected, $result);
    }

    /**
     * Tests UploadedFileInterface::moveTo.
     *
     * @return void
     */
    public function testMoveToMethod()
    {
        $target = str_replace('PopPop', 'NewFile', $this->file);

        $this->uploaded->move($target);

        $this->assertFileExists($target);

        $uploaded = $this->instance($target);

        $uploaded->move($this->file);
    }

    /**
     * Creates a new \UploadedFileInterface instance.
     *
     * @param  string $file
     * @return \UploadedFileInterface
     */
    protected function instance($file)
    {
        file_put_contents($file, 'Hello world');

        $size = filesize($file);

        $name = basename($file);

        $type = mime_content_type($file);

        $psr = new UploadedFile($file, $size, UPLOAD_ERR_OK, $name, $type);

        return new File($psr);
    }
}
