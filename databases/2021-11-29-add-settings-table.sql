CREATE TABLE `db_settings` (
  `name` varchar(250) COLLATE 'utf8_general_ci' NOT NULL,
  `value` mediumtext COLLATE 'utf8_general_ci' NULL,
  `options` json NULL
);

ALTER TABLE `db_settings`
ADD PRIMARY KEY `PRIMARY` (`name`);
