-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2024 at 05:41 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodgrocery`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ngaytao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`username`, `password`, `ngaytao`) VALUES
('dương', '123', NULL),
('duy', '123', NULL),
('huy', '123', NULL),
('khang', '123', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `mahd` int(11) NOT NULL,
  `masp` int(255) NOT NULL,
  `soluong` int(11) NOT NULL,
  `dongia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chitiethoadon`
--

INSERT INTO `chitiethoadon` (`mahd`, `masp`, `soluong`, `dongia`) VALUES
(6, 2, 1, 35000),
(6, 3, 1, 40000),
(7, 2, 1, 35000),
(8, 10, 1, 15000);

-- --------------------------------------------------------

--
-- Table structure for table `chitietphieunhap`
--

CREATE TABLE `chitietphieunhap` (
  `mapn` int(11) NOT NULL,
  `masp` int(255) NOT NULL,
  `soluong` int(11) NOT NULL,
  `gianhap` int(11) NOT NULL,
  `tongtien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chitietphieunhap`
--

INSERT INTO `chitietphieunhap` (`mapn`, `masp`, `soluong`, `gianhap`, `tongtien`) VALUES
(10, 2, 4, 35000, 140000),
(10, 4, 1, 10000, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `danhmuc`
--

CREATE TABLE `danhmuc` (
  `madm` int(255) NOT NULL,
  `tendm` varchar(255) NOT NULL,
  `ishidden` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `danhmuc`
--

INSERT INTO `danhmuc` (`madm`, `tendm`, `ishidden`) VALUES
(1, 'kẹo', 0),
(39, 'đồ chiên', 0),
(42, 'nước', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `mahd` int(11) NOT NULL,
  `makh` int(255) NOT NULL,
  `manv` int(11) NOT NULL,
  `tongtien` int(11) NOT NULL DEFAULT 0,
  `ngay` date NOT NULL,
  `trangthai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hoadon`
--

INSERT INTO `hoadon` (`mahd`, `makh`, `manv`, `tongtien`, `ngay`, `trangthai`) VALUES
(6, 1, 1, 75000, '2024-05-01', 1),
(7, 1, 1, 35000, '2024-05-01', 1),
(8, 1, 1, 15000, '2024-05-02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `makh` int(255) NOT NULL,
  `matk` varchar(255) DEFAULT NULL,
  `hoten` varchar(255) DEFAULT NULL,
  `diachi` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `dienthoai` int(11) DEFAULT NULL,
  `tttk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`makh`, `matk`, `hoten`, `diachi`, `email`, `dienthoai`, `tttk`) VALUES
(1, NULL, 'huy', '179', 'huy@', 98, 0),
(3, 'khang', NULL, NULL, 'khang', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kho`
--

CREATE TABLE `kho` (
  `masp` int(255) NOT NULL,
  `SOLUONG` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kho`
--

INSERT INTO `kho` (`masp`, `SOLUONG`) VALUES
(11, 0),
(3, 0),
(4, 0),
(2, 0),
(10, 0),
(13, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `manv` int(255) NOT NULL,
  `matk` varchar(255) DEFAULT NULL,
  `hoten` varchar(255) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dienthoai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`manv`, `matk`, `hoten`, `diachi`, `email`, `dienthoai`) VALUES
(1, NULL, 'huy', '179', 'huy', 98),
(2, 'duy', 'duy', '180/61', 'duy@gmail.com', 98);

-- --------------------------------------------------------

--
-- Table structure for table `phieunhap`
--

CREATE TABLE `phieunhap` (
  `mapn` int(11) NOT NULL,
  `manv` int(255) DEFAULT NULL,
  `tongtien` int(11) NOT NULL,
  `ngaynhap` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phieunhap`
--

INSERT INTO `phieunhap` (`mapn`, `manv`, `tongtien`, `ngaynhap`) VALUES
(10, 1, 150000, '2024-05-11');

-- --------------------------------------------------------

--
-- Table structure for table `quyen`
--

CREATE TABLE `quyen` (
  `rolename` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quyen`
--

INSERT INTO `quyen` (`rolename`, `username`) VALUES
('khachhang', 'huy'),
('admin', 'huy'),
('nhân viên', 'duy'),
('thaphonnhanvien', 'dương');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_name` varchar(255) NOT NULL,
  `addproduct` tinyint(1) NOT NULL,
  `updateproduct` tinyint(1) NOT NULL,
  `deleteproduct` tinyint(1) NOT NULL,
  `deletedproducts` tinyint(1) NOT NULL,
  `buy` tinyint(1) NOT NULL,
  `printbill` tinyint(1) NOT NULL,
  `deletebill` tinyint(1) NOT NULL,
  `addpn` tinyint(1) NOT NULL,
  `deletpn` tinyint(1) NOT NULL,
  `addaccount` tinyint(1) NOT NULL,
  `updateaccount` tinyint(1) NOT NULL,
  `deleteaccount` tinyint(1) NOT NULL,
  `addrole` tinyint(1) NOT NULL,
  `addcategories` tinyint(1) NOT NULL,
  `updatecategories` tinyint(1) NOT NULL,
  `deletecategories` tinyint(1) NOT NULL,
  `statistics` tinyint(1) NOT NULL,
  `ishidden` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_name`, `addproduct`, `updateproduct`, `deleteproduct`, `deletedproducts`, `buy`, `printbill`, `deletebill`, `addpn`, `deletpn`, `addaccount`, `updateaccount`, `deleteaccount`, `addrole`, `addcategories`, `updatecategories`, `deletecategories`, `statistics`, `ishidden`) VALUES
('admin', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0),
('khachhang', 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('nhân viên', 1, 1, 1, 0, 1, 1, 0, 1, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0),
('thaphonnhanvien', 1, 1, 1, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `masp` int(255) NOT NULL,
  `tensp` varchar(255) NOT NULL,
  `image` varchar(50) NOT NULL,
  `dongia` int(11) NOT NULL,
  `madm` int(255) NOT NULL,
  `motasp` varchar(255) NOT NULL,
  `ishidden` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`masp`, `tensp`, `image`, `dongia`, `madm`, `motasp`, `ishidden`) VALUES
(2, 'gà rán', 'ga_ran.jpg', 35000, 39, 'da giòn,thịt săn chắc', 0),
(3, 'mực chiên xù', 'mực_chiên_xù.jpg', 40000, 39, 'giòn rụm', 0),
(4, 'khoai tây chiên', 'Khoai_tay_chien.jpg', 10000, 39, 'khoai tây chiên giòn', 0),
(10, 'coca cola', 'coca_cola.jpg', 15000, 42, 'mát lạnh, sảng khoái', 0),
(11, 'pepsi', 'pepsi.jpg', 16000, 42, 'quá đã pepsi ơi', 0),
(13, 'SUSHI CHIÊN', 'sushi_chiên.jpg', 35000, 39, 'NGON', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD KEY `chitiethoadon_ibfk_1` (`mahd`),
  ADD KEY `masp` (`masp`);

--
-- Indexes for table `chitietphieunhap`
--
ALTER TABLE `chitietphieunhap`
  ADD KEY `masp` (`masp`),
  ADD KEY `chitietphieunhap_ibfk_3` (`mapn`);

--
-- Indexes for table `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`madm`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`mahd`),
  ADD KEY `manv` (`manv`),
  ADD KEY `makh` (`makh`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`makh`),
  ADD KEY `matk` (`matk`);

--
-- Indexes for table `kho`
--
ALTER TABLE `kho`
  ADD KEY `kho_ibfk_1` (`masp`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`manv`),
  ADD KEY `matk` (`matk`);

--
-- Indexes for table `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD PRIMARY KEY (`mapn`),
  ADD KEY `manv` (`manv`);

--
-- Indexes for table `quyen`
--
ALTER TABLE `quyen`
  ADD KEY `rolename` (`rolename`),
  ADD KEY `quyen_ibfk_2` (`username`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_name`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`masp`),
  ADD KEY `madm` (`madm`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `madm` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `mahd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `makh` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `manv` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `phieunhap`
--
ALTER TABLE `phieunhap`
  MODIFY `mapn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `masp` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD CONSTRAINT `chitiethoadon_ibfk_1` FOREIGN KEY (`mahd`) REFERENCES `hoadon` (`mahd`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chitiethoadon_ibfk_2` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`masp`);

--
-- Constraints for table `chitietphieunhap`
--
ALTER TABLE `chitietphieunhap`
  ADD CONSTRAINT `chitietphieunhap_ibfk_3` FOREIGN KEY (`mapn`) REFERENCES `phieunhap` (`mapn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chitietphieunhap_ibfk_4` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`masp`);

--
-- Constraints for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadon_ibfk_1` FOREIGN KEY (`manv`) REFERENCES `nhanvien` (`manv`),
  ADD CONSTRAINT `hoadon_ibfk_2` FOREIGN KEY (`makh`) REFERENCES `khachhang` (`makh`);

--
-- Constraints for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD CONSTRAINT `khachhang_ibfk_1` FOREIGN KEY (`matk`) REFERENCES `account` (`username`);

--
-- Constraints for table `kho`
--
ALTER TABLE `kho`
  ADD CONSTRAINT `kho_ibfk_1` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`masp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_ibfk_1` FOREIGN KEY (`matk`) REFERENCES `account` (`username`);

--
-- Constraints for table `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD CONSTRAINT `phieunhap_ibfk_1` FOREIGN KEY (`manv`) REFERENCES `nhanvien` (`manv`);

--
-- Constraints for table `quyen`
--
ALTER TABLE `quyen`
  ADD CONSTRAINT `quyen_ibfk_1` FOREIGN KEY (`rolename`) REFERENCES `role` (`role_name`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `quyen_ibfk_2` FOREIGN KEY (`username`) REFERENCES `account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`madm`) REFERENCES `danhmuc` (`madm`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
