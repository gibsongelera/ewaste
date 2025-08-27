-- SQL script to add or update the 'role' column in the 'login' table for user roles
ALTER TABLE `login`
ADD COLUMN `role` VARCHAR(32) NOT NULL DEFAULT 'client' AFTER `password`;

-- If the column already exists and you want to update values, use:
-- UPDATE `login` SET `role` = 'client' WHERE `role` IS NULL OR `role` = '';

-- To set a user as a garbage collector:
-- UPDATE `login` SET `role` = 'collector' WHERE `login_id` = <USER_ID>;
