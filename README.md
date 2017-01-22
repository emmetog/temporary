# Temporary Files and Directories
Allows easy handling of temporary files and directories which are removed automatically

# Usage

## Temporary Files

```php
<?php

use Emmetog\Temporary\File;

$tempFile = new File();

// Returns the generated temporary filename.
$filename = $tempFile->getFilename();

file_put_contents($filename, 'This file is only temporary');

// When we remove all references to the object, the file is removed.
unset($tempFile);
// Or
$tempFile->remove();
```

You don't have to call `unset()` or `->remove()`, the file will also
be removed automatically when the script ends.

## Temporary Directories

```php
<?php

use Emmetog\Temporary\Directory;

$tempDir = new Directory();

// Returns the generated temporary directory path.
$tempPath = $tempDir->getDirectory();

// Let's fill the directory with a file.
file_put_contents($tempPath . '/somefile.txt', 'This file is inside a temporary dir');

// When we remove all references to the object, the directory and
// all subdirectories are removed.
unset($tempDir);
// Or
$tempDir->remove();
```

You don't have to call `unset()` or `->remove()`, the directory and all 
subdirectories will be removed automatically when the script ends.

**WARNING**: Any and all files or directories that you create inside the
the temporary directory or anything you put inside a temporary file will be
completely removed when the script ends. This is what the library is for,
so don't put anything important in there.