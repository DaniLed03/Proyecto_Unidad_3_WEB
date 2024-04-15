<!DOCTYPE html>
<html lang="es">
<head>
    <title>Selector de Rango de Fechas</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    $( function() {
        function validarYAplicarFechas() {
            var desdeVal = $("#desde").val();
            var hastaVal = $("#hasta").val();

            var desdeDate = $.datepicker.parseDate("yy-mm-dd", desdeVal);
            var hastaDate = $.datepicker.parseDate("yy-mm-dd", hastaVal);
            if (hastaDate < desdeDate) {
                alert("La fecha Hasta no puede ser anterior a la fecha Desde");
                return;
            }
            $( "#desde, #hasta" ).datepicker("option", {
                minDate: desdeVal,
                maxDate: hastaVal
            });
        }
        $( "#desde, #hasta" ).datepicker({
            dateFormat: "yy-mm-dd"
        });

        $( "#aplicar" ).on("click", function() {
            validarYAplicarFechas();
        });
    });
    </script>
</head>
<body>
    <label for="desde">Desde:</label>
    <input type="text" id="desde" name="desde">
    <label for="hasta">Hasta:</label>
    <input type="text" id="hasta" name="hasta">
    <button id="aplicar">Apply</button>
</body>
</html>
