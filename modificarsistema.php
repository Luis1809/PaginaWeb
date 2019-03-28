<!DOCTYPE html>
<?php
  session_start();
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']==false || $_SESSION['privilegio']!=2){
  header("Location: index.php");}

  if(isset($_GET['id'])){
    $id=$_GET['id'];
    $con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
    $query1 = pg_query($con,"select * FROM micro where id = '$id';");
    if(pg_num_rows($query1)){
      $rs = pg_fetch_row($query1);
      $microid=$rs[0];
      $micronombre=$rs[2];
      $microrango_i=$rs[3];
      $microrango_s=$rs[4];
    }

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $rango_i = $_POST['rango_i'];
    $rango_s = $_POST['rango_s'];

    if(isset($_POST['submit'])){
      if(!is_numeric($rango_i )|| !is_numeric($rango_s)){
        echo '<script type="text/javascript">
        alert("Los rangos deben ser numericos")
        window.location="modificarsistema.php?id=".$id.
        </script>';
      }

      else{
      $query3=pg_query("update micro set nombre='$nombre', rango_i='$rango_i' , rango_s='$rango_s'");
      header("location: asistemas.html");}
    }
  }
?>
<html>
  <head>
    <title>Modificar Sistema CFMS</title>
  </head>
  <body>
    <div class="">
      <div>
       <form method="post" action="">
             <div class="">
                  <input class="" type="text" name="id" placeholder="occupation" name="occupation" value="<?php echo$microid;?>" readonly>
              </div>

                <div class="">
                  <input class="" type="text" name="nombre" placeholder="qualification" name="qualification" value="<?php echo$micronombre;?>" required>
              </div>

               <div class="">
                  <input class="" type="text" name="rango_i" placeholder="address" name="address" value="<?php echo$microrango_i;?>" required>
              </div>

              <div class="">
                  <input class="" type="text" name="rango_s" placeholder="address" name="address" value="<?php echo$microrango_s;?>" required>
             </div>
               <button class="" type="submit" name="submit">Modificicar</button>
        </form>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>

  </body>
</html>
