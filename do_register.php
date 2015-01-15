<?php
    include "function.php";
    $name     = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];

    if ( preg_match("/[^A-z0-9. ]/", $name) ){
      exit( "name format error" );
    }
    if ( preg_match("/[^A-z0-9_-]/", $username) ){
      exit("username format  error");
    }
    if ( preg_match("/[^A-z0-9_-]/", $password) )
      exit("password format  error");
    if ( preg_match("/[^A-z0-9_\-@.]/", $email) )
      exit("email format  error");
    if ( preg_match("/[^0-9]/", $phone) ){
      exit("phone format  error");
    }

    $data = array( 'username'=>$username, 
                   'password'=>$password, 
                   'email'=>$email, 
                   'name'=>$name, 
                   'phone'=>$phone );
    
    $data = post( "/reg", $data );
    $data = json_decode($data);
    if ($data){
      echo $data->message;
    } else {
      echo "fail";
    }
?>