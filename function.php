<?php
    $ws = "http://140.118.109.174:81/service";
    session_start();

    error_reporting(E_ALL^E_NOTICE);

    function footer(){
        echo <<<EOF
    <section class="achievement">
      <div class="container">
        <div class="section-hd">
          Copyright © 2014-2015 NTUSTIM. All Rights Reserved.
        </div>
      </div>
    </section>
EOF;
    }

    function menu(){
        $username = $_SESSION['username'];
        if ( $username )
        echo <<<EOF
              <ul class="nav navbar-nav navbar-right">
                <li>
                  <a href="./">
                    $username
                  </a>
                </li>
                <li>
                  <a href="./logout.php">
                    Logout
                  </a>
                </li>
                <li>
                  <a href="./order.php">
                    MyOrder
                  </a>
                </li>
              </ul>
EOF;
        else
        echo <<<EOF
              <ul class="nav navbar-nav navbar-right">
                <li>
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
EOF;
    }
    function get($path) {
        global $ws;
        $aHTTP = array(
          'http' => // The wrapper to be used
            array(
            'method'  => 'GET', // Request Method
          )
        );

        // $context = stream_context_create($aHTTP);
        $contents = file_get_contents($ws . $path, false);

        return $contents;
    }

    function post($path, $data){
        global $ws;
        $aHTTP = array(
          'http' => // The wrapper to be used
            array(
            'method'  => 'POST', // Request Method
            // Request Headers Below
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'content' => http_build_query($data)
          )
        );

        $context = stream_context_create($aHTTP);
        $contents = file_get_contents($ws . $path, false, $context);

        return $contents;
    }

    // post('http://140.118.109.174:81/roomService/reg.php', "username=aaaa&name=aaaa&password=1111&email=xxxx&phone=aaa");
?>