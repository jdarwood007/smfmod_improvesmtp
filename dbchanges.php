<?php
// If we have found SSI.php and we are outside of SMF, then we are running standalone.
if (file_exists(dirname(__FILE__) . '/SSI.php') && !defined('SMF'))
	require_once(dirname(__FILE__) . '/SSI.php');
elseif (file_exists(getcwd() . '/SSI.php') && !defined('SMF'))
	require_once(getcwd() . '/SSI.php');
elseif (!defined('SMF')) // If we are outside SMF and can't find SSI.php, then throw an error
	die('<b>Error:</b> Cannot install - please verify you put this file in the same place as SMF\'s SSI.php.');

if (SMF == 'SSI')
	db_extend('packages');

$smcFunc['db_add_column'](
	'{db_prefix}mail_queue',
	[
		'name' => 'last_try',
		'type' => 'tinyint',
		'default' => 0,
		'size' => 4,
		'unsigned' => false,
		'null' => false,
]);

if (!isset($modSettings['mail_max_age']))
	updateSettings(['mail_max_age' => 7]);