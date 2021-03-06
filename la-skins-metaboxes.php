<?php
/**
 * @package LA_Skins_Metaboxes
 * @version 1
 */
/*
Plugin Name: LA Skins Metaboxes
Plugin URI: 
Description: Adding metaboxes for various post types using CMB2. Requires CMB2 Plugin, or the CMB2 theme folder.
Author: Matthew Stumphy
Version: 1
Author URI: http://www.gurustump.com
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


add_action( 'cmb2_init', 'laskins_register_festival_page_metabox' );

function laskins_register_festival_page_metabox() {
	$prefix = '_laskins_festival_page_';
	
	$cmb_festival_page_box = new_cmb2_box( array(
		'id'            => $prefix . 'custom_index_metabox',
		'title'         => __( 'Festival Page Options', 'cmb2' ),
		'object_types'  => array( 'page', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

	$cmb_festival_page_box->add_field( array(
		'name' => __( 'Festival Year', 'cmb2' ),
		'desc' => __( "Enter the year the associated festival is taking place.", 'cmb2' ),
		'id'   => $prefix . 'year',
		'type' => 'text_small',
		// 'repeatable' => true,
	) );
}

add_action( 'cmb2_init', 'laskins_register_festival_archive_metabox' );

function laskins_register_festival_archive_metabox() {
	$prefix = '_laskins_festival_archive_';
	
	$cmb_festival_archive_box = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Festival Archive Options', 'cmb2' ),
		'object_types'  => array( 'page', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

	$cmb_festival_archive_box->add_field( array(
		'name'             => __( 'Festival Type', 'cmb2' ),
		'desc'             => __( 'Select the type of festival that will be listed on this archive page', 'cmb2' ),
		'id'               => $prefix . 'type',
		'type'             => 'select',
		'show_option_none' => false,
		'options'          => array(
			'film-festival' => __( 'Film Festival', 'cmb2' ),
			'music-festival'   => __( 'Music Festival', 'cmb2' ),
		),
	) );
}

add_action( 'cmb2_init', 'laskins_register_media_item_metabox' );

function laskins_register_media_item_metabox() {
	$prefix = '_laskins_media_item_';
	
	$cmb_media_item_box = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Movie Information - All fields are optional', 'cmb2' ),
		'object_types'  => array( 'media_items', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

	$cmb_media_item_box->add_field( array(
		'name'		=> __( 'Video Link', 'cmb2' ),
		'desc' => __( 'Upload/Select a video or enter a URL', 'cmb2' ),
		'id'			=> $prefix . 'video_link',
		'type'		=> 'file',
	) );

	$cmb_media_item_box->add_field( array(
		'name'		=> __( 'Director', 'cmb2' ),
		'id'			=> $prefix . 'director',
		'type'		=> 'text',
	) );

	$cmb_media_item_box->add_field( array(
		'name'		=> __( 'Producer', 'cmb2' ),
		'id' 			=> $prefix . 'producer',
		'type'		=> 'text',
	) );

	$cmb_media_item_box->add_field( array(
		'name'		=> __( 'Writer', 'cmb2' ),
		'id' 			=> $prefix . 'writer',
		'type'		=> 'text',
	) );

	/*$cmb_media_item_box->add_field( array(
		'name'		=> __( 'Cast', 'cmb2' ),
		'desc'       => __( 'Enter the names of the actors here', 'cmb2' ),
		'id' 			=> $prefix . 'cast',
		'type'		=> 'textarea_small',
	) );*/
	
	$cast_group_field_id = $cmb_media_item_box->add_field( array(
		'id'          => $prefix . 'cast',
		'type'        => 'group',
		'description' => __( 'Add cast members', 'cmb2' ),
		'options'     => array(
			'group_title'   => __( 'Cast Member {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Cast Member', 'cmb2' ),
			'remove_button' => __( 'Remove Cast Member', 'cmb2' ),
			'sortable'      => true, // beta
		),
	) );
	$cmb_media_item_box->add_group_field( $cast_group_field_id, array(
		'name'       => __( 'Character', 'cmb2' ),
		'id'         => 'character',
		'type'       => 'text',
	) );
	$cmb_media_item_box->add_group_field( $cast_group_field_id, array(
		'name'       => __( 'Castmember Name', 'cmb2' ),
		'id'         => 'name',
		'type'       => 'text',
		//'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );
	
	$crew_group_field_id = $cmb_media_item_box->add_field( array(
		'id'          => $prefix . 'other_crew',
		'type'        => 'group',
		'description' => __( 'Add other crew positions', 'cmb2' ),
		'options'     => array(
			'group_title'   => __( 'Crew Position {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Crew Member', 'cmb2' ),
			'remove_button' => __( 'Remove Crew Member', 'cmb2' ),
			'sortable'      => true, // beta
		),
	) );
	$cmb_media_item_box->add_group_field( $crew_group_field_id, array(
		'name'       => __( 'Crew Position Title', 'cmb2' ),
		'id'         => 'title',
		'type'       => 'text',
	) );
	$cmb_media_item_box->add_group_field( $crew_group_field_id, array(
		'name'       => __( 'Crewmember Name', 'cmb2' ),
		'id'         => 'name',
		'type'       => 'text',
		'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );

	$cmb_media_item_box->add_field( array(
		'name'		=> __( 'Duration', 'cmb2' ),
		'desc'       => __( 'Enter the duration in minutes. Do not include the word "min" or "minutes." It will be added automatically.', 'cmb2' ),
		'id' 			=> $prefix . 'duration',
		'type'		=> 'text_small',
	) );

	$cmb_media_item_box->add_field( array(
		'name'		=> __( 'Country', 'cmb2' ),
		'id' 			=> $prefix . 'country',
		'type'		=> 'text',
	) );

	$cmb_media_item_box->add_field( array(
		'name'		=> __( 'Age Restriction', 'cmb2' ),
		'id' 			=> $prefix . 'age_restriction',
		'type'		=> 'text_small',
	) );

	$cmb_media_item_box->add_field( array(
		'name' => __( 'IMDb URL', 'cmb2' ),
		'desc' => __( 'Enter the URL of the IMDb page for this film', 'cmb2' ),
		'id'   => $prefix . 'imdb_url',
		'type' => 'text_url',
		'protocols' => array('http', 'https'), // Array of allowed protocols
	) );

	$cmb_media_item_box->add_field( array(
		'name' => __( 'Link to film on the web', 'cmb2' ),
		'desc' => __( 'Enter the URL of where the movie can be viewed on the internet', 'cmb2' ),
		'id'   => $prefix . 'view_url',
		'type' => 'text_url',
		'protocols' => array('http', 'https'), // Array of allowed protocols
	) );

}

add_action( 'cmb2_init', 'laskins_register_ad_space_metabox' );

function laskins_register_ad_space_metabox() {
	$prefix = '_laskins_ad_space_';
	
	$cmb_ad_space_box = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Ad Space Information', 'cmb2' ),
		'object_types'  => array( 'ad_spaces', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

	$cmb_ad_space_box->add_field( array(
		'name'		=> __( 'Width', 'cmb2' ),
		'desc'       => __( 'Enter the pixel width of the ad space', 'cmb2' ),
		'id' 			=> $prefix . 'width',
		'type'		=> 'text_small',
	) );

	$cmb_ad_space_box->add_field( array(
		'name'		=> __( 'Height', 'cmb2' ),
		'desc'       => __( 'Enter the pixel height of the ad space', 'cmb2' ),
		'id' 			=> $prefix . 'height',
		'type'		=> 'text_small',
	) );
	
	$group_field_id = $cmb_ad_space_box->add_field( array(
		'id'          => $prefix . 'group',
		'type'        => 'group',
		'description' => __( 'Generates multiple ads in this size', 'cmb2' ),
		'options'     => array(
			'group_title'   => __( 'Ad #{#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Ad', 'cmb2' ),
			'remove_button' => __( 'Remove Ad', 'cmb2' ),
			'sortable'      => true, // beta
		),
	) );

	$cmb_ad_space_box->add_group_field( $group_field_id, array(
		'name' => __( 'Ad Image', 'cmb2' ),
		'desc' => __( 'Upload/Select an image or enter a URL', 'cmb2' ),
		'id'   => 'image',
		'type' => 'file',
	) );

	$cmb_ad_space_box->add_group_field( $group_field_id, array(
		'name'        => __( 'Description', 'cmb2' ),
		'description' => __( 'Enter the text that appears in the ad image', 'cmb2' ),
		'id'          => 'description',
		'type'        => 'textarea_small',
	) );

	$cmb_ad_space_box->add_group_field( $group_field_id, array(
		'name'        => __( 'Link', 'cmb2' ),
		'description' => __( 'Enter the URL where clicking this ad leads', 'cmb2' ),
		'id'          => 'link',
		'type'        => 'text_url',
	) );

}

add_action( 'cmb2_init', 'laskins_register_events_metabox' );

function laskins_register_events_metabox() {
	$prefix = '_laskins_events_';
	
	$cmb_events_box = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Screening Event Information', 'cmb2' ),
		'object_types'  => array( 'tribe_events', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

	$cmb_events_box->add_field( array(
		'name'		=> __( 'Film ID', 'cmb2' ),
		'desc'       => __( 'Select the Film associated with this Screening Event.', 'cmb2' ),
		'id' 			=> $prefix . 'film',
		'type'		=> 'custom_attached_posts',
		'options'	=> array(
			'show_thumbnails'	=> true,
			'filter_boxes' 			=> true,
			'query_args' => array(
				'post_type' => 'media_items',
			),
		),
	) );

	$cmb_events_box->add_field( array(
		'name'		=> __( 'Button Text', 'cmb2' ),
		'desc'       => __( 'Enter the text that will appear on the button that will appear in the description for a screening (and which can be used to lead to a place to purchase tickets for the screening)', 'cmb2' ),
		'id' 			=> $prefix . 'btn_text',
		'type'		=> 'text',
	) );

	$cmb_events_box->add_field( array(
		'name'		=> __( 'Button Link', 'cmb2' ),
		'desc'       => __( 'Enter the URL to which this button will lead', 'cmb2' ),
		'id' 			=> $prefix . 'btn_link',
		'type'		=> 'text_url',
	) );

	$cmb_events_box->add_field( array(
		'name'		=> __( 'Open Link in New Tab', 'cmb2' ),
		'desc'       => __( "Select this to make the button's link open in a new tab", 'cmb2' ),
		'id' 			=> $prefix . 'btn_target',
		'type'		=> 'checkbox',
	) );

}

add_action( 'cmb2_init', 'laskins_register_carousel_metabox' );

function laskins_register_carousel_metabox() {
	$prefix = '_laskins_carousel_';
	
	$cmb_media_item_box = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Heading Options - All fields are optional', 'cmb2' ),
		'object_types'  => array( /*'module', 'media_items',*/ 'tribe_events', /*'page',*/ ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

	$cmb_media_item_box->add_field( array(
		'name'       => __( 'Hide Heading', 'cmb2' ),
		'id'         => $prefix . 'hide_heading',
		'desc' => __( 'Checkmark this box to hide the heading completely', 'cmb2' ),
		'type'       => 'checkbox',
	) );

	$cmb_media_item_box->add_field( array(
		'name'       => __( 'Horizontal Position', 'cmb2' ),
		'id'         => $prefix . 'hor_pos',
		'desc' => __( 'Enter a number from 0 to 100 that sets the horizontal position of the left side of the text block as a percentage with 0 being flush left and 100 being flush right', 'cmb2' ),
		'type'       => 'text_small',
	) );
	$cmb_media_item_box->add_field( array(
		'name'       => __( 'Vertical Position', 'cmb2' ),
		'id'         => $prefix . 'ver_pos',
		'desc' => __( 'Enter a number from 0 to 100 that sets the vertical position of the top of the text block with 0 being at the top and 100 being at the bottom', 'cmb2' ),
		'type'       => 'text_small',
	) );
	/* $cmb_media_item_box->add_field( array(
		'name'		=> __( 'Title Box Position - Left', 'cmb2' ),
		'desc'       => __( 'Enter a percentage from 0-100. Controls the horizontal position of the text description on home/category pages. To hide title completely, set to 100.', 'cmb2' ),
		'id' 			=> $prefix . 'exceprt_position_left',
		'type'		=> 'text_small',
	) );

	$cmb_media_item_box->add_field( array(
		'name'		=> __( 'Title Box Position - Top', 'cmb2' ),
		'desc'       => __( 'Enter a percentage from 0-100. Controls the vertical position of the text description on home/category pages.', 'cmb2' ),
		'id' 			=> $prefix . 'exceprt_position_top',
		'type'		=> 'text_small',
	) );

	$cmb_media_item_box->add_field( array(
		'name'		=> __( 'Title Box Position - Right', 'cmb2' ),
		'desc'       => __( 'Enter a percentage from 0-100. Controls the horizontal position of the text description on home/category pages. If used, this will override the "Left" setting.', 'cmb2' ),
		'id' 			=> $prefix . 'exceprt_position_right',
		'type'		=> 'text_small',
	) );

	$cmb_media_item_box->add_field( array(
		'name'		=> __( 'Title Box Position - Bottom', 'cmb2' ),
		'desc'       => __( 'Enter a percentage from 0-100. Controls the vertical position of the text description on home/category pages. If used, this will override the "Top" setting.', 'cmb2' ),
		'id' 			=> $prefix . 'exceprt_position_bottom',
		'type'		=> 'text_small',
	) ); */

	$cmb_media_item_box->add_field( array(
		'name'		=> __( 'Title Box Text Color', 'cmb2' ),
		'desc'       => __( 'Choose the color of the text that appears over the banner image. If left blank, defaults to white.', 'cmb2' ),
		'id' 			=> $prefix . 'exceprt_text_color',
		'type'		=> 'colorpicker',
	) );

	/*******************
	rgba_colorpicker field type requires CMB2_RGBa_Picker to be installed in the plugins directory. It requires a javascript file that is also located in the plugins directory. The plugin has been modified slightly to rename the folder containing the javascript file.
	
	plugin comes from: https://github.com/JayWood/CMB2_RGBa_Picker
	*/
	$cmb_media_item_box->add_field( array(
		'name'		=> __( 'Title Box Backround Color', 'cmb2' ),
		'desc'       => __( 'Choose the color of the background field behind the title and excerpt text on banners.', 'cmb2' ),
		'id' 			=> $prefix . 'exceprt_background_color',
		'type'		=> 'rgba_colorpicker',
	) );

	$cmb_media_item_box->add_field( array(
		'name'		=> __( 'Supertitle', 'cmb2' ),
		'desc'       => __( 'Puts text above the title and excerpt on the home and category pages.', 'cmb2' ),
		'id' 			=> $prefix . 'super_title',
		'type'		=> 'text',
	) );

	$cmb_media_item_box->add_field( array(
		'name'		=> __( 'Title size', 'cmb2' ),
		'desc'       => __( 'Enter the size for your title (an integer), defaults to 56px', 'cmb2' ),
		'id' 			=> $prefix . 'title_size',
		'type'		=> 'text_small',
	) );

	$cmb_media_item_box->add_field( array(
		'name'		=> __( 'Supertitle size', 'cmb2' ),
		'desc'       => __( 'Enter the size for your supertitle (an integer), defaults to 28px', 'cmb2' ),
		'id' 			=> $prefix . 'super_title_size',
		'type'		=> 'text_small',
	) );

	$cmb_media_item_box->add_field( array(
		'name'		=> __( 'Excerpt size', 'cmb2' ),
		'desc'       => __( 'Enter the size for excerpt (an integer), defaults to 24px', 'cmb2' ),
		'id' 			=> $prefix . 'excerpt_size',
		'type'		=> 'text_small',
	) );

	$cmb_media_item_box->add_field( array(
		'name' => __( 'Override Image', 'cmb2' ),
		'desc' => __( 'Upload/Select an image or enter a URL -- used for home/category page main slider', 'cmb2' ),
		'id'   => $prefix . 'override_image',
		'type' => 'file',
	) );
}

add_action( 'cmb2_init', 'laskins_register_slider_metabox' );

function laskins_register_slider_metabox() {
	$prefix = '_laskins_slider_';
	
	$cmb_slider_box = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Custom Slider Fields', 'cmb2' ),
		'object_types'  => array( 'page'), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );
	
	$slider_group_field_id = $cmb_slider_box->add_field( array(
		'id'          => $prefix . 'slider',
		'type'        => 'group',
		'description' => __( 'Slider: Add slides to the page slider', 'cmb2' ),
		'options'     => array(
			'group_title'   => __( 'Slide {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Slide', 'cmb2' ),
			'remove_button' => __( 'Remove Slide', 'cmb2' ),
			'sortable'      => true, // beta
		),
	) );
	$cmb_slider_box->add_group_field( $slider_group_field_id, array(
		'name'       => __( 'Heading', 'cmb2' ),
		'id'         => 'heading',
		'type'       => 'text',
	) );
	$cmb_slider_box->add_group_field( $slider_group_field_id, array(
		'name'       => __( 'Superheading', 'cmb2' ),
		'desc' => __( "Add an optional smaller heading above the main heading", 'cmb2' ),
		'id'         => 'superheading',
		'type'       => 'text',
	) );
	$cmb_slider_box->add_group_field( $slider_group_field_id, array(
		'name'       => __( 'Body Text', 'cmb2' ),
		'id'         => 'body_text',
		'type'       => 'wysiwyg',
	) );
	$cmb_slider_box->add_group_field( $slider_group_field_id, array(
		'name'		=> __( 'Heading size', 'cmb2' ),
		'desc'       => __( 'Enter the size for your heading (an integer), defaults to 56px', 'cmb2' ),
		'id' 			=> 'heading_size',
		'type'		=> 'text_small',
	) );

	$cmb_slider_box->add_group_field( $slider_group_field_id, array(
		'name'		=> __( 'Superheading size', 'cmb2' ),
		'desc'       => __( 'Enter the size for your superheading (an integer), defaults to 28px', 'cmb2' ),
		'id' 			=> 'superheading_size',
		'type'		=> 'text_small',
	) );

	$cmb_slider_box->add_group_field( $slider_group_field_id, array(
		'name'		=> __( 'Excerpt size', 'cmb2' ),
		'desc'       => __( 'Enter the size for the body text below the title (an integer), defaults to 24px', 'cmb2' ),
		'id' 			=> 'body_size',
		'type'		=> 'text_small',
	) );
	$cmb_slider_box->add_group_field( $slider_group_field_id, array(
		'name'       => __( 'Link Text', 'cmb2' ),
		'id'         => 'link_text',
		'desc' => __( 'Enter the text that will show to the user for the link', 'cmb2' ),
		'type'       => 'text',
	) );
	$cmb_slider_box->add_group_field( $slider_group_field_id, array(
		'name'       => __( 'Horizontal Position', 'cmb2' ),
		'id'         => 'hor_pos',
		'desc' => __( 'Enter a number from 0 to 100 that sets the horizontal position of the left side of the text block as a percentage with 0 being flush left and 100 being flush right', 'cmb2' ),
		'type'       => 'text_small',
	) );
	$cmb_slider_box->add_group_field( $slider_group_field_id, array(
		'name'       => __( 'Vertical Position', 'cmb2' ),
		'id'         => 'ver_pos',
		'desc' => __( 'Enter a number from 0 to 100 that sets the vertical position of the top of the text block with 0 being at the top and 100 being at the bottom', 'cmb2' ),
		'type'       => 'text_small',
	) );
	$cmb_slider_box->add_group_field( $slider_group_field_id, array(
		'name'       => __( 'Width', 'cmb2' ),
		'id'         => 'width',
		'desc' => __( 'Enter a number from 1 to 100 that sets the width the text block as a percentage of the width of the whole slide', 'cmb2' ),
		'type'       => 'text_small',
	) );
	$cmb_slider_box->add_group_field( $slider_group_field_id, array(
		'name'		=> __( 'Title Box Text Color', 'cmb2' ),
		'desc'       => __( 'Choose the color of the text that appears over the banner image. If left blank, defaults to LA Skins Fest orange.', 'cmb2' ),
		'id' 			=> 'text_color',
		'type'		=> 'colorpicker',
	) );
	$cmb_slider_box->add_group_field( $slider_group_field_id, array(
		'name'       => __( 'Title Box Background Color', 'cmb2' ),
		'id'         => 'bgcolor',
		'desc' => __( 'Select the background color for the text block. Leave blank for no background color.', 'cmb2' ),
		'type'       => 'rgba_colorpicker',
	) );

	$cmb_slider_box->add_group_field( $slider_group_field_id, array(
		'name'		=> __( 'Link to Internal Page or Event', 'cmb2' ),
		'desc'       => __( 'Select one page, event or media item to which this slider will link', 'cmb2' ),
		'id' 			=> 'page_event_link',
		'type'		=> 'custom_attached_posts',
		'options'	=> array(
			'show_thumbnails' 	=> true,
			'filter_boxes'			=> true,
			'query_args'			=> array(
				'post_type'	=> array('media_items', 'tribe_events', 'page','post')
			)
		)
	) );
	$cmb_slider_box->add_group_field( $slider_group_field_id, array(
		'name' => __( 'Custom Link URL', 'cmb2' ),
		'id'   => 'link_url',
		'desc' => __( 'Enter the URL that the link will go to if you did not select a page or event above', 'cmb2' ),
		'type' => 'text_url',
		'protocols' => array('http', 'https'), // Array of allowed protocols
	) );
	$cmb_slider_box->add_group_field( $slider_group_field_id, array(
		'name' => __( 'Open Link Externally', 'cmb2' ),
		'id'   => 'link_external',
		'desc' => __( 'Check this for the link to open in a new tab/window', 'cmb2' ),
		'type' => 'checkbox',
	) );
	$cmb_slider_box->add_group_field( $slider_group_field_id, array(
		'name'		=> __( 'Override Background Image', 'cmb2' ),
		'desc' => __( "Upload or select a background image for this slide if you wish to override the default featured image coming from the above selected page, event, or media item.", 'cmb2' ),
		'id'			=> 'background_image',
		'type'		=> 'file',
	) );
	$cmb_slider_box->add_group_field( $slider_group_field_id, array(
		'name'		=> __( 'Override Video MP4', 'cmb2' ),
		'desc' => __( "Upload or select a video in .mp4 format for this slide. This will override any background image or featured image selected above", 'cmb2' ),
		'id'			=> 'background_video_mp4',
		'type'		=> 'file',
	) );
	$cmb_slider_box->add_group_field( $slider_group_field_id, array(
		'name'		=> __( 'Override Video WEBM', 'cmb2' ),
		'desc' => __( "Upload or select a video in .webm format for this slide. This will be used for browsers that do not support mp4, and is optional", 'cmb2' ),
		'id'			=> 'background_video_webm',
		'type'		=> 'file',
	) );
	
	/*$header_block_group = $cmb_slider_box->add_field( array(
		'id'          => $prefix . 'header_block',
		'type'        => 'group',
		'description' => __( 'Header Block: Enter content that will appear below and to the side of the page title in the header block', 'cmb2' ),
		'repeatable' => false,
		'options'     => array(
			'group_title'   => __( 'Header Block', 'cmb2' ),
		),
	) );*/

}


// add_action( 'cmb2_init', 'laskins_register_demo_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function laskins_register_demo_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_laskins_demo_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Test Metabox', 'cmb2' ),
		'object_types'  => array( 'page', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

	$cmb_demo->add_field( array(
		'name'       => __( 'Test Text', 'cmb2' ),
		'desc'       => __( 'field description (optional)', 'cmb2' ),
		'id'         => $prefix . 'text',
		'type'       => 'text',
		'show_on_cb' => 'laskins_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
	) );

	$cmb_demo->add_field( array(
		'name' => __( 'Test Text Small', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'textsmall',
		'type' => 'text_small',
		// 'repeatable' => true,
	) );

	$cmb_demo->add_field( array(
		'name' => __( 'Test Text Medium', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'textmedium',
		'type' => 'text_medium',
		// 'repeatable' => true,
	) );

	$cmb_demo->add_field( array(
		'name' => __( 'Website URL', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'url',
		'type' => 'text_url',
		// 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
		// 'repeatable' => true,
	) );

	$cmb_demo->add_field( array(
		'name' => __( 'Test Text Email', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'email',
		'type' => 'text_email',
		// 'repeatable' => true,
	) );

	$cmb_demo->add_field( array(
		'name' => __( 'Test Time', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'time',
		'type' => 'text_time',
	) );

	$cmb_demo->add_field( array(
		'name' => __( 'Time zone', 'cmb2' ),
		'desc' => __( 'Time zone', 'cmb2' ),
		'id'   => $prefix . 'timezone',
		'type' => 'select_timezone',
	) );

	$cmb_demo->add_field( array(
		'name' => __( 'Test Date Picker', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'textdate',
		'type' => 'text_date',
	) );

	$cmb_demo->add_field( array(
		'name' => __( 'Test Date Picker (UNIX timestamp)', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'textdate_timestamp',
		'type' => 'text_date_timestamp',
		// 'timezone_meta_key' => $prefix . 'timezone', // Optionally make this field honor the timezone selected in the select_timezone specified above
	) );

	$cmb_demo->add_field( array(
		'name' => __( 'Test Date/Time Picker Combo (UNIX timestamp)', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'datetime_timestamp',
		'type' => 'text_datetime_timestamp',
	) );

	// This text_datetime_timestamp_timezone field type
	// is only compatible with PHP versions 5.3 or above.
	// Feel free to uncomment and use if your server meets the requirement
	// $cmb_demo->add_field( array(
	// 	'name' => __( 'Test Date/Time Picker/Time zone Combo (serialized DateTime object)', 'cmb2' ),
	// 	'desc' => __( 'field description (optional)', 'cmb2' ),
	// 	'id'   => $prefix . 'datetime_timestamp_timezone',
	// 	'type' => 'text_datetime_timestamp_timezone',
	// ) );

	$cmb_demo->add_field( array(
		'name' => __( 'Test Money', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'textmoney',
		'type' => 'text_money',
		// 'before_field' => '£', // override '$' symbol if needed
		// 'repeatable' => true,
	) );

	$cmb_demo->add_field( array(
		'name'    => __( 'Test Color Picker', 'cmb2' ),
		'desc'    => __( 'field description (optional)', 'cmb2' ),
		'id'      => $prefix . 'colorpicker',
		'type'    => 'colorpicker',
		'default' => '#ffffff',
	) );

	$cmb_demo->add_field( array(
		'name' => __( 'Test Text Area', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'textarea',
		'type' => 'textarea',
	) );

	$cmb_demo->add_field( array(
		'name' => __( 'Test Text Area Small', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'textareasmall',
		'type' => 'textarea_small',
	) );

	$cmb_demo->add_field( array(
		'name' => __( 'Test Text Area for Code', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'textarea_code',
		'type' => 'textarea_code',
	) );

	$cmb_demo->add_field( array(
		'name' => __( 'Test Title Weeeee', 'cmb2' ),
		'desc' => __( 'This is a title description', 'cmb2' ),
		'id'   => $prefix . 'title',
		'type' => 'title',
	) );

	$cmb_demo->add_field( array(
		'name'             => __( 'Test Select', 'cmb2' ),
		'desc'             => __( 'field description (optional)', 'cmb2' ),
		'id'               => $prefix . 'select',
		'type'             => 'select',
		'show_option_none' => true,
		'options'          => array(
			'standard' => __( 'Option One', 'cmb2' ),
			'custom'   => __( 'Option Two', 'cmb2' ),
			'none'     => __( 'Option Three', 'cmb2' ),
		),
	) );

	$cmb_demo->add_field( array(
		'name'             => __( 'Test Radio inline', 'cmb2' ),
		'desc'             => __( 'field description (optional)', 'cmb2' ),
		'id'               => $prefix . 'radio_inline',
		'type'             => 'radio_inline',
		'show_option_none' => 'No Selection',
		'options'          => array(
			'standard' => __( 'Option One', 'cmb2' ),
			'custom'   => __( 'Option Two', 'cmb2' ),
			'none'     => __( 'Option Three', 'cmb2' ),
		),
	) );

	$cmb_demo->add_field( array(
		'name'    => __( 'Test Radio', 'cmb2' ),
		'desc'    => __( 'field description (optional)', 'cmb2' ),
		'id'      => $prefix . 'radio',
		'type'    => 'radio',
		'options' => array(
			'option1' => __( 'Option One', 'cmb2' ),
			'option2' => __( 'Option Two', 'cmb2' ),
			'option3' => __( 'Option Three', 'cmb2' ),
		),
	) );

	$cmb_demo->add_field( array(
		'name'     => __( 'Test Taxonomy Radio', 'cmb2' ),
		'desc'     => __( 'field description (optional)', 'cmb2' ),
		'id'       => $prefix . 'text_taxonomy_radio',
		'type'     => 'taxonomy_radio',
		'taxonomy' => 'category', // Taxonomy Slug
		// 'inline'  => true, // Toggles display to inline
	) );

	$cmb_demo->add_field( array(
		'name'     => __( 'Test Taxonomy Select', 'cmb2' ),
		'desc'     => __( 'field description (optional)', 'cmb2' ),
		'id'       => $prefix . 'taxonomy_select',
		'type'     => 'taxonomy_select',
		'taxonomy' => 'category', // Taxonomy Slug
	) );

	$cmb_demo->add_field( array(
		'name'     => __( 'Test Taxonomy Multi Checkbox', 'cmb2' ),
		'desc'     => __( 'field description (optional)', 'cmb2' ),
		'id'       => $prefix . 'multitaxonomy',
		'type'     => 'taxonomy_multicheck',
		'taxonomy' => 'post_tag', // Taxonomy Slug
		// 'inline'  => true, // Toggles display to inline
	) );

	$cmb_demo->add_field( array(
		'name' => __( 'Test Checkbox', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'checkbox',
		'type' => 'checkbox',
	) );

	$cmb_demo->add_field( array(
		'name'    => __( 'Test Multi Checkbox', 'cmb2' ),
		'desc'    => __( 'field description (optional)', 'cmb2' ),
		'id'      => $prefix . 'multicheckbox',
		'type'    => 'multicheck',
		'options' => array(
			'check1' => __( 'Check One', 'cmb2' ),
			'check2' => __( 'Check Two', 'cmb2' ),
			'check3' => __( 'Check Three', 'cmb2' ),
		),
		// 'inline'  => true, // Toggles display to inline
	) );

	$cmb_demo->add_field( array(
		'name'    => __( 'Test wysiwyg', 'cmb2' ),
		'desc'    => __( 'field description (optional)', 'cmb2' ),
		'id'      => $prefix . 'wysiwyg',
		'type'    => 'wysiwyg',
		'options' => array( 'textarea_rows' => 5, ),
	) );

	$cmb_demo->add_field( array(
		'name' => __( 'Test Image', 'cmb2' ),
		'desc' => __( 'Upload an image or enter a URL.', 'cmb2' ),
		'id'   => $prefix . 'image',
		'type' => 'file',
	) );

	$cmb_demo->add_field( array(
		'name'         => __( 'Multiple Files', 'cmb2' ),
		'desc'         => __( 'Upload or add multiple images/attachments.', 'cmb2' ),
		'id'           => $prefix . 'file_list',
		'type'         => 'file_list',
		'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
	) );

	$cmb_demo->add_field( array(
		'name' => __( 'oEmbed', 'cmb2' ),
		'desc' => __( 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.', 'cmb2' ),
		'id'   => $prefix . 'embed',
		'type' => 'oembed',
	) );

	$cmb_demo->add_field( array(
		'name'         => 'Testing Field Parameters',
		'id'           => $prefix . 'parameters',
		'type'         => 'text',
		'before_row'   => 'laskins_before_row_if_2', // callback
		'before'       => '<p>Testing <b>"before"</b> parameter</p>',
		'before_field' => '<p>Testing <b>"before_field"</b> parameter</p>',
		'after_field'  => '<p>Testing <b>"after_field"</b> parameter</p>',
		'after'        => '<p>Testing <b>"after"</b> parameter</p>',
		'after_row'    => '<p>Testing <b>"after_row"</b> parameter</p>',
	) );

}

// add_action( 'cmb2_init', 'laskins_register_about_page_metabox' );
/**
 * Hook in and add a metabox that only appears on the 'About' page
 */
function laskins_register_about_page_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_laskins_about_';

	/**
	 * Metabox to be displayed on a single page ID
	 */
	$cmb_about_page = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'About Page Metabox', 'cmb2' ),
		'object_types' => array( 'page', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		'show_on'      => array( 'id' => array( 2, ) ), // Specific post IDs to display this metabox
	) );

	$cmb_about_page->add_field( array(
		'name' => __( 'Test Text', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'text',
		'type' => 'text',
	) );

}

// add_action( 'cmb2_init', 'laskins_register_repeatable_group_field_metabox' );
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function laskins_register_repeatable_group_field_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_laskins_group_';

	/**
	 * Repeatable Field Groups
	 */
	$cmb_group = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Repeating Field Group', 'cmb2' ),
		'object_types' => array( 'page', ),
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $cmb_group->add_field( array(
		'id'          => $prefix . 'demo',
		'type'        => 'group',
		'description' => __( 'Generates reusable form entries', 'cmb2' ),
		'options'     => array(
			'group_title'   => __( 'Entry {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Entry', 'cmb2' ),
			'remove_button' => __( 'Remove Entry', 'cmb2' ),
			'sortable'      => true, // beta
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	$cmb_group->add_group_field( $group_field_id, array(
		'name'       => __( 'Entry Title', 'cmb2' ),
		'id'         => 'title',
		'type'       => 'text',
		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name'        => __( 'Description', 'cmb2' ),
		'description' => __( 'Write a short description for this entry', 'cmb2' ),
		'id'          => 'description',
		'type'        => 'textarea_small',
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name' => __( 'Entry Image', 'cmb2' ),
		'id'   => 'image',
		'type' => 'file',
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name' => __( 'Image Caption', 'cmb2' ),
		'id'   => 'image_caption',
		'type' => 'text',
	) );

}

// add_action( 'cmb2_init', 'laskins_register_user_profile_metabox' );
/**
 * Hook in and add a metabox to add fields to the user profile pages
 */
function laskins_register_user_profile_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_laskins_user_';

	/**
	 * Metabox for the user profile screen
	 */
	$cmb_user = new_cmb2_box( array(
		'id'               => $prefix . 'edit',
		'title'            => __( 'User Profile Metabox', 'cmb2' ),
		'object_types'     => array( 'user' ), // Tells CMB to use user_meta vs post_meta
		'show_names'       => true,
		'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
	) );

	$cmb_user->add_field( array(
		'name'     => __( 'Extra Info', 'cmb2' ),
		'desc'     => __( 'field description (optional)', 'cmb2' ),
		'id'       => $prefix . 'extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );

	$cmb_user->add_field( array(
		'name'    => __( 'Avatar', 'cmb2' ),
		'desc'    => __( 'field description (optional)', 'cmb2' ),
		'id'      => $prefix . 'avatar',
		'type'    => 'file',
	) );

	$cmb_user->add_field( array(
		'name' => __( 'Facebook URL', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'facebookurl',
		'type' => 'text_url',
	) );

	$cmb_user->add_field( array(
		'name' => __( 'Twitter URL', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'twitterurl',
		'type' => 'text_url',
	) );

	$cmb_user->add_field( array(
		'name' => __( 'Google+ URL', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'googleplusurl',
		'type' => 'text_url',
	) );

	$cmb_user->add_field( array(
		'name' => __( 'Linkedin URL', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'linkedinurl',
		'type' => 'text_url',
	) );

	$cmb_user->add_field( array(
		'name' => __( 'User Field', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'user_text_field',
		'type' => 'text',
	) );

}

// add_action( 'cmb2_init', 'laskins_register_theme_options_metabox' );
/**
 * Hook in and register a metabox to handle a theme options page
 */
function laskins_register_theme_options_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$option_key = '_laskins_theme_options';

	/**
	 * Metabox for an options page. Will not be added automatically, but needs to be called with
	 * the `cmb2_metabox_form` helper function. See wiki for more info.
	 */
	$cmb_options = new_cmb2_box( array(
		'id'      => $option_key . 'page',
		'title'   => __( 'Theme Options Metabox', 'cmb2' ),
		'hookup'  => false, // Do not need the normal user/post hookup
		'show_on' => array(
			// These are important, don't remove
			'key'   => 'options-page',
			'value' => array( $option_key )
		),
	) );

	/**
	 * Options fields ids only need
	 * to be unique within this option group.
	 * Prefix is not needed.
	 */
	$cmb_options->add_field( array(
		'name'    => __( 'Site Background Color', 'cmb2' ),
		'desc'    => __( 'field description (optional)', 'cmb2' ),
		'id'      => 'bg_color',
		'type'    => 'colorpicker',
		'default' => '#ffffff',
	) );

}
