ALTER TABLE `user`
    ADD COLUMN `user_active` TINYINT(1) NOT NULL DEFAULT 1 AFTER `user_mail`;
