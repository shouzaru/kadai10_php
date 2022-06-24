-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2022 年 6 月 24 日 02:48
-- サーバのバージョン： 5.7.34
-- PHP のバージョン: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `file_db5`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `content_table`
--

CREATE TABLE `content_table` (
  `id` int(12) NOT NULL,
  `title` varchar(64) NOT NULL COMMENT '記事のタイトル',
  `content` varchar(256) NOT NULL COMMENT '記事の内容',
  `img` varchar(256) DEFAULT NULL COMMENT '画像のPATH',
  `Number` int(3) NOT NULL,
  `date` datetime NOT NULL COMMENT '登録日',
  `update_time` datetime DEFAULT NULL COMMENT '更新日（NULL許容）'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='記事のテーブル';

--
-- テーブルのデータのダンプ `content_table`
--

INSERT INTO `content_table` (`id`, `title`, `content`, `img`, `Number`, `date`, `update_time`) VALUES
(51, '鈴木陽向', 'Hinata Suzuki', '20220623163355_17_ヒナタ.JPG', 17, '2022-06-23 23:11:41', '2022-06-24 01:33:55'),
(54, '藤山ミナタ', 'Minata Hujiyama', '20220623161550_06_ミナタ.JPG', 6, '2022-06-23 23:46:07', '2022-06-24 01:15:50'),
(59, '野間タイキ', 'Taiki Noma', '20220623161601_10_タイキ.JPG', 10, '2022-06-24 00:34:07', '2022-06-24 01:16:01'),
(61, '山下ハルト', 'Haruto Yamashita', '20220623161726_12_ハルト.JPG', 12, '2022-06-24 01:17:26', NULL),
(62, '飯塚リュウ', 'Ryu Iiduka', '20220623161802_11_リュウ.JPG', 11, '2022-06-24 01:18:02', NULL),
(63, '田中トキ', 'Toki Tanaka', '20220623161830_18_トキ.JPG', 18, '2022-06-24 01:18:30', NULL),
(64, '服部圭吾', 'keigo Hattori', '20220623162054_03_ケイゴ.JPG', 3, '2022-06-24 01:20:54', NULL);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `content_table`
--
ALTER TABLE `content_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `content_table`
--
ALTER TABLE `content_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
