<!DOCTYPE html>
<?php
 session_start();
?>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
  </head>
  <body>
    <div class="modal-dialog text-center">
      <div class="col-sm-8main">
          <div class="modal-content">

            <div class="col-12im">
                <img src="static/image/users.png" width="100" height="100"/>

            </div>
              <form action="index.php"  method="POST" class="col-12">
                <div class="form-group" id= "user-group">
                  <input type="text" name="user" class="form-control" placeholder="Nombre de Usuario" required>
                </div>

                <div class="form-group" id="contrasena-group">
                  <input type="password" name="pass" class="form-control" placeholder="Contraseña" required>
                </div>

                <div class="col-12reg">
                                <p class="text-left"> Aun no tienes una cuenta?</p>
                </div>
                <div class="col-12reg2">
                          <a  href="registro.html"  role="botton">  Registrate Ya</a>
                </div>

                <div class="col-12but">
                     <button name="login" type="submit" class="btn btn btn-secundary"><i class="fas fa-sign-in-alt"> </i>  Ingresar  </button>
                </div>
              <div class="col-12forgot">
                <a  href="forget.html"  role="botton"> Olvidaste tu contraseña?</a>
              </div>
            </form>

            <?php
              if(isset($_POST['login'])){
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
                        header("Location: Inicio.html");
                      }

                      if(isset($useri) && isset($passi)){
                        if ($useri == $username && $passi == $password){
                          $_SESSION['loggedin']=true;
                          if($privilegio==1){
                            $_SESSION['usuario']=$username;
                            header("location: Inicio.html");}
                          if($privilegio==2){
                            $_SESSION['user']=$username;
                            $_SESSION['privilegio']=$privilegio;
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
            </div>
        </div>
        </div>
  </body>
</html>
