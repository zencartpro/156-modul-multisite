<?php
/**
 * categories sidebox - prepares content for the main categories sidebox
 *
 * @package templateSystem
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: categories.php for Multisite 2019-09-28 20:42:39Z webchills $
 */

    $main_category_tree = new category_tree;
    $row = 0;
    $box_categories_array = array();

// don't build a tree when no categories
// bof Multi site
    $check_categories = $db->Execute(cat_filter("select categories_id from " . TABLE_CATEGORIES . " where categories_status=1 limit 1"));
// eof Multi site
    if ($check_categories->RecordCount() > 0) {
      $box_categories_array = $main_category_tree->zen_category_tree();
    }

    require($template->get_template_dir('tpl_categories.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_categories.php');

    $title = BOX_HEADING_CATEGORIES;
    $title_link = false;

    require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base,'common') . '/' . $column_box_default);
?>