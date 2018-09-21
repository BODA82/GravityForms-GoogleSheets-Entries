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
	
	// # FEED SETTINGS -------------------------------------------------------------------------------------------------

	/**
	 * Configures the settings which should be rendered on the feed edit page.
	 *
	 * @since  0.0.1
	 * @access public
	 *
	 * @return array
	 */
	public function feed_settings_fields() {

		return array(
			array(
				'title'  => esc_html__( 'Google Sheets Feed Settings', GFGS_TD ),
				'fields' => array(
					array(
						'name'     => 'feed_name',
						'label'    => esc_html__( 'Google Sheets Feed Name', GFGS_TD ),
						'type'     => 'text',
						'required' => true,
						'class'    => 'medium',
						'tooltip'  => sprintf(
							'<h6>%s</h6>%s',
							esc_html__( 'Feed Name' , GFGS_TD ),
							esc_html__( 'Enter a name for your feed. This is only for personal reference to identify the feed in the settings admin.', GFGS_TD )	
						),
					),
					array(
						'name'     => 'script_url',
						'label'    => esc_html__( 'Google Sheets Script URL', GFGS_TD ),
						'type'     => 'text',
						'required' => true,
						'class'    => 'medium',
						'tooltip'  => sprintf(
							'<h6>%s</h6>%s',
							esc_html__( 'Script URL', 'gravityformsmailchimp' ),
							esc_html__( 'Enter the URL for the location of your Google Sheets script. <a href="#">Click here</a> for more information.', GFGS_TD )
						),
					),
				),
			),
		);

	}
	
	/**
	 * Configures which columns should be displayed on the feed list page.
	 *
	 * @since  0.0.1
	 * @access public
	 *
	 * @return array
	 */
	public function feed_list_columns() {

		return array(
			'feed_name' => esc_html__( 'Name', GFGS_TD )
		);

	}
	
	// # FEED PROCESSING -----------------------------------------------------------------------------------------------

	/**
	 * Process the feed, subscribe the user to the list.
	 *
	 * @since  0.0.1
	 * @access public
	 *
	 * @param array $feed  The feed object to be processed.
	 * @param array $entry The entry object currently being processed.
	 * @param array $form  The form object currently being processed.
	 *
	 * @return array
	 */
	public function process_feed( $feed, $entry, $form ) {

		// Log that we are processing feed.
		$this->log_debug( __METHOD__ . '(): Processing feed.' );

		

		

	}
	
	
	
}