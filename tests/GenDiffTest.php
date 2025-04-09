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
        // Тест json файлов
        $fromFunction = genDiff(parsingFile(__DIR__."/fixtures/file1.json"),parsingFile(__DIR__."/fixtures/file2.json"));
        //var_dump($fromFunction);
        $expectedDiff = file_get_contents(__DIR__."/fixtures/test1");
        //var_dump($expectedDiff);
        $this->assertEquals($expectedDiff, $fromFunction);
        
        // Тест YML файлов
        $fromFunction2 = genDiff(parsingFile(__DIR__."/fixtures/file1.yml"),parsingFile(__DIR__."/fixtures/file2.yml"));
        //var_dump($fromFunction);
        $expectedDiff2 = file_get_contents(__DIR__."/fixtures/test1");
        //var_dump($expectedDiff);
        $this->assertEquals($expectedDiff2, $fromFunction2);
    }
}