<?php

namespace Emmetog\TempFile;

class Temporary
{
    /**
     * @var string
     */
    private $filename;

    public function __construct($prefix = null, $tempDir = null)
    {
        $prefix = ($prefix) ? $prefix : '';
        $tempDir = ($tempDir) ? $tempDir : sys_get_temp_dir();

        $this->filename = tempnam($tempDir, $prefix);
    }

    public function __destruct()
    {
        $this->remove();
    }

    public function write($contents)
    {
        file_put_contents($this->filename, $contents);
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function remove()
    {
        @unlink($this->filename);
    }
}
