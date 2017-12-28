<?php

$obj = new stdClass();
$obj->a = 1;
$obj->b = 2;

var_dump($obj);

// Output:
// object(stdClass)#%d (2) {
//   ["a"]=>
//   int(1)
//   ["b"]=>
//   int(2)
// }
