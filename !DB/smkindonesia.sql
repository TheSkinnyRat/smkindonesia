-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2019 at 09:08 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smkindonesia`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_guru` (IN `nm_guru` VARCHAR(255))  BEGIN
SELECT * FROM guru WHERE nama_guru = nm_guru;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `nip` int(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama_guru` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`nip`, `password`, `nama_guru`, `alamat`) VALUES
(1, '123', 'Ridwan', 'Cilebut'),
(2, '123', 'chippp', 'cilebut');

--
-- Triggers `guru`
--
DELIMITER $$
CREATE TRIGGER `trigger_delete` BEFORE DELETE ON `guru` FOR EACH ROW INSERT INTO log VALUES ('','Data Guru Dihapus',CONCAT(
'Nip = ',OLD.nip,
', Password = ',OLD.password,
', Nama Guru = ',OLD.nama_guru,
', Alamat = ',OLD.alamat))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trigger_insert` AFTER INSERT ON `guru` FOR EACH ROW INSERT INTO log values ('','Data Guru Ditambahkan',CONCAT(
'Nip = ',NEW.nip,
', Password = ',NEW.password,
', Nama Guru = ',NEW.nama_guru,
', Alamat = ',NEW.alamat))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trigger_update` AFTER UPDATE ON `guru` FOR EACH ROW INSERT INTO log values ('','Data Guru Diupdate',CONCAT(
'Nip = ',OLD.nip,', Menjadi = ',NEW.nip,
'. Password = ',OLD.password,', Menjadi = ',NEW.password,
'. Nama Guru = ',OLD.nama_guru,', Menjadi = ',NEW.nama_guru,
'. Alamat = ',OLD.alamat,', Menjadi = ',NEW.alamat))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(10) NOT NULL,
  `nama_jurusan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`) VALUES
(1, 'RPL 1'),
(2, 'RPL 2');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(10) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `id_jurusan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `id_jurusan`) VALUES
(1, 'XII', 1),
(2, 'XII', 2);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(10) NOT NULL,
  `nama_log` text NOT NULL,
  `detail_log` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `nama_log`, `detail_log`) VALUES
(1, 'Data Guru Ditambahkan', 'Nip = 9, Password = 123456, Nama Guru = chip, Alamat = cil'),
(2, 'Data Guru Diupdate', 'Nip = 9, Menjadi = 9. Password = 123456, Menjadi = 111. Nama Guru = chip, Menjadi = chippp. Alamat = cil, Menjadi = cilebut'),
(3, 'Data Guru Dihapus', 'Nip = 8, Password = b, Nama Guru = b, Alamat = b'),
(4, 'Data Guru Ditambahkan', 'Nip = 10, Password = a, Nama Guru = a, Alamat = a'),
(6, 'Data Guru Dihapus', 'Nip = 1, Password = guru, Nama Guru = Ata, Alamat = Citayam'),
(7, 'Data Guru Diupdate', 'Nip = 2, Menjadi = 1. Password = guru, Menjadi = guru. Nama Guru = Ridwan, Menjadi = Ridwan. Alamat = Cilebut, Menjadi = Cilebut'),
(8, 'Data Guru Diupdate', 'Nip = 1, Menjadi = 1. Password = guru, Menjadi = 123. Nama Guru = Ridwan, Menjadi = Ridwan. Alamat = Cilebut, Menjadi = Cilebut'),
(9, 'Data Guru Dihapus', 'Nip = 10, Password = a, Nama Guru = a, Alamat = a'),
(10, 'Data Guru Diupdate', 'Nip = 1, Menjadi = 1. Password = 123, Menjadi = 123. Nama Guru = Ridwan, Menjadi = . Alamat = Cilebut, Menjadi = '),
(11, 'Data Guru Diupdate', 'Nip = 1, Menjadi = 1. Password = 123, Menjadi = 123. Nama Guru = , Menjadi = . Alamat = , Menjadi = '),
(12, 'Data Guru Diupdate', 'Nip = 1, Menjadi = 1. Password = 123, Menjadi = 123. Nama Guru = , Menjadi = Ridwan. Alamat = , Menjadi = Cilebut'),
(13, 'Data Guru Ditambahkan', 'Nip = 2, Password = a, Nama Guru = a, Alamat = a'),
(14, 'Data Guru Ditambahkan', 'Nip = 3, Password = b, Nama Guru = b, Alamat = b'),
(15, 'Data Guru Ditambahkan', 'Nip = 11, Password = c, Nama Guru = c, Alamat = c'),
(16, 'Data Guru Dihapus', 'Nip = 11, Password = c, Nama Guru = c, Alamat = c'),
(17, 'Data Guru Dihapus', 'Nip = 2, Password = a, Nama Guru = a, Alamat = a'),
(18, 'Data Guru Dihapus', 'Nip = 3, Password = b, Nama Guru = b, Alamat = b'),
(19, 'Data Guru Ditambahkan', 'Nip = 12, Password = a, Nama Guru = a, Alamat = a'),
(20, 'Data Guru Diupdate', 'Nip = 12, Menjadi = 12. Password = a, Menjadi = b. Nama Guru = a, Menjadi = b. Alamat = a, Menjadi = b'),
(21, 'Data Guru Dihapus', 'Nip = 12, Password = b, Nama Guru = b, Alamat = b'),
(22, 'Data Guru Diupdate', 'Nip = 9, Menjadi = 9. Password = 111, Menjadi = 123. Nama Guru = chippp, Menjadi = chippp. Alamat = cilebut, Menjadi = cilebut'),
(23, 'Data Guru Diupdate', 'Nip = 9, Menjadi = 2. Password = 123, Menjadi = 123. Nama Guru = chippp, Menjadi = chippp. Alamat = cilebut, Menjadi = cilebut'),
(29, 'Data Guru Diupdate', 'Nip = 2, Menjadi = 2. Password = 123, Menjadi = 123. Nama Guru = chippp, Menjadi = chipp. Alamat = cilebut, Menjadi = cilebut'),
(30, 'Data Guru Diupdate', 'Nip = 2, Menjadi = 2. Password = 123, Menjadi = 123. Nama Guru = chipp, Menjadi = chippp. Alamat = cilebut, Menjadi = cilebut');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(10) NOT NULL,
  `nama_mapel` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `nama_mapel`) VALUES
(1, 'MTK'),
(2, 'IPA'),
(3, 'IPS');

-- --------------------------------------------------------

--
-- Table structure for table `mengajar`
--

CREATE TABLE `mengajar` (
  `id_mengajar` int(10) NOT NULL,
  `nip` int(10) NOT NULL,
  `id_kelas` int(10) NOT NULL,
  `id_mapel` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mengajar`
--

INSERT INTO `mengajar` (`id_mengajar`, `nip`, `id_kelas`, `id_mapel`) VALUES
(1, 1, 1, 1),
(11, 1, 1, 2),
(12, 2, 2, 1),
(13, 2, 2, 2),
(14, 1, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(10) NOT NULL,
  `id_mengajar` int(10) NOT NULL,
  `nis` int(10) NOT NULL,
  `uh` double NOT NULL,
  `uts` double NOT NULL,
  `uas` double NOT NULL,
  `na` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_mengajar`, `nis`, `uh`, `uts`, `uas`, `na`) VALUES
(3, 11, 3, 1, 2, 2, 1.67),
(4, 1, 2, 2, 3, 3, 2.67),
(5, 1, 1, 1, 2, 3, 2),
(6, 11, 1, 1, 3, 4, 2.67),
(7, 11, 2, 4, 2, 2, 2.67),
(8, 12, 3, 4, 4, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` int(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama_siswa` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `id_kelas` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `password`, `nama_siswa`, `alamat`, `id_kelas`) VALUES
(1, '123', 'Chip', 'Cilebut', 1),
(2, '123', 'chips', 'Bogor', 1),
(3, '123', 'rid', 'clb', 2),
(4, '123', 'wan', 'clbt', 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vnilai`
-- (See below for the actual view)
--
CREATE TABLE `vnilai` (
`nama_siswa` varchar(30)
,`nama_guru` varchar(30)
,`nama_kelas` varchar(10)
,`nama_jurusan` varchar(10)
,`nama_mapel` varchar(10)
,`uh` double
,`uts` double
,`uas` double
,`na` double
);

-- --------------------------------------------------------

--
-- Structure for view `vnilai`
--
DROP TABLE IF EXISTS `vnilai`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vnilai`  AS  select `siswa`.`nama_siswa` AS `nama_siswa`,`guru`.`nama_guru` AS `nama_guru`,`kelas`.`nama_kelas` AS `nama_kelas`,`jurusan`.`nama_jurusan` AS `nama_jurusan`,`mapel`.`nama_mapel` AS `nama_mapel`,`nilai`.`uh` AS `uh`,`nilai`.`uts` AS `uts`,`nilai`.`uas` AS `uas`,`nilai`.`na` AS `na` from ((((((`nilai` left join `siswa` on((`nilai`.`nis` = `siswa`.`nis`))) left join `mengajar` on((`nilai`.`id_mengajar` = `mengajar`.`id_mengajar`))) left join `guru` on((`mengajar`.`nip` = `guru`.`nip`))) left join `kelas` on((`siswa`.`id_kelas` = `kelas`.`id_kelas`))) left join `jurusan` on((`kelas`.`id_jurusan` = `jurusan`.`id_jurusan`))) left join `mapel` on((`mengajar`.`id_mapel` = `mapel`.`id_mapel`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_jurusan` (`id_jurusan`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `mengajar`
--
ALTER TABLE `mengajar`
  ADD PRIMARY KEY (`id_mengajar`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_mengajar` (`id_mengajar`),
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `nip` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mengajar`
--
ALTER TABLE `mengajar`
  MODIFY `id_mengajar` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `nis` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`);

--
-- Constraints for table `mengajar`
--
ALTER TABLE `mengajar`
  ADD CONSTRAINT `mengajar_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `mengajar_ibfk_2` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`),
  ADD CONSTRAINT `mengajar_ibfk_3` FOREIGN KEY (`nip`) REFERENCES `guru` (`nip`);

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`),
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`id_mengajar`) REFERENCES `mengajar` (`id_mengajar`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
