<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_site_links.php for Multisite 2019-09-30 18:55:02Z webchills $
 */
  $content = '';
  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent">' . "\n" ;
  $content .=  "\n" . '<ul style="margin: 0; padding: 0; list-style-type: none;">' . "\n" ;
  for ($i=0; $i<sizeof($site_links); $i++) {
    $content .= '<li>' . $site_links[$i] . '</li>' . "\n" ;
  }

  $content .= '</ul>' . "\n" ;
  $content .= '</div>';
?>