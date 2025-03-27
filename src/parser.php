<?php

namespace GETDIFF\PARSER;

function parsingFile (string $filePath)
{
    if (!file_exists($filePath)) {
        throw new \Exception("Invalid filepath: {$filePath}");
    }
    $fileContent = file_get_contents($filePath);

    if ($fileContent === false) {
        throw new \Exception("Can't read file: {$filePath}");
    }
    return json_decode($fileContent, false, 512, JSON_THROW_ON_ERROR);

}
