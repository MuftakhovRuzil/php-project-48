<?php

namespace GETDIFF\TESTS;

use PHPUnit\Framework\TestCase;

use function GETDIFF\DIFFER\getDiff;
use function GETDIFF\PARSER\parsingFile;

class GetDiffTest extends TestCase
{
    /** @test */
    
    public function testGetDiff(): void
    {
        $fromFunction = getDiff(parsingFile("/home/ruzil/php-project-48/files/file1.json"),parsingFile("/home/ruzil/php-project-48/files/file2.json"));
        var_dump($fromFunction);
        $expectedDiff = file_get_contents(__DIR__."/fixtures/test1");
        var_dump($expectedDiff);
        $this->assertEquals($expectedDiff, $fromFunction);

    }
}