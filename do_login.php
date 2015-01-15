<?php
    include "function.php";
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ( preg_match("/[^A-z0-9_-]/", $username) ){
      exit("username error");
    }
    if ( preg_match("/[^A-z0-9_-]/", $password) )
      exit("password error");


    $data = array( 'username'=>$username, 
                   'password'=>$password );
    
    $data = post( "/login", $data );
    $data = json_decode($data);

    if ( count($data) > 0 ){
      $data = $data[0];
      // print_r($data);
      $_SESSION['username'] = $username;
      $_SESSION['id'] = $data->id;

      // echo $_SESSION['id'];
      echo "success";
    } else {
      echo "fail";
    }
?>