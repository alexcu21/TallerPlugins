<?php

/**
 * Plugin Name:       My Plugin
 * Plugin URI:        https://tallercuadra.dev
 * Description:       A short description of the plugin.
 * Version:           1.0.0
 * Requires at least: 5.3
 * Requires PHP:      5.6
 * Author:            Taller Cuadra
 * Author URI:        https://example.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       tallerplugins
 */

 // agregando metodo de desinstalacion
 //require_once 'uninstall.php';

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
    
  }

  /**
   * Metodo Unistall
   */

   register_uninstall_hook( __FILE__, 'taller_uninstall' );
 
    function taller_uninstall() {
        remove_role( 'taller_admin' );
    }


require_once 'includes/menus.php';

require_once 'includes/settings.php';

echo var_dump(get_option( 'taller_api_token', '' ));

/**
 * creando el shortcode
 */

 function taller_weather_shortcode($atts){

    $a = shortcode_atts( array(
		'cityname' => $cityname
	), $atts );

    echo var_dump($a);

    //API variables
    $url = 'https://api.openweathermap.org/data/2.5/weather';
    $apiKey = get_option( 'taller_api_token', '' );

    $fullUrl = $url . '?q=' . $a['cityname'] . '&appid=' . $apiKey;
    $response = wp_remote_get($fullUrl);

   
    if (is_wp_error($response)) {
		error_log("Error: ". $response->get_error_message());
		return false;
	}

    if ($cityname !== ''){

    $body = wp_remote_retrieve_body($response);

	$data = json_decode($body);

       
   $city = $data->name;
   $temp = $data->main->temp;
   $cityweather = $data->weather[0]->description;
   $hummidity = $data->main->humidity;
   $speed = $data->wind->speed;
   $weatherIcon = $data->weather[0]->icon;

  
   ob_start();
    ?>
        <section class="weather-card">
            <div class="main-weather">
                <div class="city">
                    <h3><?php echo esc_html( $city );?></h3>
                    <p> <?php echo esc_html( $cityweather );?></p>
                </div>
                <div class="weather-icon">
                    <img src="http://openweathermap.org/img/wn/<?php echo $weatherIcon ?>@2x.png" />
                </div>
            </div>
            
            <div class="temp-info">
                <p class="temp"> <span><?php echo esc_html( $temp )?></span> F </p>         
                <div class="humidity">
                    <img src="<?php echo plugin_dir_url(__FILE__) . 'assets/humidity.png'  ?>"/>
                    <p><?php echo esc_html($hummidity ) . ' ' . '%'; ?></p>
                </div>
               <div class="wind">
                    <img src="<?php echo plugin_dir_url(__FILE__) . 'assets/wind.png'  ?>"/>
                    <p><?php echo esc_html($speed ) . ' ' . 'mi/h'; ?></p>
               </div>
            </div>
        </section>


    <?php

   return ob_get_clean();
   }

}

add_shortcode('weather','taller_weather_shortcode' );