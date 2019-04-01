

<?php include 'nav.php'; ?>

  <body>

    <main role="main" class="container">
      <div class="starter-template">
        <h1>Manage Tunels</h1>
        <p class="lead">Map port to a name with sqlite.</p>
      </div>

      <div class="starter-template">
            <?php
            // Create a new database, if the file doesn't exist and open it for reading/writing.
            // The extension of the file is arbitrary.
            $db = new SQLite3('db/manage.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

            // Create a table.

            $db->query('CREATE TABLE IF NOT EXISTS "tunnels" (
                "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
                "name" VARCHAR,
                "port" INTEGER
            )');

           //insert data
          //  $db->exec('BEGIN');
      //      $db->query('INSERT INTO "tunnels" ("name", "port")
        //        VALUES ("tomcat1", 9922)');

    //        $db->query('INSERT INTO "tunnels" ("name", "port")
  //              VALUES ("tomcat2", 9923)');
//            $db->exec('COMMIT');


            $query = 'SELECT  * FROM "tunnels"';

            //echo $query;


            $results = $db->query($query);
            //while ($row = $results->fetchArray()) {
            //var_dump($row);
            //}

            echo "
             <table class=table >
               <thead>
                 <tr>
                 <th scope='col'>Name</th>
                 <th scope='col'>Port</th>
                 </tr>
                </thead>
                 <tbody>
                 ";


                 while($row = $results->fetchArray()) {
                   //print_r($row);
                  echo "
                  <tr>
                   <td> $row[name] </td>
                    <td> $row[port] </td>
                     </tr>
                   ";
                  }
                  echo '
                  </tbody>
                 </table>
                 ';                   




             ?>
      </div>


</body>




    </main><!-- /.container -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  </body>
</html>
