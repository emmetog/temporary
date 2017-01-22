<?php

namespace Emmetog\Temporary;

class DirectoryTest extends \PHPUnit_Framework_TestCase
{
    public function testTemporaryDirectoryExistsWhenCreated()
    {
        $tempDir = new Directory();

        $path = $tempDir->getDirectory();

        $this->assertTrue(is_dir($path));
    }

    public function testTemporaryDirectoryIsRemovedWhenRemoveIsCalled()
    {
        $tempDir = new Directory();

        $path = $tempDir->getDirectory();

        $this->assertTrue(is_dir($path));
        $tempDir->remove();

        $this->assertFalse(is_dir($path));
    }

    public function testTemporaryDirectoryIsRemovedWhenObjectIsDestroyed()
    {
        $tempDir = new Directory();

        $path = $tempDir->getDirectory();

        $this->assertTrue(is_dir($path));

        unset($tempDir);

        $this->assertFalse(is_dir($path));
    }

    public function testTemporaryDirectoryContentsAreRemoved()
    {
        $tempDir = new Directory();

        $path = $tempDir->getDirectory();

        $this->assertTrue(is_dir($path));

        // Now let's create some temporary files in the directory.
        $deepPath = $path . '/test/something';
        mkdir($deepPath, 0777, true);

        file_put_contents($deepPath . '/test_file.txt', 'This file and all subdirs should be removed');

        unset($tempDir);

        $this->assertFalse(is_dir($path));
        $this->assertFalse(file_exists($deepPath . '/test_file.txt'));
    }
}