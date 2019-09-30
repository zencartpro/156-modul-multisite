ALTER TABLE `orders` DROP `order_site`;
DELETE FROM admin_pages WHERE page_key = 'toolsMultiSite' LIMIT 1;