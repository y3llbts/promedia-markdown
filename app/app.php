<?
    if (isset($_POST["text"])) { 
        $result =  $_POST["text"];
    }
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
        public static function render ($result) {
            $result = "\n" . $result . "\n";
            foreach (self::$rules as $regex => $replacement) {
                if (is_callable ($replacement)) {
                    $result = preg_replace_callback ($regex, $replacement, $result);
                } else { $result = preg_replace ($regex, $replacement, $result);}
            }
            $order = array ("\r\n", "\n", "\r"); 
            $replace = '<br>';
            $result = str_replace($order, $replace, $result);
            return trim ($result);
        }
    }
?>