

<?php include 'nav.php'; ?>

  <body>



    <main role="main" class="container">

      <div class="starter-template">
        <br>
        <br>
        <h1>Information</h1>
        <p class="lead">Use this page to start monitoring your connections and ssh tunnels.</p>



      </div>

      <?php
      // php funtion to check if the port is open
      function stest($ip, $port) {



        if(fsockopen("$ip",$port))
        {
        //echo "Port $port is openened for ssh access";
        echo '
            <div class="card" style="width: 40rem;">
                <div class="card-header">
                    <h6 class="card-title">Tunnels</h6>
              </div>
                 <div class="card-body">

                  <i class="fa fa-check-circle-o" aria-hidden="true"  style="color:green"></i>
                  <a>Port  '.$port.' is mapped </a>
                     <br>

                </div>
              </div>
             <br>
              ';
        }

      }

      // Report simple running errors
      error_reporting(E_ERROR);
      // For loop we have written in our doc bind the remote ssh port to ports between 8222-92000
      for( $i=9922; $i<=9950; $i++ )

      {
      $stestoutput= stest ('127.0.0.1',"$i");

      if (!empty($stestoutput)) {
           echo "$stestoutput";

          }
       }


       ?>


      </div>




    </main><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>


  </body>
</html>
