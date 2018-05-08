A simple markdown editor.

That's all that the app can do:
```php
('need' => 'strong', 'regex' => '\*\*', 'casenum' => 1),  // **..** = <strong>
('need' => 'i', 'regex' => '\*', 'casenum' => 1),         // *..* = <italic>
('need' => 'h1', 'regex' => '\#', 'casenum' => 0),        // # = <h1>
('need' => 'br', 'regex' => '\n', 'casenum' => 2),        // <br> replace with \n
('need' => 'li', 'regex' => '\-', 'casenum' => 2),        // - = <li>
('need' => 'mark', 'regex' => '\$', 'casenum' => 2),      // $ = <mark>
('need' => 'del', 'regex' => '\@', 'casenum' => 2),       // @ = <del>
('need' => 'small', 'regex' => '\&', 'casenum' => 2),     // & = <small>
('need' => 'big', 'regex' => '\!', 'casenum' => 2)        // ! = <big>
```

P.S. I am just learning.
