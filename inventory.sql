-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 04, 2020 at 03:21 AM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.28-3+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `goods_receipt`
--

CREATE TABLE `goods_receipt` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchase_order` int(10) UNSIGNED NOT NULL,
  `document_no` varchar(115) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `goods_receipt`
--

INSERT INTO `goods_receipt` (`id`, `purchase_order`, `document_no`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'GR-280377732', 1, '2020-03-21 08:57:49', '2020-03-21 08:57:49'),
(2, 4, 'GR-545872641', 2, '2020-03-21 08:57:59', '2020-03-23 19:29:30'),
(3, 5, 'GR-731762609', 2, '2020-04-01 16:18:16', '2020-04-01 16:19:08'),
(4, 6, 'GR-1802196402', 2, '2020-04-03 13:13:10', '2020-04-03 13:13:58');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_03_01_152608_create_supplier', 2),
(4, '2020_03_05_183645_create_table_produk', 3),
(5, '2020_03_13_175404_add_buy', 4),
(6, '2020_03_14_153127_create_table_po', 5),
(7, '2020_03_14_160641_purchase_order_line', 6),
(8, '2020_03_17_022032_m_status', 7),
(9, '2020_03_17_022225_alter_table_po', 8),
(10, '2020_03_21_142104_goods_receipt', 9),
(11, '2020_03_27_020821_table_sales', 10),
(12, '2020_03_27_021706_table_sales_line', 11),
(13, '2020_03_27_021919_alter_sales_line', 12),
(14, '2020_03_28_011346_alter_sales', 13),
(15, '2020_03_31_184729_perusahaan', 14);

-- --------------------------------------------------------

--
-- Table structure for table `m_produk`
--

CREATE TABLE `m_produk` (
  `id` int(10) UNSIGNED NOT NULL,
  `supplier` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `minimal_stock` int(11) NOT NULL,
  `buy` int(11) DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_produk`
--

INSERT INTO `m_produk` (`id`, `supplier`, `nama`, `kode`, `stock`, `minimal_stock`, `buy`, `harga`, `created_at`, `updated_at`) VALUES
(2, 2, 'Produk kedua', '281781869', 57, 15, 10000, 25000, '2020-03-05 12:05:49', '2020-04-03 13:14:49'),
(3, 2, 'Test Product', '2140560417', 5, 10, 15000, 50000, '2020-03-08 08:54:07', '2020-04-03 12:56:45');

-- --------------------------------------------------------

--
-- Table structure for table `m_status`
--

CREATE TABLE `m_status` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(115) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_status`
--

INSERT INTO `m_status` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Pending', NULL, NULL),
(2, 'Complete', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_supplier`
--

CREATE TABLE `m_supplier` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_supplier`
--

INSERT INTO `m_supplier` (`id`, `nama`, `alamat`, `no_telp`, `created_at`, `updated_at`) VALUES
(2, 'PT. Sangcahaya.com', 'Bekasi', '123', '2020-03-03 07:52:15', '2020-03-04 09:46:25');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(115) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(115) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`id`, `nama`, `no_telp`, `alamat`, `email`, `created_at`, `updated_at`) VALUES
(1, 'PT.  Fadly.net', '123', 'Bekasi', 'fadly@sangcahaya.com', NULL, '2020-04-01 07:11:47');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `document_no` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier` int(10) UNSIGNED NOT NULL,
  `status` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`id`, `document_no`, `supplier`, `status`, `created_at`, `updated_at`) VALUES
(3, 'PO-252997309', 2, 2, '2020-03-16 19:24:21', '2020-03-21 08:57:49'),
(4, 'PO-2068876756', 2, 2, '2020-03-21 07:17:42', '2020-03-21 08:57:58'),
(5, 'PO-1441835154', 2, 2, '2020-04-01 16:17:22', '2020-04-01 16:18:16'),
(6, 'PO-1706966692', 2, 2, '2020-04-03 13:12:20', '2020-04-03 13:13:10');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_line`
--

CREATE TABLE `purchase_order_line` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchase_order` int(10) UNSIGNED NOT NULL,
  `produk` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `buy` int(11) DEFAULT NULL,
  `grand_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_order_line`
--

INSERT INTO `purchase_order_line` (`id`, `purchase_order`, `produk`, `qty`, `buy`, `grand_total`) VALUES
(5, 3, 3, 7, 15000, 105000),
(6, 4, 2, 2, 10000, 20000),
(7, 4, 3, 3, 15000, 45000),
(8, 5, 2, 200, 10000, 2000000),
(9, 5, 3, 500, 15000, 7500000),
(10, 6, 2, 50, 10000, 500000);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `no_struk` varchar(115) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_bayar` int(11) DEFAULT NULL,
  `kembalian` int(11) DEFAULT NULL,
  `grand_total` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `no_struk`, `jumlah_bayar`, `kembalian`, `grand_total`, `created_at`, `updated_at`) VALUES
(3, '116791006', NULL, NULL, 125000, '2020-03-26 19:40:34', '2020-03-26 19:40:34'),
(4, '1664518858', NULL, NULL, 25000, '2020-03-27 17:58:10', '2020-03-27 17:58:10'),
(5, '1049933564', NULL, NULL, 50000, '2020-03-27 17:58:44', '2020-03-27 17:58:44'),
(6, '695123184', NULL, NULL, 50000, '2020-03-27 18:12:09', '2020-03-27 18:12:09'),
(7, '1926713964', 1000000, 750000, 250000, '2020-03-27 18:17:34', '2020-03-27 18:17:34'),
(8, '109848323', 100000, 75000, 25000, '2020-03-27 18:17:51', '2020-03-27 18:17:51'),
(9, '553070650', 200000, 100000, 100000, '2020-03-27 18:20:52', '2020-03-27 18:20:52'),
(11, '1243237653', 200000, 50000, 150000, '2020-03-27 18:25:11', '2020-03-27 18:25:11'),
(12, '451311929', 25000, 0, 25000, '2020-04-01 16:20:53', '2020-04-01 16:20:53'),
(13, '1524062124', 100000, 0, 100000, '2020-04-01 16:21:09', '2020-04-01 16:21:09'),
(14, '973038432', 50000, 0, 50000, '2020-04-03 12:56:10', '2020-04-03 12:56:10'),
(15, '906452905', 100000, 0, 100000, '2020-04-03 12:56:28', '2020-04-03 12:56:28'),
(16, '1287352975', 50000, 0, 50000, '2020-04-03 12:56:36', '2020-04-03 12:56:36'),
(17, '1683239774', 100000, 50000, 50000, '2020-04-03 12:56:45', '2020-04-03 12:56:45'),
(18, '1814981006', 50000, 25000, 25000, '2020-04-03 13:14:49', '2020-04-03 13:14:49');

-- --------------------------------------------------------

--
-- Table structure for table `sales_line`
--

CREATE TABLE `sales_line` (
  `id` int(10) UNSIGNED NOT NULL,
  `sales` int(10) UNSIGNED NOT NULL,
  `produk` int(10) UNSIGNED NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `grand_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_line`
--

INSERT INTO `sales_line` (`id`, `sales`, `produk`, `harga`, `qty`, `grand_total`) VALUES
(5, 3, 2, 25000, 3, 75000),
(6, 3, 3, 50000, 1, 50000),
(7, 4, 2, 25000, 1, 25000),
(8, 5, 2, 25000, 2, 50000),
(9, 6, 2, 25000, 2, 50000),
(10, 7, 2, 25000, 10, 250000),
(11, 8, 2, 25000, 1, 25000),
(12, 9, 2, 25000, 2, 50000),
(13, 9, 3, 50000, 1, 50000),
(15, 11, 3, 50000, 3, 150000),
(16, 12, 2, 25000, 1, 25000),
(17, 13, 3, 50000, 2, 100000),
(18, 14, 2, 25000, 2, 50000),
(19, 15, 3, 50000, 2, 100000),
(20, 16, 3, 50000, 1, 50000),
(21, 17, 3, 50000, 1, 50000),
(22, 18, 2, 25000, 1, 25000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@sangcahaya.com', NULL, '$2y$10$8hDLlK3mE5AWs7MUznklkeyS9A5ko0agl/yaWVh/1B3yQWN/xPPcS', NULL, '2020-02-29 20:44:48', '2020-02-29 20:44:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `goods_receipt`
--
ALTER TABLE `goods_receipt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_produk`
--
ALTER TABLE `m_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `m_produk_supplier_foreign` (`supplier`);

--
-- Indexes for table `m_status`
--
ALTER TABLE `m_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_supplier`
--
ALTER TABLE `m_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_order_status_foreign` (`status`);

--
-- Indexes for table `purchase_order_line`
--
ALTER TABLE `purchase_order_line`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_order_line_purchase_order_foreign` (`purchase_order`),
  ADD KEY `purchase_order_line_produk_foreign` (`produk`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_line`
--
ALTER TABLE `sales_line`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_line_sales_foreign` (`sales`),
  ADD KEY `sales_line_produk_foreign` (`produk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `goods_receipt`
--
ALTER TABLE `goods_receipt`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `m_produk`
--
ALTER TABLE `m_produk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `m_status`
--
ALTER TABLE `m_status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `m_supplier`
--
ALTER TABLE `m_supplier`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `purchase_order_line`
--
ALTER TABLE `purchase_order_line`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `sales_line`
--
ALTER TABLE `sales_line`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_produk`
--
ALTER TABLE `m_produk`
  ADD CONSTRAINT `m_produk_supplier_foreign` FOREIGN KEY (`supplier`) REFERENCES `m_supplier` (`id`);

--
-- Constraints for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD CONSTRAINT `purchase_order_status_foreign` FOREIGN KEY (`status`) REFERENCES `m_status` (`id`);

--
-- Constraints for table `purchase_order_line`
--
ALTER TABLE `purchase_order_line`
  ADD CONSTRAINT `purchase_order_line_produk_foreign` FOREIGN KEY (`produk`) REFERENCES `m_produk` (`id`),
  ADD CONSTRAINT `purchase_order_line_purchase_order_foreign` FOREIGN KEY (`purchase_order`) REFERENCES `purchase_order` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales_line`
--
ALTER TABLE `sales_line`
  ADD CONSTRAINT `sales_line_produk_foreign` FOREIGN KEY (`produk`) REFERENCES `m_produk` (`id`),
  ADD CONSTRAINT `sales_line_sales_foreign` FOREIGN KEY (`sales`) REFERENCES `sales` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
