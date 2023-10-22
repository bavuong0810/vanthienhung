CREATE TABLE `db_sent_message` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `customer_id` int NOT NULL,
  `type` varchar(10) NOT NULL,
  `title` varchar(255) COLLATE 'utf8_general_ci' NULL,
  `message` longtext COLLATE 'utf8_general_ci' NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);
