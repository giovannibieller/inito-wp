<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php wp_title(); ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <?php wp_head(); ?>

        <link rel="stylesheet" href="<?php echo $tmpDir;?>/dist/css/main.css?v=666">

        <!-- generated favicons block -->
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $tmpDir;?>/dist/ico/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $tmpDir;?>/dist/ico/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $tmpDir;?>/dist/ico/favicon-16x16.png">
        <link rel="manifest" href="<?php echo $tmpDir;?>/manifest.json">
        <link rel="mask-icon" href="<?php echo $tmpDir;?>/dist/ico/safari-pinned-tab.svg" color="#000000">
        <meta name="msapplication-TileColor" content="#000000">
        <meta name="theme-color" content="#000000">

        <!-- Google tag (gtag.js) -->
        <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-BVFQ98F05K"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-XXXXXXXXX');
        </script> -->

    <body class="<?php body_classes(); ?>">