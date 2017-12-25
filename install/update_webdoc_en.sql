-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- ホスト: localhost:3306
-- 生成時間: 2013 年 1 月 31 日 23:58
-- サーバのバージョン: 5.5.16
-- PHP のバージョン: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `webdoc`
--
use webdoc;
--
-- テーブルのデータをダンプしています `sys_action`
--

UPDATE `sys_action` SET `id` = 1,`action` = 'insert',`name` = 'add',`script` = 'insertNum = "0";\r\nwhile (isNaN(insertNum) || insertNum == "0") {\r\n  insertNum = prompt( "Please input add record num!"); \r\n}\r\nif(insertNum == null) {return;};\r\nfrmCommand.id.value = insertNum;\r\nfrmCommand.act.value = action;\r\nfrmCommand.submit();' WHERE `sys_action`.`id` = 1;
UPDATE `sys_action` SET `id` = 2,`action` = 'update',`name` = 'edit',`script` = 'var id = "";\r\nif (frmMain.selFlg == null) { return false; }\r\nfor(i=0;i<frmMain.selFlg.length;i++) {\r\n  if (frmMain.selFlg[i].checked == true) {\r\n    if (id == "") {\r\n      id = frmMain.selFlg[i].value;\r\n    } else {\r\n      id = id + "," + frmMain.selFlg[i].value;\r\n    }\r\n  }\r\n}\r\nif (id == "") {\r\n  if (frmMain.selFlg.checked == true)\r\n    id = frmMain.selFlg.value;\r\n  }\r\nif (id == "") { return false; }\r\nfrmCommand.id.value = id;\r\nfrmCommand.act.value = action;\r\nfrmCommand.submit();\r\n' WHERE `sys_action`.`id` = 2;
UPDATE `sys_action` SET `id` = 3,`action` = 'delete',`name` = 'delete',`script` = 'var id = "";\r\nif (frmMain.selFlg == null) { return false; }\r\nfor(i=0;i<frmMain.selFlg.length;i++) {\r\n  if (frmMain.selFlg[i].checked == true) {\r\n    if (id == "") {\r\n      id = frmMain.selFlg[i].value;\r\n    } else {\r\n    id = id + "," + frmMain.selFlg[i].value;\r\n    }\r\n  }\r\n}\r\nif (id == "") { if (frmMain.selFlg.checked == true) id = frmMain.selFlg.value; }\r\nif (id == "") { return false; }\r\nfrmCommand.id.value = id;\r\nfrmCommand.act.value = action;\r\nfrmCommand.submit();' WHERE `sys_action`.`id` = 3;
UPDATE `sys_action` SET `id` = 4,`action` = 'sort',`name` = 'sort/filter',`script` = 'var returnValue = window.showModalDialog("sort.php", \r\n"",\r\n"dialogWidth=740px;dialogHeight=700px;toolbar=no,menubar=no,scrollbars=auto,resizable=no,location=no,status=no");\r\n\r\n//for chrome\r\nif (returnValue == undefined) {\r\n  returnValue = window.returnValue;\r\n}\r\n\r\nif (returnValue == "finish") {\r\n  window.location.reload();\r\n}' WHERE `sys_action`.`id` = 4;
UPDATE `sys_action` SET `id` = 5,`action` = 'copy',`name` = 'copy',`script` = 'var id = "";\r\nif (frmMain.selFlg == null) { return false; }\r\nfor(i=0;i<frmMain.selFlg.length;i++) {\r\n  if (frmMain.selFlg[i].checked == true) {\r\n    if (id == "") {\r\n      id = frmMain.selFlg[i].value;\r\n    } else {\r\n      id = id + "," + frmMain.selFlg[i].value;\r\n    }\r\n  }\r\n}\r\nif (id == "") {\r\n  if (frmMain.selFlg.checked == true)\r\n    id = frmMain.selFlg.value;\r\n  }\r\nif (id == "") { return false; }\r\nfrmCommand.id.value = id;\r\nfrmCommand.act.value = action;\r\nfrmCommand.submit();' WHERE `sys_action`.`id` = 5;
UPDATE `sys_action` SET `id` = 6,`action` = 'cancel',`name` = 'cancel',`script` = 'frmCommand.id.value = "";\r\nfrmCommand.act.value = "";\r\nfrmCommand.submit();' WHERE `sys_action`.`id` = 6;
UPDATE `sys_action` SET `id` = 7,`action` = 'confirm',`name` = 'ok',`script` = 'frmMain.submit();' WHERE `sys_action`.`id` = 7;

--
-- テーブルのデータをダンプしています `sys_code`
--

UPDATE `sys_code` SET `id` = 1,`code` = 'CODE_901',`type` = 2,`table` = 'sys_user',`name` = 'user' WHERE `sys_code`.`id` = 1;
UPDATE `sys_code` SET `id` = 2,`code` = 'CODE_902',`type` = 2,`table` = 'sys_table',`name` = 'table' WHERE `sys_code`.`id` = 2;
UPDATE `sys_code` SET `id` = 3,`code` = 'CODE_903',`type` = 2,`table` = 'sys_code',`name` = 'codelist(for codelist)' WHERE `sys_code`.`id` = 3;
UPDATE `sys_code` SET `id` = 4,`code` = 'CODE_904',`type` = 2,`table` = 'sys_code',`name` = 'codelist(for tablelist)' WHERE `sys_code`.`id` = 4;
UPDATE `sys_code` SET `id` = 5,`code` = 'CODE_905',`type` = 2,`table` = 'sys_action',`name` = 'action type' WHERE `sys_code`.`id` = 5;
UPDATE `sys_code` SET `id` = 6,`code` = 'CODE_906',`type` = 1,`table` = '',`name` = 'edit,display column' WHERE `sys_code`.`id` = 6;
UPDATE `sys_code` SET `id` = 7,`code` = 'CODE_907',`type` = 1,`table` = '',`name` = 'codelist type' WHERE `sys_code`.`id` = 7;
UPDATE `sys_code` SET `id` = 8,`code` = 'CODE_908',`type` = 1,`table` = '',`name` = 'display status' WHERE `sys_code`.`id` = 8;
UPDATE `sys_code` SET `id` = 9,`code` = 'CODE_909',`type` = 1,`table` = '',`name` = 'button display type' WHERE `sys_code`.`id` = 9;
UPDATE `sys_code` SET `id` = 10,`code` = 'CODE_910',`type` = 1,`table` = '',`name` = 'yes/no' WHERE `sys_code`.`id` = 10;
UPDATE `sys_code` SET `id` = 11,`code` = 'CODE_911',`type` = 1,`table` = '',`name` = 'message status' WHERE `sys_code`.`id` = 11;
UPDATE `sys_code` SET `id` = 12,`code` = 'CODE_912',`type` = 1,`table` = '',`name` = 'workgroup list' WHERE `sys_code`.`id` = 12;
UPDATE `sys_code` SET `id` = 13,`code` = 'CODE_913',`type` = 1,`table` = '',`name` = 'align' WHERE `sys_code`.`id` = 13;

--
-- テーブルのデータをダンプしています `sys_codevalue`
--

UPDATE `sys_codevalue` SET `id` = 1,`code` = 1,`value` = 'id',`name` = 'name' WHERE `sys_codevalue`.`id` = 1;
UPDATE `sys_codevalue` SET `id` = 2,`code` = 2,`value` = 'id',`name` = 'name' WHERE `sys_codevalue`.`id` = 2;
UPDATE `sys_codevalue` SET `id` = 3,`code` = 3,`value` = 'id',`name` = 'concat(code, ''：'', name)' WHERE `sys_codevalue`.`id` = 3;
UPDATE `sys_codevalue` SET `id` = 4,`code` = 4,`value` = 'code',`name` = 'concat(code, ''：'', name)' WHERE `sys_codevalue`.`id` = 4;
UPDATE `sys_codevalue` SET `id` = 5,`code` = 5,`value` = 'action',`name` = 'name' WHERE `sys_codevalue`.`id` = 5;
UPDATE `sys_codevalue` SET `id` = 6,`code` = 6,`value` = '1',`name` = 'text' WHERE `sys_codevalue`.`id` = 6;
UPDATE `sys_codevalue` SET `id` = 7,`code` = 6,`value` = '2',`name` = 'select' WHERE `sys_codevalue`.`id` = 7;
UPDATE `sys_codevalue` SET `id` = 8,`code` = 6,`value` = '3',`name` = 'textarea' WHERE `sys_codevalue`.`id` = 8;
UPDATE `sys_codevalue` SET `id` = 9,`code` = 6,`value` = '4',`name` = 'progress(editable)' WHERE `sys_codevalue`.`id` = 9;
UPDATE `sys_codevalue` SET `id` = 10,`code` = 6,`value` = '5',`name` = 'progredd(display)' WHERE `sys_codevalue`.`id` = 10;
UPDATE `sys_codevalue` SET `id` = 11,`code` = 6,`value` = '6',`name` = 'password' WHERE `sys_codevalue`.`id` = 11;
UPDATE `sys_codevalue` SET `id` = 12,`code` = 6,`value` = '7',`name` = 'text(display)' WHERE `sys_codevalue`.`id` = 12;
UPDATE `sys_codevalue` SET `id` = 13,`code` = 6,`value` = '8',`name` = 'select(display)' WHERE `sys_codevalue`.`id` = 13;
UPDATE `sys_codevalue` SET `id` = 14,`code` = 7,`value` = '1',`name` = 'const code' WHERE `sys_codevalue`.`id` = 14;
UPDATE `sys_codevalue` SET `id` = 15,`code` = 7,`value` = '2',`name` = 'database code' WHERE `sys_codevalue`.`id` = 15;
UPDATE `sys_codevalue` SET `id` = 16,`code` = 8,`value` = '1',`name` = 'display' WHERE `sys_codevalue`.`id` = 16;
UPDATE `sys_codevalue` SET `id` = 17,`code` = 8,`value` = '2',`name` = 'hidden' WHERE `sys_codevalue`.`id` = 17;
UPDATE `sys_codevalue` SET `id` = 18,`code` = 9,`value` = '1',`name` = 'action' WHERE `sys_codevalue`.`id` = 18;
UPDATE `sys_codevalue` SET `id` = 19,`code` = 9,`value` = '2',`name` = 'confirm' WHERE `sys_codevalue`.`id` = 19;
UPDATE `sys_codevalue` SET `id` = 20,`code` = 9,`value` = '3',`name` = 'both' WHERE `sys_codevalue`.`id` = 20;
UPDATE `sys_codevalue` SET `id` = 21,`code` = 10,`value` = '1',`name` = 'yes' WHERE `sys_codevalue`.`id` = 21;
UPDATE `sys_codevalue` SET `id` = 22,`code` = 10,`value` = '2',`name` = 'no' WHERE `sys_codevalue`.`id` = 22;
UPDATE `sys_codevalue` SET `id` = 23,`code` = 11,`value` = '1',`name` = 'unread' WHERE `sys_codevalue`.`id` = 23;
UPDATE `sys_codevalue` SET `id` = 24,`code` = 11,`value` = '2',`name` = 'have read' WHERE `sys_codevalue`.`id` = 24;
UPDATE `sys_codevalue` SET `id` = 25,`code` = 11,`value` = '3',`name` = 'saved' WHERE `sys_codevalue`.`id` = 25;
UPDATE `sys_codevalue` SET `id` = 26,`code` = 11,`value` = '4',`name` = 'deleted' WHERE `sys_codevalue`.`id` = 26;
UPDATE `sys_codevalue` SET `id` = 27,`code` = 12,`value` = '1',`name` = 'project all' WHERE `sys_codevalue`.`id` = 27;
UPDATE `sys_codevalue` SET `id` = 28,`code` = 13,`value` = '1',`name` = 'left' WHERE `sys_codevalue`.`id` = 28;
UPDATE `sys_codevalue` SET `id` = 29,`code` = 13,`value` = '2',`name` = 'center' WHERE `sys_codevalue`.`id` = 29;
UPDATE `sys_codevalue` SET `id` = 30,`code` = 13,`value` = '3',`name` = 'right' WHERE `sys_codevalue`.`id` = 30;
UPDATE `sys_codevalue` SET `id` = 31,`code` = 13,`value` = '4',`name` = 'justify' WHERE `sys_codevalue`.`id` = 31;

--
-- テーブルのデータをダンプしています `sys_command`
--

UPDATE `sys_command` SET `id` = 1,`tableid` = 1,`no` = 1,`name` = 'add',`enable` = 1,`action` = 'insert',`advance` = '1' WHERE `sys_command`.`id` = 1;
UPDATE `sys_command` SET `id` = 2,`tableid` = 1,`no` = 2,`name` = 'edit',`enable` = 1,`action` = 'update',`advance` = '1' WHERE `sys_command`.`id` = 2;
UPDATE `sys_command` SET `id` = 3,`tableid` = 1,`no` = 3,`name` = 'delete',`enable` = 1,`action` = 'delete',`advance` = '1' WHERE `sys_command`.`id` = 3;
UPDATE `sys_command` SET `id` = 4,`tableid` = 1,`no` = 4,`name` = 'copy',`enable` = 1,`action` = 'copy',`advance` = '1' WHERE `sys_command`.`id` = 4;
UPDATE `sys_command` SET `id` = 5,`tableid` = 1,`no` = 5,`name` = 'sort/filter',`enable` = 1,`action` = 'sort',`advance` = '1' WHERE `sys_command`.`id` = 5;
UPDATE `sys_command` SET `id` = 6,`tableid` = 1,`no` = 98,`name` = 'cancel',`enable` = 2,`action` = 'cancel',`advance` = '1' WHERE `sys_command`.`id` = 6;
UPDATE `sys_command` SET `id` = 7,`tableid` = 1,`no` = 99,`name` = 'ok',`enable` = 2,`action` = 'confirm',`advance` = '1' WHERE `sys_command`.`id` = 7;

--
-- テーブルのデータをダンプしています `sys_list`
--

UPDATE `sys_list` SET `id` = 1,`tableid` = 2,`no` = 1,`column` = '`table`',`name` = 'table',`width` = 100,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 1;
UPDATE `sys_list` SET `id` = 2,`tableid` = 2,`no` = 2,`column` = 'name',`name` = 'table name',`width` = 120,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 2;
UPDATE `sys_list` SET `id` = 3,`tableid` = 3,`no` = 1,`column` = 'tableid',`name` = 'table',`width` = 200,`align` = 1,`type` = 2,`code` = 'CODE_902',`display` = 1 WHERE `sys_list`.`id` = 3;
UPDATE `sys_list` SET `id` = 4,`tableid` = 3,`no` = 2,`column` = 'no',`name` = 'no.',`width` = 40,`align` = 2,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 4;
UPDATE `sys_list` SET `id` = 5,`tableid` = 3,`no` = 3,`column` = '`column`',`name` = 'column',`width` = 100,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 5;
UPDATE `sys_list` SET `id` = 6,`tableid` = 3,`no` = 4,`column` = 'name',`name` = 'title',`width` = 120,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 6;
UPDATE `sys_list` SET `id` = 7,`tableid` = 3,`no` = 5,`column` = 'align',`name` = 'align',`width` = 60,`align` = 2,`type` = 2,`code` = 'CODE_913',`display` = 1 WHERE `sys_list`.`id` = 7;
UPDATE `sys_list` SET `id` = 8,`tableid` = 3,`no` = 6,`column` = 'width',`name` = 'width',`width` = 40,`align` = 2,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 8;
UPDATE `sys_list` SET `id` = 9,`tableid` = 3,`no` = 7,`column` = 'type',`name` = 'type',`width` = 60,`align` = 2,`type` = 2,`code` = 'CODE_906',`display` = 1 WHERE `sys_list`.`id` = 9;
UPDATE `sys_list` SET `id` = 10,`tableid` = 3,`no` = 8,`column` = 'code',`name` = 'codelist',`width` = 200,`align` = 1,`type` = 2,`code` = 'CODE_904',`display` = 1 WHERE `sys_list`.`id` = 10;
UPDATE `sys_list` SET `id` = 11,`tableid` = 3,`no` = 9,`column` = 'display',`name` = 'display status',`width` = 60,`align` = 2,`type` = 2,`code` = 'CODE_908',`display` = 1 WHERE `sys_list`.`id` = 11;
UPDATE `sys_list` SET `id` = 12,`tableid` = 4,`no` = 1,`column` = 'code',`name` = 'code',`width` = 40,`align` = 2,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 12;
UPDATE `sys_list` SET `id` = 13,`tableid` = 4,`no` = 2,`column` = 'type',`name` = 'code type',`width` = 120,`align` = 2,`type` = 2,`code` = 'CODE_907',`display` = 1 WHERE `sys_list`.`id` = 13;
UPDATE `sys_list` SET `id` = 14,`tableid` = 4,`no` = 3,`column` = '`table`',`name` = 'table',`width` = 80,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 14;
UPDATE `sys_list` SET `id` = 15,`tableid` = 4,`no` = 4,`column` = 'name',`name` = 'code name',`width` = 380,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 15;
UPDATE `sys_list` SET `id` = 16,`tableid` = 5,`no` = 1,`column` = 'code',`name` = 'code name',`width` = 200,`align` = 1,`type` = 2,`code` = 'CODE_903',`display` = 1 WHERE `sys_list`.`id` = 16;
UPDATE `sys_list` SET `id` = 17,`tableid` = 5,`no` = 2,`column` = 'value',`name` = 'code',`width` = 80,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 17;
UPDATE `sys_list` SET `id` = 18,`tableid` = 5,`no` = 3,`column` = 'name',`name` = 'code value',`width` = 300,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 18;
UPDATE `sys_list` SET `id` = 19,`tableid` = 6,`no` = 1,`column` = '`tableid`',`name` = 'table',`width` = 80,`align` = 1,`type` = 2,`code` = 'CODE_902',`display` = 1 WHERE `sys_list`.`id` = 19;
UPDATE `sys_list` SET `id` = 20,`tableid` = 6,`no` = 2,`column` = 'no',`name` = 'button no',`width` = 100,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 20;
UPDATE `sys_list` SET `id` = 21,`tableid` = 6,`no` = 3,`column` = 'name',`name` = 'name',`width` = 80,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 21;
UPDATE `sys_list` SET `id` = 22,`tableid` = 6,`no` = 4,`column` = 'action',`name` = 'action',`width` = 150,`align` = 1,`type` = 2,`code` = 'CODE_905',`display` = 1 WHERE `sys_list`.`id` = 22;
UPDATE `sys_list` SET `id` = 23,`tableid` = 6,`no` = 5,`column` = 'enable',`name` = 'button display',`width` = 100,`align` = 0,`type` = 2,`code` = 'CODE_909',`display` = 1 WHERE `sys_list`.`id` = 23;
UPDATE `sys_list` SET `id` = 24,`tableid` = 7,`no` = 1,`column` = 'action',`name` = 'action',`width` = 60,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 24;
UPDATE `sys_list` SET `id` = 25,`tableid` = 7,`no` = 2,`column` = 'name',`name` = 'name',`width` = 80,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 25;
UPDATE `sys_list` SET `id` = 26,`tableid` = 7,`no` = 3,`column` = 'script',`name` = 'script',`width` = 160,`align` = 1,`type` = 3,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 26;
UPDATE `sys_list` SET `id` = 27,`tableid` = 8,`no` = 1,`column` = 'name',`name` = 'menu name',`width` = 200,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 27;
UPDATE `sys_list` SET `id` = 28,`tableid` = 8,`no` = 2,`column` = 'tableid',`name` = 'table',`width` = 200,`align` = 1,`type` = 2,`code` = 'CODE_902',`display` = 1 WHERE `sys_list`.`id` = 28;
UPDATE `sys_list` SET `id` = 29,`tableid` = 8,`no` = 3,`column` = 'status',`name` = 'operate display',`width` = 80,`align` = 2,`type` = 2,`code` = 'CODE_908',`display` = 1 WHERE `sys_list`.`id` = 29;
UPDATE `sys_list` SET `id` = 30,`tableid` = 8,`no` = 4,`column` = 'status_admin',`name` = 'admin display',`width` = 80,`align` = 2,`type` = 2,`code` = 'CODE_908',`display` = 1 WHERE `sys_list`.`id` = 30;
UPDATE `sys_list` SET `id` = 31,`tableid` = 9,`no` = 1,`column` = 'user',`name` = 'user',`width` = 100,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 31;
UPDATE `sys_list` SET `id` = 32,`tableid` = 9,`no` = 2,`column` = 'password',`name` = 'password',`width` = 100,`align` = 1,`type` = 6,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 32;
UPDATE `sys_list` SET `id` = 33,`tableid` = 9,`no` = 3,`column` = 'admin',`name` = 'admin',`width` = 70,`align` = 2,`type` = 2,`code` = 'CODE_910',`display` = 1 WHERE `sys_list`.`id` = 33;
UPDATE `sys_list` SET `id` = 34,`tableid` = 9,`no` = 4,`column` = 'name',`name` = 'name',`width` = 100,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 34;
UPDATE `sys_list` SET `id` = 35,`tableid` = 9,`no` = 5,`column` = 'ip',`name` = 'ip addr',`width` = 100,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 35;
UPDATE `sys_list` SET `id` = 36,`tableid` = 9,`no` = 6,`column` = 'level',`name` = 'level',`width` = 100,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 36;
UPDATE `sys_list` SET `id` = 37,`tableid` = 9,`no` = 7,`column` = 'tel',`name` = 'tel',`width` = 100,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 37;
UPDATE `sys_list` SET `id` = 38,`tableid` = 9,`no` = 8,`column` = 'terminal',`name` = 'terminal',`width` = 100,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 38;
UPDATE `sys_list` SET `id` = 39,`tableid` = 10,`no` = 1,`column` = 'userid',`name` = 'user',`width` = 100,`align` = 2,`type` = 2,`code` = 'CODE_901',`display` = 1 WHERE `sys_list`.`id` = 39;
UPDATE `sys_list` SET `id` = 40,`tableid` = 10,`no` = 2,`column` = 'teamid',`name` = 'workgroup',`width` = 120,`align` = 2,`type` = 2,`code` = 'CODE_912',`display` = 1 WHERE `sys_list`.`id` = 40;

--
-- テーブルのデータをダンプしています `sys_menu`
--

UPDATE `sys_menu` SET `id` = 1,`name` = 'table',`tableid` = 2,`status` = '2',`status_admin` = '1' WHERE `sys_menu`.`id` = 1;
UPDATE `sys_menu` SET `id` = 2,`name` = 'list',`tableid` = 3,`status` = '2',`status_admin` = '1' WHERE `sys_menu`.`id` = 2;
UPDATE `sys_menu` SET `id` = 3,`name` = 'codelist',`tableid` = 4,`status` = '2',`status_admin` = '1' WHERE `sys_menu`.`id` = 3;
UPDATE `sys_menu` SET `id` = 4,`name` = 'codevalue',`tableid` = 5,`status` = '2',`status_admin` = '1' WHERE `sys_menu`.`id` = 4;
UPDATE `sys_menu` SET `id` = 5,`name` = 'button',`tableid` = 6,`status` = '2',`status_admin` = '1' WHERE `sys_menu`.`id` = 5;
UPDATE `sys_menu` SET `id` = 6,`name` = 'action',`tableid` = 7,`status` = '2',`status_admin` = '1' WHERE `sys_menu`.`id` = 6;
UPDATE `sys_menu` SET `id` = 7,`name` = 'menu',`tableid` = 8,`status` = '2',`status_admin` = '1' WHERE `sys_menu`.`id` = 7;
UPDATE `sys_menu` SET `id` = 8,`name` = 'user',`tableid` = 9,`status` = '2',`status_admin` = '1' WHERE `sys_menu`.`id` = 8;
UPDATE `sys_menu` SET `id` = 9,`name` = 'workgroup',`tableid` = 10,`status` = '2',`status_admin` = '1' WHERE `sys_menu`.`id` = 9;

--
-- テーブルのデータをダンプしています `sys_table`
--

UPDATE `sys_table` SET `id` = 1,`table` = 'all_tables',`name` = 'all_tables' WHERE `sys_table`.`id` = 1;
UPDATE `sys_table` SET `id` = 2,`table` = 'sys_table',`name` = 'table' WHERE `sys_table`.`id` = 2;
UPDATE `sys_table` SET `id` = 3,`table` = 'sys_list',`name` = 'list' WHERE `sys_table`.`id` = 3;
UPDATE `sys_table` SET `id` = 4,`table` = 'sys_code',`name` = 'codelist' WHERE `sys_table`.`id` = 4;
UPDATE `sys_table` SET `id` = 5,`table` = 'sys_codevalue',`name` = 'codevalue' WHERE `sys_table`.`id` = 5;
UPDATE `sys_table` SET `id` = 6,`table` = 'sys_command',`name` = 'button' WHERE `sys_table`.`id` = 6;
UPDATE `sys_table` SET `id` = 7,`table` = 'sys_action',`name` = 'action' WHERE `sys_table`.`id` = 7;
UPDATE `sys_table` SET `id` = 8,`table` = 'sys_menu',`name` = 'menu' WHERE `sys_table`.`id` = 8;
UPDATE `sys_table` SET `id` = 9,`table` = 'sys_user',`name` = 'user' WHERE `sys_table`.`id` = 9;
UPDATE `sys_table` SET `id` = 10,`table` = 'sys_team',`name` = 'workgroup' WHERE `sys_table`.`id` = 10;

--
-- テーブルのデータをダンプしています `sys_team`
--

UPDATE `sys_team` SET `id` = 1,`userid` = '1',`teamid` = '1' WHERE `sys_team`.`id` = 1;
UPDATE `sys_team` SET `id` = 2,`userid` = '2',`teamid` = '1' WHERE `sys_team`.`id` = 2;

--
-- テーブルのデータをダンプしています `sys_user`
--

UPDATE `sys_user` SET `id` = 1,`user` = 'admin',`password` = 'admin',`admin` = '1',`name` = 'admin',`ip` = '127.0.0.1',`level` = '',`tel` = '',`terminal` = '' WHERE `sys_user`.`id` = 1;
UPDATE `sys_user` SET `id` = 2,`user` = 'test',`password` = 'test',`admin` = '2',`name` = 'testuser',`ip` = '0.0.0.0',`level` = '',`tel` = '',`terminal` = '' WHERE `sys_user`.`id` = 2;
