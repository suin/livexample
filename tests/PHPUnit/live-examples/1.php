<?php

$rest = substr("abcdef", -1);
var_dump($rest); //=> string(1) "f"

$rest = substr("abcdef", -2);
var_dump($rest); // Output: string(2) "ef"

$rest = substr("abcdef", -3, 1);
var_dump($rest);
// Output:
// string(1) "d"
