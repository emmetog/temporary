<?php

namespace Emmetog\Temporary;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class Directory
{
    /**
     * @var string
     */
    private $path;

    public function __construct($prefix = null, $tempDir = null)
    {
        $prefix = ($prefix) ? $prefix : '';
        $tempDir = ($tempDir) ? $tempDir : sys_get_temp_dir();

        if (substr($tempDir, strlen($tempDir) - 1, 1) != '/') {
            $tempDir .= '/';
        }

        $this->path = $tempDir . uniqid($prefix);

        mkdir($this->path);
    }

    public function __destruct()
    {
        $this->remove();
    }

    public function getDirectory()
    {
        return $this->path;
    }

    public function remove()
    {
        if(!is_dir($this->path))
        {
            return;
        }

        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($this->path, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($files as $fileinfo) {
            if ($fileinfo->isDir()) {
                rmdir($fileinfo->getRealPath());
            } else {
                unlink($fileinfo->getRealPath());
            }
        }

        rmdir($this->path);
    }
}
