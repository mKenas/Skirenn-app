<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/app.css">
    <title>Vis Publikum</title>
    <div class="topnav">
       <a href="index.php">Registering</a>
       <a href="vis_publikum.php">Vis Publikum</a>
       <a class="active"  href="vis_utover.php">Vis Utøvere</a>
       <a href="vis_ovelse.php">Øvelser</a>
     </div>
  </head>
  <body>
    <table>
      <tr>
        <th>Fornavn</th>
        <th>Etternavn</th>
        <th>Nasjonalitet</th>
        <th>Adresse</th>
        <th>PostNr</th>
        <th>Poststed</th>
        <th>Telefon</th>
        <th>Øvelses Informasjon</th>


      </tr>
      <?php
        $ingendata= false;
        $db = mysqli_connect("localhost","root","","vm_ski");
        if(!$db)
        {
            die("Feil i kobling til databasen!");
        }
        else
        {
        $db->set_charset("utf8");

        $foresporring = "select Fornavn, Etternavn, Adresse, PostNum, Poststed, Telefonnr,ØvelsesInfo, Nasjonalitet ";
        $foresporring .= "from Person, Utøver WHERE Person.PersonId = Utøver.PersonId;";
        $resultat = $db->query($foresporring);

        if ($resultat->num_rows > 0) {
            while($rad = $resultat->fetch_assoc()) {
              echo "<tr><td>" . $rad["Fornavn"] . "</td>";
              echo "<td>" . $rad["Etternavn"] . "</td>";
              echo "<td>" . $rad["Nasjonalitet"] . "</td>";
              echo "<td>" . $rad["Adresse"] . "</td>";
              echo "<td>" . $rad["PostNum"] . "</td>";
              echo "<td>" . $rad["Poststed"] . "</td>";
              echo "<td>" . $rad["Telefonnr"] . "</td>";
              echo "<td>" . $rad["ØvelsesInfo"] . "</td></tr>";
            }
        } else {
            $ingendata = true;
            $db->close();

        }
      }

       ?>
      </table>

      <?php
        if($ingendata){
            echo "<p class='null-resultat'> Fant ingen data! </p>";
        }
        ?>

    <script src="js/app.js"></script>
   </body>
 </html>
