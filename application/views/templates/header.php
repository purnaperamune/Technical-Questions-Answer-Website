<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="<?= base_url() ?>assets/js/jquery-3.7.1.min.js"></script>
    <script src="<?= base_url() ?>assets/js/underscore-umd-min.js"></script>
    <script src="<?= base_url() ?>assets/js/backbone-min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css" />
    <title>KnowledgeNest</title>
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?= base_url() ?>index.php"><b>KnowledgeNest</b></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">

                <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($isLoggedIn) && $isLoggedIn) { ?>
                        <li>
                            <a href="<?= base_url() ?>index.php/auth/account">Account</a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>index.php/auth/logout">Sign Out</a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a href="<?= base_url() ?>index.php">Sign up</a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>index.php/auth/login">Sign In</a>
                        </li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        