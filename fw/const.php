<?php
/**********************************************************************
  コードリスト用定数
**********************************************************************/
// コード種類：固定
if(!defined("CODE_TYPE_CONST"))     define("CODE_TYPE_CONST" ,"1");
// コード種類：データベース
if(!defined("CODE_TYPE_DB")) 	    define("CODE_TYPE_DB" ,"2");

/**********************************************************************
  フォーム用定数
**********************************************************************/
// フォーム出力状態：表示
if(!defined("STATUS_DISPLAY"))      define("STATUS_DISPLAY" ,"1");
// フォーム出力状態：非活性化
if(!defined("STATUS_DISABLE"))      define("STATUS_DISABLE" ,"2");
// フォーム出力状態：活性化
if(!defined("STATUS_INPUT"))        define("STATUS_INPUT" ,"3");

// フォーム出力種類：文字
if(!defined("FORM_TYPE_TEXT")) 	    define("FORM_TYPE_TEXT" ,"1");
// フォーム出力種類：選択リスト
if(!defined("FORM_TYPE_SELECT")) 	  define("FORM_TYPE_SELECT" ,"2");
// フォーム出力種類：文字エリア
if(!defined("FORM_TYPE_TEXTAREA"))  define("FORM_TYPE_TEXTAREA" ,"3");
// フォーム出力種類：進捗（編集可）
if(!defined("FORM_TYPE_PROGRESS_EDIT"))   define("FORM_TYPE_PROGRESS_EDIT" ,"4");
// フォーム出力種類：進捗（編集不可）
if(!defined("FORM_TYPE_PROGRESS"))   define("FORM_TYPE_PROGRESS" ,"5");
// フォーム出力種類：パスワード
if(!defined("FORM_TYPE_PASSWORD"))   define("FORM_TYPE_PASSWORD" ,"6");
// フォーム出力種類：表示用文字
if(!defined("FORM_TYPE_DTEXT")) 	  define("FORM_TYPE_DTEXT" ,"7");
// フォーム出力種類：表示用コードリスト
if(!defined("FORM_TYPE_DSELECT"))   define("FORM_TYPE_DSELECT" ,"8");
// フォーム出力種類：ボタン
if(!defined("FORM_TYPE_BUTTON"))    define("FORM_TYPE_BUTTON" ,"9");
// フォーム出力種類：チェックボックス
if(!defined("FORM_TYPE_CHECKBOX")) 	define("FORM_TYPE_CHECKBOX" ,"10");
// フォーム出力種類：ラジオ
if(!defined("FORM_TYPE_RADIO")) 	define("FORM_TYPE_RADIO" ,"11");
// フォーム出力種類：非表示
if(!defined("FORM_TYPE_HIDDEN"))    define("FORM_TYPE_HIDDEN" ,"12");

/**********************************************************************
  データベースアクション用定数
**********************************************************************/
// データベースアクション種類：新規
if(!defined("DB_ACTION_INSERT"))   define("DB_ACTION_INSERT" ,"insert");
// データベースアクション種類：更新
if(!defined("DB_ACTION_UPDATE"))   define("DB_ACTION_UPDATE" ,"update");
// データベースアクション種類：削除
if(!defined("DB_ACTION_DELETE"))   define("DB_ACTION_DELETE" ,"delete");
// データベースアクション種類：コピー
if(!defined("DB_ACTION_COPY"))   define("DB_ACTION_COPY" ,"copy");

/**********************************************************************
  システム管理用定数
**********************************************************************/
// 管理員権限：なし
if(!defined("SYSTEM_ADMIN_NASI"))     define("SYSTEM_ADMIN_NASI" ,"0");
// 管理員権限：あり
if(!defined("SYSTEM_ADMIN_ARI"))     define("SYSTEM_ADMIN_ARI" ,"1");
// 管理員権限：対象
$system_admin_tables = array( "sys_action", "sys_code", "sys_codevalue", "sys_command", "sys_list", "sys_menu", "sys_style", "sys_table", "sys_team", "sys_user" );
// 送信内容中、データベース以外対象
$expend_post_array = array( "action_type", "table_name", "action_id", "action_url", "x", "y", "submit", "btnSubmit" );

/**********************************************************************
  ログ用定数
**********************************************************************/
// ログファイル名
if(!defined("FW_LOG_FILENAME"))   define("FW_LOG_FILENAME" ,"../log/webdoc_".date('Ymd').".log");
// データバックアップファイル
if(!defined("FW_DATABACK_FILENAME"))   define("FW_DATABACK_FILENAME" ,"../log/webdoc_sqlback_".date('Ymd').".log");

/**********************************************************************
  ロック用定数
**********************************************************************/
// ロック有効時間
if(!defined("FW_LOCK_TIME"))   define("FW_LOCK_TIME" ,"600");

?>
