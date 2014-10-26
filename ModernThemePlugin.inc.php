<?php

/**
 * @file plugins/themes/modern/ModernThemePlugin.inc.php
 *
 * Copyright (c) 2013-2014 Simon Fraser University Library
 * Copyright (c) 2003-2014 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class ModernThemePlugin
 * @ingroup plugins_themes_modern
 *
 * @brief Modern theme plugin
 */

import('classes.plugins.ThemePlugin');

class ModernThemePlugin extends ThemePlugin {

	/**
	 * @see PKPPlugin::register($category, $path)
	 */
	function register($category, $path) {
		HookRegistry::register ('TemplateManager::display', array(&$this, 'callbackDisplay'));
		return parent::register($category, $path);
	}

	/**
	 * Template manager display hook callback to register smarty filters.
	 * @param $hookName string
	 * @param $args array
	 * @return boolean
	 */
	function callbackDisplay($hookName, $args) {
		$smarty = $args[0]; /* @var $smarty Smarty */
		$additionalHeadData = $smarty->get_template_vars('additionalHeadData');
		$pluginScriptImportString = '<script language="javascript" type="text/javascript" src="' . 
			Request::getBaseUrl() . DIRECTORY_SEPARATOR . $this->getPluginPath() . DIRECTORY_SEPARATOR . 'js/modernThemeSiteHandler.js"></script>';

		$googleFonts = "<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css' />" . 
			"<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,400' rel='stylesheet' type='text/css' />";
		
		$smarty->assign('additionalHeadData', $pluginScriptImportString . $googleFonts);

		$smarty->register_prefilter(array(&$this, 'addPluginSiteController'));

		return false;
	}

	/**
	 * Smarty prefilter to modify the template markup before it's rendered,
	 * adding the article title in workflow pages h2 element.
	 * @param $output string
	 * @param $smarty Smarty
	 * @return string
	 */
	function addPluginSiteController($output, &$smarty) {
		$markupToBeReplaced = '<body';
		$replaceMarkup = '<script type="text/javascript"> 
				$(function() {ldelim} 
					$("body").pkpHandler("$.pkp.plugins.themes.modern.ModernThemeSiteHandler"); 
				{rdelim}); 
			</script>' . $markupToBeReplaced;
		$output = str_replace($markupToBeReplaced, $replaceMarkup, $output);	
		return $output;
	}

	/**
	 * @see ThemePlugin::getName()
	 */
	function getName() {
		return 'modernThemePlugin';
	}

	/**
	 * @see ThemePlugin::getDisplayName()
	 */
	function getDisplayName() {
		return 'Modern Theme';
	}

	/**
	 * @see ThemePlugin::getDescription()
	 */
	function getDescription() {
		return 'Modern OJS appearance.';
	}

	/**
	 * Get the css file for this plugin.
	 * @see ThemePlugin::getStylesheetFilename()
	 * @return string
	 */
	function getStylesheetFilename() {
		return 'modernThemePlugin.css';
	}
}

?>
