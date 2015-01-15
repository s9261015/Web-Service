<?php include "function.php";?><!DOCTYPE html>
<html lang="en">
  <head>
    <title>
      Ez Home | Orders
    </title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <link href="bootstrap.min.css?v=3.0" rel="stylesheet">
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
  </style>

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
              
<?php menu();?>
              
            </div>
          </div>
    </nav>
    <div id="carousel-banner" class="carousel slide" >
      <div class="carousel-inner" role="listbox">
        <div class="item banner-1 active">
            <div class="the-wall">
              <?php
                $id = $_GET[id];
                $id = (int)$id;
                if ( !$_SESSION['username'] ) {
              ?>
              <div class=" col-md-8 col-md-offset-2">
                <div class="">
                  <h2> <a href='./login.php'>Login</a> to Order </h2>
                </div>
              </div>
            </div>

              ?>
              <?php
                } else if ( $_SERVER['REQUEST_METHOD'] == 'GET' && $id) {
              ?>
                <div class="">
                  <h2> River Hotel Order Page</h2>
                </div>
                
                <form class="form-signin" method='POST'>
                <input name="card" class="form-control" placeholder="Credit Card" required>
                <input type='date' name="startdate" class="form-control"required>
                <p stlye='text-align:center;'> <h4>to</h4> </p>
                <input type='date' name="enddate" class="form-control" required>
                <br>
                <input class="btn btn-success btn-block" type="submit" value='Order' onclick='order(t);'>
                </form>
                <div class="msg"><h2></h2></div>
              <?php 
                } else if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
              ?>
              <div class=" col-md-8 col-md-offset-2">
                <div class="">
                  <h2> Your Order List</h2>
                </div>
              <table class='table table-condensed'>
                <tr>
                  <th style='width:20%'> # </th>
                  <th style='width:50%'> Suite </th> 
                  <th style='width:15%;'> From. </th> 
                  <th style='width:15%'> To.</th> 
                </tr>
                <?php 
                  $id = $_SESSION['id'];
                  if ($id) {
                    $data = get( "/show/" . $id );
                    $data = json_decode($data);
                    for ($i=1; $i<=count($data); $i++){
                      $res = $data[$i-1];
                      $startdate = $res->startdate;
                      $enddate   = $res->enddate;
                      $hotelname = $res->hotelname;
                      $roomcate = $res->roomcate;

                    echo "<tr>";
                    echo "<td> $i </td>";
                    echo "<td> $hotelname ($roomcate) </td>";
                    echo "<td> $startdate</td>";
                    echo "<td> $enddate</td>";
                    echo "</tr>";

                    }
                  } else {
                    echo "<tr>";
                    echo "<td>  </td>";
                    echo "<td> No order now </td>";
                    echo "<td> </td>";
                    echo "<td> </td>";
                    echo "</tr>";
                  }

?>

              </table>
            </div>
            <?php } else {

                $card = $_POST['card'];
                $enddate = $_POST['enddate'];
                $startdate = $_POST['startdate'];
                $user_id   = $_SESSION['id'];
                $id = (int)$_GET['id'];

              if ( preg_match("/[^0-9]/", $card) ){
                $message = "Credit Card format  error";
              } else {
                $data = array( 'card'=>$card, 
                               'startdate'=>$startdate, 
                               'enddate'=>$enddate, 
                               'user_id'=>$user_id );
                
                
                $data = post( "/res/" . $id, $data );
                $data = json_decode($data);
                $message = "Order " . $data->message;
              }
              ?>
              <div class=" col-md-8 col-md-offset-2">
                <div class="">
                  <h2> <?php echo $message;?></h2>
                </div>
              </div>
            </div>

<?php } ?>

        </div>
      </div>

    </div>

    <?php footer();?>
  
</body>
</html>
