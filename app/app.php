<?php
error_reporting(0);
    $formtext =  new markdown_rules($_POST['text']);
    $formtext -> format();
    class markdown_rules {
        public $tags;          
        public $text_format;
        
        function __construct($text) {
            $this -> tags = array (
                array ('need' => 'strong', 'regex' => '\*\*', 'casenum' => 1),
                array ('need' => 'i', 'regex' => '\*', 'casenum' => 1),       
                array ('need' => 'h1', 'regex' => '\#', 'casenum' => 0),
                array ('need' => 'br', 'regex' => '\n', 'casenum' => 2),
                array ('need' => 'li', 'regex' => '\-', 'casenum' => 2),
                array ('need' => 'mark', 'regex' => '\$', 'casenum' => 2),
                array ('need' => 'del', 'regex' => '\@', 'casenum' => 2),
                array ('need' => 'small', 'regex' => '\&', 'casenum' => 2),
                array ('need' => 'big', 'regex' => '\!', 'casenum' => 2)
            );
            $this -> text_format = $text;
        }
        public function format() {	
            foreach ($this -> tags as $key => $value) {
                $text = $this -> text_format;
                switch ($value['casenum']) {
                    case 0:
                        $pattern = '/'.$value['regex'].'([^\*\v]+)/s';                         
                        $replacement = '<'.$value['need'].'>'.'$1'.'</'.$value['need'].'>';     
                        $this -> text_format = preg_replace($pattern, $replacement, $text);  
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
