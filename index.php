<?php
/*
Skeleton Controller

Just build a controller by requiring 'view.php',
creating a View object, filling in the fields and call render().

*/
require 'view.php';

// initialize connections to mysql or doctrine
// you can create a file 'bootstrap.php' that is included from all controllers

// insert evaluation of $_GET and $_POST parameters here
// do some fancy logic and prepare the model

$view = new View(); // this initializes the template engine
$view->title = 'PicoMVC PHP framework skeleton application'; // Page title
$view->template = 'greet'; // render view/greet.phtml as page content
$view->text = 'World'; // whom to greet
$view->render(); // finally render the whole thing
