-- -------------------------------------------------------------
-- SQL Dump Bersih (Clean Database)
-- Sistem Manajemen Tamu Undangan Sidang Promosi Doktor UII x KOWPI
-- Domain Target: https://undangan-sidang.kowpi.id/
-- Tanggal Pembuatan: 17 Oktober 2026
--
-- Rangkuman:
-- 1. Tabel 'admins' berisi akun administrator panitia.
--    Username : admin
--    Password : admin123
-- 2. Tabel 'event_settings' berisi data resmi Promovendus & Acara Sidang.
-- 3. Tabel 'guests' KOSONG / BERSIH (0 data tamu, AUTO_INCREMENT = 1)
--    Siap untuk impor data tamu resmi via Excel / CSV atau input manual.
-- -------------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- -------------------------------------------------------------
-- 1. Struktur Tabel `admins`
-- -------------------------------------------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'admin',
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data Default Admin Panitia
-- Kredensial Login: username = admin | password = password123
INSERT INTO `admins` (`id`, `username`, `password_hash`, `full_name`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$NQDS8s03kwNwDp99NZOsy.9fixE2X0qddiBWPSHyArlAUe6B9.nBi', 'Panitia Sidang Promosi Doktor', 'admin', NOW(), NOW());

-- -------------------------------------------------------------
-- 2. Struktur Tabel `event_settings`
-- -------------------------------------------------------------
DROP TABLE IF EXISTS `event_settings`;
CREATE TABLE `event_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `candidate_name` varchar(150) DEFAULT 'Muhammad Abu Rivai',
  `candidate_nim` varchar(50) DEFAULT '21933020 (HI)',
  `dissertation_title` text DEFAULT NULL,
  `event_day_date` varchar(100) DEFAULT 'Selasa, 20 Oktober 2026',
  `event_hijri_date` varchar(100) DEFAULT 'Selasa, 9 Jumadil Awal 1448 H',
  `event_time` varchar(50) DEFAULT '09.00 - 11.00 WIB',
  `event_room` varchar(255) DEFAULT 'Ruang 03.16 Gedung K.H. A. Wahid Hasyim, Kampus Terpadu Universitas Islam Indonesia, Jl. Kaliurang KM. 14,5 Sleman Yogyakarta 55584',
  `signatory_title` varchar(100) DEFAULT 'Dekan FIAI UII',
  `signatory_name` varchar(150) DEFAULT 'Dr. Drs. Asmuni, M.A.',
  `is_event_completed` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 = Berlangsung/Aktif, 1 = Telah Selesai (Kunci Presensi)',
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data Default Pengaturan Acara Sidang Promosi Doktor
INSERT INTO `event_settings` (`id`, `candidate_name`, `candidate_nim`, `dissertation_title`, `event_day_date`, `event_hijri_date`, `event_time`, `event_room`, `signatory_title`, `signatory_name`, `is_event_completed`, `updated_at`) VALUES
(1, 'Muhammad Abu Rivai', '21933020 (HI)', 'DINAMIKA PERENCANAAN WARIS DALAM MITIGASI SENGKETA PADA MASYARAKAT JAWA MUSLIM', 'Selasa, 20 Oktober 2026', 'Selasa, 9 Jumadil Awal 1448 H', '09.00 - 11.00 WIB', 'Ruang 03.16 Gedung K.H. A. Wahid Hasyim, Kampus Terpadu Universitas Islam Indonesia, Jl. Kaliurang KM. 14,5 Sleman Yogyakarta 55584', 'Dekan FIAI UII', 'Dr. Drs. Asmuni, M.A.', 1, NOW());

-- -------------------------------------------------------------
-- 3. Struktur Tabel `guests` (KOSONG / BERSIH DARI TAMU)
-- -------------------------------------------------------------
DROP TABLE IF EXISTS `guests`;
CREATE TABLE `guests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guest_code` varchar(20) NOT NULL COMMENT 'Misal: KOWPI-001 s/d KOWPI-100 atau WALKIN-xxx',
  `salutation` varchar(50) DEFAULT 'Bapak/Ibu/Ustadz' COMMENT 'Sapaan penghormatan',
  `full_name` varchar(255) NOT NULL COMMENT 'Nama lengkap dan gelar yang tercetak di Hal 1 & Hal 2',
  `institution` varchar(255) DEFAULT NULL COMMENT 'Asal instansi / pesantren / KOWPI / domisili',
  `phone` varchar(30) DEFAULT NULL COMMENT 'Nomor WhatsApp tamu',
  `guest_type` enum('invited','walk_in') NOT NULL DEFAULT 'invited',
  `pdf_filename` varchar(255) DEFAULT NULL COMMENT 'Nama file PDF hasil generate',
  `is_present` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = Belum Hadir, 1 = Hadir',
  `check_in_time` datetime DEFAULT NULL COMMENT 'Waktu kedatangan akurat (YYYY-MM-DD HH:MM:SS)',
  `signature_image` varchar(255) DEFAULT NULL COMMENT 'Path file PNG tanda tangan dari Pen Tablet/Touch',
  `wishes` text DEFAULT NULL COMMENT 'Doa / ucapan selamat opsional',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `guest_code` (`guest_code`),
  KEY `idx_attendance_order` (`is_present`,`check_in_time`),
  KEY `idx_guest_type` (`guest_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
COMMIT;
