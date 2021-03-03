<?php
$postData = $_POST;

$postInfo = $postData['info'];

$postInfoObj = [];

$files = $_FILES;

$filesArr = [];

foreach ($files as $file => $value) {

	$fileNameArr = explode('.', $value['name']);
	$fileFormat = $fileNameArr[ count( $fileNameArr ) -1 ];

	if(  $value['error'] > 0 ||  $value['size'] > 10000000 ){

		echo "uploaded file error";
		die();
	}

	$imgFolderPath = '../images/';

	$newImgName = $dot_number . '_' . $file . '.' . $fileFormat;

	$filesArr[] = $newImgName;

	if( !move_uploaded_file( $value['tmp_name'], $imgFolderPath . $newImgName ) ){
		echo "uploaded file error";
		die();
	}
}

$img = $postData["canvas"];

$img = str_replace('data:image/octet-stream;base64,', '', $img);  
$img = str_replace(' ', '+', $img);  
$data = base64_decode($img);

$canvasFileName = $dot_number . '-canvas.png';
$file = $imgFolderPath . $canvasFileName;  

$success = file_put_contents($file, $data);

if( !$success ){
	echo  'canvas error';
	die();
}