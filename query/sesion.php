<?php
  session_start();
  $_SESSION['microses']=$_GET['id'];
  header("Location: ../Inicio.html")
?>
