<?php

if ( class_exists( 'RyanCVPlugin' ) && class_exists( 'OCDI_Plugin' ) ) {

function ryancv_ocdi_import_files() {
    $extra_dir = ryancv_extra_dir();
    if ( $extra_dir == 'normal' ) : return array(); endif;

    return array(
        array(
            'import_file_name'             => 'default',
            'categories'                   => array( esc_attr__( 'Main', 'ryancv' ) ),
            'import_file_url'            => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/default/content.xml',
            'import_preview_image_url'     => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/default/preview.jpg',
            'preview_url'                  => 'https://1.envato.market/c/1790164/275988/4415?u=https://themeforest.net/item/ryancv-vcard-resume-wordpress-theme/full_screen_preview/22890097',
        ),

        array(
            'import_file_name'             => 'designer-2',
            'categories'                   => array( esc_attr__( 'Main', 'ryancv' ) ),
            'import_file_url'              => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/designer-2/content.xml',
            'import_preview_image_url'     => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/designer-2/preview.jpg',
            'preview_url'                  => 'https://1.envato.market/c/1790164/275988/4415?u=https://themeforest.net/item/ryancv-vcard-resume-wordpress-theme/full_screen_preview/22890097',
        ),

        array(
            'import_file_name'             => 'cyberpunk',
            'categories'                   => array( esc_attr__( 'Main', 'ryancv' ) ),
            'import_file_url'            => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/cyberpunk/content.xml',
            'import_preview_image_url'     => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/cyberpunk/preview.jpg',
            'preview_url'                  => 'https://1.envato.market/c/1790164/275988/4415?u=https://themeforest.net/item/ryancv-vcard-resume-wordpress-theme/full_screen_preview/22890097',
        ),

        array(
            'import_file_name'             => 'digital-2',
            'categories'                   => array( esc_attr__( 'Main', 'ryancv' ) ),
            'import_file_url'            => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/digital-2/content.xml',
            'import_preview_image_url'     => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/digital-2/preview.jpg',
            'preview_url'                  => 'https://1.envato.market/c/1790164/275988/4415?u=https://themeforest.net/item/ryancv-vcard-resume-wordpress-theme/full_screen_preview/22890097',
        ),

        array(
            'import_file_name'             => 'digital',
            'categories'                   => array( esc_attr__( 'Main', 'ryancv' ) ),
            'import_file_url'            => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/digital/content.xml',
            'import_preview_image_url'     => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/digital/preview.jpg',
            'preview_url'                  => 'https://1.envato.market/c/1790164/275988/4415?u=https://themeforest.net/item/ryancv-vcard-resume-wordpress-theme/full_screen_preview/22890097',
        ),

        array(
            'import_file_name'             => 'developer',
            'categories'                   => array( esc_attr__( 'Main', 'ryancv' ) ),
            'import_file_url'            => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/developer/content.xml',
            'import_preview_image_url'     => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/developer/preview.jpg',
            'preview_url'                  => 'https://1.envato.market/c/1790164/275988/4415?u=https://themeforest.net/item/ryancv-vcard-resume-wordpress-theme/full_screen_preview/22890097',
        ),

        array(
            'import_file_name'             => 'designer',
            'categories'                   => array( esc_attr__( 'Main', 'ryancv' ) ),
            'import_file_url'            => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/designer/content.xml',
            'import_preview_image_url'     => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/designer/preview.jpg',
            'preview_url'                  => 'https://1.envato.market/c/1790164/275988/4415?u=https://themeforest.net/item/ryancv-vcard-resume-wordpress-theme/full_screen_preview/22890097',
        ),

        array(
            'import_file_name'             => 'marketing',
            'categories'                   => array( esc_attr__( 'Main', 'ryancv' ) ),
            'import_file_url'            => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/marketing/content.xml',
            'import_preview_image_url'     => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/marketing/preview.jpg',
            'preview_url'                  => 'https://1.envato.market/c/1790164/275988/4415?u=https://themeforest.net/item/ryancv-vcard-resume-wordpress-theme/full_screen_preview/22890097',
        ),

        array(
            'import_file_name'             => 'sysadmin',
            'categories'                   => array( esc_attr__( 'Main', 'ryancv' ) ),
            'import_file_url'            => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/sysadmin/content.xml',
            'import_preview_image_url'     => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/sysadmin/preview.jpg',
            'preview_url'                  => 'https://1.envato.market/c/1790164/275988/4415?u=https://themeforest.net/item/ryancv-vcard-resume-wordpress-theme/full_screen_preview/22890097',
        ),

        array(
            'import_file_name'             => 'business',
            'categories'                   => array( esc_attr__( 'Main', 'ryancv' ) ),
            'import_file_url'            => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/business/content.xml',
            'import_preview_image_url'     => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/business/preview.jpg',
            'preview_url'                  => 'https://1.envato.market/c/1790164/275988/4415?u=https://themeforest.net/item/ryancv-vcard-resume-wordpress-theme/full_screen_preview/22890097',
        ),

        array(
            'import_file_name'             => 'crypto',
            'categories'                   => array( esc_attr__( 'Main', 'ryancv' ) ),
            'import_file_url'            => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/crypto/content.xml',
            'import_preview_image_url'     => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/crypto/preview.jpg',
            'preview_url'                  => 'https://1.envato.market/c/1790164/275988/4415?u=https://themeforest.net/item/ryancv-vcard-resume-wordpress-theme/full_screen_preview/22890097',
        ),

        array(
            'import_file_name'             => 'streamer',
            'categories'                   => array( esc_attr__( 'Main', 'ryancv' ) ),
            'import_file_url'            => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/streamer/content.xml',
            'import_preview_image_url'     => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/streamer/preview.jpg',
            'preview_url'                  => 'https://1.envato.market/c/1790164/275988/4415?u=https://themeforest.net/item/ryancv-vcard-resume-wordpress-theme/full_screen_preview/22890097',
        ),

        array(
            'import_file_name'             => 'writer',
            'categories'                   => array( esc_attr__( 'Main', 'ryancv' ) ),
            'import_file_url'            => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/writer/content.xml',
            'import_preview_image_url'     => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/writer/preview.jpg',
            'preview_url'                  => 'https://1.envato.market/c/1790164/275988/4415?u=https://themeforest.net/item/ryancv-vcard-resume-wordpress-theme/full_screen_preview/22890097',
        ),

        array(
            'import_file_name'             => 'lawyer',
            'categories'                   => array( esc_attr__( 'Main', 'ryancv' ) ),
            'import_file_url'            => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/lawyer/content.xml',
            'import_preview_image_url'     => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/lawyer/preview.jpg',
            'preview_url'                  => 'https://1.envato.market/c/1790164/275988/4415?u=https://themeforest.net/item/ryancv-vcard-resume-wordpress-theme/full_screen_preview/22890097',
        ),

        array(
            'import_file_name'             => 'dark',
            'categories'                   => array( esc_attr__( 'Main', 'ryancv' ) ),
            'import_file_url'            => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/dark/content.xml',
            'import_preview_image_url'     => RYANCV_EXTRA_PLUGINS_DIRECTORY . $extra_dir . '/ocdi-import/demo/dark/preview.jpg',
            'preview_url'                  => 'https://1.envato.market/c/1790164/275988/4415?u=https://themeforest.net/item/ryancv-vcard-resume-wordpress-theme/full_screen_preview/22890097',
        ),

    );
}
add_filter( 'pt-ocdi/import_files', 'ryancv_ocdi_import_files' );

function ryancv_ocdi_after_import_setup( $selected_import ) {
    if ( ryancv_extra_dir() == 'normal' ) : return; endif;

    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
    $index_url = get_home_url();
    $contacts_url = $index_url . '#contact';

    set_theme_mod( 'nav_menu_locations', array(
            'primary' => $main_menu->term_id,
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );
    if ( !empty( $front_page_id ) ) {
      update_option( 'show_on_front', 'page' );
      update_option( 'page_on_front', $front_page_id->ID );
    }
    update_option( 'posts_per_page', 4 );

    $acf_options = array();

    if( $selected_import['import_file_name'] ) {
      $json = file_get_contents( plugin_dir_path( __FILE__ ) . 'acf-options/' . $selected_import['import_file_name'] . '.json' );
      $json_obj = json_decode( $json, true );
      if ( isset( $json_obj['data'] ) ) {
        $acf_options = $json_obj['data'];
      }
    }
    if ( !empty( $acf_options ) ) {
      global $wpdb;
      foreach ( $acf_options as $item ) {
        if ( $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wpdb->options WHERE option_name = %s", $item['option_name'] ) ) == 0 ) {
            $wpdb->query( $wpdb->prepare( "INSERT INTO $wpdb->options ( option_name, option_value, autoload ) VALUES (%s, %s, 'no')", $item['option_name'], $item['option_value'] ) );
        } else {
            $wpdb->query( $wpdb->prepare( "UPDATE $wpdb->options SET option_value = %s WHERE option_name = %s", $item['option_value'], $item['option_name'] ) );
        }
      }
    }

}
add_action( 'pt-ocdi/after_import', 'ryancv_ocdi_after_import_setup' );

}
