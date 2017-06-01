<?php
    // default language it_IT.php
    include (TEMPLATEPATH . "/lang/it_IT.php");

    // page current url
	$pageURL = 'http';
    
    if( isset($_SERVER["HTTPS"]) ){
        if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    }

    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }

    // links
    $homeLink = home_url();
    $tmpDir = get_template_directory_uri();
?>