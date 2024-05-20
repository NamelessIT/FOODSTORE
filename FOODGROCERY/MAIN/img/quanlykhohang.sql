-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for quanlykhohanglaptop
CREATE DATABASE IF NOT EXISTS `quanlykhohanglaptop` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `quanlykhohanglaptop`;

-- Dumping structure for table quanlykhohanglaptop.chitietphieunhap
CREATE TABLE IF NOT EXISTS `chitietphieunhap` (
  `MaPhieuNhap` varchar(50) NOT NULL,
  `MaLaptop` varchar(50) NOT NULL,
  `SoLuong` int(11) DEFAULT NULL,
  KEY `MaPhieuNhap` (`MaPhieuNhap`),
  KEY `MaLaptop` (`MaLaptop`),
  CONSTRAINT `FK1_CTPhieuNhap_MaPhieuNhap` FOREIGN KEY (`MaPhieuNhap`) REFERENCES `phieunhap` (`MaPhieuNhap`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK2_CTPhieuNhap_MaLaptop` FOREIGN KEY (`MaLaptop`) REFERENCES `laptop` (`MaLaptop`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table quanlykhohanglaptop.chitietphieuxuat
CREATE TABLE IF NOT EXISTS `chitietphieuxuat` (
  `MaPhieuXuat` varchar(50) NOT NULL,
  `MaLaptop` varchar(50) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  KEY `MaPhieuXuat` (`MaPhieuXuat`),
  KEY `MaLaptop` (`MaLaptop`),
  CONSTRAINT `FK1_CTPhieuXuat_MaPhieuXuat` FOREIGN KEY (`MaPhieuXuat`) REFERENCES `phieuxuat` (`MaPhieuXuat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK2_CTPhieuXuat_MaLaptop` FOREIGN KEY (`MaLaptop`) REFERENCES `laptop` (`MaLaptop`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table quanlykhohanglaptop.cuahang
CREATE TABLE IF NOT EXISTS `cuahang` (
  `MaCuaHang` varchar(50) NOT NULL,
  `TenCuaHang` varchar(50) DEFAULT NULL,
  `DiaChi` varchar(255) NOT NULL,
  `SDT` varchar(20) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`MaCuaHang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table quanlykhohanglaptop.laptop
CREATE TABLE IF NOT EXISTS `laptop` (
  `MaLaptop` varchar(50) NOT NULL,
  `TenLaptop` varchar(255) DEFAULT NULL,
  `CPU` varchar(255) DEFAULT NULL,
  `GPU` varchar(255) DEFAULT NULL,
  `Ram` varchar(50) DEFAULT NULL,
  `Rom` char(50) DEFAULT NULL,
  `HeDieuHanh` varchar(255) DEFAULT NULL,
  `ManHinh` varchar(255) DEFAULT NULL,
  `Hang` varchar(50) DEFAULT NULL,
  `NamSanXuat` int(11) DEFAULT NULL,
  `SoLuong` int(11) DEFAULT NULL,
  `Gia` double NOT NULL,
  PRIMARY KEY (`MaLaptop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table quanlykhohanglaptop.nguoidung
CREATE TABLE IF NOT EXISTS `nguoidung` (
  `MaNguoiDung` varchar(50) NOT NULL,
  `TaiKhoan` varchar(50) DEFAULT NULL,
  `MatKhau` varchar(50) DEFAULT NULL,
  `PhamViTruyCap` tinyint(4) NOT NULL,
  PRIMARY KEY (`MaNguoiDung`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table quanlykhohanglaptop.nhacungcap
CREATE TABLE IF NOT EXISTS `nhacungcap` (
  `MaNhaCungCap` varchar(50) NOT NULL,
  `TenNhaCungCap` varchar(50) DEFAULT NULL,
  `DiaChi` varchar(255) DEFAULT NULL,
  `SDT` int(11) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`MaNhaCungCap`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table quanlykhohanglaptop.nhanvien
CREATE TABLE IF NOT EXISTS `nhanvien` (
  `MaNhanVien` varchar(50) NOT NULL,
  `TenNhanVien` varchar(50) DEFAULT NULL,
  `NgaySinh` date DEFAULT NULL,
  `GioiTinh` tinyint(4) DEFAULT NULL,
  `DiaChi` varchar(50) DEFAULT NULL,
  `SDT` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `MaNguoiDung` varchar(50) NOT NULL,
  PRIMARY KEY (`MaNhanVien`),
  KEY `FK_nhanvien_nguoidung` (`MaNguoiDung`),
  CONSTRAINT `FK_nhanvien_nguoidung` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table quanlykhohanglaptop.phieunhap
CREATE TABLE IF NOT EXISTS `phieunhap` (
  `MaPhieuNhap` varchar(50) NOT NULL,
  `MaNhaCungCap` varchar(50) NOT NULL,
  `NgayNhap` date NOT NULL,
  `MaNhanVien` varchar(50) NOT NULL,
  `TongTien` double NOT NULL,
  PRIMARY KEY (`MaPhieuNhap`),
  KEY `FK1_PhieuNhap_MaNCC` (`MaNhaCungCap`),
  KEY `FK2_PhieuNhap_MaNV` (`MaNhanVien`),
  CONSTRAINT `FK1_PhieuNhap_MaNCC` FOREIGN KEY (`MaNhaCungCap`) REFERENCES `nhacungcap` (`MaNhaCungCap`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK2_PhieuNhap_MaNV` FOREIGN KEY (`MaNhanVien`) REFERENCES `nhanvien` (`MaNhanVien`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table quanlykhohanglaptop.phieuxuat
CREATE TABLE IF NOT EXISTS `phieuxuat` (
  `MaPhieuXuat` varchar(50) NOT NULL,
  `MaCuaHang` varchar(50) NOT NULL,
  `MaNhanVien` varchar(50) NOT NULL,
  `NgayXuat` date NOT NULL,
  `TongTien` double NOT NULL,
  PRIMARY KEY (`MaPhieuXuat`),
  KEY `FK1_PhieuXuat_MaCuaHang` (`MaCuaHang`),
  KEY `FK2_PhieuXuat_MaNhanVien` (`MaNhanVien`),
  CONSTRAINT `FK1_PhieuXuat_MaCuaHang` FOREIGN KEY (`MaCuaHang`) REFERENCES `cuahang` (`MaCuaHang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK2_PhieuXuat_MaNhanVien` FOREIGN KEY (`MaNhanVien`) REFERENCES `nhanvien` (`MaNhanVien`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
