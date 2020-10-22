-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2020 年 10 月 22 日 23:48
-- サーバのバージョン： 5.7.26
-- PHP のバージョン: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `cafe`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `cafe_table`
--

CREATE TABLE `cafe_table` (
  `id` int(12) NOT NULL,
  `cafeName` varchar(64) NOT NULL,
  `cafeUrl` text NOT NULL,
  `comment` varchar(140) DEFAULT NULL,
  `reputation` int(11) DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `cafe_table`
--

INSERT INTO `cafe_table` (`id`, `cafeName`, `cafeUrl`, `comment`, `reputation`, `date`) VALUES
(51, 'LATTEST', 'http://lattest.jp', 'チャコールラテが美味しかった！', 5, '2020-10-22 22:00:54'),
(63, 'Piggy back cafe', 'https://www.instagram.com/piggybackcafe/?hl=ja', 'レインボーのラテが可愛かった♡', 5, '2020-10-22 23:46:05'),
(64, 'TheBloomRoomCafe', 'https://www.facebook.com/TheBloomRoomCafe/?ref=py_c', 'お店の雰囲気が良かった！', 5, '2020-10-22 23:47:20');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `cafe_table`
--
ALTER TABLE `cafe_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `cafe_table`
--
ALTER TABLE `cafe_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
