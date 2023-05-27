<?php
/**
 * Agregando menu de configuracion
 */

 add_action( 'admin_menu', 'taller_crear_menu' );
             
function taller_crear_menu() {
             
    //crea menu de nivel superior
    add_menu_page( 'Pagina de configuracion taller','Configuracion', 'manage_options', 'taller-options', 'taller_settings_page','dashicons-smiley', 99 );

    //crea sub menus
    add_submenu_page( 'taller-options', 'Acerca del Plugin', 'Acerca','manage_options', 'taller-about', 'taller_about_page' );
    add_submenu_page( 'taller-options', 'Ayuda del Plugin', 'Ayuda', 'manage_options', 'taller-help', 'taller_help_page' );
    add_submenu_page( 'taller-options', 'Desinstalar el Plugin', 'Desinstalar', 'manage_options', 'taller-uninstall', 'taller_uninstall_page' );


}

/**
 * crea submenu en menu de configuracion
 */

 add_action( 'admin_menu', 'taller_create_submenu' );
             
function taller_create_submenu() {
 
    //create a submenu under Settings
    add_options_page( 'Configuracion de plugin taller', 'Configuracion Taller', 'manage_options',
        'taller_plugin', 'taller_plugin_option_page' );

}
