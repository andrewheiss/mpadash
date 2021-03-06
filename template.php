<?php
/**
 * @file
 * Contains theme override functions and preprocess functions for the theme.
 *
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. You can add new regions for block content, modify
 *   or override Drupal's theme functions, intercept or make additional
 *   variables available to your theme, and create custom PHP logic. For more
 *   information, please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/theme-guide
 *
 * OVERRIDING THEME FUNCTIONS
 *
 *   The Drupal theme system uses special theme functions to generate HTML
 *   output automatically. Often we wish to customize this HTML output. To do
 *   this, we have to override the theme function. You have to first find the
 *   theme function that generates the output, and then "catch" it and modify it
 *   here. The easiest way to do it is to copy the original function in its
 *   entirety and paste it here, changing the prefix from theme_ to mpadash_.
 *   For example:
 *
 *     original: theme_breadcrumb()
 *     theme override: mpadash_breadcrumb()
 *
 *   where mpadash is the name of your sub-theme. For example, the
 *   zen_classic theme would define a zen_classic_breadcrumb() function.
 *
 *   If you would like to override any of the theme functions used in Zen core,
 *   you should first look at how Zen core implements those functions:
 *     theme_breadcrumbs()      in zen/template.php
 *     theme_menu_item_link()   in zen/template.php
 *     theme_menu_local_tasks() in zen/template.php
 *
 *   For more information, please visit the Theme Developer's Guide on
 *   Drupal.org: http://drupal.org/node/173880
 *
 * CREATE OR MODIFY VARIABLES FOR YOUR THEME
 *
 *   Each tpl.php template file has several variables which hold various pieces
 *   of content. You can modify those variables (or add new ones) before they
 *   are used in the template files by using preprocess functions.
 *
 *   This makes THEME_preprocess_HOOK() functions the most powerful functions
 *   available to themers.
 *
 *   It works by having one preprocess function for each template file or its
 *   derivatives (called template suggestions). For example:
 *     THEME_preprocess_page    alters the variables for page.tpl.php
 *     THEME_preprocess_node    alters the variables for node.tpl.php or
 *                              for node-forum.tpl.php
 *     THEME_preprocess_comment alters the variables for comment.tpl.php
 *     THEME_preprocess_block   alters the variables for block.tpl.php
 *
 *   For more information on preprocess functions and template suggestions,
 *   please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/node/223440
 *   and http://drupal.org/node/190815#template-suggestions
 */

function clean_content($content) {
	$search = array("Readings &amp; Due Dates:", "Readings:", "Assignments:");
	return str_replace($search, '-', $content);
} // End of clean_content()

/**
 * Implementation of HOOK_theme().
 */
function mpadash_theme(&$existing, $type, $theme, $path) {
  $hooks = zen_theme($existing, $type, $theme, $path);
  // Add your theme hooks like this:
  /*
  $hooks['hook_name_here'] = array( // Details go here );
  */
  // @TODO: Needs detailed comments. Patches welcome!
  return $hooks;
}

/**
 * Override or insert variables into all templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered (name of the .tpl.php file.)
 */
/* -- Delete this line if you want to use this function
function mpadash_preprocess(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */

function mpadash_preprocess_page(&$vars, $hook) {
	if (!module_exists('dashboard_settings')) {
		print '<h1>' . t('Module missing') . '</h1>';
		print '<h3>' . t('The MPA dashboard theme requires the custom Dashboard Settings module to work correctly. Please download and enable the module.') . '</h3>';
		print '<h6>' . t( 'Warning generated in file: %f', array ( '%f'=>__FILE__ )) . '</h6>';
	}
	
	if ($vars['node']->type != "") {
		$vars['template_files'][] = "page-node-" . $vars['node']->type;
	}
	
	// Disable Drupal's jQuery since Google's CDN version is hardcoded in the template, but not on admin, edit, or add pages
	$curr_uri = request_uri();
	if (!strpos($curr_uri,'admin') > 0 && !strpos($curr_uri,'edit') > 0 && !strpos($curr_uri,'add') > 0 && !strpos($curr_uri,'batch') > 0) {
		$scripts = drupal_add_js();
		unset($scripts['core']['misc/jquery.js']);
		$vars['scripts'] = drupal_get_js('header', $scripts);
		$vars['use_google_jquery'] = TRUE;
		$vars['show_content'] = FALSE;
	} else {
		$vars['use_google_jquery'] = FALSE;
		$vars['show_content'] = TRUE;
	}
	
	// Strip duplicate head charset metatag
	$matches = array();
	  preg_match_all('/(<meta http-equiv=\"Content-Type\"[^>]*>)/', $vars['head'], $matches);
	  if( count($matches) >= 2){
	    $vars['head'] = preg_replace('/<meta http-equiv=\"Content-Type\"[^>]*>/', '', $vars['head'], 1); // strip 1 only
	    $vars['head'] = preg_replace('/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/', '', $vars['head']);
	}
}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function mpadash_preprocess_node(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // mpadash_preprocess_node_page() or mpadash_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $vars['node']->type;
  if (function_exists($function)) {
    $function($vars, $hook);
  }
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function mpadash_preprocess_comment(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function mpadash_preprocess_block(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */
