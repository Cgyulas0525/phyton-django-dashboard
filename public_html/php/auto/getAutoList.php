<?php
include('dbconnect.php');

mysqli_set_charset($conn, 'utf8');
$sql = "SELECT t.*, t1.name as fnev FROM cars t, users t1
         WHERE t.deleted_at IS NULL AND
               t1.id = t.felhasznalo";
$result = mysqli_query($conn, $sql);
$data = array();

$i = 0;
while($row = mysqli_fetch_assoc($result))
{
  $data[$i]['id']    = $row['id'];
  $data[$i]['rendszam'] = $row['rendszam'];
  $data[$i]['tipus'] = $row['tipus'];
  $data[$i]['motorszam'] = $row['motorszam'];
  $data[$i]['alvazszam'] = $row['alvazszam'];
  $data[$i]['karbantarto'] = $row['karbantarto'];
  $data[$i]['hatter'] = $row['hatter'];
  $data[$i]['kep'] = $row['kep'];
  $data[$i]['felhasznalo'] = $row['felhasznalo'];
  $data[$i]['fnev'] = $row['fnev'];
  $i++;
}
echo json_encode($data);
mysqli_close($conn);
?>
