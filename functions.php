<?php
    // remove admin bar
	add_filter('show_admin_bar', '__return_false');

    //add menu support
	add_theme_support( 'menus' );

    // register main menu
    function register_menus() {
		register_nav_menus(
			array(
				'main' => __( 'Main Menu' )
			)
		);
	}
	add_action( 'init', 'register_menus' );

    // page title
    function page_title(){
        if (is_home () ) { 
            bloginfo('name');
            // Add the blog description for the home/front page.
            $site_description = get_bloginfo( 'description' );
            if ( $site_description && ( is_home() || is_front_page() ) ){
                echo " | $site_description";
            }
        }elseif ( is_category() ) { 
            single_cat_title(); echo ' - ' ; bloginfo('name'); 
        }elseif (is_single() ) { 
            single_post_title();
        }elseif (is_page() ) { 
            single_post_title(); echo ' | ';  bloginfo('name');
        }else { wp_title('',true); }
    }

    // body page classes
    function body_classes(){
        $catClass = '';
        if(is_home()){
            $catClass = 'home';
        }elseif ( is_category() ){
            $currentCat = get_query_var('cat');
            $catClass = get_cat_name( $currentCat );
        }elseif ( is_tax() ) { 
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            $catClass = $term->name;
        }elseif (is_page() ) {
            $slug = basename(get_permalink());
            $catClass = 'page page-'.str_replace(' ', '_', strtolower(get_the_title()));
        }elseif (is_single()){
            $slug = basename(get_permalink());
            $catClass = 'single '.$slug;
        }elseif ( is_404() ){
            $catClass = 'error-page';
        }

        echo $catClass;
    }
?>