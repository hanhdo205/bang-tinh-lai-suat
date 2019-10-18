<?php
/*
  Plugin Name: Bảng tính lãi suất
  Plugin URI: https://hanhdo.info
  Description: Bảng tính trả góp hằng tháng. Sử dụng shortcode [laisuat] để hiện bảng tính trong giao diện.
  Author: Nguyen Quoc Hanh
  Version: 1.0.1
  Author URI: https://facebook.com/hanhdo205
*/

require_once (__DIR__ . '/form.php');

function laisuat_load_plugin_textdomain() {
    load_plugin_textdomain('laisuat', FALSE, plugin_basename(dirname(__FILE__)) . '/languages/');
}

add_action('plugins_loaded', 'laisuat_load_plugin_textdomain');

function laisuat_reg_scripts() {

  wp_register_style( 'laisuat-css', plugin_dir_url( __FILE__) . 'css/laisuat.css' );
  wp_enqueue_style( 'laisuat-css' );

  wp_enqueue_script( 'laisuat-script', plugin_dir_url( __FILE__) . 'js/laisuat.js', array ( 'jquery' ), '03122017', true);
  wp_localize_script( 'laisuat-script', 'ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action('wp_enqueue_scripts', 'laisuat_reg_scripts');

// Admin sub-menu
add_action('admin_init', 'laisuat_admin_init');
add_action('admin_menu','laisuat_add_page');

// White list our options using the Settings API
function laisuat_admin_init() {
    register_setting('laisuat_options', 'laisuat');
}

// Add entry in the settings menu
function laisuat_add_page() {
    add_options_page('Laisuat  Options', 'Laisuat Options', 'manage_options', 'laisuat_options', 'laisuat_options_do_page');
}

// Print the menu page itself
function laisuat_options_do_page() {
    $options = get_option('laisuat');
    ?>
    <div class="wrap">
        <h2>Công thức</h2>
        <form method="post" action="options.php">
            <?php settings_fields('laisuat_options'); ?>
            <table class="form-table">
                <tr valign="top">
                  <th scope="row">Dư nợ thực tế:</th>
                    <td><input type="text" name="laisuat[basic_rate]" value="<?php echo ($options['basic_rate']) ? $options['basic_rate'] : '(G*LS/365*N)'; ?>" /><br>
                      <em>(G*LS/365*N) - G: nợ gốc, LS: lãi suất, N: số ngày trong tháng</em></td>
                </tr>
            </table>
            <p class="submit">
                <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
            </p>
        </form>
    </div>
    <?php
}