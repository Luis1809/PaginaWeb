<?php
session_start();
 /*if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']==false){
   header("Location: index.php");}*/

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
 <head>
   <meta charset="utf-8">
   <title>Localidades</title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js" integrity="sha384-0pzryjIRos8mFBWMzSSZApWtPl/5++eIfzYmTgBBmXYdhvxPc+XcFEk+zJwDgWbP" crossorigin="anonymous"></script>
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

   <script type="text/javascript">
   google.charts.load('current', {packages: ['corechart', 'bar']});
   google.charts.setOnLoadCallback(function() {
      $(function() {
        chartsload();
      });
    });

    function drawBasic(chart_data) {
      var jsonData = chart_data;
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Hora');
      data.addColumn('number', 'Cant de lluvia');
      $.each(chart_data, function(i, jsonData){
         var hora = jsonData.horadia;
         var lluvia = parseFloat($.trim(jsonData.cantidad));
         data.addRows([[hora,lluvia]]);
      });

        var options = {
          title: 'Cantidad de lluvia',
          hAxis: {
            title: 'Horas del dia'
            // format: 'h:mm a',
          },
          vAxis: {
            title: 'Cantidad de lluvia en mm'
          }
        };

        var chart = new google.visualization.ColumnChart(
          document.getElementById('chart_lluvia'));
          chart.draw(data, options);
        }

        $(window).resize(function() {
          drawBasic();
        });


     $(document).ready(function(){
      $("#rango").change(function(){
        var rango = ($("#rango").val());
           $.ajax({
             url: 'query/graficolluvia2.php',
             method: 'post',
             data: 'rango=' +rango,
             dataType:"JSON",
         }).done(function(data){
           console.log(data);
           drawBasic(data);
         })
       })
     })

     function chartsload(){
        var rango = ($("#rango").val());
          $.ajax({
            url: 'query/graficolluvia2.php',
            method: 'post',
            data: 'rango=' +rango,
            dataType:"JSON",
        }).done(function(data){
          console.log(data);
          drawBasic(data);
        })
      }

   </script>



   </head>
   <body>
     <style type="text/css">
        body { background: hsl(15, 1%, 95%) !important; } /* Adding !important forces the browser to overwrite the default style applied by Bootstrap */
     </style>
     <nav class="navbar navbar-expand-lg navbar-light bg-white">
       <span class="navbar-brand text-dark "> Cities Flood Monitoring System <i class="fas fa-city"></i></span>
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="navbarColor03">
       <ul class="navbar-nav mr-auto">
         <li class="nav-item active">
           <a class="nav-link text-dark" href="Inicio.html"> Inicio <span class="sr-only">(current)</span></a>
         </li>
         <li class="nav-item">
           <a class="nav-link text-dark" href="Localidades.html"> Localidades </a>
         </li>
         <li class="nav-item">
           <a class="nav-link text-dark" href="valoresh.html"> Valores Historicos (BD) </a>
         </li>

         <li class="nav-item">
           <a class="nav-link text-dark" href="nosotros.html">Nosotros </a>
         </li>
       </ul>
       <div class="collapse navbar-collapse justify-content-end" id="navigation">
       <p>&nbsp;&nbsp;</p>
       <form method="post">
         <button id="cerrarc" name="csesion" type="submit" class="btn btn-dark"><i class="far fa-user"></i> Cerrar sesion</button>
       </form>
         <?php
           if(isset($_POST['csesion'])){
             $_SESSION['loggedin']=false;
             echo '<script type="text/javascript">
             window.location="index.php";
             </script>';
           }
           if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']==false){
           echo  '<script type="text/javascript">
           $("#cerrarc").hide()
           </script>';
         }

         ?>

         <form method="post">
         <button  id="iniciar" name="iniciar" type="submit" class="btn btn btn-dark"> <i class="far fa-user"></i> Iniciar sesion</button>
       </form>
       <?php
         if(isset($_POST['iniciar'])){
           $_SESSION['loggedin']=false;
           echo '<script type="text/javascript">
           window.location="index.php";
           </script>';
         }

         if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']==false){
         echo  '<script type="text/javascript">
         $("#iniciar").show()
         </script>';
         }
         else
         {
           echo  '<script type="text/javascript">
           $("#iniciar").hide()
           </script>';
         }
         ?>
       </div>
       </div>
       <p class="fixed-bottom bg-dark text-white clearfix mb-0 d-flex justify-content-center">
       ALL-RIGHTS RESERVED 2019</p>
     </nav>

     <h3></h3>
     <br>

  <div class="container" style="max-width: 90rem;">
    <div class="card border-light mb-3" style="max-width: 100rem;">
      <div class="card-header form-inline">
          <h5> Selecione el rango de data </h5>
           <form class="form-inline ml-auto">
              <select id="rango" class="custom-select">
              <option value="1" selected>Dia</option>
              <option value="2">Semana</option>
              <option value="3">Mes</option>
              <option value="4">Año</option>
            </select>
          </form>
      </div>
    <div class="card-body">
     <div class="container">
       <div id="chart_lluvia"></div>
       </div>
     </div>
    </div>
   </div>
   </body>
  </html>
