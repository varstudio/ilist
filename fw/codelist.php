<?php
/**********************************************************************
							codelist
***********************************************************************/
class CodeList  {

  // データベース
  var $db;
  
  // コードリスト変数
  var $code_list;

  /* 
   * ＤＢから、コードリストの内容を取得する。
   */
  function get_values_from_db($code) {

    // コード"CODE_999"により、コード情報を取得する
    $rs = $this->db->query("SELECT * FROM sys_code WHERE code = '".$code."'");
    if ($row = $rs->fetch_assoc()) {
      $code_type = $row["type"];
      $table_name = $row["table"];
    } else {
      return;
    }

    // コードＩＤにより、コードリストを取得する
    $rs = $this->db->query("SELECT value, name FROM sys_codevalue WHERE code = ".$row["id"]." ORDER BY value");

    // ＤＢコードの場合、指定テーブルから、コードリストを取得する
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
    // コードリスト変数を設定する
    while ($row = $rs->fetch_assoc()) {
      $code_array[$row["value"]] = $row["name"];
    }
    
    // 戻る
    return $code_array;
  }
  
  /***********************************
		 		Constructor
	************************************/
  // コードリスト設定していない場合、取得する
  function CodeList() {

    // データベースリンクを作成する
    global $db;
    $this->db = $db;

    // コード定義から、情報を取得する
    $code = "";
    $rs = $db->query("SELECT * FROM sys_code ORDER BY id");
    while ($row = $rs->fetch_assoc()) {
      $code = $row["code"];
      $this->code_list[$code] = $this->get_values_from_db($code);
    }
  }
  
  /* 
   * コード"CODE_999"、コード値により、コード名を取得する
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
