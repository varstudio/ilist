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
(1, 'insert', '登録', 'insertNum = "0";\r\nwhile (isNaN(insertNum) || insertNum == "0") {\r\n  insertNum = prompt( "登録件数を入力してください！"); \r\n}\r\nif(insertNum == null) {return;};\r\nfrmCommand.id.value = insertNum;\r\nfrmCommand.act.value = action;\r\nfrmCommand.submit();'),
(2, 'update', '編集', 'var id = "";\r\nif (frmMain.selFlg == null) { return false; }\r\nfor(i=0;i<frmMain.selFlg.length;i++) {\r\n  if (frmMain.selFlg[i].checked == true) {\r\n    if (id == "") {\r\n      id = frmMain.selFlg[i].value;\r\n    } else {\r\n      id = id + "," + frmMain.selFlg[i].value;\r\n    }\r\n  }\r\n}\r\nif (id == "") {\r\n  if (frmMain.selFlg.checked == true)\r\n    id = frmMain.selFlg.value;\r\n  }\r\nif (id == "") { return false; }\r\nfrmCommand.id.value = id;\r\nfrmCommand.act.value = action;\r\nfrmCommand.submit();\r\n'),
(3, 'delete', '削除', 'var id = "";\r\nif (frmMain.selFlg == null) { return false; }\r\nfor(i=0;i<frmMain.selFlg.length;i++) {\r\n  if (frmMain.selFlg[i].checked == true) {\r\n    if (id == "") {\r\n      id = frmMain.selFlg[i].value;\r\n    } else {\r\n    id = id + "," + frmMain.selFlg[i].value;\r\n    }\r\n  }\r\n}\r\nif (id == "") { if (frmMain.selFlg.checked == true) id = frmMain.selFlg.value; }\r\nif (id == "") { return false; }\r\nfrmCommand.id.value = id;\r\nfrmCommand.act.value = action;\r\nfrmCommand.submit();'),
(4, 'sort', 'ソート／フィルタ', 'var returnValue = window.showModalDialog("sort.php", \r\n"",\r\n"dialogWidth=740px;dialogHeight=700px;toolbar=no,menubar=no,scrollbars=auto,resizable=no,location=no,status=no");\r\n\r\n//for chrome\r\nif (returnValue == undefined) {\r\n  returnValue = window.returnValue;\r\n}\r\n\r\nif (returnValue == "finish") {\r\n  window.location.reload();\r\n}'),
(5, 'copy', 'コピー', 'var id = "";\r\nif (frmMain.selFlg == null) { return false; }\r\nfor(i=0;i<frmMain.selFlg.length;i++) {\r\n  if (frmMain.selFlg[i].checked == true) {\r\n    if (id == "") {\r\n      id = frmMain.selFlg[i].value;\r\n    } else {\r\n      id = id + "," + frmMain.selFlg[i].value;\r\n    }\r\n  }\r\n}\r\nif (id == "") {\r\n  if (frmMain.selFlg.checked == true)\r\n    id = frmMain.selFlg.value;\r\n  }\r\nif (id == "") { return false; }\r\nfrmCommand.id.value = id;\r\nfrmCommand.act.value = action;\r\nfrmCommand.submit();'),
(6, 'cancel', '取消', 'frmCommand.id.value = "";\r\nfrmCommand.act.value = "";\r\nfrmCommand.submit();'),
(7, 'confirm', '確定', 'frmMain.submit();');

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
(1, 'CODE_901', 2, 'sys_user', '担当者'),
(2, 'CODE_902', 2, 'sys_table', 'テーブル'),
(3, 'CODE_903', 2, 'sys_code', 'コード名称（リスト値用）'),
(4, 'CODE_904', 2, 'sys_code', 'コード名称（一覧表用）'),
(5, 'CODE_905', 2, 'sys_action', 'アクション種類'),
(6, 'CODE_906', 1, '', '編集、表示列種別'),
(7, 'CODE_907', 1, '', 'コードリスト種別'),
(8, 'CODE_908', 1, '', '表示状態'),
(9, 'CODE_909', 1, '', 'ボタン表示種別'),
(10, 'CODE_910', 1, '', '有無区分'),
(11, 'CODE_911', 1, '', 'メッセージ状態'),
(12, 'CODE_912', 1, '', 'チームリスト'),
(13, 'CODE_913', 1, '', '表示詰め');

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
(6, 6, '1', '文字'),
(7, 6, '2', '選択リスト'),
(8, 6, '3', '文字エリア'),
(9, 6, '4', '進捗％（編集可）'),
(10, 6, '5', '進捗％（編集不可）'),
(11, 6, '6', 'パスワード'),
(12, 6, '7', '表示用文字'),
(13, 6, '8', '表示用選択リスト'),
(14, 7, '1', '定数コード'),
(15, 7, '2', 'ＤＢコード'),
(16, 8, '1', '表示'),
(17, 8, '2', '非表示'),
(18, 9, '1', 'アクション'),
(19, 9, '2', '確認'),
(20, 9, '3', '両方'),
(21, 10, '1', '有り'),
(22, 10, '2', '無し'),
(23, 11, '1', '未開封'),
(24, 11, '2', '開封済み'),
(25, 11, '3', '保存済み'),
(26, 11, '4', '削除した'),
(27, 12, '1', 'プロジェクト全員'),
(28, 13, '1', '左詰'),
(29, 13, '2', '中間'),
(30, 13, '3', '右詰'),
(31, 13, '4', '両端');

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
(1, 1, 1, '登録', 1, 'insert', '1'),
(2, 1, 2, '編集', 1, 'update', '1'),
(3, 1, 3, '削除', 1, 'delete', '1'),
(4, 1, 4, 'コピー', 1, 'copy', '1'),
(5, 1, 5, 'ｿｰﾄ/ﾌｨﾙﾀ', 1, 'sort', '1'),
(6, 1, 98, '取消', 2, 'cancel', '1'),
(7, 1, 99, '確定', 2, 'confirm', '1');

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
(1, 2, 1, '`table`', 'テーブル', 100, 1, 1, '', 1),
(2, 2, 2, 'name', 'テーブル名称', 120, 1, 1, '', 1),
(3, 3, 1, 'tableid', 'テーブル', 200, 1, 2, 'CODE_902', 1),
(4, 3, 2, 'no', '順番', 40, 2, 1, '', 1),
(5, 3, 3, '`column`', 'テーブル列名', 100, 1, 1, '', 1),
(6, 3, 4, 'name', 'タイトル', 120, 1, 1, '', 1),
(7, 3, 5, 'align', '表示詰め', 60, 2, 2, 'CODE_913', 1),
(8, 3, 6, 'width', '列幅', 40, 2, 1, '', 1),
(9, 3, 7, 'type', '種別', 60, 2, 2, 'CODE_906', 1),
(10, 3, 8, 'code', 'コード', 200, 1, 2, 'CODE_904', 1),
(11, 3, 9, 'display', '表示状態', 60, 2, 2, 'CODE_908', 1),
(12, 4, 1, 'code', 'コード', 40, 2, 1, '', 1),
(13, 4, 2, 'type', 'コード種別', 120, 2, 2, 'CODE_907', 1),
(14, 4, 3, '`table`', 'テーブル', 80, 1, 1, '', 1),
(15, 4, 4, 'name', 'コード名称', 380, 1, 1, '', 1),
(16, 5, 1, 'code', 'コード名称', 200, 1, 2, 'CODE_903', 1),
(17, 5, 2, 'value', 'コード', 80, 1, 1, '', 1),
(18, 5, 3, 'name', 'コード値', 300, 1, 1, '', 1),
(19, 6, 1, '`tableid`', 'テーブル', 80, 1, 2, 'CODE_902', 1),
(20, 6, 2, 'no', 'ボタン番号', 100, 1, 1, '', 1),
(21, 6, 3, 'name', '名前', 80, 1, 1, '', 1),
(22, 6, 4, 'action', 'アクション', 150, 1, 2, 'CODE_905', 1),
(23, 6, 5, 'enable', 'ボタン表示', 100, 0, 2, 'CODE_909', 1),
(24, 7, 1, 'action', 'アクション', 60, 1, 1, '', 1),
(25, 7, 2, 'name', '名前', 80, 1, 1, '', 1),
(26, 7, 3, 'script', 'スクリプト', 160, 1, 3, '', 1),
(27, 8, 1, 'name', 'メニュー名称', 200, 1, 1, '', 1),
(28, 8, 2, 'tableid', 'テーブル', 200, 1, 2, 'CODE_902', 1),
(29, 8, 3, 'status', '通常表示状態', 80, 2, 2, 'CODE_908', 1),
(30, 8, 4, 'status_admin', '管理表示状態', 80, 2, 2, 'CODE_908', 1),
(31, 9, 1, 'user', 'ユーザ', 100, 1, 1, '', 1),
(32, 9, 2, 'password', 'パスワード', 100, 1, 6, '', 1),
(33, 9, 3, 'admin', '管理権限', 70, 2, 2, 'CODE_910', 1),
(34, 9, 4, 'name', '名前', 100, 1, 1, '', 1),
(35, 9, 5, 'ip', 'IPアドレス', 100, 1, 1, '', 1),
(36, 9, 6, 'level', 'レベル', 100, 1, 1, '', 1),
(37, 9, 7, 'tel', '電話番号', 100, 1, 1, '', 1),
(38, 9, 8, 'terminal', '端末番号', 100, 1, 1, '', 1),
(39, 10, 1, 'userid', 'ユーザ', 100, 2, 2, 'CODE_901', 1),
(40, 10, 2, 'teamid', 'チーム', 120, 2, 2, 'CODE_912', 1);

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
(1, 'テーブル', 2, '2', '1'),
(2, '一覧', 3, '2', '1'),
(3, 'コードリスト', 4, '2', '1'),
(4, 'コードリスト値', 5, '2', '1'),
(5, 'コマンドボタン', 6, '2', '1'),
(6, 'アクション', 7, '2', '1'),
(7, 'メニュー', 8, '2', '1'),
(8, 'ユーザ', 9, '2', '1'),
(9, 'チーム', 10, '2', '1');

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
(1, 'all_tables', '全体テーブル'),
(2, 'sys_table', 'テーブル'),
(3, 'sys_list', '一覧'),
(4, 'sys_code', 'コードリスト'),
(5, 'sys_codevalue', 'コードリスト値'),
(6, 'sys_command', 'コマンドボタン'),
(7, 'sys_action', 'アクション'),
(8, 'sys_menu', 'メニュー'),
(9, 'sys_user', 'ユーザ'),
(10, 'sys_team', 'チーム');

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
(1, 'admin', 'admin', '1', '管理者', '127.0.0.1', '', '', ''),
(2, 'test', 'test', '2', '試験ユーザ', '0.0.0.0', '', '', '');

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
