<?php require_once('../../codeblocks/session.php'); ?>
<?php require_once('../../database/connection.php'); ?>
<?php require_once('../../codeblocks/login.php');?>
<?php require_once('../../codeblocks/functions.php');?>
<?php

$conn=getConnection() or die("Connection Failed: " . mysqli_connect_error());

$requestData= $_REQUEST;

$columns = array( 
	0 => 'usr_name', 
	1 => 'usr_email',
	3 => 'usr_type',
	4 => 'usr_id'
);

$sql = "SELECT *  
		FROM tblusers
		WHERE 1=1";
$query=mysqli_query($conn, $sql) or die("Process Failed : Status 1");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;

$sql = "SELECT *  
		FROM tblusers
		WHERE 1=1";
if( !empty($requestData['search']['value']) ) {
	$sql.=" AND ( usr_name LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR usr_email LIKE '%".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) or die("Process Failed : Status 2");
$totalFiltered = mysqli_num_rows($query);

$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	
$query=mysqli_query($conn, $sql) or die("Process Failed : Status 3");

$data = array();
while( $row=mysqli_fetch_array($query) ) {
	$nestedData = array();
	$usr_id = $row['usr_id'];
	$nestedData[] = $row["usr_name"];
	$nestedData[] = $row["usr_email"];
	if ($row["usr_type"] == 1){
		$nestedData[] = "Administrator";
	}else{
		$nestedData[] = "Editor";
	}
	if($usr_id == sysdecode($_SESSION['iuni_usid'])){
		$nestedData[] = '<small>Active Profile</small>';
	}else{
		$nestedData[] = '<button type="button" class="btn btn-outline-primary btn-sm" onclick="editModal(' . $usr_id . ');">Edit</button> 
		<button type="button" class="btn btn-outline-secondary btn-sm" onclick="resetModal(' . $usr_id . ');">Reset Password</button> 
		<button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteModal(' . $usr_id . ');">Delete</button>';
	}
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
