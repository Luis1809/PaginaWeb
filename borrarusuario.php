  <?php
  session_start();
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']==false || $_SESSION['privilegio']!=2){
    header("Location: index.php");
  }
    if(isset($_GET['id'])){
      $id=$_GET['id'];
      $con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
      $query1=pg_query($con,"select privilegio from usuario where id='$id'");
      $fila1= pg_fetch_row($query1);
      if($fila1[0]==1){
        $query1=pg_query($con,"delete from usuario where id='$id'");
        pg_close($con);
        header("location: ausuarios.html");}
      if($fila1[0]==2){
        pg_close($con);
        echo '<script type="text/javascript">alert("El usuario administrador no puede ser eliminado")
        window.location="ausuarios.html";
        </script>';
      }
    }
  ?>
