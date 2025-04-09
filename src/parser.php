<?php

namespace GENDIFF\PARSER;

use Symfony\Component\Yaml\Yaml;

function parsingFile(string $filePath)
{
    if (!file_exists($filePath)) {
        throw new \Exception("Invalid filepath: {$filePath}");
    }
    $fileContent = file_get_contents($filePath);

    if ($fileContent === false) {
        throw new \Exception("Can't read file: {$filePath}");
    }
    
    $pathInfo= pathinfo($filePath);
    //var_dump ($pathInfo['extension']);
    
    switch ($pathInfo['extension']) {
        case 'json':
            return json_decode($fileContent);
        case 'yaml':
            return Yaml::parse($fileContent,Yaml::PARSE_OBJECT_FOR_MAP);
        case 'yml':
            return Yaml::parse($fileContent, Yaml::PARSE_OBJECT_FOR_MAP);
    }
    
}
