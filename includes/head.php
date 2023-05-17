<!DOCTYPE html>
<html lang="<?php echo $curlang; ?>">
    <head>
        <?php include (TEMPLATEPATH . "/includes/seo.php"); ?>
        
        <?php wp_head(); ?>

        <link rel="stylesheet" href="<?php echo $tmpDir;?>/dist/css/main.css?v=<?php echo $version; ?>">

        <?php include (TEMPLATEPATH . "/includes/favicons.php"); ?>
        <?php include (TEMPLATEPATH . "/includes/google_analytics.php"); ?>

    <body class="<?php body_classes(); ?>">