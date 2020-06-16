<?php 
include_once('../../src/common/DBConnection.php');

$conn=new DBConnection();
if(isset($_GET['date'])){
      $newDate = explode(" ", $_GET['date']);
      $date = $newDate[0];
      $time = $newDate[1];
      $sql = "SELECT availability.*,contractors.speciality 
	          FROM availability INNER JOIN contractors ON availability.contractor_id = contractors.id 
			  WHERE ('$time' between availability.available_from and availability.available_to) AND '$date' = availability.date ";

      $result = $conn->getAll($sql);
      if(!empty($result)){
            $table = "<p>
            <table id='datatable-buttons' class='table table-striped table-bordered'>
            <thead>
            <tr>
                <th><center>Contractor ID</center></th>
				<th><center>Speciality</center></th>
                <th><center>Date</center></th>
                <th><center>From</center></th>
                <th><center>To</center></th>
            </tr>
            </thead>
            <tbody>";
            foreach($result as $row){
                  $table .= "<tr><td><center>".$row['contractor_id']."</center></td>";
				  $table .= "<td><center>".$row['speciality']."</center></td>";
                  $table .= "<td><center>".$row['date']."</center></td>";
                  $table .= "<td><center>".$row['available_from']."</center></td>";
                  $table .= "<td><center>".$row['available_to']."</center></td></tr>";
            }
            $table .= "</tbody>
        </table></p>";
        echo $table;
      }
      else{
            echo "<h3>No Contractors Available</h3>";
      }
}
else{
      echo "Error! Please choose a Date";
}
?>
