<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<link rel="stylesheet" href="registration.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<style>
    form{
        margin-left:30%;
        margin-top:40px;
        border: 5px solid black;
        align-content: center;
        padding:20px;
        width:400px;
    }
    h1{
        margin-left:30%;
        margin-top:100px;
        align-content: center;
        padding:20px;
        width:400px;
    }
    </style>
<body>
<h1>UPLOAD</h1>
<form name="form" method="post" action="start.php" enctype="multipart/form-data" >
<input type="file" name="my_file" /><br /><br />
<input type="submit" name="submit" value="Upload"/>
</form>
<?php
require('db.php');
session_start();
$uploaded="false";
$myfilename='';
if (($_FILES['my_file']['name']!="")){
    
    // Where the file is going to be stored
        $target_dir = "C:/xampp/htdocs/Financepeer/";
        $file = $_FILES['my_file']['name'];
        $path = pathinfo($file);
        $filename = $path['filename'];
        $ext = $path['extension'];
        $temp_name = $_FILES['my_file']['tmp_name'];
        $path_filename_ext = $target_dir.$filename.".".$ext;
     
    // Check if file already exists
    if (file_exists($path_filename_ext)) {
     echo "file already exists.";
     }
     else{
     move_uploaded_file($temp_name,$path_filename_ext);
     echo "File Uploaded Successfully.";
     $myfilename=$filename.".".$ext;
     $uploaded="true";
     }

    }
    if($uploaded=="true")
    {
$jsonCont = file_get_contents($myfilename); 
$content = json_decode($jsonCont, true);
$query = '';
foreach($content as $row) {
    $query .= "INSERT INTO data1 VALUES 
    ('".$row["userId"]."', '".$row["id"]."', 
    '".$row["title"]."','".$row["body"]."'); "; 
}
if(mysqli_multi_query($conn, $query)) {
    echo '<h3>Inserted JSON Data</h3><br />';
}
    }
?> 
</body>
</html>
