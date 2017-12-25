-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- ホスト: localhost
-- 生成時間: 2013 年 2 月 19 日 05:30
-- サーバのバージョン: 5.0.51
-- PHP のバージョン: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- データベース: `webdoc`
-- 
use webdoc;
-- --------------------------------------------------------
-- 
-- テーブルのデータをダンプしています `sys_table`
-- 

INSERT INTO `sys_table` (`table`, `name`) VALUES ('tbl_progress', '进度');
SELECT @tableid:=(SELECT last_insert_id());

-- --------------------------------------------------------
-- 
-- テーブルのデータをダンプしています `sys_list`
-- 

INSERT INTO `sys_list` (`tableid`, `no`, `column`, `name`, `width`, `align`, `type`, `code`, `display`) VALUES (@tableid, 10, 'itemname', '项目名称', 200, 1, 3, '', 1);
INSERT INTO `sys_list` (`tableid`, `no`, `column`, `name`, `width`, `align`, `type`, `code`, `display`) VALUES (@tableid, 20, 'user', '担当者', 100, 2, 2, 'CODE_901', 1);
INSERT INTO `sys_list` (`tableid`, `no`, `column`, `name`, `width`, `align`, `type`, `code`, `display`) VALUES (@tableid, 30, 'yuding', '预定作业量', 50, 2, 1, '', 1);
INSERT INTO `sys_list` (`tableid`, `no`, `column`, `name`, `width`, `align`, `type`, `code`, `display`) VALUES (@tableid, 40, 'finish', '完成作业量', 50, 2, 1, '', 1);
INSERT INTO `sys_list` (`tableid`, `no`, `column`, `name`, `width`, `align`, `type`, `code`, `display`) VALUES (@tableid, 45, '(finish/yuding)*100', '进度', 100, 2, 5, '', 1);
INSERT INTO `sys_list` (`tableid`, `no`, `column`, `name`, `width`, `align`, `type`, `code`, `display`) VALUES (@tableid, 50, 'ydstart', '预定开始日', 70, 2, 1, '', 1);
INSERT INTO `sys_list` (`tableid`, `no`, `column`, `name`, `width`, `align`, `type`, `code`, `display`) VALUES (@tableid, 60, 'ydend', '预定终了日', 70, 2, 1, '', 1);
INSERT INTO `sys_list` (`tableid`, `no`, `column`, `name`, `width`, `align`, `type`, `code`, `display`) VALUES (@tableid, 70, 'sjstart', '实际开始日', 70, 2, 1, '', 1);
INSERT INTO `sys_list` (`tableid`, `no`, `column`, `name`, `width`, `align`, `type`, `code`, `display`) VALUES (@tableid, 80, 'sjend', '实际终了日', 70, 2, 1, '', 1);
INSERT INTO `sys_list` (`tableid`, `no`, `column`, `name`, `width`, `align`, `type`, `code`, `display`) VALUES (@tableid, 90, 'memo', '备注', 150, 1, 3, '', 1);

-- --------------------------------------------------------
-- 
-- テーブルのデータをダンプしています `sys_menu`
-- 

INSERT INTO `sys_menu` (`name`, `tableid`, `status`, `status_admin`) VALUES ('进度', @tableid, '1', '2');

-- --------------------------------------------------------

-- 
-- テーブルの構造 `tbl_progress`
-- 

CREATE TABLE `tbl_progress` (
  `id` int(11) NOT NULL auto_increment,
  `itemname` text,
  `user` text,
  `yuding` text,
  `finish` text,
  `ydstart` text,
  `ydend` text,
  `sjstart` text,
  `sjend` text,
  `memo` text,
  PRIMARY KEY  (`id`)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
