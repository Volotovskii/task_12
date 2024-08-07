<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/styles.css" />
</head>

<body>
    <main>

        <!-- Разбиение и объединение ФИО -->
        <section class="truth">

            <table>
                <caption>
                    <h3>Разбиение и объединение ФИО</h3>
                </caption>
                <thead>
                    <tr>
                        <th>ФИО</th>
                        <th>Фамилия</th>
                        <th>Имя</th>
                        <th>Отчество</th>
                    </tr>
                </thead>
                <tbody>
                    <?php


                    require_once './models/processingStr.php';
                    require_once './models/feature.php';

                    //Разбиение и объединение ФИО из массива example_persons_array
                    foreach ($example_persons_array as $x) {
                        echo "<tr>";
                        // разбиваем ФИО на части для функции getFullnameFromParts
                        list($surname, $name, $patronomyc) = explode(' ', $x['fullname']);
                        $listFullname = getFullnameFromParts($surname, $name, $patronomyc); // Возвращает как результат их же, но склеенные через пробел. 
                        echo "<td>" . $listFullname . "</td>";

                        $listParts = getPartsFromFullname($x['fullname']); // Отправляем ФИО возвращаем массив $surname, $name, $patronomyc

                        // Выводим разбитые ФИО
                        echo "<td>" . $listParts['surname'] . "</td>";
                        echo "<td>" . $listParts['name'] . "</td>";
                        echo "<td>" . $listParts['patronomyc'] . "</td>";
                        echo "</tr>";
                    }

                    ?>

                </tbody>
            </table>

        </section>

        <!-- Сокращение ФИО -->
        <section class="truth">

            <table>
                <caption>
                    <h3>Сокращение ФИО</h3>
                </caption>
                <thead>
                    <tr>
                        <th>ФИО </th>
                        <th>Сокращение ФИО </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($example_persons_array as $x) {
                        //Сокращение ФИО
                        $reduction = getShortName($x['fullname']);
                        echo "<tr>";
                        echo "<td>" . $x['fullname'] . "</td>";
                        echo "<td>" . $reduction . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <!-- Функция определения пола по ФИО -->
        <section class="truth">

            <table>
                <caption>
                    <h3>Функция определения пола по ФИО</h3>
                    <h4>мужской: 1
                        женский: -1
                        неопределенный пол: 0
                    </h4>
                </caption>
                <thead>
                    <tr>
                        <th>ФИО</th>
                        <th>Пол</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    //Функция определения пола по ФИО из массива example_persons_array
                    foreach ($example_persons_array as $x) {
                        echo "<tr>";
                        echo "<td>" . $x['fullname'] . "</td>";
                        $gender = getGenderFromName($x['fullname']);
                        echo "<td>" . $gender . "</td>";
                        echo "</tr>";
                    }
                    ?>

                </tbody>
            </table>



        </section>

        <!-- Определение возрастно-полового состава -->
        <section class="truth">

            <table>
                <caption>
                    <h3>Гендерный состав аудитории:</h3>
                </caption>
                <thead>
                    <tr>
                        <th>Мужчины </th>
                        <th>Женщины </th>
                        <th>Не удалось определить </th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    //Определение возрастно-полового состава
                    $mas = getGenderDescription($example_persons_array);
                    //Перенёс округления в функую 
                    // echo "<td>" . round($mas[1], 1) . "</td>";
                    // echo "<td>" . round($mas[-1], 1) . "</td>";
                    // echo "<td>" . round($mas[0], 1) . "</td>";

                    echo "<td>" . $mas[1] . "</td>";
                    echo "<td>" . $mas[-1] . "</td>";
                    echo "<td>" . $mas[0] . "</td>";
                    ?>
                </tbody>
            </table>
        </section>

        <section class="truth">

            <table>
                <caption>
                    <h3>Идеальный подбор пары</h3>
                </caption>
                <!-- <thead>
            <tr>
                <th>Мужчины </th>
            </tr>
        </thead> -->
                <tbody>
                    <?php

                    list($surname, $name, $patronomyc) = explode(' ', $example_persons_array[rand(0, count($example_persons_array) - 1)]['fullname']);

                    echo "<td>" . getPerfectPartner($surname, $name, $patronomyc, $example_persons_array) . "</td>";
                    ?>
                </tbody>
            </table>
        </section>


    </main>

</body>

</html>