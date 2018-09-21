<?php
	
GFForms::include_feed_addon_framework();

/**
 * Gravity Forms - Google Sheets Entries Add-On.
 */
class GFGSEntries extends GFFeedAddOn {
	
	private static $_instance = null;
	protected $_version = GFGS_VERSION;
	protected $_min_gravityforms_version = '1.9.12';
	protected $_slug = 'gsentries';
	protected $_path = 'gravityforms-googlesheets-entries/googlesheets-entries.php';
	protected $_full_path = __FILE__;
	protected $_url = 'https://github.com/BODA82/gravityforms-googlesheets-entries';
	protected $_title = 'Gravity Forms - Google Sheets Entries Add-On';
	protected $_short_title = 'Google Sheets';
	protected $_enable_rg_autoupgrade = false;
	protected $_capabilities = array('gfgsentries', 'gfgsentries_uninstall');
	protected $_capabilities_settings_page = 'gfgsentries';
	protected $_capabilities_form_settings = 'gfgsentries';
	protected $_capabilities_uninstall = 'gfgsentries_uninstall';
	protected $merge_var_name = '';
	private $api = null;
	
	public static function get_instance() {

		if ( null === self::$_instance ) {
			self::$_instance = new self;
		}

		return self::$_instance;

	}

	public function init() {
		
		parent::init();
		add_filter( 'gform_submit_button', array( $this, 'form_submit_button' ), 10, 2 );
		
	}
	
	public function uninstall() {

		parent::uninstall();

		GFCache::delete( 'gfgs_plugin_settings' );
		delete_option( 'gfgs_settings' );
		delete_option( 'gfgs_version' );

	}
	
	
	
	
	
}