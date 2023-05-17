<?php
    // remove admin bar for non admin users
    add_action('after_setup_theme', 'remove_admin_bar');
    
    function remove_admin_bar() {
        if (!current_user_can('administrator') && !is_admin()) {
            show_admin_bar(false);
        }
    }

    //add menu support
	add_theme_support( 'menus' );

    // add thumbnails support
    add_theme_support( 'post-thumbnails' ); 

    // register main menu
    function register_menus() {
		register_nav_menus(
			array(
				'main' => __( 'Main Menu' )
			)
		);
	}
	add_action( 'init', 'register_menus' );

    // body page classes
    function body_classes()
    {
        $catClass = '';
        if (is_home()) {
            $catClass = 'home';
        } elseif (is_category()) {
            $currentCat = get_query_var('cat');
            $catClass = get_cat_name($currentCat);
        } elseif (is_tax()) {
            $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            $catClass = $term->slug;
        } elseif (is_page()) {
            $slug = basename(get_permalink());
            $catClass = 'page page-' . str_replace(' ', '_', strtolower(get_the_title()));
        } elseif (is_single()) {
            $slug = basename(get_permalink());
            $catClass = 'single ' . $slug;
        } elseif (is_404()) {
            $catClass = 'error-page';
        }

        echo $catClass;
    }

    // add current item class
    function add_current_nav_class($classes, $item) {
    
        // Getting the current post details
        global $post;
        
        // Getting the post type of the current post
        $current_post_type = get_post_type_object(get_post_type($post->ID));
        $current_post_type_slug = $current_post_type->rewrite[slug];
            
        // Getting the URL of the menu item
        $menu_slug = strtolower(trim($item->url));
        
        // If the menu item URL contains the current post types slug add the current-menu-item class
        if ( strpos($menu_slug,$current_post_type_slug) !== false ) {
            $classes[] = 'current-menu-item';
        }
        
        // Return the corrected set of classes to be added to the menu item
        return $classes;
    
    }

    // post types for search
    function include_custom_post_types( $query ) {
        $custom_post_type = get_query_var( 'post_type' );
    
        if ( is_archive() ) {
            if ( empty( $custom_post_type ) ) $query->set( 'post_type' , get_post_types() );
        }
    
        if ( is_search() ) {
            if ( empty( $custom_post_type ) ) {
                $query->set( 'post_type' , array('post'));
            }
        }
    
        return $query;
    }
    add_filter( 'pre_get_posts' , 'include_custom_post_types' );

    // add SVG
    function cc_mime_types($mimes) {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }
    add_filter('upload_mimes', 'cc_mime_types');

    // Move Yoast SEO to bottom
    function yoasttobottom() {
        return 'low';
    }
    add_filter( 'wpseo_metabox_prio', 'yoasttobottom');

    // Load Translations
    function wp_inito_load_theme_textdomain() {
        load_theme_textdomain( 'inito-wp-theme', get_template_directory() . '/lang' );
    }
    add_action( 'after_setup_theme', 'wp_inito_load_theme_textdomain' );

    // function default_site_locale( $locale ) {
    //     $default_locale = 'en_US';
    //     return $default_locale;
    // }
    // add_filter( 'locale', 'default_site_locale' );

    function tr($text){
        return _e($text, 'inito-wp-theme');
    }

    if( function_exists('acf_add_options_page') ) {
        acf_add_options_page(array(
            'page_title'    => 'SEO Settings',
            'menu_title'    => 'SEO Settings',
            'menu_slug'     => 'seo-settings',
        ));

        acf_add_options_page(array(
            'page_title'    => 'Utils',
            'menu_title'    => 'Utils',
            'menu_slug'     => 'utils',
        ));
    }

    /**
     * Return the post excerpt, if one is set, else generate it using the
     * post content. If original text exceeds $num_of_words, the text is
     * trimmed and an ellipsis (…) is added to the end.
     *
     * @param  int|string|WP_Post $post_id   Post ID or object. Default is current post.
     * @param  int                $num_words Number of words. Default is 33.
     * @return string                        The generated excerpt.
     */
    function get_post_excerpt( $post_id = null, $num_words = 33 ) {

        $post = $post_id ? get_post( $post_id ) : get_post( get_the_ID() );
        $text = get_the_excerpt( $post );

        if ( ! $text ) {
            $text = get_post_field( 'post_content', $post );
        }

        $generated_excerpt = wp_trim_words( $text, $num_words );

        return apply_filters( 'get_the_excerpt', $generated_excerpt, $post );

    }
    
?>