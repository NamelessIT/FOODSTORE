-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 20, 2024 lúc 03:48 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `foodgrocery`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ngaytao` date DEFAULT NULL,
  `recovery` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`username`, `password`, `ngaytao`, `recovery`) VALUES
('dương', '123', NULL, 0),
('duy', '123', NULL, 0),
('huy', '123', NULL, 0),
('s', 'ssdđ', NULL, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `mahd` int(11) NOT NULL,
  `masp` int(255) NOT NULL,
  `soluong` int(11) NOT NULL,
  `dongia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitiethoadon`
--

INSERT INTO `chitiethoadon` (`mahd`, `masp`, `soluong`, `dongia`) VALUES
(6, 2, 1, 35000),
(6, 3, 1, 40000),
(7, 2, 1, 35000),
(8, 10, 1, 15000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietphieunhap`
--

CREATE TABLE `chitietphieunhap` (
  `mapn` int(11) NOT NULL,
  `masp` int(255) NOT NULL,
  `soluong` int(11) NOT NULL,
  `gianhap` int(11) NOT NULL,
  `tongtien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietphieunhap`
--

INSERT INTO `chitietphieunhap` (`mapn`, `masp`, `soluong`, `gianhap`, `tongtien`) VALUES
(10, 2, 4, 35000, 140000),
(10, 4, 1, 10000, 10000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `madm` int(255) NOT NULL,
  `tendm` varchar(255) NOT NULL,
  `ishidden` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`madm`, `tendm`, `ishidden`) VALUES
(39, 'đồ chiên', 0),
(42, 'nước', 0),
(43, 'Món nước', 0),
(44, 'Món lẩu', 0),
(45, 'Món khô', 0),
(46, 'Món ăn vặt', 0),
(47, 'Tráng miệng', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
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
-- Đang đổ dữ liệu cho bảng `hoadon`
--

INSERT INTO `hoadon` (`mahd`, `makh`, `manv`, `tongtien`, `ngay`, `trangthai`) VALUES
(6, 1, 1, 75000, '2024-05-01', 1),
(7, 1, 1, 35000, '2024-05-01', 1),
(8, 1, 1, 15000, '2024-05-02', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
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
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`makh`, `matk`, `hoten`, `diachi`, `email`, `dienthoai`, `tttk`) VALUES
(1, NULL, 'huy', '179', 'huy@', 98, 0),
(3, NULL, NULL, NULL, 'khang', NULL, 0),
(25, 's', 'te', 'te', 'te', 123, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kho`
--

CREATE TABLE `kho` (
  `masp` int(255) NOT NULL,
  `SOLUONG` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `kho`
--

INSERT INTO `kho` (`masp`, `SOLUONG`) VALUES
(11, 0),
(3, 0),
(4, 0),
(2, 0),
(10, 0),
(13, 0),
(14, 0),
(16, 0),
(17, 0),
(18, 0),
(19, 0),
(20, 0),
(21, 0),
(22, 0),
(23, 0),
(24, 0),
(25, 0),
(26, 0),
(27, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
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
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`manv`, `matk`, `hoten`, `diachi`, `email`, `dienthoai`) VALUES
(1, NULL, 'huy', '179', 'huy', 98),
(2, 'duy', 'duy', '180/61', 'duy@gmail.com', 98);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieunhap`
--

CREATE TABLE `phieunhap` (
  `mapn` int(11) NOT NULL,
  `manv` int(255) DEFAULT NULL,
  `tongtien` int(11) NOT NULL,
  `ngaynhap` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phieunhap`
--

INSERT INTO `phieunhap` (`mapn`, `manv`, `tongtien`, `ngaynhap`) VALUES
(10, 1, 150000, '2024-05-11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyen`
--

CREATE TABLE `quyen` (
  `rolename` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `quyen`
--

INSERT INTO `quyen` (`rolename`, `username`) VALUES
('khách hàng', 'huy'),
('admin', 'huy'),
('nhân viên', 'duy'),
('thaphonnhanvien', 'dương'),
('khách hàng', 's');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role`
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
  `lockkh` int(11) NOT NULL,
  `deletekh` int(11) NOT NULL,
  `ishidden` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `role`
--

INSERT INTO `role` (`role_name`, `addproduct`, `updateproduct`, `deleteproduct`, `deletedproducts`, `buy`, `printbill`, `deletebill`, `addpn`, `deletpn`, `addaccount`, `updateaccount`, `deleteaccount`, `addrole`, `addcategories`, `updatecategories`, `deletecategories`, `statistics`, `lockkh`, `deletekh`, `ishidden`) VALUES
('admin', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0),
('khách hàng', 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('nhân viên', 1, 1, 1, 0, 1, 1, 0, 1, 0, 0, 0, 0, 0, 1, 1, 1, 0, 1, 0, 0),
('thaphonnhanvien', 1, 1, 1, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
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
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`masp`, `tensp`, `image`, `dongia`, `madm`, `motasp`, `ishidden`) VALUES
(2, 'gà rán', 'ga_ran.jpg', 35000, 39, 'da giòn,thịt săn chắc', 0),
(3, 'mực chiên xù', 'mực_chiên_xù.jpg', 40000, 39, 'giòn rụm', 0),
(4, 'khoai tây chiên', 'Khoai_tay_chien.jpg', 10000, 39, 'khoai tây chiên giòn', 0),
(10, 'coca cola', 'coca_cola.jpg', 15000, 42, 'mát lạnh, sảng khoái', 0),
(11, 'pepsi', 'pepsi.jpg', 16000, 42, 'quá đã pepsi ơi', 0),
(13, 'SUSHI CHIÊN', 'sushi_chiên.jpg', 35000, 39, 'NGON', 0),
(14, 'Bánh tráng cuộn sốt me ', 'banh trang cuon sot me.jpg', 30000, 46, 'nước sốt chua ngọt béo vi trứng thơm mùiđậu phộng', 0),
(16, 'Cơm gà nanban', 'COMGANANBAN.jpg', 39000, 45, 'gà viên giòn nước sốt béo ngậy', 0),
(17, 'fanta', 'fansta.jpg', 10000, 42, 'vị cam mát lạnh giải nhiệt hè', 0),
(18, 'sprite', 'sprite.jpg', 10000, 42, 'vị chanh thanh mát cho mùa hè', 0),
(19, 'thịt ba chỉ nướng', 'thit-ba-chi-nuong-sate.jpg', 125000, 45, 'da heo giòn thơm mùi sa tế ', 0),
(20, 'chè khoai dẻo', 'che khoai deo.jpg', 25000, 47, 'khoai dẻo béo vị nước cốt dừa', 0),
(21, 'chè trái cây', 'che trai cay.jpg', 25000, 47, 'nhiều trái cay thơm nước cốt dừa', 0),
(22, 'Lẩu mắm cá linh', 'lau mam ca linh.jpg', 250000, 44, 'đặc sản miền tây', 0),
(23, 'lẩu chay', 'lau chay.jpg', 150000, 44, 'tốt cho sức khỏe nhiều rau ', 0),
(24, 'lẩu bò nhúng me', 'lau bo nhung me.webp', 285000, 44, 'chua ngọt bò dai ngon', 0),
(25, 'Mì bò kho', 'mi bo kho.jpg', 30000, 43, 'thơm ngon vị bò kho mì dai ngon', 0),
(26, 'Phở bò', 'phở.jpg', 30000, 43, 'phở bò thơm ngon', 0),
(27, 'bún riêu cua', 'bun rieu cua.jpg', 30000, 43, 'món ăn sang thơm ngon', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD KEY `chitiethoadon_ibfk_1` (`mahd`),
  ADD KEY `masp` (`masp`);

--
-- Chỉ mục cho bảng `chitietphieunhap`
--
ALTER TABLE `chitietphieunhap`
  ADD KEY `masp` (`masp`),
  ADD KEY `chitietphieunhap_ibfk_3` (`mapn`);

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`madm`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`mahd`),
  ADD KEY `manv` (`manv`),
  ADD KEY `makh` (`makh`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`makh`),
  ADD KEY `matk` (`matk`);

--
-- Chỉ mục cho bảng `kho`
--
ALTER TABLE `kho`
  ADD KEY `kho_ibfk_1` (`masp`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`manv`),
  ADD KEY `matk` (`matk`);

--
-- Chỉ mục cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD PRIMARY KEY (`mapn`),
  ADD KEY `manv` (`manv`);

--
-- Chỉ mục cho bảng `quyen`
--
ALTER TABLE `quyen`
  ADD KEY `rolename` (`rolename`),
  ADD KEY `quyen_ibfk_2` (`username`);

--
-- Chỉ mục cho bảng `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_name`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`masp`),
  ADD KEY `madm` (`madm`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `madm` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `mahd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `makh` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `manv` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  MODIFY `mapn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `masp` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD CONSTRAINT `chitiethoadon_ibfk_1` FOREIGN KEY (`mahd`) REFERENCES `hoadon` (`mahd`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chitiethoadon_ibfk_2` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`masp`);

--
-- Các ràng buộc cho bảng `chitietphieunhap`
--
ALTER TABLE `chitietphieunhap`
  ADD CONSTRAINT `chitietphieunhap_ibfk_3` FOREIGN KEY (`mapn`) REFERENCES `phieunhap` (`mapn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chitietphieunhap_ibfk_4` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`masp`);

--
-- Các ràng buộc cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadon_ibfk_1` FOREIGN KEY (`manv`) REFERENCES `nhanvien` (`manv`),
  ADD CONSTRAINT `hoadon_ibfk_2` FOREIGN KEY (`makh`) REFERENCES `khachhang` (`makh`);

--
-- Các ràng buộc cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD CONSTRAINT `khachhang_ibfk_1` FOREIGN KEY (`matk`) REFERENCES `account` (`username`);

--
-- Các ràng buộc cho bảng `kho`
--
ALTER TABLE `kho`
  ADD CONSTRAINT `kho_ibfk_1` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`masp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_ibfk_1` FOREIGN KEY (`matk`) REFERENCES `account` (`username`);

--
-- Các ràng buộc cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD CONSTRAINT `phieunhap_ibfk_1` FOREIGN KEY (`manv`) REFERENCES `nhanvien` (`manv`);

--
-- Các ràng buộc cho bảng `quyen`
--
ALTER TABLE `quyen`
  ADD CONSTRAINT `quyen_ibfk_1` FOREIGN KEY (`rolename`) REFERENCES `role` (`role_name`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `quyen_ibfk_2` FOREIGN KEY (`username`) REFERENCES `account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`madm`) REFERENCES `danhmuc` (`madm`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
