<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            <?php page_title(); ?> </title>
        <meta name="description" content="<?php echo get_bloginfo( 'description' ); ?>">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- facebook open graph -->
        <meta property="og:title" content="<?php page_title(); ?>">
        <meta property="og:url" content="<?php echo $pageURL; ?>">
        <meta property="og:type" content="article">
        <meta property="og:description" content="<?php echo get_bloginfo( 'description' ); ?>">
        <!-- itemprop google -->
        <meta itemprop="name" content="<?php page_title(); ?>">
        <meta itemprop="description" content="<?php echo get_bloginfo( 'description' ); ?>">
        <meta itemprop="image" content="<?php echo $tmpDir;?>/dist/img/share/share.png">
        <link rel="stylesheet" href="<?php echo $tmpDir;?>/dist/css/main.css">
        <!-- generated favicons -->
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $tmpDir;?>/dist/ico/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $tmpDir;?>/dist/ico/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $tmpDir;?>/dist/ico/favicon-16x16.png">
        <link rel="manifest" href="<?php echo $tmpDir;?>/manifest.json">
        <link rel="mask-icon" href="<?php echo $tmpDir;?>/dist/ico/safari-pinned-tab.svg" color="#ffffff">
        <link rel="shortcut icon" href="<?php echo $tmpDir;?>/dist/ico/favicon.ico">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?php echo $tmpDir;?>/dist/ico/mstile-144x144.png">
        <meta name="msapplication-config" content="<?php echo $tmpDir;?>/browserconfig.xml">
        <meta name="theme-color" content="#ffffff"> </head>
    <body class="<?php body_classes(); ?>">