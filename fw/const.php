<?php
/**********************************************************************
  �R�[�h���X�g�p�萔
**********************************************************************/
// �R�[�h��ށF�Œ�
if(!defined("CODE_TYPE_CONST"))     define("CODE_TYPE_CONST" ,"1");
// �R�[�h��ށF�f�[�^�x�[�X
if(!defined("CODE_TYPE_DB")) 	    define("CODE_TYPE_DB" ,"2");

/**********************************************************************
  �t�H�[���p�萔
**********************************************************************/
// �t�H�[���o�͏�ԁF�\��
if(!defined("STATUS_DISPLAY"))      define("STATUS_DISPLAY" ,"1");
// �t�H�[���o�͏�ԁF�񊈐���
if(!defined("STATUS_DISABLE"))      define("STATUS_DISABLE" ,"2");
// �t�H�[���o�͏�ԁF������
if(!defined("STATUS_INPUT"))        define("STATUS_INPUT" ,"3");

// �t�H�[���o�͎�ށF����
if(!defined("FORM_TYPE_TEXT")) 	    define("FORM_TYPE_TEXT" ,"1");
// �t�H�[���o�͎�ށF�I�����X�g
if(!defined("FORM_TYPE_SELECT")) 	  define("FORM_TYPE_SELECT" ,"2");
// �t�H�[���o�͎�ށF�����G���A
if(!defined("FORM_TYPE_TEXTAREA"))  define("FORM_TYPE_TEXTAREA" ,"3");
// �t�H�[���o�͎�ށF�i���i�ҏW�j
if(!defined("FORM_TYPE_PROGRESS_EDIT"))   define("FORM_TYPE_PROGRESS_EDIT" ,"4");
// �t�H�[���o�͎�ށF�i���i�ҏW�s�j
if(!defined("FORM_TYPE_PROGRESS"))   define("FORM_TYPE_PROGRESS" ,"5");
// �t�H�[���o�͎�ށF�p�X���[�h
if(!defined("FORM_TYPE_PASSWORD"))   define("FORM_TYPE_PASSWORD" ,"6");
// �t�H�[���o�͎�ށF�\���p����
if(!defined("FORM_TYPE_DTEXT")) 	  define("FORM_TYPE_DTEXT" ,"7");
// �t�H�[���o�͎�ށF�\���p�R�[�h���X�g
if(!defined("FORM_TYPE_DSELECT"))   define("FORM_TYPE_DSELECT" ,"8");
// �t�H�[���o�͎�ށF�{�^��
if(!defined("FORM_TYPE_BUTTON"))    define("FORM_TYPE_BUTTON" ,"9");
// �t�H�[���o�͎�ށF�`�F�b�N�{�b�N�X
if(!defined("FORM_TYPE_CHECKBOX")) 	define("FORM_TYPE_CHECKBOX" ,"10");
// �t�H�[���o�͎�ށF���W�I
if(!defined("FORM_TYPE_RADIO")) 	define("FORM_TYPE_RADIO" ,"11");
// �t�H�[���o�͎�ށF��\��
if(!defined("FORM_TYPE_HIDDEN"))    define("FORM_TYPE_HIDDEN" ,"12");

/**********************************************************************
  �f�[�^�x�[�X�A�N�V�����p�萔
**********************************************************************/
// �f�[�^�x�[�X�A�N�V������ށF�V�K
if(!defined("DB_ACTION_INSERT"))   define("DB_ACTION_INSERT" ,"insert");
// �f�[�^�x�[�X�A�N�V������ށF�X�V
if(!defined("DB_ACTION_UPDATE"))   define("DB_ACTION_UPDATE" ,"update");
// �f�[�^�x�[�X�A�N�V������ށF�폜
if(!defined("DB_ACTION_DELETE"))   define("DB_ACTION_DELETE" ,"delete");
// �f�[�^�x�[�X�A�N�V������ށF�R�s�[
if(!defined("DB_ACTION_COPY"))   define("DB_ACTION_COPY" ,"copy");

/**********************************************************************
  �V�X�e���Ǘ��p�萔
**********************************************************************/
// �Ǘ��������F�Ȃ�
if(!defined("SYSTEM_ADMIN_NASI"))     define("SYSTEM_ADMIN_NASI" ,"0");
// �Ǘ��������F����
if(!defined("SYSTEM_ADMIN_ARI"))     define("SYSTEM_ADMIN_ARI" ,"1");
// �Ǘ��������F�Ώ�
$system_admin_tables = array( "sys_action", "sys_code", "sys_codevalue", "sys_command", "sys_list", "sys_menu", "sys_style", "sys_table", "sys_team", "sys_user" );
// ���M���e���A�f�[�^�x�[�X�ȊO�Ώ�
$expend_post_array = array( "action_type", "table_name", "action_id", "action_url", "x", "y", "submit", "btnSubmit" );

/**********************************************************************
  ���O�p�萔
**********************************************************************/
// ���O�t�@�C����
if(!defined("FW_LOG_FILENAME"))   define("FW_LOG_FILENAME" ,"../log/webdoc_".date('Ymd').".log");
// �f�[�^�o�b�N�A�b�v�t�@�C��
if(!defined("FW_DATABACK_FILENAME"))   define("FW_DATABACK_FILENAME" ,"../log/webdoc_sqlback_".date('Ymd').".log");

/**********************************************************************
  ���b�N�p�萔
**********************************************************************/
// ���b�N�L������
if(!defined("FW_LOCK_TIME"))   define("FW_LOCK_TIME" ,"600");

?>
