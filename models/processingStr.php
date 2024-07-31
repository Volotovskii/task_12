<?php
require_once __DIR__ . '/structures.php';


//namespace MyFuncs; // Имя пространства имен - MyFuncs
function getFullnameFromParts($surname, $name, $patronomyc)
{

    // TODO Если не хватает значений пускай так и будет пусто? тогда при определении пола ошибка будет проверка? 

    //return "<td>". $surname ." ". $name. " ".$patronomyc ."</td>" ; // из-за td не получется использовать ещё где 
    return  $surname . " " . $name . " " . $patronomyc;
}

// Разбиваем ФИО на Ф.И.О
function getPartsFromFullname($fullname)
{
    $parts = explode(' ', $fullname);
    return [
        'surname' => $parts[0],
        'name' => $parts[1],
        'patronomyc' => $parts[2]
    ];
}

//Сокращение ФИО «Иванов Иван Иванович» -> «Иван И.»
function getShortName($fullname)
{
    $parts = getPartsFromFullname($fullname);

    return $parts['name'] . " " . substr($parts['surname'], 0, 2) . ".";
}
