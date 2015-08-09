ALTER TABLE `voucher_orders`
ADD COLUMN `voucher_order_lastname` VARCHAR(100) NULL DEFAULT NULL COMMENT '' AFTER `voucher_order_name`;


ALTER TABLE `voucher_orders`
ADD COLUMN `voucher_order_state` VARCHAR(2) NULL DEFAULT NULL COMMENT '' AFTER `voucher_order_country`;


ALTER TABLE `orders`
ADD COLUMN `order_state` VARCHAR(2) NULL DEFAULT NULL COMMENT '' AFTER `order_country`;
