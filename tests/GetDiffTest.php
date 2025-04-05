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
        $expectedDiff = file_get_contents(__DIR__ . "/tests/fixtures/test1");
        $this->assertEquals($expectedDiff, $fromFunction);

    }
}