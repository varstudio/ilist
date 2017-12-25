-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- ホスト: localhost:3306
-- 生成時間: 2013 年 1 月 28 日 17:53
-- サーバのバージョン: 5.5.16
-- PHP のバージョン: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- データベース: `webdoc`
--
use webdoc;
-- --------------------------------------------------------

--
-- テーブルを削除する
--
DROP TABLE IF EXISTS `sys_action`;
DROP TABLE IF EXISTS `sys_code`;
DROP TABLE IF EXISTS `sys_codevalue`;
DROP TABLE IF EXISTS `sys_command`;
DROP TABLE IF EXISTS `sys_list`;
DROP TABLE IF EXISTS `sys_menu`;
DROP TABLE IF EXISTS `sys_message`;
DROP TABLE IF EXISTS `sys_sort`;
DROP TABLE IF EXISTS `sys_style`;
DROP TABLE IF EXISTS `sys_table`;
DROP TABLE IF EXISTS `sys_team`;
DROP TABLE IF EXISTS `sys_user`;

-- --------------------------------------------------------
--
-- テーブルの構造 `sys_action`
--

CREATE TABLE IF NOT EXISTS `sys_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` text,
  `name` text,
  `script` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- テーブルのデータをダンプしています `sys_action`
--

INSERT INTO `sys_action` (`id`, `action`, `name`, `script`) VALUES
(1, 'insert', 'add', 'insertNum = "0";\r\nwhile (isNaN(insertNum) || insertNum == "0") {\r\n  insertNum = prompt( "Please input add record num!"); \r\n}\r\nif(insertNum == null) {return;};\r\nfrmCommand.id.value = insertNum;\r\nfrmCommand.act.value = action;\r\nfrmCommand.submit();'),
(2, 'update', 'edit', 'var id = "";\r\nif (frmMain.selFlg == null) { return false; }\r\nfor(i=0;i<frmMain.selFlg.length;i++) {\r\n  if (frmMain.selFlg[i].checked == true) {\r\n    if (id == "") {\r\n      id = frmMain.selFlg[i].value;\r\n    } else {\r\n      id = id + "," + frmMain.selFlg[i].value;\r\n    }\r\n  }\r\n}\r\nif (id == "") {\r\n  if (frmMain.selFlg.checked == true)\r\n    id = frmMain.selFlg.value;\r\n  }\r\nif (id == "") { return false; }\r\nfrmCommand.id.value = id;\r\nfrmCommand.act.value = action;\r\nfrmCommand.submit();\r\n'),
(3, 'delete', 'delete', 'var id = "";\r\nif (frmMain.selFlg == null) { return false; }\r\nfor(i=0;i<frmMain.selFlg.length;i++) {\r\n  if (frmMain.selFlg[i].checked == true) {\r\n    if (id == "") {\r\n      id = frmMain.selFlg[i].value;\r\n    } else {\r\n    id = id + "," + frmMain.selFlg[i].value;\r\n    }\r\n  }\r\n}\r\nif (id == "") { if (frmMain.selFlg.checked == true) id = frmMain.selFlg.value; }\r\nif (id == "") { return false; }\r\nfrmCommand.id.value = id;\r\nfrmCommand.act.value = action;\r\nfrmCommand.submit();'),
(4, 'sort', 'sort/filter', 'var returnValue = window.showModalDialog("sort.php", \r\n"",\r\n"dialogWidth=740px;dialogHeight=700px;toolbar=no,menubar=no,scrollbars=auto,resizable=no,location=no,status=no");\r\n\r\n//for chrome\r\nif (returnValue == undefined) {\r\n  returnValue = window.returnValue;\r\n}\r\n\r\nif (returnValue == "finish") {\r\n  window.location.reload();\r\n}'),
(5, 'copy', 'copy', 'var id = "";\r\nif (frmMain.selFlg == null) { return false; }\r\nfor(i=0;i<frmMain.selFlg.length;i++) {\r\n  if (frmMain.selFlg[i].checked == true) {\r\n    if (id == "") {\r\n      id = frmMain.selFlg[i].value;\r\n    } else {\r\n      id = id + "," + frmMain.selFlg[i].value;\r\n    }\r\n  }\r\n}\r\nif (id == "") {\r\n  if (frmMain.selFlg.checked == true)\r\n    id = frmMain.selFlg.value;\r\n  }\r\nif (id == "") { return false; }\r\nfrmCommand.id.value = id;\r\nfrmCommand.act.value = action;\r\nfrmCommand.submit();'),
(6, 'cancel', 'cancel', 'frmCommand.id.value = "";\r\nfrmCommand.act.value = "";\r\nfrmCommand.submit();'),
(7, 'confirm', 'ok', 'frmMain.submit();');

-- --------------------------------------------------------

--
-- テーブルの構造 `sys_code`
--

CREATE TABLE IF NOT EXISTS `sys_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` text NOT NULL,
  `type` int(11) NOT NULL,
  `table` text NOT NULL,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- テーブルのデータをダンプしています `sys_code`
--

INSERT INTO `sys_code` (`id`, `code`, `type`, `table`, `name`) VALUES
(1, 'CODE_901', 2, 'sys_user', 'user'),
(2, 'CODE_902', 2, 'sys_table', 'table'),
(3, 'CODE_903', 2, 'sys_code', 'codelist(for codelist)'),
(4, 'CODE_904', 2, 'sys_code', 'codelist(for tablelist)'),
(5, 'CODE_905', 2, 'sys_action', 'action type'),
(6, 'CODE_906', 1, '', 'edit,display column'),
(7, 'CODE_907', 1, '', 'codelist type'),
(8, 'CODE_908', 1, '', 'display status'),
(9, 'CODE_909', 1, '', 'button display type'),
(10, 'CODE_910', 1, '', 'yes/no'),
(11, 'CODE_911', 1, '', 'message status'),
(12, 'CODE_912', 1, '', 'workgroup list'),
(13, 'CODE_913', 1, '', 'align');

-- --------------------------------------------------------

--
-- テーブルの構造 `sys_codevalue`
--

CREATE TABLE IF NOT EXISTS `sys_codevalue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `value` text NOT NULL,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- テーブルのデータをダンプしています `sys_codevalue`
--

INSERT INTO `sys_codevalue` (`id`, `code`, `value`, `name`) VALUES
(1, 1, 'id', 'name'),
(2, 2, 'id', 'name'),
(3, 3, 'id', 'concat(code, ''：'', name)'),
(4, 4, 'code', 'concat(code, ''：'', name)'),
(5, 5, 'action', 'name'),
(6, 6, '1', 'text'),
(7, 6, '2', 'select'),
(8, 6, '3', 'textarea'),
(9, 6, '4', 'progress(editable)'),
(10, 6, '5', 'progredd(display)'),
(11, 6, '6', 'password'),
(12, 6, '7', 'text(display)'),
(13, 6, '8', 'select(display)'),
(14, 7, '1', 'const code'),
(15, 7, '2', 'database code'),
(16, 8, '1', 'display'),
(17, 8, '2', 'hidden'),
(18, 9, '1', 'action'),
(19, 9, '2', 'confirm'),
(20, 9, '3', 'both'),
(21, 10, '1', 'yes'),
(22, 10, '2', 'no'),
(23, 11, '1', 'unread'),
(24, 11, '2', 'have read'),
(25, 11, '3', 'saved'),
(26, 11, '4', 'deleted'),
(27, 12, '1', 'project all'),
(28, 13, '1', 'left'),
(29, 13, '2', 'center'),
(30, 13, '3', 'right'),
(31, 13, '4', 'justify');

-- --------------------------------------------------------

--
-- テーブルの構造 `sys_command`
--

CREATE TABLE IF NOT EXISTS `sys_command` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tableid` int(11) NOT NULL,
  `no` int(11) NOT NULL,
  `name` text NOT NULL,
  `enable` int(11) DEFAULT NULL,
  `action` text NOT NULL,
  `advance` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- テーブルのデータをダンプしています `sys_command`
--

INSERT INTO `sys_command` (`id`, `tableid`, `no`, `name`, `enable`, `action`, `advance`) VALUES
(1, 1, 1, 'add', 1, 'insert', '1'),
(2, 1, 2, 'edit', 1, 'update', '1'),
(3, 1, 3, 'delete', 1, 'delete', '1'),
(4, 1, 4, 'copy', 1, 'copy', '1'),
(5, 1, 5, 'sort/filter', 1, 'sort', '1'),
(6, 1, 98, 'cancel', 2, 'cancel', '1'),
(7, 1, 99, 'ok', 2, 'confirm', '1');

-- --------------------------------------------------------

--
-- テーブルの構造 `sys_list`
--

CREATE TABLE IF NOT EXISTS `sys_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tableid` int(11) DEFAULT NULL,
  `no` int(11) DEFAULT NULL,
  `column` text,
  `name` text,
  `width` int(11) DEFAULT NULL,
  `align` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `code` text,
  `display` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- テーブルのデータをダンプしています `sys_list`
--

INSERT INTO `sys_list` (`id`, `tableid`, `no`, `column`, `name`, `width`, `align`, `type`, `code`, `display`) VALUES
(1, 2, 1, '`table`', 'table', 100, 1, 1, '', 1),
(2, 2, 2, 'name', 'table name', 120, 1, 1, '', 1),
(3, 3, 1, 'tableid', 'table', 200, 1, 2, 'CODE_902', 1),
(4, 3, 2, 'no', 'no.', 40, 2, 1, '', 1),
(5, 3, 3, '`column`', 'column', 100, 1, 1, '', 1),
(6, 3, 4, 'name', 'title', 120, 1, 1, '', 1),
(7, 3, 5, 'align', 'align', 60, 2, 2, 'CODE_913', 1),
(8, 3, 6, 'width', 'width', 40, 2, 1, '', 1),
(9, 3, 7, 'type', 'type', 60, 2, 2, 'CODE_906', 1),
(10, 3, 8, 'code', 'codelist', 200, 1, 2, 'CODE_904', 1),
(11, 3, 9, 'display', 'display status', 60, 2, 2, 'CODE_908', 1),
(12, 4, 1, 'code', 'code', 40, 2, 1, '', 1),
(13, 4, 2, 'type', 'code type', 120, 2, 2, 'CODE_907', 1),
(14, 4, 3, '`table`', 'table', 80, 1, 1, '', 1),
(15, 4, 4, 'name', 'code name', 380, 1, 1, '', 1),
(16, 5, 1, 'code', 'code name', 200, 1, 2, 'CODE_903', 1),
(17, 5, 2, 'value', 'code', 80, 1, 1, '', 1),
(18, 5, 3, 'name', 'code value', 300, 1, 1, '', 1),
(19, 6, 1, '`tableid`', 'table', 80, 1, 2, 'CODE_902', 1),
(20, 6, 2, 'no', 'button no', 100, 1, 1, '', 1),
(21, 6, 3, 'name', 'name', 80, 1, 1, '', 1),
(22, 6, 4, 'action', 'action', 150, 1, 2, 'CODE_905', 1),
(23, 6, 5, 'enable', 'button display', 100, 0, 2, 'CODE_909', 1),
(24, 7, 1, 'action', 'action', 60, 1, 1, '', 1),
(25, 7, 2, 'name', 'name', 80, 1, 1, '', 1),
(26, 7, 3, 'script', 'script', 160, 1, 3, '', 1),
(27, 8, 1, 'name', 'menu name', 200, 1, 1, '', 1),
(28, 8, 2, 'tableid', 'table', 200, 1, 2, 'CODE_902', 1),
(29, 8, 3, 'status', 'operate display', 80, 2, 2, 'CODE_908', 1),
(30, 8, 4, 'status_admin', 'admin display', 80, 2, 2, 'CODE_908', 1),
(31, 9, 1, 'user', 'user', 100, 1, 1, '', 1),
(32, 9, 2, 'password', 'password', 100, 1, 6, '', 1),
(33, 9, 3, 'admin', 'admin', 70, 2, 2, 'CODE_910', 1),
(34, 9, 4, 'name', 'name', 100, 1, 1, '', 1),
(35, 9, 5, 'ip', 'ip addr', 100, 1, 1, '', 1),
(36, 9, 6, 'level', 'level', 100, 1, 1, '', 1),
(37, 9, 7, 'tel', 'tel', 100, 1, 1, '', 1),
(38, 9, 8, 'terminal', 'terminal', 100, 1, 1, '', 1),
(39, 10, 1, 'userid', 'user', 100, 2, 2, 'CODE_901', 1),
(40, 10, 2, 'teamid', 'workgroup', 120, 2, 2, 'CODE_912', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `sys_menu`
--

CREATE TABLE IF NOT EXISTS `sys_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `tableid` int(11),
  `status` text,
  `status_admin` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- テーブルのデータをダンプしています `sys_menu`
--

INSERT INTO `sys_menu` (`id`, `name`, `tableid`, `status`, `status_admin`) VALUES
(1, 'table', 2, '2', '1'),
(2, 'list', 3, '2', '1'),
(3, 'codelist', 4, '2', '1'),
(4, 'codevalue', 5, '2', '1'),
(5, 'button', 6, '2', '1'),
(6, 'action', 7, '2', '1'),
(7, 'menu', 8, '2', '1'),
(8, 'user', 9, '2', '1'),
(9, 'workgroup', 10, '2', '1');

-- --------------------------------------------------------

--
-- テーブルの構造 `sys_message`
--

CREATE TABLE IF NOT EXISTS `sys_message` (
  `id` int(11) NOT NULL auto_increment,
  `sendtype` int(11) default NULL,
  `sendtime` text NOT NULL,
  `sender` int(11) default NULL,
  `recver` int(11) default NULL,
  `content` text,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `sys_msgstatus`
--

CREATE TABLE IF NOT EXISTS `sys_msgstatus` (
  `id` int(11) NOT NULL auto_increment,
  `msgid` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `sys_sort`
--

CREATE TABLE IF NOT EXISTS `sys_sort` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tableid` text NOT NULL,
  `userid` text NOT NULL,
  `sort` text NOT NULL,
  `filter` text NOT NULL,
  `group` text,
  `updtime` int(11) NOT NULL,
  `enabled` text,
  `memo` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `sys_style`
--

CREATE TABLE IF NOT EXISTS `sys_style` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tableid` int(11) DEFAULT NULL,
  `column` text,
  `value` text,
  `style_type` int(11) DEFAULT NULL,
  `style` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `sys_table`
--

CREATE TABLE IF NOT EXISTS `sys_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table` text,
  `name` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- テーブルのデータをダンプしています `sys_table`
--

INSERT INTO `sys_table` (`id`, `table`, `name`) VALUES
(1, 'all_tables', 'all_tables'),
(2, 'sys_table', 'table'),
(3, 'sys_list', 'list'),
(4, 'sys_code', 'codelist'),
(5, 'sys_codevalue', 'codevalue'),
(6, 'sys_command', 'button'),
(7, 'sys_action', 'action'),
(8, 'sys_menu', 'menu'),
(9, 'sys_user', 'user'),
(10, 'sys_team', 'workgroup');

-- --------------------------------------------------------

--
-- テーブルの構造 `sys_team`
--

CREATE TABLE IF NOT EXISTS `sys_team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` text,
  `teamid` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- テーブルのデータをダンプしています `sys_team`
--

INSERT INTO `sys_team` (`id`, `userid`, `teamid`) VALUES
(1, '1', '1'),
(2, '2', '1');

-- --------------------------------------------------------

--
-- テーブルの構造 `sys_user`
--

CREATE TABLE IF NOT EXISTS `sys_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` text NOT NULL,
  `password` text NOT NULL,
  `admin` text,
  `name` text NOT NULL,
  `ip` text,
  `level` text,
  `tel` text,
  `terminal` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- テーブルのデータをダンプしています `sys_user`
--

INSERT INTO `sys_user` (`id`, `user`, `password`, `admin`, `name`, `ip`, `level`, `tel`, `terminal`) VALUES
(1, 'admin', 'admin', '1', 'admin', '127.0.0.1', '', '', ''),
(2, 'test', 'test', '2', 'testuser', '0.0.0.0', '', '', '');

-- --------------------------------------------------------
--
-- テーブルの構造 `sys_lock`
--

CREATE TABLE IF NOT EXISTS `sys_lock` (
  `id` int(11) NOT NULL auto_increment,
  `tableid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `recordid` int(11) NOT NULL,
  `locktime` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
