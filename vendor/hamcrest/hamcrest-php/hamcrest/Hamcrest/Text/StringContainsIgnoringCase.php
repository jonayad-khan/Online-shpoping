<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header("Location: index.php");
    }

    require '../vendor/autoload.php';
    use App\classes\Category;
    use App\classes\Login;
    use App\classes\Blog;

    $queryResult = Category::getAllpublishedCategory();
    
    if(isset($_GET['status'])){
        if($_GET['status'] == 'logout') {
            $message = Login::adminLogout();
            $_SESSION['message'] = $message;
        }
    }

    $message = '';
    if (isset($_POST['btn'])) {
        $message = Blog::saveBlogInfo($_POST);
    }
    
    
    
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" conten