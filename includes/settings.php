<?php 
// Create a function to add a management page for the plugin
function taller_add_plugin_management_page() {
    // Add a menu item under "Settings" menu in the WP admin panel
    add_options_page(
      'Pagina de administracion del plugin', // Page title
      'Configuracion Taller', // Menu title
      'manage_options', // Capability required to access the page
      'taller_plugin_settings', // Page slug
      'taller_render_plugin_settings_page' // Callback function to render the settings page
    );
  }
  add_action( 'admin_menu', 'taller_add_plugin_management_page' );
  
  // Create a function to render the settings page
  function taller_render_plugin_settings_page() {
    // Get the current value of the API token setting
    $api_token = get_option( 'taller_api_token', '' );
    ?>
    <div class="wrap">
      <h1>Plugin Management Page</h1>
      <form method="post" action="options.php">
        <?php settings_fields( 'taller_plugin_settings_group' ); ?> 
        <?php do_settings_sections( 'taller_plugin_settings' ); ?>
        <table class="form-table">
          <tr valign="top">
            <th scope="row">API Token</th>
            <td>
              <input type="text" name="taller_api_token" value="<?php echo esc_attr( $api_token ); ?>">
            </td>
          </tr>
        </table>
        <?php submit_button('guardar cambios'); ?>
      </form>
    </div>
    <?php
  }
  
  // Create a function to register the setting
  function taller_register_plugin_settings() {
    // Register the setting with WordPress
    register_setting(
      'taller_plugin_settings_group', // Setting group name
      'taller_api_token' // Setting name
    );
  }
  add_action( 'admin_init', 'taller_register_plugin_settings' );