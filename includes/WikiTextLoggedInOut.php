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
		$parserOptions = $parser->getOptions();

		if ( $parserOptions->getOption( 'loggedin' ) ) {
			return $parser->recursiveTagParse( $input, $frame );
		}

		return '';
	}

	public static function outputLoggedOutText( $input, $args, $parser, $frame ) {
		$parserOptions = $parser->getOptions();

		if ( !$parserOptions->getOption( 'loggedin' ) ) {
			return $parser->recursiveTagParse( $input, $frame );
		}

		return '';
	}

	/**
	 * Handler for the ParserOptionsRegister hook to add a "loggedin" option for cache-splitting
	 *
	 * @param array &$defaults Options and their defaults
	 * @param array &$inCacheKey Whether each option splits the parser cache
	 * @param array &$lazyLoad Initializers for lazy-loaded options
	 */
	public static function onParserOptionsRegister( &$defaults, &$inCacheKey, &$lazyLoad ) {
		$defaults['loggedin'] = false;
		$inCacheKey['loggedin'] = true;
		$lazyLoad['loggedin'] = static function ( ParserOptions $options ) {
			return $options->getUserIdentity()->isRegistered();
		};
	}

}
