<?php
require_once __DIR__ . '/processingStr.php';


function getGenderFromName($fullname)
{

    $parts = getPartsFromFullname($fullname); // Разбиваем ФИО на Ф.И.О

    $gender = 0; // Признак гендера


    //Признаки женского пола: сумируем их.
    if (str_ends_with($parts['patronomyc'], "вна")) $gender--;
    if (str_ends_with($parts['name'], "а")) $gender--;
    if (str_ends_with($parts['surname'], "ва")) $gender--;
    //   

    //Признаки мужского пола: сумируем их.
    if (str_ends_with($parts['patronomyc'], "ич")) $gender++;
    if (str_ends_with($parts['name'], "й") || str_ends_with($parts['name'], "н")) $gender++;
    if (str_ends_with($parts['surname'], "в")) $gender++;
    //

    return ($gender > 0) ? 1 : (($gender < 0) ? -1 : 0);
}


//Определение возрастно-полового состава
function getGenderDescription($fullname)
{

    $mass = array();

    foreach ($fullname as $x) {
        array_push($mass, getGenderFromName($x['fullname']));
    }

    $mass_count_val = array_count_values($mass); // количество вхождений каждого отдельного значения в массиве

    $mass_count_val[1] = ($mass_count_val[1] * 100) / count($mass); // перезаписываем мужской пол в процентах от всех 
    $mass_count_val[-1] = ($mass_count_val[-1] * 100) / count($mass); // перезаписываем женский пол в процентах от всех 
    $mass_count_val[0] = ($mass_count_val[0] * 100) / count($mass); // перезаписываем хз пол в процентах от всех 

    return $mass_count_val;
}

//Идеальный подбор пары
function getPerfectPartner($surname, $name, $patronomyc, $fullname)
{

    // mb_strtolower - меняем на нижний регистр слово целиком
    // mb_convert_case (MB_CASE_TITLE) - меняем первую букву на заглавную
    // getFullnameFromParts соеденяем ФИО
    $fromParts = getFullnameFromParts(
        mb_convert_case(mb_strtolower($surname), MB_CASE_TITLE, "UTF-8"),
        mb_convert_case(mb_strtolower($name), MB_CASE_TITLE, "UTF-8"),
        mb_convert_case(mb_strtolower($patronomyc), MB_CASE_TITLE, "UTF-8")
    );


    $gender_person = getGenderFromName($fromParts); // определяем гендер переданной персоны


    while (true) {
        $random_person = $fullname[rand(0, count($fullname) - 1)]['fullname']; // рандомный человек из массива

        $random_gender = getGenderFromName($random_person); // определяем его пол

        if ($gender_person != $random_gender) // Если их гендер разный то -
        {
            if ($gender_person === 0 || $random_gender === 0) { // если у одной из персон гендер 0 то - 
                return  'Не удалось определить пол но вы можете присмортеться: <br/>' . getShortName($fromParts) . ' + ' . getShortName($random_person) . ' =' . '<br/>' . '♡ Идеально на ' . round(rand(50, 100), 2) . '% ♡';
            }
            return getShortName($fromParts) . ' + ' . getShortName($random_person) . ' =' . '<br/>' . '♡ Идеально на ' . round(rand(50, 100), 2) . '% ♡';
        }
    }
}
