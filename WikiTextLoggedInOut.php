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
 * @author Jack Phoenix <jack@countervandalism.net>
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 * @link http://www.mediawiki.org/wiki/Extension:WikiTextLoggedInOut Documentation
 */

// Extension credits that will show up on Special:Version
$wgExtensionCredits['parserhook'][] = array(
	'path' => __FILE__,
	'name' => 'WikiTextLoggedInOut',
	'version' => '1.5.0',
	'author' => array( 'Aaron Wright', 'David Pean', 'Jack Phoenix' ),
	'url' => 'https://www.mediawiki.org/wiki/Extension:WikiTextLoggedInOut',
	'descriptionmsg' => 'wikitextloggedinout-desc'
);

$wgMessagesDirs['WikiTextLoginInOut'] = __DIR__ . '/i18n';

$wgAutoloadClasses['WikiTextLoggedInOut'] = __DIR__ . '/WikiTextLoggedInOut.class.php';

$wgHooks['ParserFirstCallInit'][] = 'WikiTextLoggedInOut::registerTags';