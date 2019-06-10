

<?php include 'nav.php'; ?>

  <body>

    <main role="main" class="container">
      <div class="starter-template">
        <h1>Information</h1>
        <p class="lead">Use this page to start monitoring your connections and ssh tunnels.</p>
      </div>

      <?php
      // php funtion to check if the port is open
      function stest($ip, $port) {
   


        if(fsockopen("$ip",$port))
        {
         $db = new SQLite3('db/manage.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
         $query = "SELECT  name FROM tunnels WHERE port=$port";
         $host = $db->querysingle($query);
        //echo "Port $port is openened for ssh access";
        if(empty($host)){
          $host='Unknown Server';
      }
        echo '
            <div class="card" style="width: 40rem;">
                <div class="card-header">
                    <h6 class="card-title">Tunnels</h6>
              </div>
                 <div class="card-body">

                  <i class="fa fa-check-circle-o" aria-hidden="true"  style="color:green"></i>
                  <a>'.$host.' is connected on Port '.$port.' </a>
                  <br>
                 

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

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  </body>
</html>
