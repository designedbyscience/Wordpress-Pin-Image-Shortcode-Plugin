<?php
/*
Plugin Name: Pin Image Shortcode
Plugin URI: https://github.com/designedbyscience/Wordpress-Pin-Image-Shortcode-Plugin
Description: Add Pin It button to images that appears on hover
Version: 1.0
Author: Matthew Richmond and Eric Haseltine
Author URI: http://choppingblock.com
License: MIT/Expat
*/

/*** Post Image Hovers ***/

function cb_pinImage_func( $atts ) {
	$styleUrl = plugins_url('pinimage.css', __FILE__); 
    $styleFile = WP_PLUGIN_DIR . '/pin-image/pinimage.css';
    if ( file_exists($styleFile) ) {
        wp_register_style('pinimagestyle', $styleUrl);
        wp_enqueue_style( 'pinimagestyle');
    }
	

	$scriptUrl = plugins_url('pinimage.js', __FILE__); 
	$scriptFile = WP_PLUGIN_DIR . '/pin-image/pinimage.js';
	
	if(file_exists($scriptFile)){
		wp_register_script('pinimagejs', plugins_url('pinimage.js', __FILE__));
		wp_enqueue_script('jquery');
		wp_enqueue_script('pinimagejs');
	}
		
	extract( shortcode_atts( array(
		'src' => '',
		'title' => '',
		'width' => '',
		'height' => ''
	), $atts ) );
	
	$url = get_permalink();

	$inlineStyle = "";
	$inlineWH = "";
	
	if($width != '' && $height != ''){
		$inlineStyle = "style='width: {$width}; height: {$height};'";
		$inlineWH = "width='{$width}' height='{$height}'";
	}
	

	
	return "<div class='img-hover' {$inlineStyle}>
		<a href='{$url}'><img src='{$src}' {$inlineWH} alt title='{$title}' /></a><div class='img-hover-meta'>
			<a href='http://pinterest.com/pin/create/button/?url={$url}&media={$src}&description={$title}' class='pin-it-button' count-layout='none'>Pin It</a>
		</div></div>";
}

add_shortcode( 'pinImage', 'cb_pinImage_func' );

?>