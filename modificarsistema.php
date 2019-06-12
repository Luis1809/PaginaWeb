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
      $localidad=$rs[5];
    }

    if(isset($_POST['submit'])){
      $id = $_POST['id'];
      $nombre = $_POST['nombre'];
      $rango_i = $_POST['rango_i'];
      $rango_s = $_POST['rango_s'];
      $localidad2 = $_POST['localidad'];

      if(!is_numeric($rango_i)|| !is_numeric($rango_s)){
        echo '<script type="text/javascript">
        alert("Los rangos deben ser numericos")
        </script>';
      }

      if(($rango_i) <= ($rango_s)){
        echo '<script type="text/javascript">
        alert("El Rango Inferior debe ser MAYOR que el Superior")
        </script>';
      }

      else{
      $query3=pg_query("update micro set nombre='$nombre', rango_i='$rango_i' , rango_s='$rango_s', localidad='$localidad2'");
      echo "<script>window.close();</script>";
      }
    }
  }
?>
<html>
  <head>
    <title>Modificar Sistema CFMS</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  </head>
  <body>
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title text-center">Modifcar Sistema</div>
            <div style="float:right; font-size: 65%; position: relative; top:-10px"></div>
        </div>
            <div class="panel-body" >
                <form method="post" action="">
                        <div id="div_id_username" class="form-group required">
                            <label for="id_username" class="control-label col-md-4  requiredField"> ID del Sistema<span class="asteriskField">*</span> </label>
                            <div class="controls col-md-8 ">
                                <input class="input-md  textinput textInput form-control" maxlength="30" name="id" value="<?php echo$microid;?>" placeholder="id" style="margin-bottom: 10px" readonly/>
                            </div>
                        </div>
                        <div id="div_id_email" class="form-group required">
                            <label for="id_email" class="control-label col-md-4  requiredField"> Nombre de Sistema<span class="asteriskField">*</span> </label>
                            <div class="controls col-md-8 ">
                                <input class="input-md emailinput form-control" name="nombre"  placeholder="Nombre sistema" value="<?php echo$micronombre;?>"  style="margin-bottom: 10px" required/>
                            </div>
                        </div>
                        <div id="div_id_email" class="form-group required">
                            <label for="id_email" class="control-label col-md-4  requiredField"> Sector<span class="asteriskField">*</span> </label>
                            <div class="controls col-md-8 ">
                                <input class="input-md textinput textInput form-control" name="localidad"  placeholder="Sector" value="<?php echo$localidad;?>"  style="margin-bottom: 10px" required/>
                            </div>
                        </div>
                        <div id="div_id_password1" class="form-group required">
                            <label for="id_password1" class="control-label col-md-4  requiredField">Rango Inferior <spanclass="asteriskField">*</span> </label>
                            <div class="controls col-md-8 ">
                                <input class="input-md textinput textInput form-control" name="rango_i" value="<?php echo$microrango_i;?>" placeholder="Rango Inferior" style="margin-bottom: 10px" required/>
                            </div>
                        </div>
                        <div id="div_id_password2" class="form-group required">
                             <label for="id_password2" class="control-label col-md-4  requiredField">Rango Superior<span class="asteriskField">*</span> </label>
                             <div class="controls col-md-8 ">
                                <input class="input-md textinput textInput form-control" name="rango_s" value="<?php echo$microrango_s;?>" placeholder="Rango Superior" style="margin-bottom: 10px" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="controls col-md-8 ">
                                <button class="" name="submit" type="submit" class="btn btn-primary btn btn-info center-block" id="submit-id-signup">Modificar</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>

  </body>
</html>
