<?
    require("app/app.php");
?>
<html lang="ru_RU">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Markdown Editor</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">  
        <link rel="stylesheet" href="assets/css/main.css">
    </head>
    <body>
        <!--Блок ввода текста пользователем-->
        <div class="split left">
            <form method="post" id="areaform">
                <div class="form-group">
                    <label>Введите текст в поле ниже:</label>
                    <hr>
                    <textarea class="form-control" name="text" rows="12"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Подтвердить</button>
            </form>
            <ul>Инструкция:
                <li><b>#</b> - при появлении в начале строки, строка считается заголовком, до момента переноса на новую строку.</li>
                <li><b>**..**</b> - помещенный в ** текст, становится жирным.</li>
                <li><b>*..*</b> - помещенный в * текст, становится курсивом.</li>
            </ul>
        </div>
        <!--Блок вывода форматнутого текста-->
        <div class="split right">
            <label>Отформатированный текст:</label>
            <hr>
            <div id="result_form">
                <?php echo (myMark::render($result)); ?>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="app/ajax.js"></script>
    </body>
</html>