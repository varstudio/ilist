-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- ホスト: localhost:3306
-- 生成時間: 2013 年 2 月 01 日 00:00
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

UPDATE `sys_action` SET `id` = 1,`action` = 'insert',`name` = '追加',`script` = 'insertNum = "0";\r\nwhile (isNaN(insertNum) || insertNum == "0") {\r\n  insertNum = prompt( "请输入要追加的记录数！"); \r\n}\r\nif(insertNum == null) {return;};\r\nfrmCommand.id.value = insertNum;\r\nfrmCommand.act.value = action;\r\nfrmCommand.submit();' WHERE `sys_action`.`id` = 1;
UPDATE `sys_action` SET `id` = 2,`action` = 'update',`name` = '编辑',`script` = 'var id = "";\r\nif (frmMain.selFlg == null) { return false; }\r\nfor(i=0;i<frmMain.selFlg.length;i++) {\r\n  if (frmMain.selFlg[i].checked == true) {\r\n    if (id == "") {\r\n      id = frmMain.selFlg[i].value;\r\n    } else {\r\n      id = id + "," + frmMain.selFlg[i].value;\r\n    }\r\n  }\r\n}\r\nif (id == "") {\r\n  if (frmMain.selFlg.checked == true)\r\n    id = frmMain.selFlg.value;\r\n  }\r\nif (id == "") { return false; }\r\nfrmCommand.id.value = id;\r\nfrmCommand.act.value = action;\r\nfrmCommand.submit();\r\n' WHERE `sys_action`.`id` = 2;
UPDATE `sys_action` SET `id` = 3,`action` = 'delete',`name` = '删除',`script` = 'var id = "";\r\nif (frmMain.selFlg == null) { return false; }\r\nfor(i=0;i<frmMain.selFlg.length;i++) {\r\n  if (frmMain.selFlg[i].checked == true) {\r\n    if (id == "") {\r\n      id = frmMain.selFlg[i].value;\r\n    } else {\r\n    id = id + "," + frmMain.selFlg[i].value;\r\n    }\r\n  }\r\n}\r\nif (id == "") { if (frmMain.selFlg.checked == true) id = frmMain.selFlg.value; }\r\nif (id == "") { return false; }\r\nfrmCommand.id.value = id;\r\nfrmCommand.act.value = action;\r\nfrmCommand.submit();' WHERE `sys_action`.`id` = 3;
UPDATE `sys_action` SET `id` = 4,`action` = 'sort',`name` = '排序／筛选',`script` = 'var returnValue = window.showModalDialog("sort.php", \r\n"",\r\n"dialogWidth=740px;dialogHeight=700px;toolbar=no,menubar=no,scrollbars=auto,resizable=no,location=no,status=no");\r\n\r\n//for chrome\r\nif (returnValue == undefined) {\r\n  returnValue = window.returnValue;\r\n}\r\n\r\nif (returnValue == "finish") {\r\n  window.location.reload();\r\n}' WHERE `sys_action`.`id` = 4;
UPDATE `sys_action` SET `id` = 5,`action` = 'copy',`name` = '复制',`script` = 'var id = "";\r\nif (frmMain.selFlg == null) { return false; }\r\nfor(i=0;i<frmMain.selFlg.length;i++) {\r\n  if (frmMain.selFlg[i].checked == true) {\r\n    if (id == "") {\r\n      id = frmMain.selFlg[i].value;\r\n    } else {\r\n      id = id + "," + frmMain.selFlg[i].value;\r\n    }\r\n  }\r\n}\r\nif (id == "") {\r\n  if (frmMain.selFlg.checked == true)\r\n    id = frmMain.selFlg.value;\r\n  }\r\nif (id == "") { return false; }\r\nfrmCommand.id.value = id;\r\nfrmCommand.act.value = action;\r\nfrmCommand.submit();' WHERE `sys_action`.`id` = 5;
UPDATE `sys_action` SET `id` = 6,`action` = 'cancel',`name` = '取消',`script` = 'frmCommand.id.value = "";\r\nfrmCommand.act.value = "";\r\nfrmCommand.submit();' WHERE `sys_action`.`id` = 6;
UPDATE `sys_action` SET `id` = 7,`action` = 'confirm',`name` = '确定',`script` = 'frmMain.submit();' WHERE `sys_action`.`id` = 7;

--
-- テーブルのデータをダンプしています `sys_code`
--

UPDATE `sys_code` SET `id` = 1,`code` = 'CODE_901',`type` = 2,`table` = 'sys_user',`name` = '用户' WHERE `sys_code`.`id` = 1;
UPDATE `sys_code` SET `id` = 2,`code` = 'CODE_902',`type` = 2,`table` = 'sys_table',`name` = '表格' WHERE `sys_code`.`id` = 2;
UPDATE `sys_code` SET `id` = 3,`code` = 'CODE_903',`type` = 2,`table` = 'sys_code',`name` = '编码名称（编码值用）' WHERE `sys_code`.`id` = 3;
UPDATE `sys_code` SET `id` = 4,`code` = 'CODE_904',`type` = 2,`table` = 'sys_code',`name` = '编码名称（一览表用）' WHERE `sys_code`.`id` = 4;
UPDATE `sys_code` SET `id` = 5,`code` = 'CODE_905',`type` = 2,`table` = 'sys_action',`name` = '操作种类' WHERE `sys_code`.`id` = 5;
UPDATE `sys_code` SET `id` = 6,`code` = 'CODE_906',`type` = 1,`table` = '',`name` = '编辑列种类' WHERE `sys_code`.`id` = 6;
UPDATE `sys_code` SET `id` = 7,`code` = 'CODE_907',`type` = 1,`table` = '',`name` = '编码种类' WHERE `sys_code`.`id` = 7;
UPDATE `sys_code` SET `id` = 8,`code` = 'CODE_908',`type` = 1,`table` = '',`name` = '表示状态' WHERE `sys_code`.`id` = 8;
UPDATE `sys_code` SET `id` = 9,`code` = 'CODE_909',`type` = 1,`table` = '',`name` = '按钮表示类别' WHERE `sys_code`.`id` = 9;
UPDATE `sys_code` SET `id` = 10,`code` = 'CODE_910',`type` = 1,`table` = '',`name` = '有无区分' WHERE `sys_code`.`id` = 10;
UPDATE `sys_code` SET `id` = 11,`code` = 'CODE_911',`type` = 1,`table` = '',`name` = '消息状态' WHERE `sys_code`.`id` = 11;
UPDATE `sys_code` SET `id` = 12,`code` = 'CODE_912',`type` = 1,`table` = '',`name` = '工作组' WHERE `sys_code`.`id` = 12;
UPDATE `sys_code` SET `id` = 13,`code` = 'CODE_913',`type` = 1,`table` = '',`name` = '对齐方式' WHERE `sys_code`.`id` = 13;

--
-- テーブルのデータをダンプしています `sys_codevalue`
--

UPDATE `sys_codevalue` SET `id` = 1,`code` = 1,`value` = 'id',`name` = 'name' WHERE `sys_codevalue`.`id` = 1;
UPDATE `sys_codevalue` SET `id` = 2,`code` = 2,`value` = 'id',`name` = 'name' WHERE `sys_codevalue`.`id` = 2;
UPDATE `sys_codevalue` SET `id` = 3,`code` = 3,`value` = 'id',`name` = 'concat(code, ''：'', name)' WHERE `sys_codevalue`.`id` = 3;
UPDATE `sys_codevalue` SET `id` = 4,`code` = 4,`value` = 'code',`name` = 'concat(code, ''：'', name)' WHERE `sys_codevalue`.`id` = 4;
UPDATE `sys_codevalue` SET `id` = 5,`code` = 5,`value` = 'action',`name` = 'name' WHERE `sys_codevalue`.`id` = 5;
UPDATE `sys_codevalue` SET `id` = 6,`code` = 6,`value` = '1',`name` = '文本' WHERE `sys_codevalue`.`id` = 6;
UPDATE `sys_codevalue` SET `id` = 7,`code` = 6,`value` = '2',`name` = '选择列表' WHERE `sys_codevalue`.`id` = 7;
UPDATE `sys_codevalue` SET `id` = 8,`code` = 6,`value` = '3',`name` = '多行文本' WHERE `sys_codevalue`.`id` = 8;
UPDATE `sys_codevalue` SET `id` = 9,`code` = 6,`value` = '4',`name` = '进度（可编辑）' WHERE `sys_codevalue`.`id` = 9;
UPDATE `sys_codevalue` SET `id` = 10,`code` = 6,`value` = '5',`name` = '进度（不可编辑）' WHERE `sys_codevalue`.`id` = 10;
UPDATE `sys_codevalue` SET `id` = 11,`code` = 6,`value` = '6',`name` = '密码' WHERE `sys_codevalue`.`id` = 11;
UPDATE `sys_codevalue` SET `id` = 12,`code` = 6,`value` = '7',`name` = '表示文本' WHERE `sys_codevalue`.`id` = 12;
UPDATE `sys_codevalue` SET `id` = 13,`code` = 6,`value` = '8',`name` = '表示选择列表' WHERE `sys_codevalue`.`id` = 13;
UPDATE `sys_codevalue` SET `id` = 14,`code` = 7,`value` = '1',`name` = '固定编码' WHERE `sys_codevalue`.`id` = 14;
UPDATE `sys_codevalue` SET `id` = 15,`code` = 7,`value` = '2',`name` = '数据库编码' WHERE `sys_codevalue`.`id` = 15;
UPDATE `sys_codevalue` SET `id` = 16,`code` = 8,`value` = '1',`name` = '表示' WHERE `sys_codevalue`.`id` = 16;
UPDATE `sys_codevalue` SET `id` = 17,`code` = 8,`value` = '2',`name` = '隐藏' WHERE `sys_codevalue`.`id` = 17;
UPDATE `sys_codevalue` SET `id` = 18,`code` = 9,`value` = '1',`name` = '操作' WHERE `sys_codevalue`.`id` = 18;
UPDATE `sys_codevalue` SET `id` = 19,`code` = 9,`value` = '2',`name` = '确认' WHERE `sys_codevalue`.`id` = 19;
UPDATE `sys_codevalue` SET `id` = 20,`code` = 9,`value` = '3',`name` = '两者' WHERE `sys_codevalue`.`id` = 20;
UPDATE `sys_codevalue` SET `id` = 21,`code` = 10,`value` = '1',`name` = '有' WHERE `sys_codevalue`.`id` = 21;
UPDATE `sys_codevalue` SET `id` = 22,`code` = 10,`value` = '2',`name` = '无' WHERE `sys_codevalue`.`id` = 22;
UPDATE `sys_codevalue` SET `id` = 23,`code` = 11,`value` = '1',`name` = '未读' WHERE `sys_codevalue`.`id` = 23;
UPDATE `sys_codevalue` SET `id` = 24,`code` = 11,`value` = '2',`name` = '已读' WHERE `sys_codevalue`.`id` = 24;
UPDATE `sys_codevalue` SET `id` = 25,`code` = 11,`value` = '3',`name` = '保存' WHERE `sys_codevalue`.`id` = 25;
UPDATE `sys_codevalue` SET `id` = 26,`code` = 11,`value` = '4',`name` = '删除' WHERE `sys_codevalue`.`id` = 26;
UPDATE `sys_codevalue` SET `id` = 27,`code` = 12,`value` = '1',`name` = '项目全体成员' WHERE `sys_codevalue`.`id` = 27;
UPDATE `sys_codevalue` SET `id` = 28,`code` = 13,`value` = '1',`name` = '左对齐' WHERE `sys_codevalue`.`id` = 28;
UPDATE `sys_codevalue` SET `id` = 29,`code` = 13,`value` = '2',`name` = '居中' WHERE `sys_codevalue`.`id` = 29;
UPDATE `sys_codevalue` SET `id` = 30,`code` = 13,`value` = '3',`name` = '右对齐' WHERE `sys_codevalue`.`id` = 30;
UPDATE `sys_codevalue` SET `id` = 31,`code` = 13,`value` = '4',`name` = '两端对齐' WHERE `sys_codevalue`.`id` = 31;

--
-- テーブルのデータをダンプしています `sys_command`
--

UPDATE `sys_command` SET `id` = 1,`tableid` = 1,`no` = 1,`name` = '追加',`enable` = 1,`action` = 'insert',`advance` = '1' WHERE `sys_command`.`id` = 1;
UPDATE `sys_command` SET `id` = 2,`tableid` = 1,`no` = 2,`name` = '编辑',`enable` = 1,`action` = 'update',`advance` = '1' WHERE `sys_command`.`id` = 2;
UPDATE `sys_command` SET `id` = 3,`tableid` = 1,`no` = 3,`name` = '删除',`enable` = 1,`action` = 'delete',`advance` = '1' WHERE `sys_command`.`id` = 3;
UPDATE `sys_command` SET `id` = 4,`tableid` = 1,`no` = 4,`name` = '复制',`enable` = 1,`action` = 'copy',`advance` = '1' WHERE `sys_command`.`id` = 4;
UPDATE `sys_command` SET `id` = 5,`tableid` = 1,`no` = 5,`name` = '排序/筛选',`enable` = 1,`action` = 'sort',`advance` = '1' WHERE `sys_command`.`id` = 5;
UPDATE `sys_command` SET `id` = 6,`tableid` = 1,`no` = 98,`name` = '取消',`enable` = 2,`action` = 'cancel',`advance` = '1' WHERE `sys_command`.`id` = 6;
UPDATE `sys_command` SET `id` = 7,`tableid` = 1,`no` = 99,`name` = '确定',`enable` = 2,`action` = 'confirm',`advance` = '1' WHERE `sys_command`.`id` = 7;

--
-- テーブルのデータをダンプしています `sys_list`
--

UPDATE `sys_list` SET `id` = 1,`tableid` = 2,`no` = 1,`column` = '`table`',`name` = '表格',`width` = 100,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 1;
UPDATE `sys_list` SET `id` = 2,`tableid` = 2,`no` = 2,`column` = 'name',`name` = '表格名称',`width` = 120,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 2;
UPDATE `sys_list` SET `id` = 3,`tableid` = 3,`no` = 1,`column` = 'tableid',`name` = '表格',`width` = 200,`align` = 1,`type` = 2,`code` = 'CODE_902',`display` = 1 WHERE `sys_list`.`id` = 3;
UPDATE `sys_list` SET `id` = 4,`tableid` = 3,`no` = 2,`column` = 'no',`name` = '顺序',`width` = 40,`align` = 2,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 4;
UPDATE `sys_list` SET `id` = 5,`tableid` = 3,`no` = 3,`column` = '`column`',`name` = '表格列名称',`width` = 100,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 5;
UPDATE `sys_list` SET `id` = 6,`tableid` = 3,`no` = 4,`column` = 'name',`name` = '标题',`width` = 120,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 6;
UPDATE `sys_list` SET `id` = 7,`tableid` = 3,`no` = 5,`column` = 'align',`name` = '对齐方式',`width` = 60,`align` = 2,`type` = 2,`code` = 'CODE_913',`display` = 1 WHERE `sys_list`.`id` = 7;
UPDATE `sys_list` SET `id` = 8,`tableid` = 3,`no` = 6,`column` = 'width',`name` = '列宽',`width` = 40,`align` = 2,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 8;
UPDATE `sys_list` SET `id` = 9,`tableid` = 3,`no` = 7,`column` = 'type',`name` = '类别',`width` = 60,`align` = 2,`type` = 2,`code` = 'CODE_906',`display` = 1 WHERE `sys_list`.`id` = 9;
UPDATE `sys_list` SET `id` = 10,`tableid` = 3,`no` = 8,`column` = 'code',`name` = '编码',`width` = 200,`align` = 1,`type` = 2,`code` = 'CODE_904',`display` = 1 WHERE `sys_list`.`id` = 10;
UPDATE `sys_list` SET `id` = 11,`tableid` = 3,`no` = 9,`column` = 'display',`name` = '表示状态',`width` = 60,`align` = 2,`type` = 2,`code` = 'CODE_908',`display` = 1 WHERE `sys_list`.`id` = 11;
UPDATE `sys_list` SET `id` = 12,`tableid` = 4,`no` = 1,`column` = 'code',`name` = '编码',`width` = 40,`align` = 2,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 12;
UPDATE `sys_list` SET `id` = 13,`tableid` = 4,`no` = 2,`column` = 'type',`name` = '编码类别',`width` = 120,`align` = 2,`type` = 2,`code` = 'CODE_907',`display` = 1 WHERE `sys_list`.`id` = 13;
UPDATE `sys_list` SET `id` = 14,`tableid` = 4,`no` = 3,`column` = '`table`',`name` = '表格',`width` = 80,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 14;
UPDATE `sys_list` SET `id` = 15,`tableid` = 4,`no` = 4,`column` = 'name',`name` = '编码名称',`width` = 380,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 15;
UPDATE `sys_list` SET `id` = 16,`tableid` = 5,`no` = 1,`column` = 'code',`name` = '编码名称',`width` = 200,`align` = 1,`type` = 2,`code` = 'CODE_903',`display` = 1 WHERE `sys_list`.`id` = 16;
UPDATE `sys_list` SET `id` = 17,`tableid` = 5,`no` = 2,`column` = 'value',`name` = '编码',`width` = 80,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 17;
UPDATE `sys_list` SET `id` = 18,`tableid` = 5,`no` = 3,`column` = 'name',`name` = '编码值',`width` = 300,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 18;
UPDATE `sys_list` SET `id` = 19,`tableid` = 6,`no` = 1,`column` = '`tableid`',`name` = '表格',`width` = 80,`align` = 1,`type` = 2,`code` = 'CODE_902',`display` = 1 WHERE `sys_list`.`id` = 19;
UPDATE `sys_list` SET `id` = 20,`tableid` = 6,`no` = 2,`column` = 'no',`name` = '按钮序号',`width` = 100,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 20;
UPDATE `sys_list` SET `id` = 21,`tableid` = 6,`no` = 3,`column` = 'name',`name` = '名称',`width` = 80,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 21;
UPDATE `sys_list` SET `id` = 22,`tableid` = 6,`no` = 4,`column` = 'action',`name` = '操作',`width` = 150,`align` = 1,`type` = 2,`code` = 'CODE_905',`display` = 1 WHERE `sys_list`.`id` = 22;
UPDATE `sys_list` SET `id` = 23,`tableid` = 6,`no` = 5,`column` = 'enable',`name` = '表示',`width` = 100,`align` = 0,`type` = 2,`code` = 'CODE_909',`display` = 1 WHERE `sys_list`.`id` = 23;
UPDATE `sys_list` SET `id` = 24,`tableid` = 7,`no` = 1,`column` = 'action',`name` = '操作',`width` = 60,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 24;
UPDATE `sys_list` SET `id` = 25,`tableid` = 7,`no` = 2,`column` = 'name',`name` = '名称',`width` = 80,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 25;
UPDATE `sys_list` SET `id` = 26,`tableid` = 7,`no` = 3,`column` = 'script',`name` = '执行脚本',`width` = 160,`align` = 1,`type` = 3,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 26;
UPDATE `sys_list` SET `id` = 27,`tableid` = 8,`no` = 1,`column` = 'name',`name` = '菜单名称',`width` = 200,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 27;
UPDATE `sys_list` SET `id` = 28,`tableid` = 8,`no` = 2,`column` = 'tableid',`name` = '表格',`width` = 200,`align` = 1,`type` = 2,`code` = 'CODE_902',`display` = 1 WHERE `sys_list`.`id` = 28;
UPDATE `sys_list` SET `id` = 29,`tableid` = 8,`no` = 3,`column` = 'status',`name` = '通常模式表示状态',`width` = 80,`align` = 2,`type` = 2,`code` = 'CODE_908',`display` = 1 WHERE `sys_list`.`id` = 29;
UPDATE `sys_list` SET `id` = 30,`tableid` = 8,`no` = 4,`column` = 'status_admin',`name` = '管理模式表示状态',`width` = 80,`align` = 2,`type` = 2,`code` = 'CODE_908',`display` = 1 WHERE `sys_list`.`id` = 30;
UPDATE `sys_list` SET `id` = 31,`tableid` = 9,`no` = 1,`column` = 'user',`name` = '用户',`width` = 100,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 31;
UPDATE `sys_list` SET `id` = 32,`tableid` = 9,`no` = 2,`column` = 'password',`name` = '密码',`width` = 100,`align` = 1,`type` = 6,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 32;
UPDATE `sys_list` SET `id` = 33,`tableid` = 9,`no` = 3,`column` = 'admin',`name` = '管理权限',`width` = 70,`align` = 2,`type` = 2,`code` = 'CODE_910',`display` = 1 WHERE `sys_list`.`id` = 33;
UPDATE `sys_list` SET `id` = 34,`tableid` = 9,`no` = 4,`column` = 'name',`name` = '用户姓名',`width` = 100,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 34;
UPDATE `sys_list` SET `id` = 35,`tableid` = 9,`no` = 5,`column` = 'ip',`name` = 'IP地址',`width` = 100,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 35;
UPDATE `sys_list` SET `id` = 36,`tableid` = 9,`no` = 6,`column` = 'level',`name` = '级别',`width` = 100,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 36;
UPDATE `sys_list` SET `id` = 37,`tableid` = 9,`no` = 7,`column` = 'tel',`name` = '电话',`width` = 100,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 37;
UPDATE `sys_list` SET `id` = 38,`tableid` = 9,`no` = 8,`column` = 'terminal',`name` = '终端编号',`width` = 100,`align` = 1,`type` = 1,`code` = '',`display` = 1 WHERE `sys_list`.`id` = 38;
UPDATE `sys_list` SET `id` = 39,`tableid` = 10,`no` = 1,`column` = 'userid',`name` = '用户',`width` = 100,`align` = 2,`type` = 2,`code` = 'CODE_901',`display` = 1 WHERE `sys_list`.`id` = 39;
UPDATE `sys_list` SET `id` = 40,`tableid` = 10,`no` = 2,`column` = 'teamid',`name` = '工作组',`width` = 120,`align` = 2,`type` = 2,`code` = 'CODE_912',`display` = 1 WHERE `sys_list`.`id` = 40;

--
-- テーブルのデータをダンプしています `sys_menu`
--

UPDATE `sys_menu` SET `id` = 1,`name` = '表格',`tableid` = 2,`status` = '2',`status_admin` = '1' WHERE `sys_menu`.`id` = 1;
UPDATE `sys_menu` SET `id` = 2,`name` = '一览',`tableid` = 3,`status` = '2',`status_admin` = '1' WHERE `sys_menu`.`id` = 2;
UPDATE `sys_menu` SET `id` = 3,`name` = '编码',`tableid` = 4,`status` = '2',`status_admin` = '1' WHERE `sys_menu`.`id` = 3;
UPDATE `sys_menu` SET `id` = 4,`name` = '编码值',`tableid` = 5,`status` = '2',`status_admin` = '1' WHERE `sys_menu`.`id` = 4;
UPDATE `sys_menu` SET `id` = 5,`name` = '按钮',`tableid` = 6,`status` = '2',`status_admin` = '1' WHERE `sys_menu`.`id` = 5;
UPDATE `sys_menu` SET `id` = 6,`name` = '操作',`tableid` = 7,`status` = '2',`status_admin` = '1' WHERE `sys_menu`.`id` = 6;
UPDATE `sys_menu` SET `id` = 7,`name` = '菜单',`tableid` = 8,`status` = '2',`status_admin` = '1' WHERE `sys_menu`.`id` = 7;
UPDATE `sys_menu` SET `id` = 8,`name` = '用户',`tableid` = 9,`status` = '2',`status_admin` = '1' WHERE `sys_menu`.`id` = 8;
UPDATE `sys_menu` SET `id` = 9,`name` = '工作组',`tableid` = 10,`status` = '2',`status_admin` = '1' WHERE `sys_menu`.`id` = 9;

--
-- テーブルのデータをダンプしています `sys_table`
--

UPDATE `sys_table` SET `id` = 1,`table` = 'all_tables',`name` = '全体表格' WHERE `sys_table`.`id` = 1;
UPDATE `sys_table` SET `id` = 2,`table` = 'sys_table',`name` = '表格' WHERE `sys_table`.`id` = 2;
UPDATE `sys_table` SET `id` = 3,`table` = 'sys_list',`name` = '一览' WHERE `sys_table`.`id` = 3;
UPDATE `sys_table` SET `id` = 4,`table` = 'sys_code',`name` = '编码' WHERE `sys_table`.`id` = 4;
UPDATE `sys_table` SET `id` = 5,`table` = 'sys_codevalue',`name` = '编码值' WHERE `sys_table`.`id` = 5;
UPDATE `sys_table` SET `id` = 6,`table` = 'sys_command',`name` = '按钮' WHERE `sys_table`.`id` = 6;
UPDATE `sys_table` SET `id` = 7,`table` = 'sys_action',`name` = '操作' WHERE `sys_table`.`id` = 7;
UPDATE `sys_table` SET `id` = 8,`table` = 'sys_menu',`name` = '菜单' WHERE `sys_table`.`id` = 8;
UPDATE `sys_table` SET `id` = 9,`table` = 'sys_user',`name` = '用户' WHERE `sys_table`.`id` = 9;
UPDATE `sys_table` SET `id` = 10,`table` = 'sys_team',`name` = '工作组' WHERE `sys_table`.`id` = 10;

--
-- テーブルのデータをダンプしています `sys_team`
--

UPDATE `sys_team` SET `id` = 1,`userid` = '1',`teamid` = '1' WHERE `sys_team`.`id` = 1;
UPDATE `sys_team` SET `id` = 2,`userid` = '2',`teamid` = '1' WHERE `sys_team`.`id` = 2;

--
-- テーブルのデータをダンプしています `sys_user`
--

UPDATE `sys_user` SET `id` = 1,`user` = 'admin',`password` = 'admin',`admin` = '1',`name` = '管理员',`ip` = '127.0.0.1',`level` = '',`tel` = '',`terminal` = '' WHERE `sys_user`.`id` = 1;
UPDATE `sys_user` SET `id` = 2,`user` = 'test',`password` = 'test',`admin` = '2',`name` = '测试用户',`ip` = '0.0.0.0',`level` = '',`tel` = '',`terminal` = '' WHERE `sys_user`.`id` = 2;
