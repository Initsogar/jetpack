<?php

$current_dir = dirname( __FILE__ );

define( 'THEMES_PATH_BASE', '/home/mendezco/wordpress/themes' ); // TODO: DELETE AFTER TESTING
define( 'THEMES_SYMLINK_BASE', THEMES_PATH_BASE ); // TODO: DELETE AFTER TESTING

// Base paths containing the location of WP.com and storefront themes, defined in Pressable.
if ( ! defined( 'THEMES_SYMLINK_BASE' ) || ! defined( 'THEMES_PATH_BASE' ) ) {
	define( 'THEMES_SYMLINK_BASE', $current_dir );
	define( 'THEMES_PATH_BASE', $current_dir );
}

define( 'WPCOMSH_PUB_THEMES_PATH', THEMES_PATH_BASE . '/pub' );
define( 'WPCOMSH_PREMIUM_THEMES_PATH', THEMES_PATH_BASE . '/premium' );
define( 'WPCOMSH_STOREFRONT_THEMES_PATH', THEMES_PATH_BASE . '/woo-all-themes' );
define( 'WPCOMSH_STOREFRONT_PATH', THEMES_PATH_BASE . '/storefront' );

define( 'WPCOMSH_PUB_THEMES_SYMLINK', THEMES_SYMLINK_BASE . '/pub' );
define( 'WPCOMSH_PREMIUM_THEMES_SYMLINK', THEMES_SYMLINK_BASE . '/premium' );
define( 'WPCOMSH_STOREFRONT_THEMES_SYMLINK', THEMES_SYMLINK_BASE . '/woo-all-themes' );
define( 'WPCOMSH_STOREFRONT_SYMLINK', THEMES_SYMLINK_BASE . '/storefront' );

define( 'WPCOMSH_PUB_THEME_TYPE', 'wpcom_pub_theme_type' );
define( 'WPCOMSH_PREMIUM_THEME_TYPE', 'wpcom_premium_theme_type' );
define( 'WPCOMSH_STOREFRONT_THEME_TYPE', 'wpcom_storefront_theme_type' );
define( 'WPCOMSH_NON_WPCOM_THEME', 'non_wpcom_theme' );

define( 'WPCOMSH_PLAN_FREE', 'free' );
define( 'WPCOMSH_PLAN_PREMIUM', 'premium' );
define( 'WPCOMSH_PLAN_BUSINESS', 'business' );
