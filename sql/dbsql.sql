create database priceCom;

CREATE TABLE `User` (
  `id` int PRIMARY KEY NOT NULL,
  `username` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_no` text NOT NULL,
  `email` text NOT NULL,
  `gender` int COMMENT '0 male 1 female' NOT NULL,
  `status` int COMMENT '0 inactive 1 active' NOT NULL,
  `image` varchar(255),
  `created_at` datetime,
  `deleted_at` datetime,
);

CREATE TABLE `Admin` (
  `id` int PRIMARY KEY NOT NULL,
  `username` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_no` text NOT NULL,
  `email` text NOT NULL,
  `gender` int COMMENT '0 male 1 female' NOT NULL,
  `super` int DEFAULT 0 COMMENT '0 normal 1 super' NOT NULL,
  `image` varchar(255),
  `created_at` datetime,
  `deleted_at` datetime
);

CREATE TABLE `Product` (
  `id` int PRIMARY KEY NOT NULL,
  `category_id` int NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime,
  `deleted_at` datetime
);

CREATE TABLE `ProductStore` (
  `id` int PRIMARY KEY NOT NULL,
  `product_id` int NOT NULL,
  `name` text NOT NULL,
  `price` double NOT NULL,
  `created_at` datetime,
  `deleted_at` datetime
);

CREATE TABLE `Category` (
  `id` int PRIMARY KEY NOT NULL,
  `name` text NOT NULL,
  `status` int COMMENT '0 inactive 1 active' NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime,
  `deleted_at` datetime
);

CREATE TABLE `Purchase_history` (
  `id` int PRIMARY KEY NOT NULL,
  `user_id` int NOT NULL,
  `product_store_id` int NOT NULL,
  `created_at` datetime
);

