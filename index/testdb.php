<?php
 $dbc = mysqli_connect("sql966.main-hosting.eu","u727927886_admin",'Biba$arsene0',"u727927886_concorde");
 $query = "SELECT * FROM concorde_users";
 $row = mysqli_query($dbc, $query);
 while($data = mysqli_fetch_array($row)){
echo $data['username'];
echo "<br>";
 }
 mysqli_close($dbc);
?>