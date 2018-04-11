
 <?php
  session_start();
  include 'Person.php';
  include 'Utover.php';
  include 'Publikum.php';
  include 'Validering.php';
  include 'Tilkobling.php';
  ini_set('default_charset', 'utf-8');
  $erInnlogget = isset($_SESSION["erInnlogget"]);
  if($erInnlogget){



  }
  ?>
<!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="css/app.css">
     <title>Skirenn Registeret</title>
     <div class="topnav">
        <a class="active" href="index.php">Registering</a>
        <a href="vis_publikum.php">Vis Publikum</a>
        <a href="vis_utover.php">Vis Utøvere</a>
        <a href="vis_ovelse.php">Øvelser</a>
        <div class="registert">
          <?php
            if ($erInnlogget){
              echo "<span class = 'bruker'> Innlogget som " . $_SESSION["Bruker"] . "</span>";
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
     <h2>Skirenn Registeret</h2>

     <form class="myform" action="" method="post">
       <label for="fornavn">Fornavn</label>
       <input type="text" name="fornavn" value="" id="fornavn" onchange=testFornavn(this.value);>

       <label for="etternavn">Etternavn</label>
       <input type="text" name="etternavn" value="" id="etternavn" onchange=testEtternavn(this.value);>
       <div class="person-type">
         <label for="">Jeg er: </label>
         <label for="">Publikum</label>
         <input type="radio" name="persontype" value="Publikum" id="radio1"checked >
          <label for="">Utøver</label>

         <?php
           if ($erInnlogget){
             echo  '<input type="radio" name="persontype" value="Utøver" id="radio2">';
           }
           else {
             echo  '<input type="radio" name="persontype" value="Utøver" id="radio2" disabled>';
             echo " <a href='Logg_inn.php'>logg inn</a> for å registere Utøvere.";
           }
          ?>
       </div>

        <div id="bilett-type">
         <label for="">Bilett type </label>
         <select name="bilettType">
          <option value="vip">VIP</option>
          <option value="voksen">Voksen</option>
          <option value="barn">Barn</option>
          </select>
        </div>

        <div id="nasjon">
          <label for="">Nasjonalitet </label>
          <select  name="nasjonaliteten">
            <option value="norge">Norge</option>
            <option value="sverige">Sverige</option>
            <option value="danmark">Danmark</option>
           </select>
        </div>
       <label for="adresse">Adresse</label>
       <input type="text" name="adresse" value="" id="adresse">

       <label for="postnr">PostNr</label>
       <input type="text" name="postnr" value="" id="postnr">

       <label for="poststed">Poststed</label>
       <input type="text" name="poststed" value="" id="poststed">

       <label for="telefon">Telefon</label>
       <input type="text" name="telefon" value="" id="telefon">

       <div id="type-øvelse">

          <label for="">Øvelses Informasjon </label>
          <select  name="ovelseInfo">
            <?php
             $foresporring= "select ØvelsId ,Type ,Sted,Dato from Øvels;";
             $res=$db->query($foresporring);
             if ($res->num_rows >0){
               while ($rad =$res->fetch_assoc()) {

                 echo "<option name='radio' value='" . $rad['ØvelsId']. "'>" . $rad['Type'] ." - ". $rad['Sted'] ." - ". $rad['Dato'] . "</option>";
               }
             }


             ?>

          </select>
         </div>

       <input type="submit" name="register" value="Register">
       <?php



       if(isset($_REQUEST["register"]))
        {
          $oveslesID =(int)$_REQUEST['ovelseInfo'];
          $felter= array(
            "navn"=> $_REQUEST["fornavn"],
            "etternavn" => $_REQUEST["etternavn"],
            "adresse" => $_REQUEST["adresse"],
            "postNum" => $_REQUEST["postnr"],
            "poststed" => $_REQUEST["poststed"],
            "telefon" => $_REQUEST["telefon"]
          );

            if(validering($felter)){

                if ($_REQUEST["persontype"]=="Utøver"){

                  $utover = new Utover($_REQUEST["fornavn"],$_REQUEST["etternavn"],
                                       $_REQUEST["adresse"],$_REQUEST["postnr"],
                                       $_REQUEST["poststed"],$_REQUEST["telefon"],$oveslesID,$_REQUEST["nasjonaliteten"]);
                    $navn=$utover->getNavn();
                    $etternavn=$utover->getEtternavn();
                    $adresse=$utover->getAdresse();
                    $postnr=$utover->getPostNum();
                    $poststed=$utover->getPostSted();
                    $telefon=$utover->getTelefon();
                    $nasjinalitet=$utover->getNasjon();
                    $øvelsesId = $utover->getØvelsId();
                    $utover->settInnData($navn,$etternavn,$adresse,$postnr,$poststed,$telefon,$øvelsesId,$nasjinalitet);



                  }

                else{
                  $publikum = new Publikum($_REQUEST["fornavn"],$_REQUEST["etternavn"],
                                         $_REQUEST["adresse"],$_REQUEST["postnr"],
                                         $_REQUEST["poststed"],$_REQUEST["telefon"],$oveslesID,$_REQUEST["bilettType"]);


                   $navn=$publikum->getNavn();
                   $etternavn=$publikum->getEtternavn();
                   $adresse=$publikum->getAdresse();
                   $postnr=$publikum->getPostNum();
                   $poststed=$publikum->getPostSted();
                   $telefon=$publikum->getTelefon();
                   $bilettType=$publikum->getBilettType();
                   $øvelsesId = $publikum->getØvelsId();
                   $publikum->settInnData($navn,$etternavn,$adresse,$postnr,$poststed,$telefon,$øvelsesId,$bilettType);

                    }
                }
              }
        ?>

     </form>

    <script src="js/app.js"></script>
   </body>
 </html>
