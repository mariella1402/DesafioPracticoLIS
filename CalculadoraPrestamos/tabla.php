<!DOCTYPE html>
<html lang="es">

<head>
    <title>Tabla de Calculos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device=width, user-scalable=no, initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0" />
    <link rel="stylesheet" href="css/tablaCalculos.css" />
</head>

<body>
    <?php
    //Extrayendo todos los datos del formulario
    if (isset($_POST['send']) && $_POST['send'] == "Calcular") {
        extract($_POST);
        $tipAmort = !empty($tipAmort) ? $tipAmort : 0;
        $paymentDate = !empty($paymentDate) ? $paymentDate : 0;
        $import = !empty($import) ? $import : 0;
        $period = !empty($period) ? $period : 0;
        $timeLimit = !empty($timeLimit) ? $timeLimit : 0;
        $interest = !empty($interest) ? $interest : 0;
    } else {
        echo "<table>\n<tr>No se ha recibido Ningun Dato del Formulario</tr>\n</table>";
        echo "<div>
            <a href=\"./formulario.html\" class=\"regresarBox\">
                <input type=\"button\" value=\"Regresar\" class=\"regresar\" />
            </a>
        </div>";
    }

    function simpleSystem($paymentDate, $import, $period, $interest, $timeLimit)
    {
        switch ($period) {
            case 'diary':
                $balance = 0;
                $i = $interest / 100;
                $annualCost = ($interest * pow(1 + $interest, $timeLimit)) / (pow(1 + $interest, $timeLimit) - 1);
                $rate = 0;
                $annualValue = $import;
                $additional = '1 days';
                simplePrint($paymentDate, $annualValue, $i, $rate, $balance, $additional, $timeLimit, $annualCost, "Diario");
                break;
            case 'weekly':
                $balance = 0;
                $i = $interest / 100;
                $annualCost = ($interest * pow(1 + $interest, $timeLimit)) / (pow(1 + $interest, $timeLimit) - 1);
                $rate = 0;
                $annualValue = $import;
                $additional = '7 days';
                simplePrint($paymentDate, $annualValue, $i, $rate, $balance, $additional, $timeLimit, $annualCost, "Semanal");
                break;
            case 'biweekly':
                $balance = 0;
                $i = $interest / 100;
                $annualCost = $annualCost = ($interest * pow(1 + $interest, $timeLimit)) / (pow(1 + $interest, $timeLimit) - 1);
                $rate = 0;
                $annualValue = $import;
                $additional = ' 15 days';
                simplePrint($paymentDate, $annualValue, $i, $rate, $balance, $additional, $timeLimit, $annualCost, "Quincenal");
                break;
            case 'monthly':
                $balance = 0;
                $i = $interest / 100;
                $annualCost = ($interest * pow(1 + $interest, $timeLimit)) / (pow(1 + $interest, $timeLimit) - 1);
                $rate = 0;
                $annualValue = $import;
                $additional = '1 month';
                simplePrint($paymentDate, $annualValue, $i, $rate, $balance, $additional, $timeLimit, $annualCost, "Anual");
                break;
        }
    }

    function composedSystem($paymentDate, $import, $period, $interest, $timeLimit)
    {
        switch ($period) {
            case 'diary':
                $balance = 0;
                $i = $interest / 100;
                $annualCost = 0;
                $rate = 0;
                $annualValue = $import;
                $additional = '1 days';
                composedPrint($paymentDate, $annualValue, $i, $rate, $balance, $timeLimit, $additional, "Diario");
                break;
            case 'weekly':
                $balance = 0;
                $i = $interest / 100;
                $annualCost = 0;
                $rate = 0;
                $annualValue = $import;
                $additional = '7 days';
                composedPrint($paymentDate, $annualValue, $i, $rate, $balance, $timeLimit, $additional, "Semanal");
                break;
            case 'biweekly':
                $balance = 0;
                $i = $interest / 100;
                $annualCost = 0;
                $rate = 0;
                $annualValue = $import;
                $additional = '15 days';
                composedPrint($paymentDate, $annualValue, $i, $rate, $balance, $timeLimit, $additional, "Quincenal");
                break;
            case 'monthly':
                $balance = 0;
                $i = $interest / 100;
                $annualCost = 0;
                $rate = 0;
                $annualValue = $import;
                $additional = '1 month';
                composedPrint($paymentDate, $annualValue, $i, $rate, $balance, $timeLimit, $additional, "Mensual");
                break;
            case 'annual':
                $balance = 0;
                $i = $interest / 100;
                $annualCost = 0;
                $rate = 0;
                $annualValue = $import;
                $additional = '1 year';
                composedPrint($paymentDate, $annualValue, $i, $rate, $balance, $timeLimit, $additional, "Anual");
                break;
        }
    }


    function simplePrint($paymentDate, $annualValue, $i, $rate, $balance, $additional, $timeLimit, $annualCost, $tipPeriod)
    {
        $n = 0;
        echo "<div>
        <div class=\"item\">
            <p class=\"principal\"> Datos Principales </p>
        </div>
        <div class=\"item\">
        <label>Fecha del préstamo: $paymentDate</label>
        </div>
        <div class=\"item\">
        <label>Monto del préstamo: $$annualValue</label>
        </div>
        <div class=\"item\">
        <label>Periodo del préstamo: $tipPeriod</label>
        </div>
        <div class=\"item\">
        <label>Interés del préstamo: " . ($i * 100) .  "% </label> 
        </div>
        <div class=\"item\">
        <label>Plazo del préstamo: $timeLimit </label>
        </div>
        </div>
        </div>
        <div class=\"item\">
        <p class=\"principal\"> Tabla de Valores </p>
        </div>
        <div class=\"tableBox\">
        <table class=\"table table-bordered \">
        <thead>
          <tr>
            <th scope=\"col\">#</th>
            <th scope=\"col\">Fecha de desembolso</th>
            <th scope=\"col\">Costo Anual</th>
            <th scope=\"col\">Tasa</th>
            <th scope=\"col\">Valor Anual</th>
            <th scope=\"col\">Saldo</th>
          </tr>
        </thead>
        <tbody>";
        do {
            $rate = ($i * $annualValue);
            $balance = ($annualValue + $rate - $annualCost);
            $annualValue = ($balance);
            $paymentDate = date('Y-m-d', strtotime($paymentDate . ' + ' . $additional));
            echo "<tr>
            <td scope=\"row\">" . ($n + 1) . "</td>
            <td>$paymentDate</td>
            <td>$" . round($annualCost, 2) . "</td>
            <td>$" . round($rate, 2) . "</td>
            <td>$" . round($annualValue, 2) . "</td>
            <td>$" . round($balance, 2) . "</td>
            </tr>\n </div> ";
            $n = $n + 1;
        } while ($n <  $timeLimit);
        echo " </tbody>\n\n </table></div>";
    }

    function composedPrint($paymentDate, $annualValue, $i, $rate, $balance, $timeLimit, $additional, $tipPeriod)
    {
        $n = 0;
        echo "<div>\n\n
        <div class=\"item\">
            <p class=\"principal\"> Datos Principales </p> </br>
        </div>
        <div class=\"item\">
            <label>Fecha del préstamo: $paymentDate</label>
        </div>
        <div class=\"item\">
            <label>Monto del préstamo:$$annualValue</label>
        </div>
        <div class=\"item\">
            <label>Periodo del préstamo: $tipPeriod</label>
        </div>
        <div class=\"item\">
            <label>Interés del préstamo:" . ($i * 100) .  "% </label>
        </div>
        <div class=\"item\">
            <label>Plazo del préstamo: $timeLimit</label>
        </div>
        </div>
        </div>
        <div>
        <div class=\"item\">
        <p class=\"principal\"> Tabla de Valores </p>
        </div>
        <div class=\"tableBox\">
        <table class=\"table table-bordered \">
        <thead>
            <tr>
            <th scope=\"col\">#</th>
            <th scope=\"col\">Fecha de desembolso</th>
            <th scope=\"col\">Tasa</th>
            <th scope=\"col\">Valor Anual</th>
            <th scope=\"col\">Saldo</th>
            </tr>
        </thead>
        <tbody>";
        do {
            $rate = ($i * $annualValue);
            $balance = ($annualValue + $rate);
            $annualValue = ($balance);
            $paymentDate = date('Y-m-d', strtotime($paymentDate . ' + ' . $additional));
            echo "<tr>
        <th scope=\"row\">" . ($n + 1) . "</th>
        <td>$$paymentDate</td>
        <td>$" . round($rate, 2) . "</td>
        <td>$" . round($annualValue, 2) . "</td>
        <td>$" . round($balance, 2) . "</td>
        </tr>\n </div> ";
            $n = $n + 1;
        } while ($n <  $timeLimit);
        echo " </tbody>\n\n </table></div>";
    }

    ?>
    <div class="title">
        <h1>Tabla de los Calculos para los Prestamos</h1>
    </div>
    <div class="mainBox">
        <?php
        if ($tipAmort == "simpleSystem") {
            simpleSystem($paymentDate, $import, $period, $interest, $timeLimit);
        } else if ($tipAmort == "composedSystem") {
            composedSystem($paymentDate, $import, $period, $interest, $timeLimit);
        } else {
            echo "
            <a href=\"./formulario.html\" class=\"regresarBox\">
                <input type=\"button\" value=\"Regresar\" class=\"regresar\" />
            </a>";
        }
        ?>
    </div>
    <div>
        <a href="./formulario.html" class="regresarBox">
            <input type="button" value="Regresar" class="regresar" />
        </a>
    </div>
</body>

</html>