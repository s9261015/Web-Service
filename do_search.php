<?php
    include "function.php";
    $keyword = $_POST['keyword'];

    if ( preg_match("/[^A-z0-9_-]/", $keyword) ){
      exit("keyword error");
    }


    $data = array( 'keyword'=>$keyword );
    
    $data = post( "/search", $data );
    //$data = json_decode($data);
    echo $data;
?>