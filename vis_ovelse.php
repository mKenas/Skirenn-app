<?php
session_start();
include "Tilkobling.php";
$erInnlogget = isset($_SESSION["erInnlogget"]);
 ?>
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
       <div class="registert">
         <?php
           if ($erInnlogget){
             echo "<span class = 'bruker'> Innlogget som " . $_SESSION["brukerNavn"] . "</span>";
             echo "<a href='Logg_ut.php'>Logg ut</a>";


           }
           else {
             echo '<a href="Logg_inn.php">Logg inn</a>';
             echo '<a href="Register.php">Register</a>';
           }
          ?>
       </div>
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
        if($erInnlogget)
        {

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

      }



       echo '<tr>';
       echo '<td><input type="text" name="legg-til-type" value="" placeholder="Slalom, Langrenn"></td>';
       echo '<td><input type="text" name="legg-til-sted" value="" placeholder="Oslo"></td>';
       echo '<td><input class="legg-til-dato" type="datetime-local" name="legg-til-dato" value=""></td>';
       echo  '<td><input type="submit" name="legg-til" value="Legg til øvelse"></td>';
       echo '</tr>';

        if (isset($_REQUEST["legg-til"])){
          $type=$_REQUEST['legg-til-type'];
          $sted=$_REQUEST['legg-til-sted'];
          $dato=$_REQUEST['legg-til-dato'];

          if (!empty($type) && !empty($sted) && !empty($dato))
          {
            $orgindato = str_replace('T', ' ', $dato);
            $insert="insert into  Øvels  (Type,Sted,Dato) Values('";
            $insert .=$type ."' ,'" . $sted . "' ,'" . $orgindato . "');";

            $res3 = $db->query($insert);
            if($res3){
              echo "<p class='velykket'>Ny øvelese er lagt inn! </p>";
            }
          }
          else {
            echo "<p class='feil'> Du må oppgi type, sted og dato for hver øvelse.</p>";
        }

        $db->close();
    }

  }

  else{

    echo "<p class='feil'> Du må logge inn for å kunne adminstere øvelser!</p>";
  }
        ?>
      </table>
        </form>

  </body>
</html>
