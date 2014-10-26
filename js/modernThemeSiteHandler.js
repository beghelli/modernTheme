/**
 * @defgroup plugins_themes_modern_js
 */
/**
 * @file plugins/themes/modern/js/modernThemeSiteHandler.js
 *
 * Copyright (c) 2013-2014 Simon Fraser University Library
 * Copyright (c) 2000-2014 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class ModernThemeSiteHandler
 * @ingroup plugins_themes_modern_js
 *
 * @brief Site handler that handles the modern theme customizations.
 */
(function($) {

        /** @type {Object} */
        $.pkp.plugins = $.pkp.plugins || {};
	/** @type {Object} */
	$.pkp.plugins.themes = $.pkp.plugins.themes || {};
	/** @type {Object} */
	$.pkp.plugins.themes.modern = $.pkp.plugins.themes.modern || {};

	/**
         * @constructor
         *
         * @extends $.pkp.classes.Handler
         */
        $.pkp.plugins.themes.modern.ModernThemeSiteHandler = function($site, options) {
		this.parent($site, options);
		
		$("#navbar").insertAfter("#headerTitle");
		if ($("#main").css('margin-right') !== "0px") {
			$("#main").css('margin-right', '9%');
		}
		if ($("#main").css('margin-left') !== "0px") {
                        $("#main").css('margin-left', '9%');
                }

		if ($("#sidebar").children().length == 1) {
			$("#main").css('width', '65%');
		} else {
			$("#main").css('width', '49%');
		}
		
		$('#breadcrumb').insertBefore('#sidebar');
		$('#topBar').remove();
	};
	$.pkp.classes.Helper.inherits(
			$.pkp.plugins.themes.modern.ModernThemeSiteHandler, 
			$.pkp.controllers.SiteHandler);


/** @param {jQuery} $ jQuery closure. */
}(jQuery))
