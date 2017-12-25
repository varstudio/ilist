-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- ホスト: localhost:3306
-- 生成時間: 2013 年 1 月 24 日 18:57
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
-- テーブルのデータをダンプしています `sys_table`
--
INSERT INTO `sys_table` (`table`, `name`) VALUES
('tbl_bug', '故障管理');

-- --------------------------------------------------------
--
-- テーブルのデータをダンプしています `sys_command`
--
SELECT @tableid:=(SELECT last_insert_id());

INSERT INTO `sys_command` (`tableid`, `no`, `name`, `enable`, `action`, `advance`) VALUES
(@tableid, 1, '起票', 1, 'bug_step1', '1'),
(@tableid, 2, '発行', 1, 'bug_step2', '1'),
(@tableid, 3, '解析', 1, 'bug_step3', '1'),
(@tableid, 4, '処置', 1, 'bug_step4', '1'),
(@tableid, 5, '確認', 1, 'bug_step5', '1'),
(@tableid, 6, '結了', 1, 'bug_step6', '1'),
(@tableid, 7, '参照', 1, 'bug_ref', '1'),
(@tableid, 8, '編集', 1, 'bug_edit', '1'),
(@tableid, 9, '備考', 1, 'update', '1'),
(@tableid, 98, '取消', 2, 'cancel', '1'),
(@tableid, 99, '確定', 2, 'confirm', '1');
-- --------------------------------------------------------

--
-- テーブルのデータをダンプしています `sys_action`
--
INSERT INTO `sys_action` (`action`, `name`, `script`) VALUES
('bug_step1', '故障の起票', 'var id = "";\r\nif (frmMain.selFlg == null) {\r\n  id = "";\r\n} else {\r\n  for(i=0;i<frmMain.selFlg.length;i++) {\r\n    if (frmMain.selFlg[i].checked == true) {\r\n      id = frmMain.selFlg[i].value;\r\n      break;\r\n    }\r\n  }\r\n  if (id == "") {\r\n    if (frmMain.selFlg.checked == true) {\r\n      id = frmMain.selFlg.value;\r\n    }\r\n  }\r\n}\r\n\r\nvar returnValue = window.showModalDialog(\r\n                  "./extension/bug.php?step=1&id=" + id,\r\n                  "",\r\n                  "dialogWidth=1124px;dialogHeight=768px;toolbar=no,menubar=no,scrollbars=auto,resizable=no,location=no,status=no"\r\n                  );\r\n\r\n//for chrome\r\nif (returnValue == undefined) {\r\n  returnValue = window.returnValue;\r\n}\r\n\r\nif (returnValue == "finish") {\r\n  window.location.reload();\r\n}\r\n'),
('bug_step2', '故障の発行', 'var id = "";\r\nif (frmMain.selFlg == null) { return false; }\r\nfor(i=0;i<frmMain.selFlg.length;i++) {\r\n  if (frmMain.selFlg[i].checked == true) {\r\n    id = frmMain.selFlg[i].value;\r\n    break;\r\n  }\r\n}\r\nif (id == "") {\r\n  if (frmMain.selFlg.checked == true) {\r\n    id = frmMain.selFlg.value;\r\n  }\r\n}\r\n\r\nif (id != "") {\r\n  var returnValue = window.showModalDialog(\r\n                    "./extension/bug.php?step=2&id=" + id,\r\n                    "",\r\n                    "dialogWidth=1124px;dialogHeight=768px;toolbar=no,menubar=no,scrollbars=auto,resizable=no,location=no,status=no"\r\n                    );\r\n  //for chrome\r\n  if (returnValue == undefined) {\r\n    returnValue = window.returnValue;\r\n  }\r\n  if (returnValue == "finish") {\r\n    window.location.reload();\r\n  }\r\n}'),
('bug_step3', '故障の解析', 'var id = "";\r\nif (frmMain.selFlg == null) { return false; }\r\nfor(i=0;i<frmMain.selFlg.length;i++) {\r\n  if (frmMain.selFlg[i].checked == true) {\r\n    id = frmMain.selFlg[i].value;\r\n    break;\r\n  }\r\n}\r\nif (id == "") {\r\n  if (frmMain.selFlg.checked == true) {\r\n    id = frmMain.selFlg.value;\r\n  }\r\n}\r\n\r\nif (id != "") {\r\n  var returnValue = window.showModalDialog(\r\n                    "./extension/bug.php?step=3&id=" + id,\r\n                    "",\r\n                    "dialogWidth=1124px;dialogHeight=768px;toolbar=no,menubar=no,scrollbars=auto,resizable=no,location=no,status=no"\r\n                    );\r\n  //for chrome\r\n  if (returnValue == undefined) {\r\n    returnValue = window.returnValue;\r\n  }\r\n  if (returnValue == "finish") {\r\n    window.location.reload();\r\n  }\r\n}'),
('bug_step4', '故障の処置', 'var id = "";\r\nif (frmMain.selFlg == null) { return false; }\r\nfor(i=0;i<frmMain.selFlg.length;i++) {\r\n  if (frmMain.selFlg[i].checked == true) {\r\n    id = frmMain.selFlg[i].value;\r\n    break;\r\n  }\r\n}\r\nif (id == "") {\r\n  if (frmMain.selFlg.checked == true) {\r\n    id = frmMain.selFlg.value;\r\n  }\r\n}\r\n\r\nif (id != "") {\r\n  var returnValue = window.showModalDialog(\r\n                    "./extension/bug.php?step=4&id=" + id,\r\n                    "",\r\n                    "dialogWidth=1124px;dialogHeight=768px;toolbar=no,menubar=no,scrollbars=auto,resizable=no,location=no,status=no"\r\n                    );\r\n\r\n  //for chrome\r\n  if (returnValue == undefined) {\r\n    returnValue = window.returnValue;\r\n  }\r\n\r\n  if (returnValue == "finish") {\r\n    window.location.reload();\r\n  }\r\n}'),
('bug_step5', '故障の確認', 'var id = "";\r\nif (frmMain.selFlg == null) { return false; }\r\nfor(i=0;i<frmMain.selFlg.length;i++) {\r\n  if (frmMain.selFlg[i].checked == true) {\r\n    id = frmMain.selFlg[i].value;\r\n    break;\r\n  }\r\n}\r\nif (id == "") {\r\n  if (frmMain.selFlg.checked == true) {\r\n    id = frmMain.selFlg.value;\r\n  }\r\n}\r\n\r\nif (id != "") {\r\n  var returnValue = window.showModalDialog(\r\n                    "./extension/bug.php?step=5&id=" + id,\r\n                    "",\r\n                    "dialogWidth=1124px;dialogHeight=768px;toolbar=no,menubar=no,scrollbars=auto,resizable=no,location=no,status=no"\r\n                    );\r\n  //for chrome\r\n  if (returnValue == undefined) {\r\n    returnValue = window.returnValue;\r\n  }\r\n  if (returnValue == "finish") {\r\n    window.location.reload();\r\n  }\r\n}'),
('bug_step6', '故障の結了', 'var id = "";\r\nif (frmMain.selFlg == null) { return false; }\r\nfor(i=0;i<frmMain.selFlg.length;i++) {\r\n  if (frmMain.selFlg[i].checked == true) {\r\n    id = frmMain.selFlg[i].value;\r\n    break;\r\n  }\r\n}\r\nif (id == "") {\r\n  if (frmMain.selFlg.checked == true) {\r\n    id = frmMain.selFlg.value;\r\n  }\r\n}\r\n\r\nif (id != "") {\r\n  var returnValue = window.showModalDialog(\r\n                    "./extension/bug.php?step=6&id=" + id,\r\n                    "",\r\n                    "dialogWidth=1124px;dialogHeight=768px;toolbar=no,menubar=no,scrollbars=auto,resizable=no,location=no,status=no"\r\n                    );\r\n  //for chrome\r\n  if (returnValue == undefined) {\r\n    returnValue = window.returnValue;\r\n  }\r\n  if (returnValue == "finish") {\r\n    window.location.reload();\r\n  }\r\n}'),
('bug_ref', '故障の照会', 'var id = "";\r\nif (frmMain.selFlg == null) { return false; }\r\nfor(i=0;i<frmMain.selFlg.length;i++) {\r\n  if (frmMain.selFlg[i].checked == true) {\r\n    id = frmMain.selFlg[i].value;\r\n    break;\r\n  }\r\n}\r\nif (id == "") {\r\n  if (frmMain.selFlg.checked == true) {\r\n    id = frmMain.selFlg.value;\r\n  }\r\n}\r\n\r\nif (id != "") {\r\n  window.showModalDialog("./extension/bug.php?step=ref&id=" + id, \r\n      "","dialogWidth=1124px;dialogHeight=768px;toolbar=no,menubar=no,scrollbars=auto,resizable=no,location=no,status=no");\r\n}'),
('bug_edit', '故障の編集', 'var id = "";\r\nif (frmMain.selFlg == null) { return false; }\r\nfor(i=0;i<frmMain.selFlg.length;i++) {\r\n  if (frmMain.selFlg[i].checked == true) {\r\n    id = frmMain.selFlg[i].value;\r\n    break;\r\n  }\r\n}\r\nif (id == "") {\r\n  if (frmMain.selFlg.checked == true) {\r\n    id = frmMain.selFlg.value;\r\n  }\r\n}\r\n\r\nif (id != "") {\r\n  var returnValue = window.showModalDialog(\r\n                    "./extension/bug.php?step=edit&id=" + id,\r\n                    "",\r\n                    "dialogWidth=1124px;dialogHeight=768px;toolbar=no,menubar=no,scrollbars=auto,resizable=no,location=no,status=no"\r\n                    );\r\n  //for chrome\r\n  if (returnValue == undefined) {\r\n    returnValue = window.returnValue;\r\n  }\r\n  if (returnValue == "finish") {\r\n    window.location.reload();\r\n  }\r\n}');

-- --------------------------------------------------------
--
-- テーブルのデータをダンプしています `sys_code`
-- テーブルのデータをダンプしています `sys_codevalue`
--

-- 故障票−発見手段
INSERT INTO `sys_code` (`code`, `type`, `table`, `name`) VALUES
('CODE_920', 1, '', '故障票−発見手段');

SELECT @codeid:=(SELECT last_insert_id());

INSERT INTO `sys_codevalue` (`code`, `value`, `name`) VALUES
(@codeid, '1', '1:机上'),
(@codeid, '2', '2:マシン');

-- 故障票−事象
INSERT INTO `sys_code` (`code`, `type`, `table`, `name`) VALUES
('CODE_921', 1, '', '故障票−事象');

SELECT @codeid:=(SELECT last_insert_id());

INSERT INTO `sys_codevalue` (`code`, `value`, `name`) VALUES
(@codeid, '1', '1:システムダウン'),
(@codeid, '2', '2:ABEND'),
(@codeid, '3', '3:データ破壊（ファイル、テーブル）'),
(@codeid, '4', '4:部分（一部機能障害）'),
(@codeid, '5', '5:形式（メッセージ、データ等'),
(@codeid, '6', '6:その他 (　　　　　　　　　　　　　)');

-- 故障票−発見試験名
INSERT INTO `sys_code` (`code`, `type`, `table`, `name`) VALUES
('CODE_922', 1, '', '故障票−発見試験名');

SELECT @codeid:=(SELECT last_insert_id());

INSERT INTO `sys_codevalue` (`code`, `value`, `name`) VALUES
(@codeid, '1', 'UT1'),
(@codeid, '2', 'UT2'),
(@codeid, '3', 'SI1'),
(@codeid, '4', 'SI2'),
(@codeid, '5', 'PT');

-- 故障票−添付資料
INSERT INTO `sys_code` (`code`, `type`, `table`, `name`) VALUES
('CODE_923', 1, '', '故障票−添付資料');

SELECT @codeid:=(SELECT last_insert_id());

INSERT INTO `sys_codevalue` (`code`, `value`, `name`) VALUES
(@codeid, '1', '1:有'),
(@codeid, '2', '2:無');

-- 故障票−返却
INSERT INTO `sys_code` (`code`, `type`, `table`, `name`) VALUES
('CODE_924', 1, '', '故障票−返却');

SELECT @codeid:=(SELECT last_insert_id());

INSERT INTO `sys_codevalue` (`code`, `value`, `name`) VALUES
(@codeid, '1', '1:要'),
(@codeid, '2', '2:否');

-- 故障票−エラーを作り込んだ工程
INSERT INTO `sys_code` (`code`, `type`, `table`, `name`) VALUES
('CODE_925', 1, '', '故障票−エラーを作り込んだ工程');

SELECT @codeid:=(SELECT last_insert_id());

INSERT INTO `sys_codevalue` (`code`, `value`, `name`) VALUES
(@codeid, '1', '1A:BI'),
(@codeid, '2', '1B:BD'),
(@codeid, '3', '1C:DD'),
(@codeid, '4', '1D:PD'),
(@codeid, '5', '1E:C'),
(@codeid, '6', '1F:試験工程以降の修正ミス');

-- 故障票−設計工程で摘出できなかった要因
INSERT INTO `sys_code` (`code`, `type`, `table`, `name`) VALUES
('CODE_926', 1, '', '故障票−設計工程で摘出できなかった要因');

SELECT @codeid:=(SELECT last_insert_id());

INSERT INTO `sys_codevalue` (`code`, `value`, `name`) VALUES
(@codeid, '1', '1:品質作込み（品質項目反映）考慮不足'),
(@codeid, '2', '2:レビュー未実施（PJ内/DR/お客様レビュー）'),
(@codeid, '3', '3:レビュー指摘漏れ'),
(@codeid, '4', '4:再レビュー及び修正・確認漏れ'),
(@codeid, '5', '5:工程間引継ぎコミュニケーション不足'),
(@codeid, '6', '6:その他 (　　　　　　　　　　　　　　　　)');

-- 故障票−バグを本来摘出すべき試験工程
INSERT INTO `sys_code` (`code`, `type`, `table`, `name`) VALUES
('CODE_927', 1, '', '故障票−バグを本来摘出すべき試験工程');

SELECT @codeid:=(SELECT last_insert_id());

INSERT INTO `sys_codevalue` (`code`, `value`, `name`) VALUES
(@codeid, '1', 'UT1'),
(@codeid, '2', 'UT2'),
(@codeid, '3', 'SI1'),
(@codeid, '4', 'SI2'),
(@codeid, '5', 'PT');

-- 故障票−試験工程で摘出できなかった要因
INSERT INTO `sys_code` (`code`, `type`, `table`, `name`) VALUES
('CODE_928', 1, '', '故障票−試験工程で摘出できなかった要因');

SELECT @codeid:=(SELECT last_insert_id());

INSERT INTO `sys_codevalue` (`code`, `value`, `name`) VALUES
(@codeid, '1', '1:試験項目抽出漏れ'),
(@codeid, '2', '2:テストそのものの漏れ'),
(@codeid, '3', '3:環境上の問題で後工程にもっていった'),
(@codeid, '4', '4:結果確認ミス'),
(@codeid, '5', '5:その他 (　　　　　　　　　　　　　　　)');

-- 故障票−環境バグ
INSERT INTO `sys_code` (`code`, `type`, `table`, `name`) VALUES
('CODE_929', 1, '', '故障票−環境バグ');

SELECT @codeid:=(SELECT last_insert_id());

INSERT INTO `sys_codevalue` (`code`, `value`, `name`) VALUES
(@codeid, '1', '2A:SG設計'),
(@codeid, '2', '2B:SGパラメータ設定'),
(@codeid, '3', '2C:ファイル統合'),
(@codeid, '4', '2D:環境の同期'),
(@codeid, '5', '2E:その他 (　　　　　　　　　　　)');

-- 故障票−ハードウェア
INSERT INTO `sys_code` (`code`, `type`, `table`, `name`) VALUES
('CODE_930', 1, '', '故障票−ハードウェア');

SELECT @codeid:=(SELECT last_insert_id());

INSERT INTO `sys_codevalue` (`code`, `value`, `name`) VALUES
(@codeid, '1', '3A:サーバ（本体系）'),
(@codeid, '2', '3B:サーバ（周辺機器）'),
(@codeid, '3', '3C:電源系'),
(@codeid, '4', '3D:空調･冷却系'),
(@codeid, '5', '3E:回線系'),
(@codeid, '6', '3F:クライアント（本体系）'),
(@codeid, '7', '3G:クライアント（周辺機器）'),
(@codeid, '8', '3H:その他 (　　　　　　　　　　　)');

-- 故障票−その他の要因
INSERT INTO `sys_code` (`code`, `type`, `table`, `name`) VALUES
('CODE_931', 1, '', '故障票−その他の要因');

SELECT @codeid:=(SELECT last_insert_id());

INSERT INTO `sys_codevalue` (`code`, `value`, `name`) VALUES
(@codeid, '1', '4A:誤操作'),
(@codeid, '2', '4B:再現せず'),
(@codeid, '3', '4C:指摘ミス'),
(@codeid, '4', '4D:重複'),
(@codeid, '5', '4E:ドキュメント不良'),
(@codeid, '6', '4F:潜在バグ（旧バージョン）'),
(@codeid, '7', '4G:パッケージ、ツール'),
(@codeid, '8', '4H:その他 (　　　　　　　　　　　)');

-- 故障票−バグ現象
INSERT INTO `sys_code` (`code`, `type`, `table`, `name`) VALUES
('CODE_932', 1, '', '故障票−バグ現象');

SELECT @codeid:=(SELECT last_insert_id());

INSERT INTO `sys_codevalue` (`code`, `value`, `name`) VALUES
(@codeid, '1', '1:インタフェースエラー'),
(@codeid, '2', '2:論理エラー'),
(@codeid, '3', '3:データ定義エラー'),
(@codeid, '4', '4:テーブル定義エラー'),
(@codeid, '5', '5:形式エラー'),
(@codeid, '6', '6:その他 (　　　　　　　　　　　　　)');

-- 故障票−処理機能
INSERT INTO `sys_code` (`code`, `type`, `table`, `name`) VALUES
('CODE_933', 1, '', '故障票−処理機能');

SELECT @codeid:=(SELECT last_insert_id());

INSERT INTO `sys_codevalue` (`code`, `value`, `name`) VALUES
(@codeid, '1', '1:入力データチェック機能'),
(@codeid, '2', '2:演算機能'),
(@codeid, '3', '3:データ編集機能'),
(@codeid, '4', '4:ファイル更新機能'),
(@codeid, '5', '5:データ出力機能'),
(@codeid, '6', '6:連動（組み合わせ）処理'),
(@codeid, '7', '7:限界処理'),
(@codeid, '8', '8:外囲条件異常検知機能'),
(@codeid, '9', '9:その他 (　　　　　　　　　　　　　)');

-- 故障票−1:仕様書不備の問題
INSERT INTO `sys_code` (`code`, `type`, `table`, `name`) VALUES
('CODE_934', 1, '', '故障票−1:仕様書不備の問題');

SELECT @codeid:=(SELECT last_insert_id());

INSERT INTO `sys_codevalue` (`code`, `value`, `name`) VALUES
(@codeid, '1', '1A:記述漏れ（記述なし）'),
(@codeid, '2', '1B:記述誤り'),
(@codeid, '3', '1C:不明確（曖昧）'),
(@codeid, '4', '1D:標準違反'),
(@codeid, '5', '1E:ドキュメント修正漏れ'),
(@codeid, '6', '1F:ドキュメント間不整合'),
(@codeid, '7', '1G:その他 (　　　　　　　　　　　　　) ');

-- 故障票−2:仕様からの展開の問題
INSERT INTO `sys_code` (`code`, `type`, `table`, `name`) VALUES
('CODE_935', 1, '', '故障票−2:仕様からの展開の問題');

SELECT @codeid:=(SELECT last_insert_id());

INSERT INTO `sys_codevalue` (`code`, `value`, `name`) VALUES
(@codeid, '1', '2A:仕様の見落とし'),
(@codeid, '2', '2B:仕様の理解不足'),
(@codeid, '3', '2C:仕様の確認不足'),
(@codeid, '4', '2D:仕様の検討粗漏'),
(@codeid, '5', '2E:その他 (　　　　　　　　　　　　　)');

-- 故障票−3:仕様関連以外の問題点
INSERT INTO `sys_code` (`code`, `type`, `table`, `name`) VALUES
('CODE_936', 1, '', '故障票−3:仕様関連以外の問題点');

SELECT @codeid:=(SELECT last_insert_id());

INSERT INTO `sys_codevalue` (`code`, `value`, `name`) VALUES
(@codeid, '1', '3A:言語用法の知識不足'),
(@codeid, '2', '3B:周知連絡の不徹底'),
(@codeid, '3', '3C:標準違反'),
(@codeid, '4', '3D:再利用時のチェック漏れ'),
(@codeid, '5', '3E:修正時のチェック漏れ'),
(@codeid, '6', '3F:単なる凡ミス'),
(@codeid, '7', '3G:その他 (　　　　　　　　　　　　　) ');

-- 故障票−発生箇所
INSERT INTO `sys_code` (`code`, `type`, `table`, `name`) VALUES
('CODE_937', 1, '', '故障票−発生箇所');

SELECT @codeid:=(SELECT last_insert_id());

INSERT INTO `sys_codevalue` (`code`, `value`, `name`) VALUES
(@codeid, '1', '1:新規'),
(@codeid, '2', '2:改造'),
(@codeid, '3', '3:再利用');

-- 故障票−仕様変更
INSERT INTO `sys_code` (`code`, `type`, `table`, `name`) VALUES
('CODE_938', 1, '', '故障票−仕様変更');

SELECT @codeid:=(SELECT last_insert_id());

INSERT INTO `sys_codevalue` (`code`, `value`, `name`) VALUES
(@codeid, '1', '1:関連あり'),
(@codeid, '2', '2:関連なし');

-- --------------------------------------------------------
--
-- テーブルのデータをダンプしています `sys_list`
--
INSERT INTO `sys_list` (`tableid`, `no`, `column`, `name`, `width`, `align`, `type`, `code`, `display`) VALUES
(@tableid, 1, 'CONCAT(''UT_BUG_'', lpad(id, 4, ''0''))', '故障番号', 100, 2, 7, '', 1),
(@tableid, 2, 'step1_item0002', '管理状態', 80, 2, 7, '', 1),
(@tableid, 3, 'step3_item0001', '故障概要', 300, 1, 7, '', 1),
(@tableid, 4, 'step4_item0001', '解析開始日', 100, 2, 7, '', 1),
(@tableid, 5, 'step10_item0002', '処理完了日', 100, 2, 7, '', 1),
(@tableid, 6, 'step11_item0007', 'システム反映日', 100, 2, 7, '', 1),
(@tableid, 7, 'memo', '備考', 200, 1, 1, '', 1);
-- --------------------------------------------------------
--
-- テーブルのデータをダンプしています `sys_menu`
--
INSERT INTO `sys_menu` (`id`, `name`, `tableid`, `status`, `status_admin`) VALUES
(16, '故障', @tableid, '1', '2');
-- --------------------------------------------------------
--
-- テーブルの構造 `tbl_bug`
--
CREATE TABLE IF NOT EXISTS `tbl_bug` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `step1_item0001` text,
  `step1_item0002` text,
  `step1_item0003` text,
  `step1_item0004` text,
  `step1_item0005` text,
  `step1_item0006` text,
  `step1_item0007` text,
  `step1_item0008` text,
  `step1_item0009` text,
  `step1_item0010` text,
  `step1_item0011` text,
  `step1_item0012` text,
  `step1_item0013` text,
  `step1_item0013_text` text,
  `step2_item0001` text,
  `step2_item0002` text,
  `step2_item0003` text,
  `step2_item0004` text,
  `step2_item0005` text,
  `step2_item0006` text,
  `step2_item0007` text,
  `step2_item0008` text,
  `step3_item0001` text,
  `step3_item0002` text,
  `step3_item0003` text,
  `step3_item0004` text,
  `step3_item0005` text,
  `step3_item0006` text,
  `step3_item0007` text,
  `step4_item0001` text,
  `step5_item0001` text,
  `step5_item0002` text,
  `step5_item0003` text,
  `step5_item0004` text,
  `step5_item0005` text,
  `step5_item0006` text,
  `step5_item0007` text,
  `step5_item0008` text,
  `step5_item0009` text,
  `step5_item0010` text,
  `step5_item0011` text,
  `step5_item0012` text,
  `step5_item0013` text,
  `step5_item0014` text,
  `step5_item0015` text,
  `step5_item0016` text,
  `step5_item0017` text,
  `step5_item0018` text,
  `step5_item0019` text,
  `step5_item0020` text,
  `step6_item0001` text,
  `step6_item0002` text,
  `step6_item0002_text` text,
  `step6_item0003` text,
  `step6_item0004` text,
  `step6_item0004_text` text,
  `step6_item0005` text,
  `step6_item0005_text` text,
  `step6_item0006` text,
  `step6_item0006_text` text,
  `step6_item0007` text,
  `step6_item0007_text` text,
  `step6_item0008` text,
  `step6_item0008_text` text,
  `step6_item0009` text,
  `step6_item0009_text` text,
  `step6_item0010` text,
  `step6_item0010_text` text,
  `step6_item0011` text,
  `step6_item0011_text` text,
  `step6_item0012` text,
  `step6_item0012_text` text,
  `step7_item0001` text,
  `step7_item0002` text,
  `step7_item0003` text,
  `step7_item0004` text,
  `step7_item0005` text,
  `step7_item0006` text,
  `step7_item0007` text,
  `step7_item0008` text,
  `step7_item0009` text,
  `step7_item0010` text,
  `step7_item0011` text,
  `step7_item0012` text,
  `step7_item0013` text,
  `step7_item0014` text,
  `step8_item0001` text,
  `step8_item0002` text,
  `step8_item0003` text,
  `step9_item0001` text,
  `step10_item0001` text,
  `step10_item0002` text,
  `step11_item0001` text,
  `step11_item0002` text,
  `step11_item0003` text,
  `step11_item0004` text,
  `step11_item0005` text,
  `step11_item0006` text,
  `step11_item0007` text,
  `step11_item0008` text,
  `step12_item0001` text,
  `step12_item0002` text,
  `step12_item0003` text,
  `step12_item0004` text,
  `step12_item0005` text,
  `step12_item0006` text,
  `step12_item0007` text,
  `step12_item0008` text,
  `step12_item0009` text,
  `step12_item0010` text,
  `step12_item0011` text,
  `memo` text,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `mst_sizai`
--

CREATE TABLE IF NOT EXISTS `mst_sizai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level1id` text,
  `level1name` text,
  `level2id` text,
  `level2name` text,
  `level3id` text,
  `level3name` text,
  `level4id` text,
  `level4name` text,
  `level5id` text,
  `level5name` text,
  `level6id` text,
  `level6name` text,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- テーブルのデータをダンプしています `mst_sizai`
--

INSERT INTO `mst_sizai` (`id`, `level1id`, `level1name`, `level2id`, `level2name`, `level3id`, `level3name`, `level4id`, `level4name`, `level5id`, `level5name`, `level6id`, `level6name`) VALUES
(1, 'level1id1', 'level1name1', 'level2id1-1', 'level2name1-1', 'level3id1-1-1', 'level2name1-1-1', 'level4id1-1-1-1', 'level2name1-1-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(2, 'level1id1', 'level1name1', 'level2id1-1', 'level2name1-1', 'level3id1-1-1', 'level2name1-1-1', 'level4id1-1-1-1', 'level2name1-1-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(3, 'level1id1', 'level1name1', 'level2id1-1', 'level2name1-1', 'level3id1-1-2', 'level2name1-1-2', 'level4id1-1-2-1', 'level2name1-1-2-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(4, 'level1id1', 'level1name1', 'level2id1-1', 'level2name1-1', 'level3id1-1-2', 'level2name1-1-2', 'level4id1-1-2-1', 'level2name1-1-2-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(5, 'level1id1', 'level1name1', 'level2id1-1', 'level2name1-1', 'level3id1-1-3', 'level2name1-1-3', 'level4id1-1-3-1', 'level2name1-1-3-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(6, 'level1id1', 'level1name1', 'level2id1-2', 'level2name1-2', 'level3id1-2-3', 'level2name1-2-3', 'level4id1-2-3-1', 'level2name1-2-3-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(7, 'level1id1', 'level1name1', 'level2id1-2', 'level2name1-2', 'level3id1-2-1', 'level2name1-2-1', 'level4id1-2-1-1', 'level2name1-2-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(8, 'level1id1', 'level1name1', 'level2id1-2', 'level2name1-2', 'level3id1-2-1', 'level2name1-2-1', 'level4id1-2-1-1', 'level2name1-2-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(9, 'level1id1', 'level1name1', 'level2id1-2', 'level2name1-2', 'level3id1-2-1', 'level2name1-2-1', 'level4id1-2-1-1', 'level2name1-2-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(10, 'level1id1', 'level1name1', 'level2id1-2', 'level2name1-2', 'level3id1-2-1', 'level2name1-2-1', 'level4id1-2-1-1', 'level2name1-2-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(11, 'level1id1', 'level1name1', 'level2id1-2', 'level2name1-2', 'level3id1-2-1', 'level2name1-2-1', 'level4id1-2-1-1', 'level2name1-2-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(12, 'level1id1', 'level1name1', 'level2id1-2', 'level2name1-2', 'level3id1-2-1', 'level2name1-2-1', 'level4id1-2-1-1', 'level2name1-2-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(13, 'level1id1', 'level1name1', 'level2id1-3', 'level2name1-3', 'level3id1-3-1', 'level2name1-3-1', 'level4id1-3-1-1', 'level2name1-3-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(14, 'level1id1', 'level1name1', 'level2id1-3', 'level2name1-3', 'level3id1-3-2', 'level2name1-3-2', 'level4id1-3-2-1', 'level2name1-3-2-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(15, 'level1id1', 'level1name1', 'level2id1-3', 'level2name1-3', 'level3id1-3-2', 'level2name1-3-2', 'level4id1-3-2-1', 'level2name1-3-2-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(16, 'level1id1', 'level1name1', 'level2id1-3', 'level2name1-3', 'level3id1-3-2', 'level2name1-3-2', 'level4id1-3-2-1', 'level2name1-3-2-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(17, 'level1id1', 'level1name1', 'level2id1-3', 'level2name1-3', 'level3id1-3-3', 'level2name1-3-3', 'level4id1-3-3-1', 'level2name1-3-3-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(18, 'level1id1', 'level1name1', 'level2id1-3', 'level2name1-3', 'level3id1-3-3', 'level2name1-3-3', 'level4id1-3-3-1', 'level2name1-3-3-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(19, 'level1id2', 'level1name2', 'level2id2-1', 'level2name2-1', 'level3id2-1-1', 'level2name2-1-1', 'level4id2-1-1-1', 'level2name2-1-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(20, 'level1id2', 'level1name2', 'level2id2-1', 'level2name2-1', 'level3id2-1-1', 'level2name2-1-1', 'level4id2-1-1-1', 'level2name2-1-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(21, 'level1id2', 'level1name2', 'level2id2-1', 'level2name2-1', 'level3id2-1-1', 'level2name2-1-1', 'level4id2-1-1-1', 'level2name2-1-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(22, 'level1id2', 'level1name2', 'level2id2-1', 'level2name2-1', 'level3id2-1-1', 'level2name2-1-1', 'level4id2-1-1-1', 'level2name2-1-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(23, 'level1id2', 'level1name2', 'level2id2-1', 'level2name2-1', 'level3id2-1-1', 'level2name2-1-1', 'level4id2-1-1-1', 'level2name2-1-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(24, 'level1id2', 'level1name2', 'level2id2-2', 'level2name2-2', 'level3id2-2-1', 'level2name2-2-1', 'level4id2-2-1-1', 'level2name2-2-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(25, 'level1id2', 'level1name2', 'level2id2-2', 'level2name2-2', 'level3id2-2-1', 'level2name2-2-1', 'level4id2-2-1-1', 'level2name2-2-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(26, 'level1id2', 'level1name2', 'level2id2-2', 'level2name2-2', 'level3id2-2-1', 'level2name2-2-1', 'level4id2-2-1-1', 'level2name2-2-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(27, 'level1id2', 'level1name2', 'level2id2-2', 'level2name2-2', 'level3id2-2-1', 'level2name2-2-1', 'level4id2-2-1-1', 'level2name2-2-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(28, 'level1id2', 'level1name2', 'level2id2-2', 'level2name2-2', 'level3id2-2-1', 'level2name2-2-1', 'level4id2-2-1-1', 'level2name2-2-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(29, 'level1id2', 'level1name2', 'level2id2-2', 'level2name2-2', 'level3id2-2-1', 'level2name2-2-1', 'level4id2-2-1-1', 'level2name2-2-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(30, 'level1id2', 'level1name2', 'level2id2-2', 'level2name2-2', 'level3id2-2-1', 'level2name2-2-1', 'level4id2-2-1-1', 'level2name2-2-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(31, 'level1id2', 'level1name2', 'level2id2-3', 'level2name2-3', 'level3id2-3-1', 'level2name2-3-1', 'level4id2-3-1-1', 'level2name2-3-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(32, 'level1id2', 'level1name2', 'level2id2-3', 'level2name2-3', 'level3id2-3-1', 'level2name2-3-1', 'level4id2-3-1-1', 'level2name2-3-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(33, 'level1id2', 'level1name2', 'level2id2-3', 'level2name2-3', 'level3id2-3-1', 'level2name2-3-1', 'level4id2-3-1-1', 'level2name2-3-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(34, 'level1id3', 'level1name3', 'level2id3-1', 'level2name3-1', 'level3id3-1-1', 'level2name3-1-1', 'level4id3-1-1-1', 'level2name3-1-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(35, 'level1id3', 'level1name3', 'level2id3-1', 'level2name3-1', 'level3id3-1-1', 'level2name3-1-1', 'level4id3-1-1-1', 'level2name3-1-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(36, 'level1id3', 'level1name3', 'level2id3-1', 'level2name3-1', 'level3id3-1-1', 'level2name3-1-1', 'level4id3-1-1-1', 'level2name3-1-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(37, 'level1id3', 'level1name3', 'level2id3-1', 'level2name3-1', 'level3id3-1-1', 'level2name3-1-1', 'level4id3-1-1-1', 'level2name3-1-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(38, 'level1id3', 'level1name3', 'level2id3-1', 'level2name3-1', 'level3id3-1-1', 'level2name3-1-1', 'level4id3-1-1-1', 'level2name3-1-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(39, 'level1id3', 'level1name3', 'level2id3-2', 'level2name3-2', 'level3id3-2-1', 'level2name3-2-1', 'level4id3-2-1-1', 'level2name3-2-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(40, 'level1id3', 'level1name3', 'level2id3-2', 'level2name3-2', 'level3id3-2-1', 'level2name3-2-1', 'level4id3-2-1-1', 'level2name3-2-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(41, 'level1id3', 'level1name3', 'level2id3-2', 'level2name3-2', 'level3id3-2-1', 'level2name3-2-1', 'level4id3-2-1-1', 'level2name3-2-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(42, 'level1id3', 'level1name3', 'level2id3-2', 'level2name3-2', 'level3id3-2-1', 'level2name3-2-1', 'level4id3-2-1-1', 'level2name3-2-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(43, 'level1id3', 'level1name3', 'level2id3-2', 'level2name3-2', 'level3id3-2-1', 'level2name3-2-1', 'level4id3-2-1-1', 'level2name3-2-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(44, 'level1id3', 'level1name3', 'level2id3-2', 'level2name3-2', 'level3id3-2-1', 'level2name3-2-1', 'level4id3-2-1-1', 'level2name3-2-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(45, 'level1id3', 'level1name3', 'level2id3-2', 'level2name3-2', 'level3id3-2-1', 'level2name3-2-1', 'level4id3-2-1-1', 'level2name3-2-1-1', 'level5id', 'level5name', 'level6id', 'level6name'),
(46, 'level1id3', 'level1name3', 'level2id3-3', 'level2name3-3', 'level3id3-3-1', 'level2name3-3-1', 'level4id3-3-1-1', 'level2name3-3-1-1', 'level5id', 'level5name', 'level6id', 'level6name');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
