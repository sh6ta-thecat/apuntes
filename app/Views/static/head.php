<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | coneCter</title>
    <base href="http://<?php echo $_SERVER['SERVER_NAME']?>/conecter/">
    <link rel="shortcut icon" href="public/imges/default/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/components/<?= $css ?>.css">
    <?php if (isset($_SESSION['user_id'])) : ?>
        <link rel="stylesheet" href="public/css/components/sidebar.css">
        <style>
            body {
                display: inline-flex;
            }
        </style>
    <?php else : ?>
        <link rel="stylesheet" href="public/css/components/welcome.css">
        <style>
            body{
                display:block;
            }
            @media (max-width: 768px) {
                body{
                padding:0 !important;
            }
        }
        </style>
    <?php endif; ?>
</head>
<body>
    
    <?php if (isset($_SESSION['user_id'])) {
        echo '<div class="container" style="display:inline-flex;">';
        include 'sidebar.php';
    }else{
        echo '<div class="container">';
        include 'header.php';
    }