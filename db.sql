-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 23, 2022 lúc 06:01 PM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quan_li_f0`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giangvien`
--

CREATE TABLE `giangvien` (
  `ma_gv` int(10) UNSIGNED NOT NULL,
  `ten_gv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `giangvien`
--

INSERT INTO `giangvien` (`ma_gv`, `ten_gv`, `email`, `password`) VALUES
(1, 'GV 01', 'gv1@edu.vn', '$2a$12$bkYcKFvaEWMD11IgskTbd.lnZ5ccPwME/pz6e0pB/hp0ga1J9Fr.O'),
(2, 'GV 02', '', ''),
(3, 'GV 03', '', ''),
(4, 'GV 04', '', ''),
(5, 'GV 05', '', ''),
(6, 'GV 06', '', ''),
(7, 'GV 07', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gvlopmh`
--

CREATE TABLE `gvlopmh` (
  `ma_lop_mh` int(10) UNSIGNED NOT NULL,
  `ma_gv` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gvlopmhhinhthucday`
--

CREATE TABLE `gvlopmhhinhthucday` (
  `ma_gv` int(10) UNSIGNED NOT NULL,
  `ma_lop_mh` int(10) UNSIGNED NOT NULL,
  `ma_ht` int(10) UNSIGNED NOT NULL,
  `tu_ngay` date NOT NULL,
  `den_ngay` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinhthucday`
--

CREATE TABLE `hinhthucday` (
  `ma_ht` int(10) UNSIGNED NOT NULL,
  `ten_ht` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lop`
--

CREATE TABLE `lop` (
  `ma_lop` int(10) UNSIGNED NOT NULL,
  `ten_lop` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lop`
--

INSERT INTO `lop` (`ma_lop`, `ten_lop`) VALUES
(1, 'Lop 1'),
(2, 'Lop 2');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lopmonhoc`
--

CREATE TABLE `lopmonhoc` (
  `ma_lop_mh` int(10) UNSIGNED NOT NULL,
  `id_zoom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass_zoom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phong_hoc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ca_hoc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `host_key_zoom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_mh` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lopmonhoc`
--

INSERT INTO `lopmonhoc` (`ma_lop_mh`, `id_zoom`, `pass_zoom`, `phong_hoc`, `ca_hoc`, `thu`, `host_key_zoom`, `ma_mh`) VALUES
(1, '34234234aaa1', '23241', 'phong 1', 'ca11', 'thu 11', '2342342341', 1),
(2, '34234234aaa2', '23242', 'phong 2', 'ca12', 'thu 12', '2342342342', 2),
(3, '34234234aaa3', '23243', 'phong 3', 'ca13', 'thu 13', '2342342343', 3),
(4, '34234234aaa4', '23244', 'phong 4', 'ca14', 'thu 14', '2342342344', 4),
(5, '34234234aaa5', '23245', 'phong 5', 'ca15', 'thu 15', '2342342345', 5),
(6, '34234234aaa6', '23246', 'phong 6', 'ca16', 'thu 16', '2342342346', 6),
(7, '34234234aaa7', '23247', 'phong 7', 'ca17', 'thu 17', '2342342347', 7),
(8, '34234234aaa8', '23248', 'phong 8', 'ca18', 'thu 18', '2342342348', 8),
(9, '34234234aaa9', '23249', 'phong 9', 'ca19', 'thu 19', '2342342349', 9),
(10, '34234234aaa10', '232410', 'phong 10', 'ca110', 'thu 110', '23423423410', 10),
(11, '34234234aaa11', '232411', 'phong 11', 'ca111', 'thu 111', '23423423411', 11),
(12, '34234234aaa12', '232412', 'phong 12', 'ca112', 'thu 112', '23423423412', 12),
(13, '34234234aaa13', '232413', 'phong 13', 'ca113', 'thu 113', '23423423413', 13),
(14, '34234234aaa14', '232414', 'phong 14', 'ca114', 'thu 114', '23423423414', 14),
(15, '34234234aaa15', '232415', 'phong 15', 'ca115', 'thu 115', '23423423415', 15),
(16, '34234234aaa16', '232416', 'phong 16', 'ca116', 'thu 116', '23423423416', 16),
(17, '34234234aaa17', '232417', 'phong 17', 'ca117', 'thu 117', '23423423417', 17),
(18, '34234234aaa18', '232418', 'phong 18', 'ca118', 'thu 118', '23423423418', 18),
(19, '34234234aaa19', '232419', 'phong 19', 'ca119', 'thu 119', '23423423419', 19),
(20, '34234234aaa20', '232420', 'phong 20', 'ca120', 'thu 120', '23423423420', 20),
(21, '34234234aaa21', '232421', 'phong 21', 'ca121', 'thu 121', '23423423421', 21),
(22, '34234234aaa22', '232422', 'phong 22', 'ca122', 'thu 122', '23423423422', 22),
(23, '34234234aaa23', '232423', 'phong 23', 'ca123', 'thu 123', '23423423423', 23),
(24, '34234234aaa24', '232424', 'phong 24', 'ca124', 'thu 124', '23423423424', 24),
(25, '34234234aaa25', '232425', 'phong 25', 'ca125', 'thu 125', '23423423425', 25),
(26, '34234234aaa26', '232426', 'phong 26', 'ca126', 'thu 126', '23423423426', 26),
(27, '34234234aaa27', '232427', 'phong 27', 'ca127', 'thu 127', '23423423427', 27),
(28, '34234234aaa28', '232428', 'phong 28', 'ca128', 'thu 128', '23423423428', 28),
(29, '34234234aaa29', '232429', 'phong 29', 'ca129', 'thu 129', '23423423429', 29),
(30, '34234234aaa30', '232430', 'phong 30', 'ca130', 'thu 130', '23423423430', 30),
(31, '34234234aaa31', '232431', 'phong 31', 'ca131', 'thu 131', '23423423431', 31),
(32, '34234234aaa32', '232432', 'phong 32', 'ca132', 'thu 132', '23423423432', 32),
(33, '34234234aaa33', '232433', 'phong 33', 'ca133', 'thu 133', '23423423433', 33),
(34, '34234234aaa34', '232434', 'phong 34', 'ca134', 'thu 134', '23423423434', 34),
(35, '34234234aaa35', '232435', 'phong 35', 'ca135', 'thu 135', '23423423435', 35),
(36, '34234234aaa36', '232436', 'phong 36', 'ca136', 'thu 136', '23423423436', 36),
(37, '34234234aaa37', '232437', 'phong 37', 'ca137', 'thu 137', '23423423437', 37),
(38, '34234234aaa38', '232438', 'phong 38', 'ca138', 'thu 138', '23423423438', 38),
(39, '34234234aaa39', '232439', 'phong 39', 'ca139', 'thu 139', '23423423439', 39),
(40, '34234234aaa40', '232440', 'phong 40', 'ca140', 'thu 140', '23423423440', 40),
(41, '34234234aaa41', '232441', 'phong 41', 'ca141', 'thu 141', '23423423441', 41),
(42, '34234234aaa42', '232442', 'phong 42', 'ca142', 'thu 142', '23423423442', 42),
(43, '34234234aaa43', '232443', 'phong 43', 'ca143', 'thu 143', '23423423443', 43),
(44, '34234234aaa44', '232444', 'phong 44', 'ca144', 'thu 144', '23423423444', 44),
(45, '34234234aaa45', '232445', 'phong 45', 'ca145', 'thu 145', '23423423445', 45),
(46, '34234234aaa46', '232446', 'phong 46', 'ca146', 'thu 146', '23423423446', 46),
(47, '34234234aaa47', '232447', 'phong 47', 'ca147', 'thu 147', '23423423447', 47),
(48, '34234234aaa48', '232448', 'phong 48', 'ca148', 'thu 148', '23423423448', 48),
(49, '34234234aaa49', '232449', 'phong 49', 'ca149', 'thu 149', '23423423449', 49);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2022_04_12_160132_create_sinhvien_table', 1),
(3, '2022_04_12_160320_create_giangvien_table', 1),
(4, '2022_04_12_160402_create_lop_table', 1),
(5, '2022_04_12_160439_create_monhoc_table', 1),
(6, '2022_04_12_160547_create_lopmonhoc_table', 1),
(7, '2022_04_12_161003_create_phieukhaibaosv_table', 1),
(8, '2022_04_12_161205_create_phieukhaibaogv_table', 1),
(9, '2022_04_12_161311_create_gvlopmh_table', 1),
(10, '2022_04_12_161446_create_hinhthucday_table', 1),
(11, '2022_04_12_161546_create_gvlopmhhinhthucday_table', 1),
(12, '2022_04_12_161757_create_svlopmonhoc_table', 1),
(13, '2022_04_23_072407_create_admins_table', 2),
(14, '2022_04_23_094824_modify_ngay_gio_bao_khoi_to_nullable_phieukhaibaogv_table', 3),
(15, '2022_04_23_095551_modify_ngay_gio_bao_khoi_to_nullable_phieukhaibaosv_table', 4),
(18, '2022_04_23_103229_add_email_password_to_sinhvien_table', 5),
(19, '2022_04_23_103249_add_email_password_to_giangvien_table', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `monhoc`
--

CREATE TABLE `monhoc` (
  `ma_mh` int(10) UNSIGNED NOT NULL,
  `ten_mh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `monhoc`
--

INSERT INTO `monhoc` (`ma_mh`, `ten_mh`) VALUES
(1, 'mon hoc 1'),
(2, 'mon hoc 2'),
(3, 'mon hoc 3'),
(4, 'mon hoc 4'),
(5, 'mon hoc 5'),
(6, 'mon hoc 6'),
(7, 'mon hoc 7'),
(8, 'mon hoc 8'),
(9, 'mon hoc 9'),
(10, 'mon hoc 10'),
(11, 'mon hoc 11'),
(12, 'mon hoc 12'),
(13, 'mon hoc 13'),
(14, 'mon hoc 14'),
(15, 'mon hoc 15'),
(16, 'mon hoc 16'),
(17, 'mon hoc 17'),
(18, 'mon hoc 18'),
(19, 'mon hoc 19'),
(20, 'mon hoc 20'),
(21, 'mon hoc 21'),
(22, 'mon hoc 22'),
(23, 'mon hoc 23'),
(24, 'mon hoc 24'),
(25, 'mon hoc 25'),
(26, 'mon hoc 26'),
(27, 'mon hoc 27'),
(28, 'mon hoc 28'),
(29, 'mon hoc 29'),
(30, 'mon hoc 30'),
(31, 'mon hoc 31'),
(32, 'mon hoc 32'),
(33, 'mon hoc 33'),
(34, 'mon hoc 34'),
(35, 'mon hoc 35'),
(36, 'mon hoc 36'),
(37, 'mon hoc 37'),
(38, 'mon hoc 38'),
(39, 'mon hoc 39'),
(40, 'mon hoc 40'),
(41, 'mon hoc 41'),
(42, 'mon hoc 42'),
(43, 'mon hoc 43'),
(44, 'mon hoc 44'),
(45, 'mon hoc 45'),
(46, 'mon hoc 46'),
(47, 'mon hoc 47'),
(48, 'mon hoc 48'),
(49, 'mon hoc 49');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieukhaibaogv`
--

CREATE TABLE `phieukhaibaogv` (
  `ma_phieu` int(10) UNSIGNED NOT NULL,
  `ngay_gio_bao_benh` datetime NOT NULL,
  `ngay_gio_bao_khoi` datetime DEFAULT NULL,
  `ma_gv` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phieukhaibaogv`
--

INSERT INTO `phieukhaibaogv` (`ma_phieu`, `ngay_gio_bao_benh`, `ngay_gio_bao_khoi`, `ma_gv`) VALUES
(1, '2022-04-01 16:02:33', '2022-04-10 14:09:50', 1),
(2, '2022-03-01 16:02:33', NULL, 2),
(3, '2022-04-01 16:02:33', '2022-04-10 14:09:50', 3),
(4, '2022-02-01 16:02:33', '2022-02-10 14:09:50', 4),
(5, '2022-03-01 16:02:33', '2022-03-10 14:09:50', 5),
(6, '2022-02-01 16:02:33', '2022-02-10 14:09:50', 6),
(7, '2022-04-01 16:02:33', '2022-04-08 14:09:50', 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieukhaibaosv`
--

CREATE TABLE `phieukhaibaosv` (
  `ma_phieu` int(10) UNSIGNED NOT NULL,
  `ngay_gio_bao_benh` datetime NOT NULL,
  `ngay_gio_bao_khoi` datetime DEFAULT NULL,
  `ma_sv` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phieukhaibaosv`
--

INSERT INTO `phieukhaibaosv` (`ma_phieu`, `ngay_gio_bao_benh`, `ngay_gio_bao_khoi`, `ma_sv`) VALUES
(1, '2022-01-20 00:00:00', '2022-02-20 00:00:00', 1),
(2, '2022-01-20 00:00:00', '2022-02-20 00:00:00', 2),
(3, '2022-01-20 00:00:00', '2022-02-20 00:00:00', 3),
(4, '2022-01-20 00:00:00', '2022-02-20 00:00:00', 4),
(5, '2022-01-20 00:00:00', '2022-02-20 00:00:00', 5),
(6, '2022-04-10 00:00:00', '2022-04-20 00:00:00', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phongdaotao`
--

CREATE TABLE `phongdaotao` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phongdaotao`
--

INSERT INTO `phongdaotao` (`id`, `email`, `name`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin@admin.com', 'Test123', '$2a$12$SHB8aHgtcn5AiJj/HP74i.bv1O7uDcDopPkyVfOjscpNBNgOhc8wq', '2022-04-23 07:55:38', '2022-04-23 07:55:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinhvien`
--

CREATE TABLE `sinhvien` (
  `ma_sv` int(10) UNSIGNED NOT NULL,
  `ten_sv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_lop` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sinhvien`
--

INSERT INTO `sinhvien` (`ma_sv`, `ten_sv`, `email`, `password`, `ma_lop`) VALUES
(1, 'Nguyen Van 1', 'sv1@edu.vn', '$2a$12$bkYcKFvaEWMD11IgskTbd.lnZ5ccPwME/pz6e0pB/hp0ga1J9Fr.O', 1),
(2, 'Nguyen Van 2', 'sv2@edu.vn', '$2a$12$bkYcKFvaEWMD11IgskTbd.lnZ5ccPwME/pz6e0pB/hp0ga1J9Fr.O', 1),
(3, 'Nguyen Van 3', 'sv3@edu.vn', '$2a$12$bkYcKFvaEWMD11IgskTbd.lnZ5ccPwME/pz6e0pB/hp0ga1J9Fr.O', 1),
(4, 'Nguyen Van 4', 'sv4@edu.vn', '$2a$12$bkYcKFvaEWMD11IgskTbd.lnZ5ccPwME/pz6e0pB/hp0ga1J9Fr.O', 2),
(5, 'Nguyen Van 5', 'sv5@edu.vn', '$2a$12$bkYcKFvaEWMD11IgskTbd.lnZ5ccPwME/pz6e0pB/hp0ga1J9Fr.O', 2),
(6, 'Nguyen Van 6', 'sv6@edu.vn', '$2a$12$bkYcKFvaEWMD11IgskTbd.lnZ5ccPwME/pz6e0pB/hp0ga1J9Fr.O', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `svlopmonhoc`
--

CREATE TABLE `svlopmonhoc` (
  `ma_sv` int(10) UNSIGNED NOT NULL,
  `ma_lop_mh` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `svlopmonhoc`
--

INSERT INTO `svlopmonhoc` (`ma_sv`, `ma_lop_mh`) VALUES
(1, 25),
(2, 43),
(3, 34),
(4, 19),
(5, 48);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `giangvien`
--
ALTER TABLE `giangvien`
  ADD PRIMARY KEY (`ma_gv`);

--
-- Chỉ mục cho bảng `gvlopmh`
--
ALTER TABLE `gvlopmh`
  ADD PRIMARY KEY (`ma_lop_mh`,`ma_gv`),
  ADD KEY `gvlopmh_ma_gv_foreign` (`ma_gv`);

--
-- Chỉ mục cho bảng `gvlopmhhinhthucday`
--
ALTER TABLE `gvlopmhhinhthucday`
  ADD PRIMARY KEY (`ma_gv`,`ma_lop_mh`,`ma_ht`),
  ADD KEY `gvlopmhhinhthucday_ma_lop_mh_foreign` (`ma_lop_mh`),
  ADD KEY `gvlopmhhinhthucday_ma_ht_foreign` (`ma_ht`);

--
-- Chỉ mục cho bảng `hinhthucday`
--
ALTER TABLE `hinhthucday`
  ADD PRIMARY KEY (`ma_ht`);

--
-- Chỉ mục cho bảng `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`ma_lop`);

--
-- Chỉ mục cho bảng `lopmonhoc`
--
ALTER TABLE `lopmonhoc`
  ADD PRIMARY KEY (`ma_lop_mh`),
  ADD KEY `lopmonhoc_ma_mh_foreign` (`ma_mh`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `monhoc`
--
ALTER TABLE `monhoc`
  ADD PRIMARY KEY (`ma_mh`);

--
-- Chỉ mục cho bảng `phieukhaibaogv`
--
ALTER TABLE `phieukhaibaogv`
  ADD PRIMARY KEY (`ma_phieu`),
  ADD KEY `phieukhaibaogv_ma_gv_foreign` (`ma_gv`);

--
-- Chỉ mục cho bảng `phieukhaibaosv`
--
ALTER TABLE `phieukhaibaosv`
  ADD PRIMARY KEY (`ma_phieu`),
  ADD KEY `phieukhaibaosv_ma_sv_foreign` (`ma_sv`);

--
-- Chỉ mục cho bảng `phongdaotao`
--
ALTER TABLE `phongdaotao`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`ma_sv`),
  ADD KEY `sinhvien_ma_lop_foreign` (`ma_lop`);

--
-- Chỉ mục cho bảng `svlopmonhoc`
--
ALTER TABLE `svlopmonhoc`
  ADD PRIMARY KEY (`ma_sv`,`ma_lop_mh`),
  ADD KEY `svlopmonhoc_ma_lop_mh_foreign` (`ma_lop_mh`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `giangvien`
--
ALTER TABLE `giangvien`
  MODIFY `ma_gv` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `hinhthucday`
--
ALTER TABLE `hinhthucday`
  MODIFY `ma_ht` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lop`
--
ALTER TABLE `lop`
  MODIFY `ma_lop` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `lopmonhoc`
--
ALTER TABLE `lopmonhoc`
  MODIFY `ma_lop_mh` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `monhoc`
--
ALTER TABLE `monhoc`
  MODIFY `ma_mh` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT cho bảng `phieukhaibaogv`
--
ALTER TABLE `phieukhaibaogv`
  MODIFY `ma_phieu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `phieukhaibaosv`
--
ALTER TABLE `phieukhaibaosv`
  MODIFY `ma_phieu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `phongdaotao`
--
ALTER TABLE `phongdaotao`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  MODIFY `ma_sv` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `gvlopmh`
--
ALTER TABLE `gvlopmh`
  ADD CONSTRAINT `gvlopmh_ma_gv_foreign` FOREIGN KEY (`ma_gv`) REFERENCES `giangvien` (`ma_gv`),
  ADD CONSTRAINT `gvlopmh_ma_lop_mh_foreign` FOREIGN KEY (`ma_lop_mh`) REFERENCES `lopmonhoc` (`ma_lop_mh`);

--
-- Các ràng buộc cho bảng `gvlopmhhinhthucday`
--
ALTER TABLE `gvlopmhhinhthucday`
  ADD CONSTRAINT `gvlopmhhinhthucday_ma_gv_foreign` FOREIGN KEY (`ma_gv`) REFERENCES `giangvien` (`ma_gv`),
  ADD CONSTRAINT `gvlopmhhinhthucday_ma_ht_foreign` FOREIGN KEY (`ma_ht`) REFERENCES `hinhthucday` (`ma_ht`),
  ADD CONSTRAINT `gvlopmhhinhthucday_ma_lop_mh_foreign` FOREIGN KEY (`ma_lop_mh`) REFERENCES `lopmonhoc` (`ma_lop_mh`);

--
-- Các ràng buộc cho bảng `lopmonhoc`
--
ALTER TABLE `lopmonhoc`
  ADD CONSTRAINT `lopmonhoc_ma_mh_foreign` FOREIGN KEY (`ma_mh`) REFERENCES `monhoc` (`ma_mh`);

--
-- Các ràng buộc cho bảng `phieukhaibaogv`
--
ALTER TABLE `phieukhaibaogv`
  ADD CONSTRAINT `phieukhaibaogv_ma_gv_foreign` FOREIGN KEY (`ma_gv`) REFERENCES `giangvien` (`ma_gv`);

--
-- Các ràng buộc cho bảng `phieukhaibaosv`
--
ALTER TABLE `phieukhaibaosv`
  ADD CONSTRAINT `phieukhaibaosv_ma_sv_foreign` FOREIGN KEY (`ma_sv`) REFERENCES `sinhvien` (`ma_sv`);

--
-- Các ràng buộc cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `sinhvien_ma_lop_foreign` FOREIGN KEY (`ma_lop`) REFERENCES `lop` (`ma_lop`);

--
-- Các ràng buộc cho bảng `svlopmonhoc`
--
ALTER TABLE `svlopmonhoc`
  ADD CONSTRAINT `svlopmonhoc_ma_lop_mh_foreign` FOREIGN KEY (`ma_lop_mh`) REFERENCES `lopmonhoc` (`ma_lop_mh`),
  ADD CONSTRAINT `svlopmonhoc_ma_sv_foreign` FOREIGN KEY (`ma_sv`) REFERENCES `sinhvien` (`ma_sv`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
