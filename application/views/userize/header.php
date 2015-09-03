<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Userize Default Page</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('themes/userize/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('themes/userize/css/logo-nav.css'); ?>" rel="stylesheet">

    <script src="<?php echo base_url('themes/userize/js/jquery.js'); ?>"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                <!--
                    <img src="http://placehold.it/150x50&text=Logo" alt="">
                -->
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="<?php echo base_url('userize_admin/users'); ?>">Users</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('userize_admin/roles'); ?>">Roles</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('userize_admin/controllers'); ?>">Controllers</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('userize_admin/assign_access'); ?>">Assign Access</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('userize_admin/controller_generator'); ?>">Generate Controller</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">