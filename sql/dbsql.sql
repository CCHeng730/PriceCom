create database priceCom;

CREATE TABLE `User` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_no` text NOT NULL,
  `email` text NOT NULL,
  `gender` int COMMENT '0 male 1 female' NOT NULL,
  `status` int COMMENT '0 inactive 1 active' NOT NULL,
  `image` varchar(255),
  `created_at` datetime,
  `deleted_at` datetime NULL
);

CREATE TABLE `Admin` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_no` text NOT NULL,
  `email` text NOT NULL,
  `gender` int COMMENT '0 male 1 female' NOT NULL,
  `super` int DEFAULT 0 COMMENT '0 normal 1 super' NOT NULL,
  `image` varchar(255),
  `created_at` datetime,
  `deleted_at` datetime NULL
);

CREATE TABLE `Product` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `name` text NOT NULL,
  `description` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime,
  `deleted_at` datetime NULL
);

CREATE TABLE `ProductStore` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `name` text NOT NULL,
  `price` double NOT NULL,
  `created_at` datetime,
  `deleted_at` datetime NULL
);

CREATE TABLE `Category` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `status` int COMMENT '0 inactive 1 active' NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime,
  `deleted_at` datetime NULL
);

CREATE TABLE `Purchase_history` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_store_id` int NOT NULL,
  `product_name` text NOT NULL,
  `product_price` double NOT NULL,
  `shipping_fee` double NOT NULL,
  `total` double NOT NULL,
  `created_at` datetime
);

CREATE TABLE `Feedback` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_store_id` int NOT NULL,
  `order_id` int NOT NULL,
  `rate` int NOT NULL,
  `comment` longtext NULL,
  `created_at` datetime
);

INSERT INTO `admin` (`id`, `username`, `password`, `phone_no`, `email`, `gender`, `super`, `image`, `created_at`) VALUES (NULL, 'admin', '$1e9b9929c3f11344c874cf40c24e94c19353e8061f2befecb6818ba0c034c632fb0bcae1b', '012345876', 'admin@admin.com', '1', '1', NULL, '2022-03-07 15:54:15.000000');
INSERT INTO `user` (`id`, `username`, `password`, `phone_no`, `email`, `gender`, `status`, `image`, `created_at`) VALUES (NULL, 'root', '$14b8662d7e1074290ef56bac4e57adac2353e8061f2befecb6818ba0c034c632fb0bcae1b', '019825614', 'root@root.com', '1', '1', NULL, '2022-03-07 16:04:37.000000');


