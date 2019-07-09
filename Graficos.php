<?php
session_start();
 /*if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']==false){
   header("Location: index.php");}*/

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    $(document).ready(function(){
      var microval = '<?php echo $_SESSION['microses']; ?>';
          $.ajax({
            url: 'query/RepAlertaU.php',
            method: 'post',
            data: 'data=' +microval,
            dataType:"JSON",
        }).done(function(data){
          //console.log(data);
          var count = 1;
          data.forEach(function(item){
            if(item.promultra==null){
              console.log(item.nombre);
              $('#alerta').append('<h6 class="dropdown-item" >'+count+" -> Nombre: "+item.nombre+" - Fecha: "+item.fecha+" - Hora (0-24): "+item.hora+" - Tipo: "+item.tipo+" - Cant. lluvia (Ultima hora): "+parseFloat(item.sumpluvi).toFixed(2)+" MM"+'</h6><hr>');
            }
            else {
              $('#alerta').append('<h6 class="dropdown-item" >'+count+" -> Nombre: "+item.nombre+" - Fecha: "+item.fecha+" - Hora (0-24): "+item.hora+" - Tipo: "+item.tipo+" - Prom. ultrasonico: "+item.promultra+" CM"+'</h6><hr>');
            }
            count+=1;
          });
        });
      });
    </script>

   <script type="text/javascript">
   google.charts.load('current', {packages: ['corechart', 'bar']});
   google.charts.setOnLoadCallback(function() {
      $(function() {
        chartsload();
        chartsload2();
      });
    });

        function drawBasic(chart_data) {
          var jsonData = chart_data;
          var data = new google.visualization.DataTable();
          data.addColumn('string', jsonData.horadia);
          data.addColumn('number', 'Cant de lluvia');
          $.each(chart_data, function(i, jsonData){
             var hora = jsonData.horadia;
             var lluvia = parseFloat($.trim(jsonData.cantidad));
             data.addRows([[hora,lluvia]]);
          });

        var options = {
          title: 'Cantidad de lluvia',
          hAxis: {
            title: 'Hora',
            //ticks: ['12:00 AM','3:00 AM','6:00 AM','9:00 AM','12:00 PM','3:00 PM','6:00 PM','9:00 PM'],
            slantedText: true,
            textStyle: {
              fontSize: 8
            },
          },
          vAxis: {
            title: 'Cantidad de lluvia en mm'
          }
        };

        var chart = new google.visualization.ColumnChart(
          document.getElementById('chart_lluvia'));
          chart.draw(data, options);
        }

        function drawBasic2(chart_data) {
          var jsonData = chart_data;
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'Dias');
          data.addColumn('number', 'Cant de lluvia');
          $.each(chart_data, function(i, jsonData){
             var hora = jsonData.dia;
             var lluvia = parseFloat($.trim(jsonData.cantidad));
             data.addRows([[hora,lluvia]]);
          });

            var options = {
              title: 'Cantidad de lluvia',
              hAxis: {
                title: 'Dias',
              },
              vAxis: {
                title: 'Cantidad de lluvia en mm'
              }
            };

            var chart = new google.visualization.ColumnChart(
              document.getElementById('chart_lluvia'));
              chart.draw(data, options);
            }

        function drawBasic3(chart_data) {
          var jsonData = chart_data;
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'Dia');
          data.addColumn('number', 'Cant de lluvia');
          $.each(chart_data, function(i, jsonData){
             var hora = jsonData.mes;
             var lluvia = parseFloat($.trim(jsonData.cantidad));
             data.addRows([[hora,lluvia]]);
          });

            var options = {
              title: 'Cantidad de lluvia',
              hAxis: {
                title: 'Mes',
              },
              vAxis: {
                title: 'Cantidad de lluvia en mm'
              }
            };

            var chart = new google.visualization.ColumnChart(
              document.getElementById('chart_lluvia'));
              chart.draw(data, options);
            }

        function drawBasic4(chart_data) {
          var jsonData = chart_data;
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'Dia');
          data.addColumn('number', 'Cant de lluvia');
          $.each(chart_data, function(i, jsonData){
             var hora = jsonData.ano;
             var lluvia = parseFloat($.trim(jsonData.cantidad));
             data.addRows([[hora,lluvia]]);
          });

            var options = {
              title: 'Cantidad de lluvia',
              hAxis: {
                title: 'Año',
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
          chartsload();
        });


     $(document).ready(function(){
      $("#rango").change(function(){
        var rango = ($("#rango").val());
        var microval = '<?php echo $_SESSION['microses']; ?>';
           $.ajax({
             url: 'query/graficolluvia2.php',
             method: 'post',
             data:  {"rango": rango, "microval": microval},
             dataType:"JSON",
         }).done(function(data){
           console.log(data);
           if(rango==1){
             drawBasic(data);
           }
           if(rango==2){
             drawBasic2(data);
           }
           if(rango==3){
             drawBasic3(data);
           }
           if(rango==4){
             drawBasic4(data);
           }
         })
       })
     })

     function chartsload(){
        var rango = ($("#rango").val());
        var microval = '<?php echo $_SESSION['microses']; ?>';
          $.ajax({
            url: 'query/graficolluvia2.php',
            method: 'post',
            data:  {"rango": rango, "microval": microval},
            dataType:"JSON",
        }).done(function(data){
          console.log(data);
          if(rango==1){
            drawBasic(data);
          }
          if(rango==2){
            drawBasic2(data);
          }
          if(rango==3){
            drawBasic3(data);
          }
          if(rango==4){
            drawBasic4(data);
          }
        })
      }


   <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


   google.charts.load('current', {packages: ['corechart', 'line']});
    function drawBackgroundColor(chart_data) {
          var jsonData = chart_data;
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'X');
          data.addColumn('number', 'Altura');
          data.addColumn('number', 'Peligro');
          data.addColumn('number', 'Menor al nivel normal');
          $.each(chart_data, function(i, jsonData){
             var hora = jsonData.horadia;
             var lluvia = -+parseFloat($.trim(jsonData.cantidad));
             data.addRows([[hora,lluvia,-350,-600]]);
          });

          var options = {
            title: 'Cercania del rio al nivel de la tierra',
            hAxis: {
              title: 'Hora'
            },
            vAxis: {
              title: 'Altura del rio en cm'
            },
            //backgroundColor: '#f1f8e9'
          };

          var chart = new google.visualization.LineChart(document.getElementById('chart_ultra'));
          chart.draw(data, options);
        }

        function drawBackgroundColor2(chart_data) {
              var jsonData = chart_data;
              var data = new google.visualization.DataTable();
              data.addColumn('string', 'X');
              data.addColumn('number', 'Altura');
              data.addColumn('number', 'Nivel de la tierra');
              data.addColumn('number', 'Menor al nivel normal');
              $.each(chart_data, function(i, jsonData){
                 var hora = jsonData.dia;
                 var lluvia = -+parseFloat($.trim(jsonData.cantidad));
                 data.addRows([[hora,lluvia,-350,-600]]);
              });

              var options = {
                title: 'Cercania del rio al nivel de la tierra',
                hAxis: {
                  title: 'Dias'
                },
                vAxis: {
                  title: 'Altura del rio en cm',
                },
                //backgroundColor: '#f1f8e9'
              };

              var chart = new google.visualization.LineChart(document.getElementById('chart_ultra'));
              chart.draw(data, options);
            }

            function drawBackgroundColor3(chart_data) {
                  var jsonData = chart_data;
                  var data = new google.visualization.DataTable();
                  data.addColumn('string', 'X');
                  data.addColumn('number', 'Altura');
                  data.addColumn('number', 'Peligro');
                  data.addColumn('number', 'Menor al nivel normal');
                  $.each(chart_data, function(i, jsonData){
                     var hora = jsonData.mes;
                     var lluvia = -+parseFloat($.trim(jsonData.cantidad));
                     data.addRows([[hora,lluvia,-350,-600]]);
                  });

                  var options = {
                    title: 'Cercania del rio al nivel de la tierra',
                    hAxis: {
                      title: 'Mes'
                    },
                    vAxis: {
                      title: 'Altura del rio en cm'
                    },
                    //backgroundColor: '#f1f8e9'
                  };

                  var chart = new google.visualization.LineChart(document.getElementById('chart_ultra'));
                  chart.draw(data, options);
                }

                function drawBackgroundColor4(chart_data) {
                      var jsonData = chart_data;
                      var data = new google.visualization.DataTable();
                      data.addColumn('string', 'X');
                      data.addColumn('number', 'Altura');
                      data.addColumn('number', 'Peligro');
                      data.addColumn('number', 'Menor al nivel normal');
                      $.each(chart_data, function(i, jsonData){
                         var hora = jsonData.ano;
                         var lluvia = -+parseFloat($.trim(jsonData.cantidad));
                         data.addRows([[hora,lluvia,-350,-600]]);
                      });

                      var options = {
                        title: 'Cercania del rio al nivel de la tierra',
                        hAxis: {
                          title: 'Año'
                        },
                        vAxis: {
                          title: 'Altura del rio en cm'
                        },
                        //backgroundColor: '#f1f8e9'
                      };

                      var chart = new google.visualization.LineChart(document.getElementById('chart_ultra'));
                      chart.draw(data, options);
                    }

                    $(window).resize(function() {
                      chartsload2();
                    });

     $(document).ready(function(){
      $("#rango").change(function(){
        var rango = ($("#rango").val());
        var microval = '<?php echo $_SESSION['microses']; ?>';
           $.ajax({
             url: 'query/graficoultra.php',
             method: 'post',
             data:  {"rango": rango, "microval": microval},
             dataType:"JSON",
         }).done(function(data){
           console.log(data);
           if(rango==1){
             drawBackgroundColor(data);
           }
           if(rango==2){
             drawBackgroundColor2(data);
           }
           if(rango==3){
             drawBackgroundColor3(data);
           }
           if(rango==4){
             drawBackgroundColor4(data);
           }
         })
       })
     })

     function chartsload2(){
        var rango = ($("#rango").val());
        var microval = '<?php echo $_SESSION['microses']; ?>';
          $.ajax({
            url: 'query/graficoultra.php',
            method: 'post',
            data: {"rango": rango, "microval": microval},
            dataType:"JSON",
        }).done(function(data){
          console.log(data);
          if(rango==1){
            drawBackgroundColor(data);
          }
          if(rango==2){
            drawBackgroundColor2(data);
          }
          if(rango==3){
            drawBackgroundColor3(data);
          }
          if(rango==4){
            drawBackgroundColor4(data);
          }
        })
      }

      </script>


   <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

   <script type="text/javascript">

   function Refreshdata1(){
      var rango = ($("#rango").val());
      var microval = '<?php echo $_SESSION['microses']; ?>';
        $.ajax({
          url: 'query/graficolluvia2.php',
          method: 'post',
          data:  {"rango": rango, "microval": microval},
          dataType:"JSON",
      }).done(function(data){
        console.log(data);
        if(rango==1){
          drawBasic(data);
        }
        if(rango==2){
          drawBasic2(data);
        }
        if(rango==3){
          drawBasic3(data);
        }
        if(rango==4){
          drawBasic4(data);
        }
      })
    }

     $(document).ready(function(){
       setInterval(Refreshdata1, 10000);
     });
   </script>


   <script type="text/javascript">

   function Refreshdata2(){
      var rango = ($("#rango").val());
      var microval = '<?php echo $_SESSION['microses']; ?>';
        $.ajax({
          url: 'query/graficoultra.php',
          method: 'post',
          data: {"rango": rango, "microval": microval},
          dataType:"JSON",
      }).done(function(data){
        console.log(data);
        if(rango==1){
          drawBackgroundColor(data);
        }
        if(rango==2){
          drawBackgroundColor2(data);
        }
        if(rango==3){
          drawBackgroundColor3(data);
        }
        if(rango==4){
          drawBackgroundColor4(data);
        }
      })
    }

     $(document).ready(function(){
       setInterval(Refreshdata2, 10000);
     });
   </script>


   <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
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
           <a class="nav-link text-dark" href="Graficos.php"> Graficos </a>
         </li>
         <li class="nav-item">
           <a class="nav-link text-dark" href="valoresh.html"> Valores Historicos (BD) </a>
         </li>

         <li class="nav-item">
           <a class="nav-link text-dark" href="nosotros.html">Nosotros </a>
         </li>
         <li class="nav-item dropdown">
           <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="far fa-bell"></i></a>
           <div id="alerta" class="dropdown-menu dropdown-menu-right">
           </div>
         </li>
       </ul>
       <div class="collapse navbar-collapse justify-content-end" id="navbarColor03">
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
     <div class="container">
     <h3></h3>
     <br>

  <div class="container" >
    <div class="card border-light mb-3">
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
       <br><hr><br>
       <div id="chart_ultra"></div>
       </div>
     </div>
    </div>
   </div>

 <br><br>
</div>
   </body>
  </html>
