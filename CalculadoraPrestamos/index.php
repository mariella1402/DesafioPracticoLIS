<?php
function A_P($interes, $tiempo)
{
    return ($interes * pow(1 + $interes, $tiempo)) / (pow(1 + $interes, $tiempo) - 1);
}
function Imprimir($fechadesembolso, $VA, $i, $Tasa, $Saldo, $plazo, $CostoAnual, $adicional, $tipo)
{
    $n = 0;
    echo "<div class=\"resultado\">
    <div class=\"item\">
    <p class=\"h2\"> Resumen general </p> </br>
    <label>Fecha del préstamo: $fechadesembolso</label>
    </div>
    <div class=\"item\">
    <label>Monto del préstamo:$$VA</label>
    </div>
    <div class=\"item\">
    <label>Periodo del préstamo: $tipo</label>
    </div>
    <div class=\"item\">
    <label>Interés del préstamo:" . ($i * 100) .  "% </label> 
    <label>Plazo del préstamo: $plazo</label>
    </div>
    </div>
    <table class=\"table table-bordered \">
    <thead>
      <tr>
        <th scope=\"col\">#</th>
        <th scope=\"col\">Fecha de desembolso</th>
        <th scope=\"col\">Costo anual</th>
        <th scope=\"col\">Tasa</th>
        <th scope=\"col\">VA</th>
        <th scope=\"col\">Saldo</th>
      </tr>
    </thead>
    <tbody>";
    do {
        $Tasa = ($i * $VA);
        $Saldo = ($VA + $Tasa - $CostoAnual);
        $VA = ($Saldo);
        $fechadesembolso = date('Y-m-d', strtotime($fechadesembolso . ' + ' . $adicional));
        echo "<tr>
    <th scope=\"row\">" . ($n + 1) . "</th>
    <td>$fechadesembolso</td>
    <td>$" . round($CostoAnual, 2) . "</td>
    <td>$" . round($Tasa, 2) . "</td>
    <td>$" . round($VA, 2) . "</td>
    <td>$" . round($Saldo, 2) . "</td>
    </tr>\n </div> ";
        $n = $n + 1;
    } while ($n <  $plazo);
    echo " </tbody>\n\n </table>";
}
function SistemaSimple($fechadesembolso, $importe, $periodo, $interes, $plazo)
{
    //Declaracion de variables 
    switch ($periodo) {
        case 'diario':
            $Saldo = 0;
            $i = $interes / 100;
            $CostoAnual = round(A_P($i, $plazo) * $importe, 2);  //Constante
            $Tasa = 0;
            $VA = $importe;
            $adicional = '1 days';
            Imprimir($fechadesembolso, $VA, $i, $Tasa, $Saldo, $plazo, $CostoAnual, $adicional, "Diario");
            break;
        case 'semanal':
            $Saldo = 0;
            $i = $interes / 100;
            $CostoAnual = A_P($i, $plazo) * $importe;  //Constante
            $Tasa = 0;
            $VA = $importe;
            $adicional = '7 days';
            Imprimir($fechadesembolso, $VA, $i, $Tasa, $Saldo, $plazo, $CostoAnual, $adicional, "Semanal");
            break;
        case 'quincenal':
            $Saldo = 0;
            $i = $interes / 100;
            $CostoAnual = A_P($i, $plazo) * $importe;  //Constante
            $Tasa = 0;
            $VA = $importe;
            $adicional = '15 days';
            Imprimir($fechadesembolso, $VA, $i, $Tasa, $Saldo, $plazo, $CostoAnual, $adicional, "Quincenal");
            break;
        case 'mensual':
            $Saldo = 0;
            $i = $interes / 100;
            $CostoAnual = A_P($i, $plazo) * $importe;  //Constante
            $Tasa = 0;
            $VA = $importe;
            $adicional = '1 months';
            Imprimir($fechadesembolso, $VA, $i, $Tasa, $Saldo, $plazo, $CostoAnual, $adicional, "Mensual");
            break;
        case 'anual':
            $Saldo = 0;
            $i = $interes / 100;
            $CostoAnual = A_P($i, $plazo) * $importe;  //Constante
            $Tasa = 0;
            $VA = $importe;
            $adicional = '1 years';
            Imprimir($fechadesembolso, $VA, $i, $Tasa, $Saldo, $plazo, $CostoAnual, $adicional, "Anual");
            break;
    }
}

function ImprimirComp($fechadesembolso, $VA, $i, $Tasa, $Saldo, $plazo, $adicional, $tipo)
{
    $n = 0;
    echo "<div class=\"resultado\">\n\n
  <div class=\"item\">
  <p class=\"h2\"> Resumen general </p> </br>
  <label>Fecha del préstamo: $fechadesembolso</label>
  </div>
  <div class=\"item\">
  <label>Monto del préstamo:$$VA</label>
  </div>
  <div class=\"item\">
  <label>Periodo del préstamo: $tipo</label>
  </div>
  <div class=\"item\">
  <label>Interés del préstamo:" . ($i * 100) .  "% </label> 
  <label>Plazo del préstamo: $plazo</label>
  </div>
</div>
  <table class=\"table table-bordered \">
  <thead>
    <tr>
      <th scope=\"col\">#</th>
      <th scope=\"col\">Fecha de desembolso</th>
      <th scope=\"col\">Tasa</th>
      <th scope=\"col\">VA</th>
      <th scope=\"col\">Saldo</th>
    </tr>
  </thead>
  <tbody>";
    do {
        $Tasa = ($i * $VA);
        $Saldo = ($VA + $Tasa);
        $VA = ($Saldo);
        $fechadesembolso = date('Y-m-d', strtotime($fechadesembolso . ' + ' . $adicional));
        echo "<tr>
  <th scope=\"row\">" . ($n + 1) . "</th>
  <td>$fechadesembolso</td>
  <td>$" . round($Tasa, 2) . "</td>
  <td>$" . round($VA, 2) . "</td>
  <td>$" . round($Saldo, 2) . "</td>
  </tr>\n </div> ";
        $n = $n + 1;
    } while ($n <  $plazo);
    echo " </tbody>\n\n </table>";
}
function SistemaCompuesto($fechadesembolso, $importe, $periodo, $interes, $plazo)
{
    switch ($periodo) {

        case 'diario':
            $Saldo = 0;
            $i = $interes / 100;
            $CostoAnual = 0;
            $Tasa = 0;
            $VA = $importe;
            $adicional = '1 days';
            ImprimirComp($fechadesembolso, $VA, $i, $Tasa, $Saldo, $plazo, $adicional, "Diario");
            break;

        case 'semanal':
            $Saldo = 0;
            $i = $interes / 100;
            $CostoAnual = 0;
            $Tasa = 0;
            $VA = $importe;
            $adicional = '7 days';
            ImprimirComp($fechadesembolso, $VA, $i, $Tasa, $Saldo, $plazo, $adicional, "Semanal");
            break;

        case 'quincenal':
            $Saldo = 0;
            $i = $interes / 100;
            $CostoAnual = 0;
            $Tasa = 0;
            $VA = $importe;
            $adicional = '15 days';
            ImprimirComp($fechadesembolso, $VA, $i, $Tasa, $Saldo, $plazo, $adicional, "Quincenal");
            break;

        case 'mensual':
            $Saldo = 0;
            $i = $interes / 100;
            $CostoAnual = 0;
            $Tasa = 0;
            $VA = $importe;
            $adicional = '1 months';
            ImprimirComp($fechadesembolso, $VA, $i, $Tasa, $Saldo, $plazo, $adicional, "Mensual");
            break;

        case 'anual':
            $Saldo = 0;
            $i = $interes / 100;
            $CostoAnual = 0;
            $Tasa = 0;
            $VA = $importe;
            $adicional = '1 years';
            ImprimirComp($fechadesembolso, $VA, $i, $Tasa, $Saldo, $plazo, $adicional, "Anual");
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Formulario de préstamos</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</head>

<body>
    <div class="testbox">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="banner">
                <h1>Formulario de préstamos</h1>
            </div>
            <div class="item">
                <label for="seleccion_pago">Seleccionar tipo de pago: <span>*</span></label>
                <select name="seleccion_pago">
                    <option value="simple">Método simple:Cuota, amortización e interés fijo</option>
                    <option value="compuesto">Método compuesto</option>
                </select>
            </div>
            <div class="item">
                <label for="seleccion_periodo">Seleccionar periodo de pago: <span>*</span></label>
                <select name="seleccion_periodo">
                    <option value="diario">Diario</option>
                    <option value="semanal">Semanal</option>
                    <option value="quincenal">Quincenal</option>
                    <option value="mensual">Mensual</option>
                    <option value="anual">Anual</option>
                </select>
            </div>
            <div class="item">
                <label for="date">Fecha del préstamo: <span>*</span></label>
                <input id="fecha_des" type="date" name="fecha_des" required />
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="item">
                <label for="interes">Interes del préstamo (%): <span>*</span></label>
                <input type="number" name="interes" required />

            </div>
            <div class="item">
                <label for="plazo">Plazo del préstamo: <span>*</span></label>
                <input type="number" name="plazo" required />
            </div>
            <div class="item">
                <label for="importe">Importe del préstamo: <span>*</span></label>
                <input type="number" name="importe" required />
            </div>

            <div class="btn-block">
                <input type="submit" name="enviar" value="Ver resultados">
            </div>
        </form>
    </div>

    <?php if (isset($_POST['enviar'])) {
        if ($_POST['seleccion_pago'] === 'simple')
            echo SistemaSimple($_POST['fecha_des'], $_POST['importe'], $_POST['seleccion_periodo'], $_POST['interes'], $_POST['plazo']);
        else
            echo SistemaCompuesto($_POST['fecha_des'], $_POST['importe'], $_POST['seleccion_periodo'], $_POST['interes'], $_POST['plazo']);
    }

    ?>
</body>

</html>