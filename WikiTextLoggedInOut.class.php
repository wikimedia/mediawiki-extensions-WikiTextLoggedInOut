<?php
/**
 * WikiTextLoggedInOut extension
 * Defines two new parser hooks, <loggedin> and <loggedout>
 * that will display different output depending if the user
 * is logged in or not.
 *
 * @file
 * @ingroup Extensions
 * @author Aaron Wright
 * @author David Pean
 * @author Jack Phoenix
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 * @link https://www.mediawiki.org/wiki/Extension:WikiTextLoggedInOut Documentation
 */

class WikiTextLoggedInOut {

	public static function registerTags( &$parser ) {
		$parser->setHook( 'loggedin', array( __CLASS__, 'outputLoggedInText' ) );
		$parser->setHook( 'loggedout', array( __CLASS__, 'outputLoggedOutText' ) );
		return true;
	}

	public static function outputLoggedInText( $input, $args, $parser, $frame ) {
		global $wgUser;

		if ( $wgUser->isLoggedIn() ) {
			return $parser->recursiveTagParse( $input, $frame );
		}

		return '';
	}

	public static function outputLoggedOutText( $input, $args, $parser, $frame ) {
		global $wgUser;

		if ( !$wgUser->isLoggedIn() ) {
			return $parser->recursiveTagParse( $input, $frame );
		}

		return '';
	}

}