<?php
/**
 * Multisite Functions
 *
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: multisite_functions.php 2019-09-29 10:01:36Z webchills $
 */
 
// retrieve full cPath from category ID
function MultisiteGetcPath($cID) {
  global $db;
  static $parent_cache = array();
  $cats = array();
  //$cats[] = $cID;
  $parent = $db->Execute("SELECT parent_id, categories_id
                          FROM " . TABLE_CATEGORIES . "
                          WHERE categories_id = " . (int)$cID);
  foreach ($parent as $item) {
    if ($item['parent_id'] != '0') {
      $parent_cache[(int)$item['categories_id']] = (int)$item['parent_id'];
      $cats[] = $parent->fields['parent_id'];
      if (isset($parent_cache[(int)$item['parent_id']])) {
        $item['parent_id'] = $parent_cache[(int)$item['parent_id']];
      } else {
        $parent = $db->Execute("SELECT parent_id, categories_id
                                FROM " . TABLE_CATEGORIES . "
                                WHERE categories_id = " . (int)$item['parent_id']);
      }
    }
  }
  $cats = array_reverse($cats);
  $cPath = implode('_', $cats);
  if ($cPath == '') {
    $cPath = '0';
  }
  return $cPath;
}
