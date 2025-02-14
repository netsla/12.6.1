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
    <h2>Таблица истинности PHP</h2>
    <table class="table" id="x">
        <tr>
            <th>A</th>
            <th>B</th>
            <th>!A</th>
            <th>A || B</th>
            <th>A && B</th>
            <th>A xor B</th>
        </tr>


        <?php
        for ($a = 0; $a <= 1; $a++) {
            for ($b = 0; $b <= 1; $b++) {
                $negation = ($a == $b) ? 1 : 0;
                $or = ($a || $b) ? 1 : 0;
                $and = ($a && $b) ? 1 : 0;
                $xor = ($a != $b) ? 1 : 0;
                echo "<tr>";
                echo "<td>" . $a . "</td>";
                echo "<td>" . $b . "</td>";
                echo "<td>" . $negation . "</td>";
                echo "<td>" . $or . "</td>";
                echo "<td>" . $and . "</td>";
                echo "<td>" . $xor . "</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>

    <h2>Гибкое сравнение в PHP</h2>
    <div class="container1">
        <div class="valueY" style="float:left;" width="500">
            <table class="table" id="fontY" border="1">
                <tr>
                    <th>_</th>
                </tr>
                <tr>
                    <td>true</td>
                </tr>
                <tr>
                    <td>false</td>
                </tr>
                <tr>
                    <td>1</td>
                </tr>
                <tr>
                    <td>0</td>
                </tr>
                <tr>
                    <td>-1</td>
                </tr>
                <tr>
                    <td>'1'</td>
                </tr>
                <tr>
                    <td>null</td>
                </tr>
                <tr>
                    <td>'php'</td>
                </tr>
            </table>
        </div>
        <div style="float:left;" width="500">
            <table class="table" border="1">
                <tr>
                    <th>true</th>
                    <th>false</th>
                    <th>1</th>
                    <th>0</th>
                    <th>-1</th>
                    <th>"1"</th>
                    <th>null</th>
                    <th>"php"</th>
                </tr>
                <?php
                $valuesX = [true, false, 1, 0, -1, "1", null, "php"];
                $valuesY = [true, false, 1, 0, -1, "1", null, "php"]; // Значения по оси Y
                foreach ($valuesX as $valueX) {
                    echo "<tr>";
                    foreach ($valuesY as $valueY) {
                        echo "  <td>";
                        if ($valueX == $valueY) {
                            echo "1";
                        } else {
                            echo "";
                        }
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
        
    </div>
    <h2>Жесткое сравнение в PHP</h2>
    <div class="container2">
    <div class="valueY" style="float:left;" width="500">
            <table class="table" id="fontY" border="1">
                <tr>
                    <th>_</th>
                </tr>
                <tr>
                    <td>true</td>
                </tr>
                <tr>
                    <td>false</td>
                </tr>
                <tr>
                    <td>1</td>
                </tr>
                <tr>
                    <td>0</td>
                </tr>
                <tr>
                    <td>-1</td>
                </tr>
                <tr>
                    <td>'1'</td>
                </tr>
                <tr>
                    <td>null</td>
                </tr>
                <tr>
                    <td>'php'</td>
                </tr>
            </table>
        </div>
        <div style="float:left;" width="500">
            <table class="table" border="1">
                <tr>
                    <th>true</th>
                    <th>false</th>
                    <th>1</th>
                    <th>0</th>
                    <th>-1</th>
                    <th>"1"</th>
                    <th>null</th>
                    <th>"php"</th>
                </tr>
                <?php
                $valuesX = [true, false, 1, 0, -1, "1", null, "php"];
                $valuesY = [true, false, 1, 0, -1, "1", null, "php"]; // Значения по оси Y
                foreach ($valuesX as $valueX) {
                    echo "<tr>";
                    foreach ($valuesY as $valueY) {
                        echo "  <td>";
                        if ($valueX === $valueY) {
                            echo "1";
                        } else {
                            echo "";
                        }
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
        
    </div>
</html>