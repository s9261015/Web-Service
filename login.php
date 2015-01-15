<?php include "function.php";?><!DOCTYPE html>
<html lang="en">
  <head>
    <title>
      Ez Home | Login
    </title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <link href="bootstrap.min.css?v=3.0" rel="stylesheet">
    <link href="index.css" rel="stylesheet">
    <link href="common.css" rel="stylesheet">
  <style>
    .form-signin
    {
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
    }
    .form-signin .form-control
    {
        position: relative;
        height: auto;
        padding: 10px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    .form-signin .form-control:focus
    {
        z-index: 2;
    }
    .form-signin input[type="text"]
    {
        margin-bottom: -1px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }
    .form-signin input[type="password"]
    {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    .the-wall
    {
        padding: 100px 0px 20px 0px;
        
    }
    .profile-img
    {
        width: 128px;
        height: 128px;
        margin: 0 auto 10px;
        display: block;
        -moz-border-radius: 50%;
        -webkit-border-radius: 50%;
        border-radius: 50%;
    }
    h2 {
      text-align: center;
      padding-bottom: 32px;
      color: #5fbd3e;
    }

    .msg h2{
      color:red;
      font-weight: bold;
    }

  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script>
    function login(t){
      var password = t.form.password.value;
      var username = t.form.username.value;
      
      if (password == '' || username == ''){
        $('.msg h2').text('Information not complete');
      } else {
        data = {'password': password, 'username': username};
        $.post('./do_login.php', data=data , function(data){
          console.log(data);
          if (data == 'success'){
            $('.msg h2').text('Login ok');
            setTimeout(function(){ window.location='./' }, 1500);
          } else if (data == 'fail') {
            $('.msg h2').text('Login Failed');
          } else {
            $('.msg h2').text( data );
          }
        });
      }
    }
  </script>
  </head>
  <body>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">
              Toggle navigation
            </span>
            <span class="icon-bar">
            </span>
            <span class="icon-bar">
            </span>
          </button>
          <a class="navbar-brand" href="./">
            <img src="./logo.png">
          </a>
          
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li>
                  <a href="./">
                    Home 
                  </a>
                </li>
                <li>
                  <a href="./about.php">
                    About
                  </a>
                </li>
              </ul>
              
              <ul class="nav navbar-nav navbar-right">
                <li class="active">
                  <a href="./login.php">
                    Login
                  </a>
                </li>
                <li>
                  <a href="./register.php">
                    Register
                  </a>
                </li>
              </ul>
              
            </div>
          </div>
    </nav>
    <div id="carousel-banner" class="carousel slide" >
      <div class="carousel-inner" role="listbox">
        <div class="item banner-1 active">
            <div class="the-wall">
                <img class="profile-img" src="./tumblr_n4h95i8drx1rhti0eo8_400.gif"
                    alt="">
                <form class="form-signin" method='POST'>
                <input name="username" class="form-control" placeholder="Username" required autofocus>
                <input type='password' name="password" class="form-control" placeholder="Password" required>
                <input class="btn btn-success btn-block" type="button" value='Sign in' onclick='login(this);'>
                
                </form>
                <div class="msg"><h2></h2></div>
            </div>
        </div>
      </div>

    </div>

    <?php footer();?>
  
</body>
</html>
