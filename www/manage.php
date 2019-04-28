

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
                 <th scope='col'>RowiD</th>
                 <th scope='col'>Action</th>
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
                   <td> $row[id] </td>
                  <td>
                  <form action='manage.php' method='post'>
                  <input name='delete_data'  class='btn btn-outline-danger btn-sm' type='submit' value='Delete'>
                  <input name='rowid' type='hidden' value=$row[id] >
                    </form>
                  </td>


                     </tr>
                   ";
                  }
                  echo '
                  </tbody>
                 </table>
                 ';



// Insert post
                 $message = "";
                 if( isset($_POST['submit_data']) ){
                 	// Includs database connection
                 	include "db_connect.php";

                 	// Gets the data from post
                 	$name = $_POST['name'];
                 	$port = $_POST['port'];

                 	// Makes query with post data
                 	$query = "INSERT INTO tunnels (name, port) VALUES ('$name', '$port')";

                 	// Executes the query
                 	// If data inserted then set success message otherwise set error message
                 	if( $db->exec($query) ){
                 		$message = "Data inserted successfully.";
                    echo "<meta http-equiv='refresh' content='0'>";
                 	}else{
                 		$message = "Sorry, Data is not inserted.";
                 	}
                 }

  //Delete post
                 $message = "";
                 if( isset($_POST['delete_data']) ){
                  // Include database connection
                  //include "db_connect.php";

                  // Gets the data from post
                 // $id = $_GET['rowid']; // rowid from url
                  $id = $_POST['rowid'];

                 // $id = 2;
                  // Makes query with post data
                 $query = "DELETE FROM tunnels WHERE rowid=$id";

                  // Executes the query
                  // If data inserted then set success message otherwise set error message
                 if( $db->exec($query) ){
                    $message = "Data deleted successfully.";
                    echo "<meta http-equiv='refresh' content='0'>";
                  }else{
                    $message = "Sorry, Data is not Deleted.";
                  }
                 }
             ?>
      </div>




      		<!-- showing the message here-->
      		<div><?php echo $message;?></div>
           <br>
           <br>
           <br>

	<!-- Insert Section-->
      		<table class="table table-borderless">
      			<form action="manage.php" method="post">
      			<tr>
      				<td>Name:</td>
      				<td><input name="name" type="text"></td>
      			</tr>
      			<tr>
      				<td>Port:</td>
      				<td><input name="port" type="text"></td>
      			</tr>
      			<tr>
      				<td><a></a></td>
      				<td><input name="submit_data"  class="btn btn-primary" type="submit" value="Insert Data"></td>
      			</tr>
      			</form>
      		</table>
      	</div>

</body>




    </main><!-- /.container -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  </body>
</html>
