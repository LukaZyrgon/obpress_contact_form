<?php
/*
  Plugin name: OBPress Contact Form by Zyrgon
  Plugin uri: www.zyrgon.net
  Text Domain: OBPress_Contact_Form
  Description: Widgets to OBPress
  Version: 0.0.2
  Author: Zyrgon
  Author uri: www.zyrgon.net
  License: GPlv2 or Later
*/


require_once('contactAjax.php');
require_once('elementor/init.php');

// TODO, MAKE GIT BRANCH, CONNECT WITH UPDATE CHECKER

require_once(WP_PLUGIN_DIR . '/OBPress_Contact_Form/plugin-update-checker-4.11/plugin-update-checker.php');
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://github.com/LukaZyrgon/obpress_contact_form',
    __FILE__,
    'OBPress_Contact_Form'
);

//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('main');
