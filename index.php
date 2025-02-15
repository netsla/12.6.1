<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styles.css">
    <title>12.6.1 Практика (HW-02)</title>
</head>

<body>
    <?php
    $example_persons_array = [
        [
            'fullname' => 'Иванов Иван Иванович',
            'job' => 'tester',
        ],
        [
            'fullname' => 'Степанова Наталья Степановна',
            'job' => 'frontend-developer',
        ],
        [
            'fullname' => 'Пащенко Владимир Александрович',
            'job' => 'analyst',
        ],
        [
            'fullname' => 'Громов Александр Иванович',
            'job' => 'fullstack-developer',
        ],
        [
            'fullname' => 'Славин Семён Сергеевич',
            'job' => 'analyst',
        ],
        [
            'fullname' => 'Цой Владимир Антонович',
            'job' => 'frontend-developer',
        ],
        [
            'fullname' => 'Быстрая Юлия Сергеевна',
            'job' => 'PR-manager',
        ],
        [
            'fullname' => 'Шматко Антонина Сергеевна',
            'job' => 'HR-manager',
        ],
        [
            'fullname' => 'аль-Хорезми Мухаммад ибн-Муса',
            'job' => 'analyst',
        ],
        [
            'fullname' => 'Бардо Жаклин Фёдоровна',
            'job' => 'android-developer',
        ],
        [
            'fullname' => 'Шварцнегер Арнольд Густавович',
            'job' => 'babysitter',
        ],
    ];

/*Информационная система ФИО пользователей, 
где ФИО хранятся в отдельных строках*/

$surname = 'Иванов';
$name = 'Иван';
$patronomyc = 'Иванович';

/* ОБЪЕДИНЕНИЕ ФИО: getFullnameFromParts принимает как аргумент три строки — 
фамилию, имя и отчество. Возвращает как результат их же, 
но склеенные через пробел. */
function getFullnameFromParts($surname, $name, $patronomyc) {
    return $surname . ' ' . $name . ' ' . $patronomyc;
}
echo (getFullnameFromParts($surname, $name, $patronomyc));
echo "<br>";
echo "<br>";

/* РАЗДЕЛЕНИЕ ФИО: getPartsFromFullname принимает как аргумент одну строку — 
склеенное ФИО. Возвращает как результат массив из трёх 
элементов с ключами ‘name’, ‘surname’ и ‘patronomyc*/
function getPartsFromFullname($name) {
    $name_key = ['surname', 'name', 'patronomyc'];
    $name_value = explode(' ', $name);
    return array_combine($name_key, $name_value);
}
// Выборка значений ключа 'fullname' из массива $example_persons_arra 
foreach ($example_persons_array as $value) {
    $name = $value['fullname'];
    $parts = getPartsFromFullname($name);

    // Вывод значений на каждой строке
foreach ($parts as $key => $value) {
    echo "$key: $value<br>";
}
};
echo "<br>";

/* СОКРАЩЕНИЕ ФИО: функция getShortName, принимает как аргумент строку,
 содержащую ФИО вида «Иванов Иван Иванович» и возвращает строку 
 вида «Иван И.», где сокращается фамилия и отбрасывается отчество. 
 Для разбиения строки на составляющие используется функция 
 getPartsFromFullname */

 function getShortName($name) {
    $var = getPartsFromFullname($name);
    $forname = $var['name'];
    $surname = $var['surname'];
    return $forname . ' ' . mb_substr($surname, 0, 1) . '.';
}
    // Вывод значений на каждой строке
foreach ($example_persons_array as $value) {
    $name = $value['fullname'];
    echo getShortName($name) . "<br>"; 
};
echo "<br>";

/* Определение пола по ФИО. 
Разработана функция **getGenderFromName**, принимающая как аргумент строку, содержащую ФИО (вида «Иванов Иван Иванович»). 
Будем производить определение следующим образом:
1. внутри функции делим ФИО на составляющие с помощью функции **getPartsFromFullname**;
2. изначально «суммарный признак пола» считаем равным 0;
3. если присутствует признак мужского пола — прибавляем единицу;
4. если присутствует признак женского пола — отнимаем единицу.
5. после проверок всех признаков, если «суммарный признак пола» больше нуля — возвращаем 1 (мужской пол);
6. после проверок всех признаков, если «суммарный признак пола» меньше нуля — возвращаем -1 (женский пол);
7. после проверок всех признаков, если «суммарный признак пола» равен 0 — возвращаем 0 (неопределенный пол).
Признаки женского пола:
* отчество заканчивается на «вна»;
* имя заканчивается на «а»;
* фамилия заканчивается на «ва»;
Признаки мужского пола:
* отчество заканчивается на «ич»;
* имя заканчивается на «й» или «н»;
* фамилия заканчивается на «в». */

function getGenderFromName($name) {
    $var = getPartsFromFullname($name);
    $surname = $var['surname'];
    $forname = $var['name'];
    $patronomyc = $var['patronomyc'];
    $sumGender = 0;

    if (mb_substr($surname, -1, 1) === 'в') {
        $sumGender++;
    } elseif (mb_substr($surname, -2, 2) === 'ва') {
        $sumGender--;
    }

    if ((mb_substr($forname, -1, 1) == 'й') || (mb_substr($forname, -1, 1) == 'н')) {
        $sumGender++;
    } elseif (mb_substr($forname, -1, 1) === 'а') {
        $sumGender--;
    }

    if (mb_substr($patronomyc, -2, 2) === 'ич') {
        $sumGender++;
    } elseif (mb_substr($patronomyc, -3, 3) === 'вна') {
        $sumGender--;
    }

    return ($sumGender <=> 0);
}

foreach ($example_persons_array as $value) {
    $name = $value['fullname'];
    if (getGenderFromName($name) === 1) {
        echo 'мужской пол ' . ($name) . '<br>';
    } elseif (getGenderFromName($name) === -1) {
        echo 'женский пол ' . ($name) . '<br>';
    } else {
        echo 'неопределённый пол ' . ($name) . '<br>';
    }
};
?>

</body>
</html>
