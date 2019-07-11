<?php
$subject = "Cities Flood Monitoring System";
$link = "http://cfms.sytes.net/veri.html";
$recipient_email = $_SESSION['correo'];
$email = "lrivera.18@hotmail.com";

$con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
$na=pg_query($con,("select nombre from usuario where correo = '$recipient_email';"));
$ap=pg_query($con,("select apellido from usuario where correo = '$recipient_email';"));

$token = mt_rand(100000, 999999);
$query1 = ("UPDATE usuario set codigov='$token' where correo = '$recipient_email';");
$sql = pg_query($con,$query1);

$name=pg_fetch_row($na);
$apellido=pg_fetch_row($ap);

$headers  = "MIME-Version: 1.0 \r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1 \r\n";
$headers .= "From: $name <$email> \n";

$body = '<b>Estimado usuario </b> ' . $name[0] .'<b> </b>'. $apellido[0] . '<br />';
$body .= '<b>Su codigo de seguridad es: </b>' . $token . '<br />';
$body .= '<b>Link de acceso: </b> ' . $link . '<br /><br />';
$body .= '<b>Gracias por utilizar nuestros servicios.</b><br />';
$body .= '<b>Favor no responder a este correo</b>';

mail($recipient_email, $subject, $body, $headers);
pg_close($con);

// if( mail($recipient_email, $subject, $body, $headers) ){
//    echo "Message has been successfully sent.";
// }else{
//     echo "Sending failed.";
//  }
# mail(
#      'wichy.97@hotmail.com',
#      'Works!',
#      'An email has been generated from your localhost, congratulations!');
?>
