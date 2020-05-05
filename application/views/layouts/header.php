<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <!-- Link The Styling files -->
    <link rel="stylesheet" href="<?php echo base_url('css/custom.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <!-- js The Validating files -->
    <script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('js/jquery.validate.min.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
   
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <script src="<?php echo base_url('js/custom.js'); ?>"></script>
    <!-- add the scripts of JS -->
</head>
<body>
    <div class="header">
    <a href="<?php echo base_url(); ?>" class="logo"><img src="<?php echo base_url('uploads/flower.jpg'); ?>"  title="White flower" alt="Flower"></a>
    <div class="header-right">
        <a class="active" href="#home">Home</a>
        <a href="#contact">Contact</a>
        <a href="#about">About</a>
    </div>
    </div>