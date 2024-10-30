<?php
/**
 * Plugin Name: MaxtradeTextToPost
 * Plugin URI: http://software.avalonbg.com/maxtrade-text-to-post
 * Description: Add text to each post in WordPress.
 * Version: 1.0.1
 * Author: Ilko Ivanov
 * Author URI: http://software.avalonbg.com/ilko
 * Text Domain: mtptextdomain
 * Domain Path: /languages
 * Network: Optional. Whether the plugin can only be activated network wide. Example: true
 * License: MIT
 */

 /**
  *  Copyright 2015 Ilko Ivanov (email: ilko.iv at gmail.com)
  *
  *  This program is free software; you can redistribute it and/or modify
  *  it under the terms of the GNU General Public License as published by
  *  the Free Software Foundation; either version 2 of the License, or
  *  (at your option) any later version.
  *
  *  This program is distributed in the hope that it will be useful,
  *  but WITHOUT ANY WARRANTY; without even the implied warranty of
  *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  *  GNU General Public License for more details.
  *
  *  You should have received a copy of the GNU General Public License
  *  along with this program; if not, write to the Free Software
  *  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

/** definitions */
define( 'MTP_PLUGIN_DIR', untrailingslashit( dirname( __FILE__ ) ) );
define( 'MTP_INCLUDES_DIR', MTP_PLUGIN_DIR . '/includes' );
define( 'MTP_IMAGES_URI', MTP_PLUGIN_DIR . '/images' );
define( 'MTP_CSS_URI', MTP_PLUGIN_DIR . '/css' );
define( 'MTP_JS_URI', MTP_PLUGIN_DIR . '/js' );

/** load textdomain */
add_action( 'plugins_loaded', 'mtp_load_textdomain' );

function mtp_load_textdomain() {
  load_plugin_textdomain( 'mtptextdomain', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

/** add admin menu MaxtradeTextToPost options page ###includes/admin.php### */
add_action('admin_menu', 'mtp_admin_actions');

/** add admin menu */
function mtp_admin_actions() {
    add_options_page(__( 'MaxtradeTextToPost options page', 'mtptextdomain' ), __( 'MTP Options', 'mtptextdomain' ), 1, "mtp-options", "mtp_admin_options");
}

/** load admin menu */
function mtp_admin_options() {
    include('mtp_import_admin.php');
}

/** add some text to each post **/
add_filter ('the_content', 'insertSubscribeNewsLetter');

/** add some text to each post **/
function insertSubscribeNewsLetter($content) {
  if(is_single()) {
    if (get_option('mtp_show_categories') == 'on'){
      $content_cat .= '<div class="cat" style="display:none" >';
      $cats = get_the_category();
      foreach ($cats as $cat) {
        $content_cat .= $cat->cat_name . ' - ';
      }
      $content_cat .= '</div>';
      $content = $content_cat . $content;
    }
    $content_add = get_option('mtp_text_to_show');
    if (get_option('mtp_where_to_show') == 'In the begining'){
      $content = $content_add . $content;
    }else{
      $content .= $content_add;
    }
  }
  //$content .= ' - xdfgdfg' . get_option('mtp_show_categories');
  return $content;
}
