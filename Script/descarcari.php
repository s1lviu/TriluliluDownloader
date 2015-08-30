<?php
include('sql.php');
$sql = "SELECT id, ip, nume, data FROM descarcari";

if(isset($_POST["valoare"]))
{
  $val = $_POST["valoare"];
  $val = $conn->real_escape_string($val);
  $optiune = $_POST["optiune"];
  $optiune = $conn->real_escape_string($optiune);

$sql = "SELECT id, ip, nume, data FROM descarcari where  `$optiune` like '%$val%'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $rezultate.= "<tr><td>" . $row["id"]. "</td><td>" . $row["nume"]. "</td><td>" . $row["ip"]. "</td><td>" . $row["data"]."</td> </tr>";
    }
} else {
    $rezultate = 'Niciun rezultat';
}
}else{
  $result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $rezultate.= "<tr><td>" . $row["id"]. "</td><td>" . $row["nume"]. "</td><td>" . $row["ip"]. "</td><td>" . $row["data"]."</td> </tr>";
    }
} else {
    $rezultate = 'Niciun rezultat';
}
}

$conn->close();
?>
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
        <li><a href="index.php">Home</a></li>
        <li class="active"><a href="descarcari.php">Melodii descarcate</a></li>
    </div>
  </div>
</nav>

<div class="container">
  <h2>Căutați o melodie dupa filtre</h2>
  <form method="post" role="form">
    <div class="form-group">
      <label for="selector">Selectați un filtru:</label>
      <select name ="optiune" class="form-control">
        <option value="ip">IP</option>
        <option value="nume">Nume</option>
        <option value="data">Data</option>
      </select>
   <label for="nume">Valoare:</label>
  <input type="text" class="form-control" name="valoare">
  <input type="submit" value="Cauta">
      <br>
    </div>
  </form>
</div>
  
<div class="container">
  <div class="jumbotron">
    <div class="container">
      <h2>Rezultate</h2>
      <p>Melodii descarcate</p>                                                                                      
      <div class="table-responsive">          
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nume melodie</th>
            <th>IP</th>
            <th>Data</th>
          </tr>
        </thead>
        <tbody>
          <?php echo $rezultate; ?>
        </tbody>
      </table>
      </div>
    </div>    
  </div>
</div>


</body>
</html> 
