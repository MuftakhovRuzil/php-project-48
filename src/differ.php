<?php

namespace GENDIFF\DIFFER;

function genDiff($firstFileObject, $secondFileObject)
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
        return "- $key: " . (is_bool($value) ? ($value ? 'true' : 'false') : $value);
    }, array_keys($firstFileUnicKeys), $firstFileUnicKeys);

    $resultSecond = array_map(function ($key, $value) {
        return "+ $key: " . (is_bool($value) ? ($value ? 'true' : 'false') : $value);
    }, array_keys($secondFileUnicKeys), $secondFileUnicKeys);

    // Обрабатываем повторяющиеся ключи
    $resultCommon = array_map(function ($key) use ($firstFile, $secondFile) {
        if ($firstFile[$key] === $secondFile[$key]) {
            return "  $key: " . (is_bool($firstFile[$key]) ? ($firstFile[$key] ? 'true' : 'false') : $firstFile[$key]);
        } else {
            return ["- $key: " . (is_bool($firstFile[$key]) ? ($firstFile[$key] ? 'true' : 'false') : $firstFile[$key]),
            "+ $key: " . (is_bool($secondFile[$key]) ? ($secondFile[$key] ? 'true' : 'false') : $secondFile[$key])];
        }
    }, array_keys($repeatingKeys));
    var_dump($resultCommon);
    // переводим массив для свлучаев - + в строку
    $resultCommon = array_reduce($resultCommon, function ($carry, $item) {
        if (is_array($item)) {
            return array_merge($carry, $item);
        }
        $carry[] = $item;
        return $carry;
    }, []);

    // Объединяем все результаты
    $result = array_merge($resultCommon, $resultFirst, $resultSecond);
    var_dump($result);
    // Сортируем
    usort($result, function ($a, $b) {
        $keyA = trim(explode(':', $a)[0], ' -+');
        $keyB = trim(explode(':', $b)[0], ' -+');
        return strcmp($keyA, $keyB);
    });

    return implode(PHP_EOL, $result);
}
