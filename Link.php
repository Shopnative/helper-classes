<?php
namespace Onvardgmbh\HelperClasses;

class Link {

	/**
	 * ASCII escape a string.
	 * Can be used to obfuscate email addresses.
	 *
	 * @since 0.0.1
	 * @author André Schwarzer <schwarzer@onvard.de>
	 *
	 * @param String $string
	 *
	 * @return String
	 */
	public static function asciiEscString( $string ) {
		$return = '';
		foreach ( str_split( $string ) as $char ) {
			$return .= '&#' . ord( $char ) . ';';
		}

		return $return;
	}
}
