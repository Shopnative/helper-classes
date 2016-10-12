<?php
namespace Onvardgmbh\HelperClasses;

class Text {

	/**
	 * Unicode safe version of substr_replace
	 *
	 * @since 0.0.1
	 *
	 * @link http://php.net/manual/de/function.substr-replace.php Taken from comment in PHP docs
	 *
	 * @param String $string
	 *
	 * @return String
	 */
	public static function mb_substr_replace( $string, $replacement, $start, $length = null, $encoding = null ) {

		if ( extension_loaded( 'mbstring' ) === true ) {
			$string_length = ( is_null( $encoding ) === true ) ? mb_strlen( $string ) : mb_strlen( $string, $encoding );

			if ( $start < 0 ) {
				$start = max( 0, $string_length + $start );
			} else if ( $start > $string_length ) {
				$start = $string_length;
			}

			if ( $length < 0 ) {
				$length = max( 0, $string_length - $start + $length );
			} else if ( ( is_null( $length ) === true ) || ( $length > $string_length ) ) {
				$length = $string_length;
			}

			if ( ( $start + $length ) > $string_length ) {
				$length = $string_length - $start;
			}

			if ( is_null( $encoding ) === true ) {
				return mb_substr( $string, 0, $start ) . $replacement . mb_substr( $string, $start + $length,
					$string_length - $start - $length );
			}

			return mb_substr( $string, 0, $start, $encoding ) . $replacement . mb_substr( $string, $start + $length,
				$string_length - $start - $length, $encoding );
		}

		return ( is_null( $length ) === true ) ? substr_replace( $string, $replacement,
			$start ) : substr_replace( $string, $replacement, $start, $length );
	}
}
