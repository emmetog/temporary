<?php

namespace Emmetog\TempFile;

class TemporaryTest extends \PHPUnit_Framework_TestCase
{
    public function testTemporaryFileExistsWhenCreated()
    {
        $tempFile = new Temporary();

        $filename = $tempFile->getFilename();

        $this->assertTrue(file_exists($filename));
    }

    public function testTemporaryFileIsRemovedWhenRemoveIsCalled()
    {
        $tempFile = new Temporary();

        $filename = $tempFile->getFilename();

        $this->assertTrue(file_exists($filename));
        $tempFile->remove();

        $this->assertFalse(file_exists($filename));
    }

    public function testTemporaryFileIsRemovedWhenObjectIsDestroyed()
    {
        $tempFile = new Temporary();

        $filename = $tempFile->getFilename();

        $this->assertTrue(file_exists($filename));

        unset($tempFile);

        $this->assertFalse(file_exists($filename));
    }
}
