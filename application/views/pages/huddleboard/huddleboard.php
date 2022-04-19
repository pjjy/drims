<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<h2>HUDDLEBOARD</h2>

<table>
  <tr>
    <th>LGU</th>
    <th>FFP REQUESTED</th>
    <th>NFI REQUESTED</th>
    <th>RELEASED FFP QTY</th>
    <th>RELEASED DATE</th>
    <th>RELEASED NFI QTY</th>
    <th>RELEASED DATE</th>
  </tr>
  <?php
    foreach($getallprovince as $key =>  $value){	
			$provName = "";
			if($value['provCode'] == '0712'){
				$provName = "BOHOL";
			}  
			if($value['provCode'] == '0722'){
				$provName = "CEBU";
			} 
			if($value['provCode'] == '0746'){
				$provName = "NEGROS ORIENTAL";
			} 
			if($value['provCode'] == '0761'){
				$provName = "SIQUIJOR";
			}              	
            echo '<tr>
			    	<td>'.$provName.'-'.$value['citymunDesc'].'</td>
			    	<td>'.rand(1,1000).'</td>
			  	  </tr>';
 
	}
  ?>

 
  
 
 
</table>

</body>
</html>

