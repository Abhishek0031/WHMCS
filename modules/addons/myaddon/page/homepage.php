<?php

if(file_exists(__DIR__.'/header.php')){
    include("header.php");
    // echo __DIR__;
}
if (isset($_GET['action'])) {
    $action = $_GET['action'] . '.php';
    $filePath = __DIR__ . '/' . $action;

    if (file_exists($filePath)) {
        include($filePath);
    } else {
        echo "File not found: " . $filePath;
    }
}else{
    include('homepage');
}

if($action==''){
    foreach($var as $data){
        echo '<pre>';
        print_r($data);
        echo '</pre>';

    }
}
    
    
 ?>