<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Истинность PHP</title>
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

//Информационная система ФИО пользователей, где ФИО хранятся в отдельных строках

    $base_persons_array = [
        [
            'surname' => 'Громов',
            'name' => 'Александр',
            'patronymic' => 'Иванович',
        ],
        [
            'surname' => 'Петров',
            'name' => 'Роман',
            'patronymic' => 'Сергеевич',
        ]
    ];

    function getFullnameFromParts($personsArray)
    {
        $output = '';

        foreach ($personsArray as $person) {
            $output .= 'ФИО: ' . $person['surname'] . ' ' . $person['name'] . ' ' . $person['patronymic'] . "<br>";
        }

        echo $output;
    };

    getFullnameFromParts($base_persons_array);

// -----------------------------------------------------------
    
    function getPartsFromFullname($example_persons_array)
    {
        foreach ($example_persons_array as $person) {
            $fullname = $person['fullname'];
            $parts = explode(' ', $fullname);

            if (count($parts) == 3) { // Если в строке три слова
                $name = trim($parts[0]);
                $surname = trim($parts[1]);
                $patronymic = trim($parts[2]);

                echo "Фамилия: {$name}<br>";
                echo "Имя: {$surname}<br>";
                echo "Отчество: {$patronymic}<br>";
            } else {
                // Если в строке меньше трёх слов, продолжаем цикл
            }
        }
    };

    getPartsFromFullname($example_persons_array);

// ---------------------------------------------------------
    
    function getShortName($example_persons_array)
    {
        $shortNames = [];

        foreach ($example_persons_array as $person) {
            $fullname = $person['fullname'];
            $parts = explode(' ', $fullname);

            if (count($parts) == 3) { // Если в строке три слова
                $name = trim($parts[0]);
                $surname = trim($parts[1]);
                $patronymic = trim($parts[2]);

                // Склеиваем имя и фамилию в одну строку
                $shortName = $surname . " " . mb_substr($name, 0, 1) . ".";

                array_push($shortNames, $shortName);
            }
        }

        return $shortNames;
    };
 
// ----------------------------------------------------------
// Функция определения пола по ФИО

    $basePersonsArrayFull = [
        ['fullname' => 'Громов Александр Иванович'],
        ['fullname' => 'Петров Роман Сергеевич'],
        ['fullname' => 'Романова Ирина Викторовна'],
    ];


    function getGenderFromName($fio): int
    {
        $gender = 0;

// Разделяем ФИО на составляющие
        list($last_name, $first_name, $middle_name) = explode(' ', $fio);

        if (substr($middle_name, -3) == 'вна') {
            $gender--;
        }
        if (substr($first_name, -1) == 'а') {
            $gender--;
        }
        if (substr($last_name, -2) == 'ва') {
            $gender--;
        }

        if (substr($middle_name, -3) == 'ич') {
            $gender++;
        } else if (substr($first_name, -1) == 'й' || substr($first_name, -1) == 'н') {
            $gender++;
        } else if (substr($last_name, -2) == 'в') {
            $gender++;
        }

        return $gender;
    };


    foreach ($basePersonsArrayFull as $person) {
        $fio = $person['fullname'];
        $gender = getGenderFromName($fio);

        if ($gender == 1) {
            echo "Пол: мужской<br>";
            echo "$fio<br>";
        } else if ($gender == -1) {
            echo "Пол: женский<br>";
            echo "$fio<br>";
        } else if ($gender == 0) {
            echo "Пол: неопределённый<br>";
            echo "$fio<br>";
        }
    };

// ----------------------------------------------------------------
// Определение возрастно-полового состава
    
    function getGenderDescription($persons)
    {
        $gender = [];

        foreach ($persons as $person) {
            $fullname = $person['fullname'];
            $gender[$person['fullname']] = getGenderFromName($fullname);
        }

        $men = array_sum(array_filter($gender, function ($gender) {
            return $gender > 0;
        }));

        $women = array_sum(array_filter($gender, function ($gender) {
            return $gender < 0;
        }));

        $unknown = count($persons) - $men - $women;

        // Вычисляем процентное соотношение для каждого пола
        $total = count($persons);
        $percentMen = round((100 * $men) / $total, 2);
        $percentWomen = round((100 * $women) / $total, 2);
        $percenFailedGender = round((100 * $unknown) / $total, 2);

        return <<<HEREDOC
    Гендерный состав аудитории:
    ---------------------------
    Мужчины - $percentMen%
    Женщины - $percentWomen%
    Не удалось определить - $percenFailedGender%
HEREDOC;
    }
    ;

    echo getGenderDescription($example_persons_array) . PHP_EOL;
    echo PHP_EOL;
?>

</body>
</html>