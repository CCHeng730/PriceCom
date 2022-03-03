create database priceCom;

CREATE TABLE `User` (
  `uid` int,
  `username` text,
  `password` varchar(255),
  `phone_no` text,
  `email` text,
  `status` int COMMENT '0 inactive 1 active',
  `created_at` datetime,
  `deleted_at` datetime
);

CREATE TABLE `Admin` (
  `aid` int,
  `username` text,
  `password` varchar(255),
  `phone_no` text,
  `email` text,
  `super` int DEFAULT 0 COMMENT '0 normal 1 super',
  `created_at` datetime,
  `deleted_at` datetime
);

CREATE TABLE `Product` (
  `pid` int,
  `categoryId` int,
  `name` text,
  `description` text,
  `created_at` datetime,
  `deleted_at` datetime
);

CREATE TABLE `ProductStore` (
  `pstoreId` int,
  `pid` int,
  `name` text,
  `price` double,
  `created_at` datetime,
  `deleted_at` datetime
);

CREATE TABLE `Category` (
  `categoryId` int,
  `name` text,
  `status` int COMMENT '0 inactive 1 active',
  `created_at` datetime,
  `deleted_at` datetime
);

CREATE TABLE `PurchaseHistory` (
  `historyId` int,
  `uid` int,
  `pstoreId` int,
  `created_at` datetime
);

