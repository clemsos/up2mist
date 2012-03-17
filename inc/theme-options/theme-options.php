<?php
/**
 * up2mist Theme Options
 *
 * @package up2mist
 * @since up2mist 1.0
 */

/**
 * Register the form setting for our up2mist_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, up2mist_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are complete, properly
 * formatted, and safe.
 *
 * We also use this function to add our theme option if it doesn't already exist.
 *
 * @since up2mist 1.0
 */
function up2mist_theme_options_init() {

	// If we have no options in the database, let's add them now.
	if ( false === up2mist_get_theme_options() )
		add_option( 'up2mist_theme_options', up2mist_get_default_theme_options() );

	register_setting(
		'up2mist_options',       // Options group, see settings_fields() call in up2mist_theme_options_render_page()
		'up2mist_theme_options', // Database option, see up2mist_get_theme_options()
		'up2mist_theme_options_validate' // The sanitization callback, see up2mist_theme_options_validate()
	);

	// Register our settings field group
	add_settings_section(
		'general', // Unique identifier for the settings section
		'', // Section title (we don't want one)
		'__return_false', // Section callback (we don't want anything)
		'theme_options' // Menu slug, used to uniquely identify the page; see up2mist_theme_options_add_page()
	);

	// Register our individual settings fields
	add_settings_field(
		'sample_checkbox', // Unique identifier for the field for this section
		__( 'Sample Checkbox', 'up2mist' ), // Setting field label
		'up2mist_settings_field_sample_checkbox', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see up2mist_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);

	add_settings_field( 'sample_text_input', __( 'Sample Text Input', 'up2mist' ), 'up2mist_settings_field_sample_text_input', 'theme_options', 'general' );
	add_settings_field( 'sample_select_options', __( 'Sample Select Options', 'up2mist' ), 'up2mist_settings_field_sample_select_options', 'theme_options', 'general' );
	add_settings_field( 'sample_radio_buttons', __( 'Sample Radio Buttons', 'up2mist' ), 'up2mist_settings_field_sample_radio_buttons', 'theme_options', 'general' );
	add_settings_field( 'sample_textarea', __( 'Sample Textarea', 'up2mist' ), 'up2mist_settings_field_sample_textarea', 'theme_options', 'general' );
}
add_action( 'admin_init', 'up2mist_theme_options_init' );

/**
 * Change the capability required to save the 'up2mist_options' options group.
 *
 * @see up2mist_theme_options_init() First parameter to register_setting() is the name of the options group.
 * @see up2mist_theme_options_add_page() The edit_theme_options capability is used for viewing the page.
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function up2mist_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_up2mist_options', 'up2mist_option_page_capability' );

/**
 * Add our theme options page to the admin menu.
 *
 * This function is attached to the admin_menu action hook.
 *
 * @since up2mist 1.0
 */
function up2mist_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'up2mist' ),   // Name of page
		__( 'Theme Options', 'up2mist' ),   // Label in menu
		'edit_theme_options',                    // Capability required
		'theme_options',                         // Menu slug, used to uniquely identify the page
		'up2mist_theme_options_render_page' // Function that renders the options page
	);
}
add_action( 'admin_menu', 'up2mist_theme_options_add_page' );

/**
 * Returns an array of sample select options registered for up2mist.
 *
 * @since up2mist 1.0
 */
function up2mist_sample_select_options() {
	$sample_select_options = array(
		'0' => array(
			'value' =>	'0',
			'label' => __( 'Zero', 'up2mist' )
		),
		'1' => array(
			'value' =>	'1',
			'label' => __( 'One', 'up2mist' )
		),
		'2' => array(
			'value' => '2',
			'label' => __( 'Two', 'up2mist' )
		),
		'3' => array(
			'value' => '3',
			'label' => __( 'Three', 'up2mist' )
		),
		'4' => array(
			'value' => '4',
			'label' => __( 'Four', 'up2mist' )
		),
		'5' => array(
			'value' => '3',
			'label' => __( 'Five', 'up2mist' )
		)
	);

	return apply_filters( 'up2mist_sample_select_options', $sample_select_options );
}

/**
 * Returns an array of sample radio options registered for up2mist.
 *
 * @since up2mist 1.0
 */
function up2mist_sample_radio_buttons() {
	$sample_radio_buttons = array(
		'yes' => array(
			'value' => 'yes',
			'label' => __( 'Yes', 'up2mist' )
		),
		'no' => array(
			'value' => 'no',
			'label' => __( 'No', 'up2mist' )
		),
		'maybe' => array(
			'value' => 'maybe',
			'label' => __( 'Maybe', 'up2mist' )
		)
	);

	return apply_filters( 'up2mist_sample_radio_buttons', $sample_radio_buttons );
}

/**
 * Returns the default options for up2mist.
 *
 * @since up2mist 1.0
 */
function up2mist_get_default_theme_options() {
	$default_theme_options = array(
		'sample_checkbox' => 'off',
		'sample_text_input' => '',
		'sample_select_options' => '',
		'sample_radio_buttons' => '',
		'sample_textarea' => '',
	);

	return apply_filters( 'up2mist_default_theme_options', $default_theme_options );
}

/**
 * Returns the options array for up2mist.
 *
 * @since up2mist 1.0
 */
function up2mist_get_theme_options() {
	return get_option( 'up2mist_theme_options', up2mist_get_default_theme_options() );
}

/**
 * Renders the sample checkbox setting field.
 */
function up2mist_settings_field_sample_checkbox() {
	$options = up2mist_get_theme_options();
	?>
	<label for"sample-checkbox">
		<input type="checkbox" name="up2mist_theme_options[sample_checkbox]" id="sample-checkbox" <?php checked( 'on', $options['sample_checkbox'] ); ?> />
		<?php _e( 'A sample checkbox.', 'up2mist' );  ?>
	</label>
	<?php
}

/**
 * Renders the sample text input setting field.
 */
function up2mist_settings_field_sample_text_input() {
	$options = up2mist_get_theme_options();
	?>
	<input type="text" name="up2mist_theme_options[sample_text_input]" id="sample-text-input" value="<?php echo esc_attr( $options['sample_text_input'] ); ?>" />
	<label class="description" for="sample-text-input"><?php _e( 'Sample text input', 'up2mist' ); ?></label>
	<?php
}

/**
 * Renders the sample select options setting field.
 */
function up2mist_settings_field_sample_select_options() {
	$options = up2mist_get_theme_options();
	?>
	<select name="up2mist_theme_options[sample_select_options]" id="sample-select-options">
		<?php
			$selected = $options['sample_select_options'];
			$p = '';
			$r = '';

			foreach ( up2mist_sample_select_options() as $option ) {
				$label = $option['label'];
				if ( $selected == $option['value'] ) // Make default first in list
					$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
				else
					$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
			}
			echo $p . $r;
		?>
	</select>
	<label class="description" for="sample_theme_options[selectinput]"><?php _e( 'Sample select input', 'up2mist' ); ?></label>
	<?php
}

/**
 * Renders the radio options setting field.
 *
 * @since up2mist 1.0
 */
function up2mist_settings_field_sample_radio_buttons() {
	$options = up2mist_get_theme_options();

	foreach ( up2mist_sample_radio_buttons() as $button ) {
	?>
	<div class="layout">
		<label class="description">
			<input type="radio" name="up2mist_theme_options[sample_radio_buttons]" value="<?php echo esc_attr( $button['value'] ); ?>" <?php checked( $options['sample_radio_buttons'], $button['value'] ); ?> />
			<?php echo $button['label']; ?>
		</label>
	</div>
	<?php
	}
}

/**
 * Renders the sample textarea setting field.
 */
function up2mist_settings_field_sample_textarea() {
	$options = up2mist_get_theme_options();
	?>
	<textarea class="large-text" type="text" name="up2mist_theme_options[sample_textarea]" id="sample-textarea" cols="50" rows="10" /><?php echo esc_textarea( $options['sample_textarea'] ); ?></textarea>
	<label class="description" for="sample-textarea"><?php _e( 'Sample textarea', 'up2mist' ); ?></label>
	<?php
}

/**
 * Returns the options array for up2mist.
 *
 * @since up2mist 1.0
 */
function up2mist_theme_options_render_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php printf( __( '%s Theme Options', 'up2mist' ), get_current_theme() ); ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'up2mist_options' );
				do_settings_sections( 'theme_options' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate form input. Accepts an array, return a sanitized array.
 *
 * @see up2mist_theme_options_init()
 * @todo set up Reset Options action
 *
 * @since up2mist 1.0
 */
function up2mist_theme_options_validate( $input ) {
	$output = $defaults = up2mist_get_default_theme_options();

	// The sample checkbox should either be on or off
	if ( ! isset( $input['sample_checkbox'] ) )
		$input['sample_checkbox'] = 'off';
	$output['sample_checkbox'] = ( $input['sample_checkbox'] == 'on' ? 'on' : 'off' );

	// The sample text input must be safe text with no HTML tags
	if ( isset( $input['sample_text_input'] ) )
		$output['sample_text_input'] = wp_filter_nohtml_kses( $input['sample_text_input'] );

	// The sample select option must actually be in the array of select options
	if ( array_key_exists( $input['sample_select_options'], up2mist_sample_select_options() ) )
		$output['sample_select_options'] = $input['sample_select_options'];

	// The sample radio button value must be in our array of radio button values
	if ( isset( $input['sample_radio_buttons'] ) && array_key_exists( $input['sample_radio_buttons'], up2mist_sample_radio_buttons() ) )
		$output['sample_radio_buttons'] = $input['sample_radio_buttons'];

	// The sample textarea must be safe text with the allowed tags for posts
	if ( isset( $input['sample_textarea'] ) )
		$output['sample_textarea'] = wp_filter_post_kses($input['sample_textarea'] );

	return apply_filters( 'up2mist_theme_options_validate', $output, $input, $defaults );
}
