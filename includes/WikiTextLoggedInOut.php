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
 * @license GPL-2.0-or-later
 * @link https://www.mediawiki.org/wiki/Extension:WikiTextLoggedInOut Documentation
 */

class WikiTextLoggedInOut {

	public static function registerTags( &$parser ) {
		$parser->setHook( 'loggedin', [ __CLASS__, 'outputLoggedInText' ] );
		$parser->setHook( 'loggedout', [ __CLASS__, 'outputLoggedOutText' ] );
	}

	public static function outputLoggedInText( $input, $args, $parser, $frame ) {
		if ( method_exists( $parser, 'getUserIdentity' ) ) {
			// MW 1.36+
			$user = $parser->getUserIdentity();
		} else {
			$user = $parser->getUser();
		}
		if ( $user->isRegistered() ) {
			return $parser->recursiveTagParse( $input, $frame );
		}

		return '';
	}

	public static function outputLoggedOutText( $input, $args, $parser, $frame ) {
		if ( method_exists( $parser, 'getUserIdentity' ) ) {
			// MW 1.36+
			$user = $parser->getUserIdentity();
		} else {
			$user = $parser->getUser();
		}
		if ( !$user->isRegistered() ) {
			return $parser->recursiveTagParse( $input, $frame );
		}

		return '';
	}

}
