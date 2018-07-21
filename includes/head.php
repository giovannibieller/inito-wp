<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php wp_title(); ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <?php wp_head(); ?>

        <link rel="stylesheet" href="<?php echo $tmpDir;?>/dist/css/main.css?v=666">

        <!-- generated favicons -->
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $tmpDir;?>/dist/ico/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $tmpDir;?>/dist/ico/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $tmpDir;?>/dist/ico/favicon-16x16.png">
        <link rel="manifest" href="<?php echo $tmpDir;?>/dist/ico/site.webmanifest">
        <link rel="mask-icon" href="<?php echo $tmpDir;?>/dist/ico/safari-pinned-tab.svg" color="#ffffff">
        <link rel="shortcut icon" href="<?php echo $tmpDir;?>/dist/ico/favicon.ico">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?php echo $tmpDir;?>/dist/ico/mstile-144x144.png">
        <meta name="msapplication-config" content="<?php echo $tmpDir;?>/browserconfig.xml">
        <meta name="theme-color" content="#ffffff"> </head>
    <body class="<?php body_classes(); ?>">