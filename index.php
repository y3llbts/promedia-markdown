<?php
    error_reporting(0);
    $formtext =  new markdown_rules($_POST['text']);
    $formtext -> format();

    class markdown_rules {
        public $tags;           // Array with replacement data
        public $text_format;
        
        function __construct($text) {
            $this -> tags = array (
                array ('need' => 'strong', 'regex' => '\*\*', 'casenum' => 1),  // need - is html tag, regex - regular expression
                array ('need' => 'i', 'regex' => '\*', 'casenum' => 1),         // casenum - value of switch
                array ('need' => 'h1', 'regex' => '\#', 'casenum' => 0),        // easy to modify
                array ('need' => 'br', 'regex' => '\n', 'casenum' => 2),        // add tag and regex with casenum and make a case with this value
            );
            $this -> text_format = $text;
        }
        public function format() {	
            foreach ($this -> tags as $key => $value) {
                $text = $this -> text_format;
                switch ($value['casenum']) {
                    case 0:
                        $pattern = '/'.$value['regex'].'([^\*\v]+)/s';                          // Pattern - string in your text
                        $replacement = '<'.$value['need'].'>'.'$1'.'</'.$value['need'].'>';     // Replacement - what do you want to replace
                        $this -> text_format = preg_replace($pattern, $replacement, $text);     // Replacement function
                        break;
                    case 1:
                        $pattern = '/'.$value['regex'].'(.+?)'.$value['regex'].'/s';
                        $replacement = '<'.$value['need'].'>'.'$1'.'</'.$value['need'].'>';
                        $this -> text_format = preg_replace($pattern, $replacement, $text);
                        break;
                    case 2:
                        $pattern = '/'.$value['regex'].'([^\*\v]+)/s';
                        $replacement = '<'.$value['need'].'>'.'$1';
                        $this -> text_format = preg_replace($pattern, $replacement, $text);  
                        break;
                }
            }
        }
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta author="Mikhail Sidorchuk">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Markdown Editor</title>

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
        <!--Input text from user div-->
        <div class="split left">
            <form method="post" id="areaform" action="">
                <div class="form-group">
                    <label>Input text in textarea:</label>
                    <hr>
                    <textarea class="form-control" name="text" rows="12"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <ul>Instruction:
                <li># - Header transform.</li>
                <li>**...** - Bold transform.</li>
                <li>*...* - Italic transform.</li>
            </ul>
        </div>
        <!--Output formatted text from form div-->
        <div class="split right">
            <label>Formatted Text:</label>
            <hr>
            <div id="result_form"> <?php print_r($formtext -> text_format); ?> </div>
        </div>
    </body>
</html>
