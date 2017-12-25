<?php
/**********************************************************************
							codelist
***********************************************************************/
class CodeList  {

  // �f�[�^�x�[�X
  var $db;
  
  // �R�[�h���X�g�ϐ�
  var $code_list;

  /* 
   * �c�a����A�R�[�h���X�g�̓��e���擾����B
   */
  function get_values_from_db($code) {

    // �R�[�h"CODE_999"�ɂ��A�R�[�h�����擾����
    $rs = $this->db->query("SELECT * FROM sys_code WHERE code = '".$code."'");
    if ($row = $rs->fetch_assoc()) {
      $code_type = $row["type"];
      $table_name = $row["table"];
    } else {
      return;
    }

    // �R�[�h�h�c�ɂ��A�R�[�h���X�g���擾����
    $rs = $this->db->query("SELECT value, name FROM sys_codevalue WHERE code = ".$row["id"]." ORDER BY value");

    // �c�a�R�[�h�̏ꍇ�A�w��e�[�u������A�R�[�h���X�g���擾����
    if ($code_type == CODE_TYPE_DB) {
      if ($row = $rs->fetch_assoc()) {
        $sql = "SELECT ";
        $sql .= $row["value"]." as value, ";
        $sql .= $row["name"]." as name ";
        $sql .= " FROM ".$table_name;
        $sql .= " ORDER BY ".$row["value"];
        $rs = $this->db->query($sql);
      } else {
        return;
      }
    }

    $code_array = null;
    // �R�[�h���X�g�ϐ���ݒ肷��
    while ($row = $rs->fetch_assoc()) {
      $code_array[$row["value"]] = $row["name"];
    }
    
    // �߂�
    return $code_array;
  }
  
  /***********************************
		 		Constructor
	************************************/
  // �R�[�h���X�g�ݒ肵�Ă��Ȃ��ꍇ�A�擾����
  function CodeList() {

    // �f�[�^�x�[�X�����N���쐬����
    global $db;
    $this->db = $db;

    // �R�[�h��`����A�����擾����
    $code = "";
    $rs = $db->query("SELECT * FROM sys_code ORDER BY id");
    while ($row = $rs->fetch_assoc()) {
      $code = $row["code"];
      $this->code_list[$code] = $this->get_values_from_db($code);
    }
  }
  
  /* 
   * �R�[�h"CODE_999"�A�R�[�h�l�ɂ��A�R�[�h�����擾����
   */
  function get_code_value($code, $value) {
    if (!isset($this->code_list[$code][$value])) {
      return "";
    } else {
      return $this->code_list[$code][$value];
    }
  }
  
  function get_code_keys($code) {
    if (!isset($this->code_list[$code])) {
      return "";
    } else {
      return array_keys($this->code_list[$code]);
    }
  }
  
  function get_code_select($code, $value) {
    $select_string = "";
    
    $code_keys = array_keys($this->code_list[$code]);
    foreach ($code_keys as $code_key) {
      if ($code_key == $value) {
        $select_string .= "<option ";
        $select_string .= "value=\"".$code_key."\" ";
        $select_string .= "selected>";
        $select_string .= $this->code_list[$code][$code_key];
        $select_string .= "</option>\n";
      } else {
        $select_string .= "<option ";
        $select_string .= "value=\"".$code_key."\" ";
        $select_string .= ">";
        $select_string .= $this->code_list[$code][$code_key];
        $select_string .= "</option>\n";
      }
    }
    
    return $select_string;
  }
  
  function get_code_check($code, $value) {
    return;
  }

  function display_codelist($code) {
    echo "<pre>";
    $code_keys = array_keys($this->code_list[$code]);
    foreach ($code_keys as $code_key) {
      echo $code_key.":".$this->code_list[$code][$code_key]."\n";
    }
    echo "</pre>";
    return;
  }
  
  function dump_codelist() {
    echo "<pre>";
    var_dump($this->code_list);
    echo "</pre>";
    return;
  }
}
?>
