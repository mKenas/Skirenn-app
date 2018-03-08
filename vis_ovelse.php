<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/app.css">
    <title>Skirenn Registeret</title>
    <div class="topnav">
       <a href="index.php">Registering</a>
       <a href="vis_publikum.php">Vis Publikum</a>
       <a href="vis_utover.php">Vis Utøvere</a>
       <a class="active" href="vis_ovelse.php">Øvelser</a>
     </div>
  </head>
  <body>

    <table>
      <tr>
        <th>Type</th>
        <th>Sted</th>
        <th>Dato</th>
        <th></th>
        <th></th>
      </tr>

      <?php

        $db = mysqli_connect("localhost","root","","vm_ski");
        if(!$db)
        {
            die("Feil i kobling til databasen!");
        }
        else
        {
        $db->set_charset("utf8");

        $foresporring = "select Type, Sted, Dato ";
        $foresporring .= "from Øvels";
        $resultat = $db->query($foresporring);
        if ($resultat->num_rows > 0) {
            while($rad = $resultat->fetch_assoc()) {
              echo "<tr><td><input type=text value=" . $rad['Type'] .' />' . "</td>";
              echo "<td><input type=text value=" . $rad['Sted'] .' />' . "</td>";
              echo "<td><input type=text value=" . $rad['Dato'] .' />' . "</td>";
              echo "<td>". "<a href=''>rediger </a>" . "</td>";
              echo "<td>". "<a href=''>slett </a>" . "</td></tr>";


            }
        }
        else {

          $db->close();

        }
      }

       ?>
      </table>

  </body>
</html>
