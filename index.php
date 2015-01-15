<?php include "function.php";?><!DOCTYPE html>
<html lang="en">
  <head>
    <title>
      Ez Home | Search
    </title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <link href="./css/bootstrap.min.css?v=3.0" rel="stylesheet">
    <link href="index.css" rel="stylesheet">
    <link href="common.css" rel="stylesheet">
  <style>
    .the-wall {
        padding: 100px 0px 20px 0px;
        
    }
    .table td {
      font-size: 1.6em;
      font-weight: 100;
    }

    .table th {
      font-size: 2em;
      font-weight: 100;
    }

    h2 {
      text-align: center;
      padding-bottom: 32px;
      color: #5fbd3e;
    }

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
    h2 {
      text-align: center;
      padding-bottom: 32px;
      color: #5fbd3e;
    }

    .msg h2{
      color:red;
      font-weight: bold;
    }

    .patch{
      padding-top: 8px;
      padding-left: 16px;
      text-align: left;
    }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script>
    function search(t){

      // var keyword = $('.keyword').eq(0).val();
      
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
                <li class="active">
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
              
<?php menu();?>
              
            </div>
          </div>
    </nav>
    <div id="carousel-banner" class="carousel slide" >
      <div class="carousel-inner" role="listbox">
        <div class="item banner-1 active">
          <?php if ( $_SERVER['REQUEST_METHOD'] == 'GET' and !isset($_GET['keyword']) ) { ?>
          <div class="carousel-caption carousel-caption-1">
            <p><div>
              <form method='POST'>
              <input name="keyword" class="form-control input-lg keyword" placeholder="Search" value="" required autofocus>
              <div class='patch'> All we have:

                <a href='?keyword=howard'>howard hotels</a>, 
                <a href='?keyword=sanwant'>sanwant hotels</a>, 
                <a href='?keyword=caesarpark'>caesarpark</a>
              </div>
            </form>
            </div></p>
            <p class="sub btn" onclick='$("form").eq(0).submit()'>
              Find Now!
            </p>

          </div>

          <?php } else { ?>
          <?php 

              $keyword = $_POST['keyword'];
              if ($keyword == '')
                $keyword = $_GET['keyword'];
              $data = array( 'keyword'=>$keyword );
              
              $data = post( "/search", $data );
              $data = json_decode($data);

          ?>

          <div class="the-wall">
              <div class=" col-md-8 col-md-offset-2">
                <div class="">
                  <h2> Your Search Result</h2>
                </div>
              <table class='table table-condensed'>
                <tr>
                  <th style='width:20%'> # </th>
                  <th style='width:50%'> Suite </th> 
                  <th style='width:10%;'> Number. </th> 
                  <th style='width:15%'> Price.</th> 
                  <th style='width:5%;'> Order. </th> 
                </tr>
                <?php 
                  if (count($data) == 0){
                    echo "<tr>";
                    echo "<td>  </td>";
                    echo "<td> No such result </td>";
                    echo "<td> </td>";
                    echo "<td> </td>";
                    echo "<td></td>";
                    echo "</tr>";
                  } else {

                    for ($i=1; $i<=count($data); $i++){
                      $res = $data[$i-1];
                      // print_r($res);
                      $id        = $res->id;
                      $price     = $res->price;
                      $roomnum   = $res->roomnum;
                      $hotelname = $res->hotelname;
                      $roomcate  = $res->roomcate;

                    echo "<tr>";
                    echo "<td> $id </td>";
                    echo "<td> $hotelname ($roomcate) </td>";
                    echo "<td> $roomnum</td>";
                    echo "<td> $price</td>";
                    echo "<td align='center'> <a href='./order.php?id=$id' target=_blank>Pay!</a></td>";
                    echo "</tr>";

                    }
                  }
?>

              </table>
          </div>
        </div>


          <?php } ?>
        </div>
      </div>
    </div>
    
    <?php footer();?>

  
</body>
</html>
