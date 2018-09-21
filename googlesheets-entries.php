<?php
/*
Plugin Name:  Gravity Forms - Google Sheets Entries
Plugin URI:   https://github.com/BODA82/gravityforms-googlesheets-entries
Description:  WordPress/Gravity Forms plugin that stores Gravity Forms submissions in a Google Spreadsheet.
Version:      0.0.1
Author:       42 Web
Author URI:   https://www.fourtwoweb.com
License:      GPL3
License URI:  https://www.gnu.org/licenses/gpl-3.0.en.html
Text Domain:  gfgsentries

Gravity Forms - Google Sheets Entries is free software: you can redistribute 
it and/or modify it under the terms of the GNU General Public License as 
published by the Free Software Foundation, either version 2 of the 
License, or any later version.
 
Gravity Forms - Google Sheets Entries is distributed in the hope that it will 
be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of 
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General 
Public License for more details.
 
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
*/

define( 'GFGS_VERSION', '0.0.1' );
define( 'GFGS_TD', 'gfgsentries' );

// If Gravity Forms is loaded, bootstrap this plugin.
add_action( 'gform_loaded', array( 'GFGS_Bootstrap', 'load' ), 5 );

/**
 * Class GF_MailChimp_Bootstrap
 *
 * Handles the loading of the Mailchimp Add-On and registers with the Add-On Framework.
 */
class GFGS_Bootstrap {

	/**
	 * If the Add-On Framework exists, Google Sheets Add-On is loaded.
	 *
	 * @access public
	 * @static
	 */
	public static function load() {

		if ( ! method_exists( 'GFForms', 'include_feed_addon_framework' ) ) {
			return;
		}

		require_once( 'class-gf-gsentries.php' );

		GFAddOn::register( 'GFGSEntries' );
	}
}

/**
 * Returns an instance of the GFGSEntries class
 *
 * @see    GFGSEntries::get_instance()
 *
 * @return object GFGSEntries
 */
function gf_gsentries() {
	return GFGSEntries::get_instance();
}