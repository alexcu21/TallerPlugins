<?php  

/**
   * Metodo Unistall
   */

   if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    wp_die( sprintf(
         __( '%s se invocara cuando se desinstale el plugin.', 'taller' ),
         __FILE__
    ) );
    exit;
}

$role = get_role( 'administrator' );

if ( ! empty( $role ) ) {
    $role->remove_cap( 'taller_manage' );
}
