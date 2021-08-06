<?php require_once('../../codeblocks/session.php'); ?>
<?php require_once('../../database/connection.php'); ?>
<?php require_once('../../codeblocks/login.php');?>
<?php require_once('../../codeblocks/functions.php');?>
<?php

$conn=getConnection() or die("Connection Failed: " . mysqli_connect_error());

$requestData= $_REQUEST;

$columns = array( 
	0 => 'uni_name', 
	1 => 'uni_code',
	2 => 'uni_code'
);

$sql = "SELECT *  
		FROM tbluniversities
		WHERE uni_active=1";
$query=mysqli_query($conn, $sql) or die("Process Failed : Status 1");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;

$sql = "SELECT *  
		FROM tbluniversities
		WHERE uni_active=1";
if( !empty($requestData['search']['value']) ) {
	$sql.=" AND ( uni_name LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR uni_code LIKE '%".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) or die("Process Failed : Status 2");
$totalFiltered = mysqli_num_rows($query);

$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	
$query=mysqli_query($conn, $sql) or die("Process Failed : Status 3");

$data = array();
while( $row=mysqli_fetch_array($query) ) {
	$nestedData = array();
	$uni_id = $row['uni_id'];
	$nestedData[] = $row["uni_name"];
	$nestedData[] = $row["uni_code"];
	$nestedData[] = '<button type="button" class="btn btn-outline-primary btn-sm" onclick="editModal(' . $uni_id . ');">Edit</button> 
					<button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteModal(' . $uni_id . ');">Delete</button>';
	$data[] = $nestedData;
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),
			"recordsTotal"    => intval( $totalData ),
			"recordsFiltered" => intval( $totalFiltered ),
			"data"            => $data
			);

echo json_encode($json_data);

mysqli_close($conn);
?>
