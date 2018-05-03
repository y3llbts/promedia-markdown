<?php 
    error_reporting(0);
    $text = $_POST["text"];
    class myMark {
        public static $rules = array (
            '/(#+)(.*)/' => 'self::header',
            '/(\*\*)(.*?)\1/' => '<strong>\2</strong>', 
            '/(\*)(.*?)\1/' => '<em>\2</em>' 
        );
        private static function header ($regs) {
            list ($tmp, $chars, $header) = $regs;
            $level = strlen ($chars);
            return sprintf ('<h%d>%s</h%d>', $level, trim ($header), $level);
        }
        public static function render ($text) {
            $text = "\n" . $text . "\n";
            foreach (self::$rules as $regex => $replacement) {
                if (is_callable ($replacement)) {
                    $text = preg_replace_callback ($regex, $replacement, $text);
                } else { $text = preg_replace ($regex, $replacement, $text);}
            }
            $order = array ("\r\n", "\n", "\r"); 
            $replace = '<br>';
            $text = str_replace($order, $replace, $text);
            return trim ($text);
        }
    }
    
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>WYSWYG</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
        <style>
            .split {
                height: 100%;
                width: 48%;
                position: fixed;
                z-index: 1;
                top: 0;
                overflow-x: hidden;
                padding-top: 20px;
            }
            .left {
                left: 10px;
            }
            .right {
                right: 0;
            }
            .btn {
                width: 100%;
            }
            label {
                font-size: 20px;
                font-weight: 600;
            }
        </style>    
    </head>
    <body>
        <!--Блок ввода текста пользователем-->
        <div class="split left">
            <form method="post" id="areaform" action="">
                <div class="form-group">
                    <label>Введите текст в поле ниже:</label>
                    <hr>
                    <textarea class="form-control" name="text" rows="12"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Подтвердить</button>
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
                <?php echo (myMark::render($text)); ?>
            </div>
        </div>
    </body>
</html>