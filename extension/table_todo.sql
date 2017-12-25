-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- ホスト: localhost
-- 生成時間: 2013 年 2 月 19 日 05:53
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

INSERT INTO `sys_table` (`table`, `name`) VALUES ('tbl_todo', '待办事项');
SELECT @tableid:=(SELECT last_insert_id());

-- --------------------------------------------------------

-- 
-- テーブルのデータをダンプしています `sys_menu`
-- 

INSERT INTO `sys_menu` (`name`, `tableid`, `status`, `status_admin`) VALUES ('待办事项', @tableid, '1', '2');

-- --------------------------------------------------------

-- 
-- テーブルのデータをダンプしています `sys_list`
-- 

INSERT INTO `sys_list` (`tableid`, `no`, `column`, `name`, `width`, `align`, `type`, `code`, `display`) VALUES (@tableid, 10, 'itemname', '项目', 300, 1, 3, '', 1);
INSERT INTO `sys_list` (`tableid`, `no`, `column`, `name`, `width`, `align`, `type`, `code`, `display`) VALUES (@tableid, 20, 'user', '担当者', 100, 2, 2, 'CODE_901', 1);
INSERT INTO `sys_list` (`tableid`, `no`, `column`, `name`, `width`, `align`, `type`, `code`, `display`) VALUES (@tableid, 30, 'startdate', '开始日', 80, 2, 1, '', 1);
INSERT INTO `sys_list` (`tableid`, `no`, `column`, `name`, `width`, `align`, `type`, `code`, `display`) VALUES (@tableid, 40, 'enddate', '终了日', 80, 2, 1, '', 1);
INSERT INTO `sys_list` (`tableid`, `no`, `column`, `name`, `width`, `align`, `type`, `code`, `display`) VALUES (@tableid, 50, 'result', '状态', 70, 2, 2, 'CODE_950', 1);
INSERT INTO `sys_list` (`tableid`, `no`, `column`, `name`, `width`, `align`, `type`, `code`, `display`) VALUES (@tableid, 60, 'memo', '备注', 150, 1, 3, '', 1);

-- --------------------------------------------------------

-- 
-- テーブルのデータをダンプしています `sys_code`
-- 

INSERT INTO `sys_code` (`code`, `type`, `table`, `name`) VALUES ('CODE_950', 1, '', '待办事项状态');

-- --------------------------------------------------------

-- 
-- テーブルのデータをダンプしています `sys_codevalue`
-- 
SELECT @codeid:=(SELECT last_insert_id());

INSERT INTO `sys_codevalue` (`code`, `value`, `name`) VALUES (@codeid, '1', '计划中');
INSERT INTO `sys_codevalue` (`code`, `value`, `name`) VALUES (@codeid, '2', '讨论中');
INSERT INTO `sys_codevalue` (`code`, `value`, `name`) VALUES (@codeid, '3', '进行中');
INSERT INTO `sys_codevalue` (`code`, `value`, `name`) VALUES (@codeid, '4', '完成');

-- --------------------------------------------------------

-- 
-- テーブルの構造 `tbl_todo`
-- 

CREATE TABLE `tbl_todo` (
  `id` int(11) NOT NULL auto_increment,
  `itemname` text,
  `user` text,
  `startdate` text,
  `enddate` text,
  `result` text,
  `memo` text,
  PRIMARY KEY  (`id`)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
