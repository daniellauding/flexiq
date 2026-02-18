<?php
/**
 * FlexIQ Theme Functions
 * 
 * @package FlexIQ
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Block Patterns Category
 */
function flexiq_register_pattern_category() {
    register_block_pattern_category(
        'flexiq',
        array( 'label' => __( 'FlexIQ Patterns', 'flexiq' ) )
    );
}
add_action( 'init', 'flexiq_register_pattern_category' );

/**
 * Load block patterns
 */
function flexiq_load_patterns() {
    $patterns_dir = get_template_directory() . '/patterns/';
    $pattern_files = glob( $patterns_dir . '*.php' );
    
    foreach ( $pattern_files as $file ) {
        $file_data = get_file_data(
            $file,
            array(
                'title'       => 'Title',
                'slug'        => 'Slug',
                'description' => 'Description',
                'categories'  => 'Categories',
            )
        );
        
        if ( empty( $file_data['slug'] ) ) {
            continue;
        }
        
        ob_start();
        include $file;
        $content = ob_get_clean();
        
        // Remove PHP opening tag and header comments
        $content = preg_replace( '/^<\?php.*?\?>\s*/s', '', $content );
        
        $categories = array_map( 'trim', explode( ',', $file_data['categories'] ) );
        
        register_block_pattern(
            $file_data['slug'],
            array(
                'title'       => $file_data['title'],
                'description' => $file_data['description'],
                'categories'  => $categories,
                'content'     => trim( $content ),
            )
        );
    }
}
add_action( 'init', 'flexiq_load_patterns' );

/**
 * Enqueue theme styles
 */
function flexiq_enqueue_styles() {
    wp_enqueue_style( 'flexiq-style', get_stylesheet_uri(), array(), '1.0.0' );
    
    wp_enqueue_style( 
        'flexiq-design-system', 
        get_template_directory_uri() . '/assets/css/design-system.css', 
        array(), 
        '1.0.0' 
    );
    
    wp_enqueue_style( 
        'flexiq-components', 
        get_template_directory_uri() . '/assets/css/components.css', 
        array( 'flexiq-design-system' ), 
        '1.0.0' 
    );
    
    wp_enqueue_style( 
        'flexiq-fonts', 
        get_template_directory_uri() . '/assets/css/fonts.css', 
        array(), 
        '1.0.0' 
    );
}
add_action( 'wp_enqueue_scripts', 'flexiq_enqueue_styles' );

/**
 * Setup theme
 */
function flexiq_theme_setup() {
    add_theme_support( 'editor-styles' );
    add_editor_style( 'style.css' );
    add_editor_style( 'assets/css/design-system.css' );
    add_editor_style( 'assets/css/components.css' );
    add_editor_style( 'assets/css/fonts.css' );
}
add_action( 'after_setup_theme', 'flexiq_theme_setup' );

/**
 * FlexIQ Contact Form Handler
 */
function flexiq_handle_contact_form() {
    if ( ! isset( $_POST['flexiq_contact_submit'] ) ) {
        return;
    }

    // Verify nonce
    if ( ! wp_verify_nonce( $_POST['flexiq_nonce'] ?? '', 'flexiq_contact' ) ) {
        return;
    }

    $arende    = sanitize_text_field( $_POST['arende'] ?? '' );
    $fornamn   = sanitize_text_field( $_POST['fornamn'] ?? '' );
    $efternamn = sanitize_text_field( $_POST['efternamn'] ?? '' );
    $epost     = sanitize_email( $_POST['epost'] ?? '' );
    $meddelande = sanitize_textarea_field( $_POST['meddelande'] ?? '' );

    if ( empty( $fornamn ) || empty( $epost ) ) {
        return;
    }

    $to      = get_option( 'admin_email' );
    $subject = "Nytt meddelande från FlexIQ – $arende";
    $body    = "Ärende: $arende\nNamn: $fornamn $efternamn\nE-post: $epost\n\nMeddelande:\n$meddelande";
    $headers = [ "Reply-To: $epost" ];

    wp_mail( $to, $subject, $body, $headers );

    // Redirect back with success param
    wp_redirect( add_query_arg( 'kontakt', 'skickat', wp_get_referer() ) );
    exit;
}
add_action( 'template_redirect', 'flexiq_handle_contact_form' );

/**
 * Show success message after form submission
 */
function flexiq_form_success_script() {
    if ( isset( $_GET['kontakt'] ) && $_GET['kontakt'] === 'skickat' ) {
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                var el = document.getElementById("flexiq-form-status");
                if (el) {
                    el.textContent = "Tack! Vi återkommer inom kort.";
                    el.className = "flexiq-form-status success";
                    el.style.display = "block";
                    var form = document.querySelector(".flexiq-form");
                    if (form) form.style.display = "none";
                }
            });
        </script>';
    }
}
add_action( 'wp_footer', 'flexiq_form_success_script' );

/**
 * Output theme directory URI for use in templates
 */
function flexiq_theme_vars_script() {
    echo '<script>window.flexiqThemeUri = ' . json_encode(get_template_directory_uri()) . ';</script>';
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        var img = document.getElementById("hero-cityscape-img");
        if (img && window.flexiqThemeUri) {
            img.src = window.flexiqThemeUri + "/assets/images/stockholm-hero.jpg";
        }
    });
    </script>';
}
add_action('wp_head', 'flexiq_theme_vars_script');
