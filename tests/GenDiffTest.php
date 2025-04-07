<?php

namespace GENDIFF\TESTS;

use PHPUnit\Framework\TestCase;

use function GENDIFF\DIFFER\genDiff;
use function GENDIFF\PARSER\parsingFile;

class GenDiffTest extends TestCase
{
    /** @test */
    
    public function testGenDiff(): void
    {
        $fromFunction = genDiff(parsingFile("/home/ruzil/php-project-48/files/file1.json"),parsingFile("/home/ruzil/php-project-48/files/file2.json"));
        var_dump($fromFunction);
        $expectedDiff = file_get_contents(__DIR__."/fixtures/test1");
        var_dump($expectedDiff);
        $this->assertEquals($expectedDiff, $fromFunction);

    }
}