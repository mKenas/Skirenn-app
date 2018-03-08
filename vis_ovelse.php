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
<form class="" action="" method="post">


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

        $foresporring = "select ØvelsId, Type, Sted, Dato ";
        $foresporring .= "from Øvels";
        $resultat = $db->query($foresporring);
        if ($resultat->num_rows > 0) {
            while($rad = $resultat->fetch_assoc()) {
              $id=(string)$rad['ØvelsId'];
              $datoFormat = preg_replace('/\s+/', 'T', $rad['Dato']);
              echo "<tr><td><input type=text name='type". $id. "' value=" . $rad['Type'] .' >' . "</td>";
              echo "<td><input type=text name='sted". $id. "' value=" . $rad['Sted'] .' >' . "</td>";
              echo "<td><input class ='dato-inpunt' type=datetime-local name='dato". $id. "' value=" . $datoFormat .">" . "</td>";

              echo "<td>". "<input type='submit' name='rediger". $id. "' value ='Rediger'>" . "</td>";
              echo "<td>". "<input type='submit' name='slett". $id. "' value ='Slett'>". "</td></tr>";

              if (isset($_REQUEST["slett". $id])){
                $delete="DELETE FROM Øvels WHERE ØvelsId =" .$rad['ØvelsId'] . ";";
                $res = $db->query($delete);
                if($res){
                  echo "<p class='velykket'>Data er slettet! </p>";

                }

              }


              if (isset($_REQUEST["rediger". $id])){


                  $orgindato = str_replace('T', ' ', $_REQUEST['dato'. $id]);

                $update="update Øvels set Type='". $_REQUEST['type'. $id] . "',Sted ='".$_REQUEST['sted'. $id]. "',Dato='";
                $update .= $orgindato . "'WHERE ØvelsId =" .$rad['ØvelsId'] . ";";
                $res2 = $db->query($update);
                if($res2){
                  echo "<p class='velykket'>Data er oppdatert! </p>";
                }

              }

            }



          $db->close();


      }
    }



       ?>
      </table>
        </form>

  </body>
</html>
