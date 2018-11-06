<?php
    
       session_start();
    if (!isset($_SESSION['id'])) {
        header("Location: index.php");
    }
  

    require '../vendor/autoload.php';
    use App\classes\Blog;
    use App\classes\Login;

    $queryResult = Blog::getAllBlogInfo();
//    while ($row = mysqli_fetch_assoc($queryResult)) {
//        echo '<pre>';
//        print_r($row);
//    }
//    
//    exit();
    
    
   
    
    if(isset($_GET['status'])){
        if($_GET['status'] == 'logout') {
            $message = Login::adminLogout();
            $_SESSION['message'] = $message;
        }
    }
    $blogId = $_GET['id'];
    $queryResult = Blog::selectBlogInfoByBlogId($blogId);
    $blogInfo = mysqli_fetch_assoc($queryResult);
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Category</title>
    <link href="../assets/admin/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container" style="m