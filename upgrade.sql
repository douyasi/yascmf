SET FOREIGN_KEY_CHECKS=0;
ALTER TABLE `yascmf_metas` MODIFY COLUMN `type`  varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'category' COMMENT 'meta类型: [category]-分类，[tag]-标签' AFTER `slug`;
CREATE TABLE `yascmf_password_resets` (
`email`  varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '邮箱' ,
`token`  varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '会话token' ,
`created_at`  datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间' 
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci
CHECKSUM=0
ROW_FORMAT=Dynamic
DELAY_KEY_WRITE=0
;
ALTER TABLE `yascmf_permissions` ADD COLUMN `description`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL AFTER `display_name`;
ALTER TABLE `yascmf_permission_role` DROP INDEX `permission_id_foreign`;
ALTER TABLE `yascmf_permission_role` MODIFY COLUMN `id`  int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id' FIRST ;
ALTER TABLE `yascmf_permission_role` DROP PRIMARY KEY;
ALTER TABLE `yascmf_permission_role` ADD PRIMARY KEY (`permission_id`, `role_id`);
ALTER TABLE `yascmf_permission_role` DROP COLUMN `id`;
ALTER TABLE `yascmf_roles` ADD COLUMN `display_name`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '角色展示名' AFTER `name`;
ALTER TABLE `yascmf_roles` ADD COLUMN `description`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT '角色描述' AFTER `display_name`;
CREATE TABLE `yascmf_role_user` (
`user_id`  int(10) UNSIGNED NOT NULL ,
`role_id`  int(10) UNSIGNED NOT NULL ,
PRIMARY KEY (`user_id`, `role_id`),
INDEX `role_id_foreign` (`role_id`) USING BTREE 
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci
CHECKSUM=0
ROW_FORMAT=Fixed
DELAY_KEY_WRITE=0
;
CREATE INDEX `setting_name_index` ON `yascmf_settings`(`name`) USING BTREE ;
ALTER TABLE `yascmf_settings` DROP INDEX `config_name_index`;
ALTER TABLE `yascmf_users` MODIFY COLUMN `user_type`  enum('visitor','customer','manager') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'visitor' COMMENT '用户类型：visitor 游客, customer 投资客户, manager 管理型用户' AFTER `is_lock`;
DROP TABLE `yascmf_assigned_roles`;
DROP TABLE `yascmf_migrations`;
DROP TABLE `yascmf_password_reminders`;
SET FOREIGN_KEY_CHECKS=1;
