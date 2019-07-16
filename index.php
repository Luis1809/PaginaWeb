<!DOCTYPE html>
<?php
session_start();
?>

<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Cities Flood Monitoring System</title>
  <!--JQUERY-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- FRAMEWORK BOOTSTRAP para el estilo de la pagina-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <!-- Los iconos tipo Solid de Fontawesome-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
  <script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>

  <!-- Nuestro css-->
  <link rel="stylesheet" type="text/css" href="static/css/index.css" th:href="@{static/css/index.css}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">

  <?php

  if(isset($_POST['loginsc'])){
    $nombre_micro= $_POST['micro'];
    //echo "<script>console.log( 'Debug Objects: " . $nombre_micro . "' );</script>";
    $con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
    $query1 = pg_query($con,("SELECT id FROM micro where nombre = '$nombre_micro';"));
    $fila1= pg_fetch_row($query1);

    //echo "<script>console.log( 'Debug Objects: " .$fila1[0]. "' );</script>";
    pg_close($con);
    // header("Location: Inicio.html?id=$fila1[0]");
    $_SESSION['microses']=$fila1[0];
    header("Location: Inicio.html");
  }

  if(isset($_POST['login'])){
    $nombre_micro= $_POST['micro'];
    echo "<script>console.log( 'Debug Objects: " . $nombre_micro . "' );</script>";
    $con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
    $query1 = pg_query($con,("SELECT id FROM micro where nombre = '$nombre_micro';"));
    $fila1= pg_fetch_row($query1);

    echo "<script>console.log( 'Debug Objects: " .$fila1[0]. "' );</script>";
    pg_close($con);

    $con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
    $useri = strtolower($_POST['user']);
    $passi = $_POST['pass'];

    $sql = pg_query($con,("SELECT * FROM usuario WHERE lower(nombre_usu) LIKE lower('$useri');"));
    if(pg_num_rows($sql)){
      $rs=pg_fetch_array($sql);
      $username= strtolower($rs['nombre_usu']);
      $password= $rs['clave'];
      $privilegio= $rs['privilegio'];

      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
        $_SESSION['microses']=$fila1[0];
        header("Location: Inicio.html");
      }

      if(isset($useri) && isset($passi)){
        if ($useri == $username && password_verify($passi,$password)){
          $_SESSION['loggedin']=true;
          if($privilegio==1){
            $_SESSION['usuario']=$username;
            $_SESSION['microses']=$fila1[0];
            header("location: Inicio.html");}
            if($privilegio==2){
              $_SESSION['user']=$username;
              $_SESSION['privilegio']=$privilegio;
              $_SESSION['microses']=$fila1[0];
              header("location: administrador.html");}
            }
            else
            {
              $_SESSION['loggedin']=false;
              echo '<script type="text/javascript">alert("Credenciales invalidas")</script>';
            }
          }
        }
        else
        {
          echo '<script type="text/javascript">alert("Credenciales invalidas")</script>';
        }
      }
      ?>

      <script type="text/javascript">
      function loadmicro(){
        $.ajax({
          url: 'query/micro.php',
          method: 'post',
        }).done(function(data){
          console.log(data);
          data = JSON.parse(data);
          data.forEach(function(micro){
            $('#micro').append('<option>' + micro.nombre + '</option>')
            document.getElementById("login").disabled = true;
            document.getElementById("loginsc").disabled = true;

          })
        })
      }
      </script>

      <script type="text/javascript">
      $(document).ready(function(){
        $("#micro").change(function(){
          document.getElementById("login").disabled = false;
          document.getElementById("loginsc").disabled = false;
        })
      })

      </script>

      <script type="text/javascript">
      loadmicro();
      </script>

      <script type="text/javascript">

      $(window).resize(function() {
        mainbox;
      });
      </script>
    </head>
    <style>
    body  {
      background-image: url("static/image/back2.jpg") ;
      background-color: #cccccc;
    }
  </style>
  <body>

    <div id="mainbox" class="modal-dialog text-center">
      <div class="col-sm-8main">
        <div class="modal-content" style="height: 550px;">
          <div class="col-12cfms">
            <h3><b>Cities Flood Monitoring System</b></h3>
          </div>
          <div class="col-12im">
            <img src="static/image/users.png" width="100" height="100"/>

          </div>
          <form action="index.php"  method="POST" class="col-12">
            <div class="form-group" id= "user-group">
              <input type="text" name="user" class="form-control" placeholder="Nombre de Usuario">
            </div>

            <div>
              <div class="form-group" id="contrasena-group">
                <input type="password" name="pass" class="form-control" placeholder="Contraseña">
              </div>

              <div class="col-12reg">
                <p class="text-left"> Aun no tienes una cuenta?<a  href="registro.html"  role="botton">  Registrate Ya</a><br>
                  <form class="form-inline ml-auto">
                    <select name="micro" id="micro" class="custom-select">
                      <option value="1" selected disabled="">Seleccione la localidad que desea acceder</option>
                    </select>
                  </form>
                  <button name="login" id="login" type="submit" class="btn btn btn-secundary" ><i class="fas fa-sign-in-alt"> </i>  Ingresar  </button><br><p></p>
                  <button name="loginsc" id="loginsc"  type="submit" class="btn btn btn-secundary" style="width:230px;"><i class="fas fa-sign-in-alt"> </i>  Acceder sin Credenciales  </button>
                  <br>
                  <a  href="forget.html"  role="botton"> Olvidaste tu contraseña?</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </body>
    </html>
