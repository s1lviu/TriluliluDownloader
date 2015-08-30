<?php
if(isset($_GET["link"]))
{
date_default_timezone_set("Europe/Bucharest");
include 'SabreAMF/Client.php';
include 'sql.php';

function get_content($url) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");
  curl_setopt($ch, CURLOPT_COOKIEJAR, "cookies.txt");
  curl_setopt($ch, CURLOPT_REFERER, 'http://www.trilulilu.ro');
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.152 Safari/537.36');
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

$link = $_GET["link"];

$referer = base64_encode($link);


$html = get_content($link);


$user = explode('username=',$html);
$user = explode('&',$user[1]);
$user_i = $user[0];


$hash = explode('hash=',$html);
$hash = explode('&',$hash[1]);
$hash_i = $hash[0];


function Trilulilu($user,$hash){ //am creat o functie cu parametrii $user si $hash care returneaza request-ul serverului AMF
  $client = new SabreAMF_Client('http://www.trilulilu.ro/amf'); //am deschis conexiunea AMF catre serverul trilulilu
    return $client->sendRequest('file.audio_info',array($user, $hash, "play")); //am trimis datele catre server si am returnat rezultatul
}

$rezultat = Trilulilu($user_i, $hash_i); //am apelat functia si am pastrat rezultatul intr-o variabila

//print_r($rezultat); //afisarea vectorului cu rezultate


$URL='http://fs'.$rezultat["server"].'.trilulilu.ro/stream.php?type=audio&source=site&hash='.$rezultat["hash"].'&username='
.$rezultat["username"].'&key='.$key.'&sig='.$rezultat["sig"].'&exp='.$rezultat["exp"].'&referer='.$referer;


if(strlen($rezultat["titlu"])==0 || strlen($rezultat["username"])==0)
{
  die("Acest fisier nu este disponibil momentan.");
}else{
$nume = $rezultat["titlu"].'.mp3'; //luam titlul melodiei si ii punem extensia mp3
$ip =$_SERVER["HTTP_CF_CONNECTING_IP"];
$date = date('Y-m-d H:i:s');
//Salvam descarcarea in baza de date.

$nume = $conn->real_escape_string($nume);
$sql="INSERT INTO `descarcari` (`ip`,`nume`,`data`)  VALUES ('$ip','$nume','$date')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


ob_clean();
header('Pragma: public');   
header('Expires: 0');   // no cache
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header("Content-Type: application/force-download");
header("Content-Type: audio/mpeg");
header("Content-Disposition: attachment; filename=\"".$nume."\""); 
header("Content-Transfer-Encoding: binary");
header('Connection: close');
readfile(str_replace(" ", "%20", $URL));
exit;

}
}else{
echo '

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Proiect MDS - Trilulilu Downloader</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">MDS: Trilulilu Downloader</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="descarcari.php">Melodii descarcate</a></li>
    </div>
  </div>
</nav>
  
<div class="container">
  <div class="jumbotron">
    <h2>Introduceti link-ul melodiei de pe Trilulilu.ro</h2>    
    <h3>Pentru a cauta muzica, folositi <a href="http://cauta.trilulilu.ro/muzica/" target="_blank">acest link</a>.</h3>  
    <form name="input">
Link melodie de pe Trilulilu.ro: <input class="glyphicon glyphicon-search" type="url" name="link">
<input type="submit" value="Descarca">
</form>      
  </div>


</body>
</html>';
}
?>
