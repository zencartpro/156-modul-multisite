<?php
/**
 * initialise template system variables
 * see {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * Determines current template name for current language, from database<br />
 * Then loads template-specific language file, followed by master/default language file<br />
 * ie: includes/languages/classic/english.php followed by includes/languages/english.php
 *
 * @package initSystem
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: init_templates.php for Multisite 2019-09-28 20:36:46Z webchills $
 */
  if (!defined('IS_ADMIN_FLAG')) {
   die('Illegal Access');
  }

/*
 * Determine the active template name
 */
/* bof Multi site
  $template_dir = "";
  $sql = "select template_dir
            from " . TABLE_TEMPLATE_SELECT . "
            where template_language = 0";
  $template_query = $db->Execute($sql);
  $template_dir = $template_query->fields['template_dir'];

  $sql = "select template_dir
            from " . TABLE_TEMPLATE_SELECT . "
            where template_language = '" . $_SESSION['languages_id'] . "'";
  $template_query = $db->Execute($sql);
  if ($template_query->RecordCount() > 0) {
    $template_dir = $template_query->fields['template_dir'];
  }
 eof Multi site */

/**
 * The actual template directory to use
 */
  define('DIR_WS_TEMPLATE', DIR_WS_TEMPLATES . $template_dir . '/');
/**
 * The actual template images directory to use
 */
  define('DIR_WS_TEMPLATE_IMAGES', DIR_WS_TEMPLATE . 'images/');
/**
 * The actual template icons directory to use
 */
  define('DIR_WS_TEMPLATE_ICONS', DIR_WS_TEMPLATE_IMAGES . 'icons/');

/**
 * Load the appropriate Language files, based on the currently-selected template
 */

  include_once(zen_get_file_directory(DIR_FS_CATALOG . DIR_WS_LANGUAGES, $_SESSION['language'].'.php', 'false'));

/**
 * include the template language master (to catch all items not defined in the override file).
 * The intent here is to: load the override version to catch preferencial changes; 
 * then load the original/master version to catch any defines that didn't get set into the override version during upgrades, etc.
 */
// THE FOLLOWING MIGHT NEED TO BE DISABLED DUE TO THE EXISTENCE OF function() DECLARATIONS IN MASTER ENGLISH.PHP FILE
// THE FOLLOWING MAY ALSO SEND NUMEROUS ERRORS IF YOU HAVE ERROR_REPORTING ENABLED, DUE TO REPETITION OF SEVERAL DEFINE STATEMENTS
  include_once(DIR_WS_LANGUAGES .  $_SESSION['language'] . '.php');


/**
 * send the content charset "now" so that all content is impacted by it
 */
  header("Content-Type: text/html; charset=" . CHARSET);

/**
 * include the extra language definitions
 */
  include(DIR_WS_MODULES . zen_get_module_directory('extra_definitions.php'));
?>