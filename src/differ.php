<?php

namespace GETDIFF\DIFFER;

function getDiff($firstFileObject, $secondFileObject)
{
    $firstFile = get_object_vars($firstFileObject);
    $secondFile = get_object_vars($secondFileObject);
    // Получаем уникальные ключи массивов
    $firstFileUnicKeys = array_diff_key($firstFile, $secondFile);
    $secondFileUnicKeys = array_diff_key($secondFile, $firstFile);

    // Повторящиеся ключи
    $repeatingKeys = array_intersect_key($firstFile, $secondFile);

    // Обрабатываем уникальные ключи
    $resultFirst = array_map(function ($key, $value) {
        return "- $key: $value";
    }, array_keys($firstFileUnicKeys), $firstFileUnicKeys);

    $resultSecond = array_map(function ($key, $value) {
        return "+ $key: $value";
    }, array_keys($secondFileUnicKeys), $secondFileUnicKeys);

    // Обрабатываем общие ключи
    $resultCommon = array_map(function ($key) use ($firstFile, $secondFile) {
        if ($firstFile[$key] === $secondFile[$key]) {
            return "$key: $firstFile[$key]";
        } else {
            return ["- $key: $firstFile[$key]" , "+ $key: $secondFile[$key]"];
        }
    }, array_keys($repeatingKeys));

    $resultCommon = array_reduce($resultCommon, function ($carry, $item) {
        if (is_array($item)) {
            return array_merge($carry, $item);
        }
        $carry[] = $item;
        return $carry;
    }, []);

    // Объединяем все результаты
    $result = array_merge($resultFirst, $resultCommon, $resultSecond);

    return implode(PHP_EOL, $result);
}
