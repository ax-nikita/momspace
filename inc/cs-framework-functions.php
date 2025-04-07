<?php

/**
 *
 * Get momspace Theme options
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'momspace_get_option' ) ) {
	function momspace_get_option( $option = '', $default = null ) {
		$options = get_option( 'momspace_theme_options' ); // Attention: Set your unique id of the framework
		return ( isset( $options[$option] ) ) ? $options[$option] : $default;
	}
}

/**
 *
 * Get get switcher option
 *  for theme options
 * @since 1.0.0
 * @version 1.0.0
 *
 */

if ( ! function_exists( 'momspace_get_switcher_option' )) {

	function momspace_get_switcher_option( $option = '', $default = null ) {
		$options = get_option( 'momspace_theme_options' ); // Attention: Set your unique id of the framework
		$return_val =  ( isset( $options[$option] ) ) ? $options[$option] : $default;
		$return_val =  (is_null($return_val) || '1' == $return_val ) ? true : false;;
		return $return_val;
	}
}

if ( ! function_exists( 'momspace_switcher_option' )) {

	function momspace_switcher_option( $option = '', $default = null ) {
		$options = get_option( 'momspace_theme_options' ); // Attention: Set your unique id of the framework
		$return_val =  ( isset( $options[$option] ) ) ? $options[$option] : $default;
		$return_val =  ( '1' == $return_val ) ? true : false;;
		return $return_val;
	}
}

/**
 *
 * Get customize option
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */

if ( ! function_exists( 'momspace_get_customize_option' ) ) {

	function momspace_get_customize_option( $option = '', $default = null ) {
		$options = get_option( 'momspace_customize_options' ); // Attention: Set your unique id of the framework
		return ( isset( $options[$option] ) ) ? $options[$option] : $default;
	}
}