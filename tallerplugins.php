<?php

/**
 * Plugin Name:       My Plugin
 * Plugin URI:        https://alexcuadra.dev
 * Description:       A short description of the plugin.
 * Version:           1.0.0
 * Requires at least: 5.3
 * Requires PHP:      5.6
 * Author:            Alex Cuadra
 * Author URI:        https://example.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       tallerplugins
 */

 // Register the activation hook.
register_activation_hook( __FILE__, 'taller_activate' );

/**
 * funcion de activacion.
 *
 */
function taller_activate() {
    // Add a role.
    add_role( 'taller_admin', 'Taller Admin', array(
        'read' => true,
        'level_10' => true,
        'edit_posts' => true,
        'delete_posts' => true,
        'publish_posts' => true,
        'upload_files' => true,
        'edit_others_posts' => true,
        'delete_others_posts' => true,
        'manage_options' => true,
    ) );
}

/**
 * register deactivation hook
 */

register_deactivation_hook( __FILE__, 'taller_plugin_deactivate' );

/**
 * funcion desactivacion
 */

  function taller_plugin_deactivate() {
    // tu codigo aqui
    remove_role( 'taller_admin' );
  }