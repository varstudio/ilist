<?php @session_start(); ?>
<?php include_once("../config.php"); ?>
<?php include_once("./fw-api.php"); ?>
<?php
  /**
  * Generatting CSV formatted string from an array.
  * By Sergey Gurevich.
  */
  function array_to_csv($array, $col_sep = ",", $row_sep = "\n", $qut = '"')
  {
  	if (!is_array($array)) return false;
  	
  	//Data rows.
  	$tmp = '';
  	foreach ($array as $key => $val)
  	{
  		$val = str_replace($qut, "$qut$qut", $val);
  		$tmp .= "$col_sep$qut$val$qut";
  	}
  	return substr($tmp, 1).$row_sep;
  }
  
  $table = getRequestOrSesssion("table");
  
  header("Content-type: text/comma-separated-values");
  header("Content-Disposition: attachment; filename=\"$table".$date('Y-m-d')."csv");

  // �\�[�g�A�t�B���^�����擾����
  $rs = $db->query("SELECT * FROM sys_sort WHERE `table` = '".$table."' AND `user` = '".$_SERVER["REMOTE_ADDR"]."' AND enabled='1' ORDER BY updtime desc");
  if ($row = $rs->fetch_assoc()) {
    $group = $row["group"];
    $sort = $row["sort"];
    $filter = $row["filter"];
  } else {
    $group = "";
    $sort = "";
    $filter = "";
  }

  // �e�[�u�������擾����
  $table_id = "";
  $rs = $db->query("SELECT * FROM sys_table WHERE `table` = '".$table."'");
  if ($row = $rs->fetch_assoc()) {
    $table_id = $row["id"];
  } else {
    exit;
  }

  // �e�[�u���ꗗ�\����`���擾����
  $column_count = 0;
  $rs = $db->query("SELECT * FROM sys_list WHERE tableid = ".$table_id." AND display = 1 ORDER BY no");
  while ($row = $rs->fetch_assoc()) {
    $column[$column_count] = $row["column"];
    $column_count++;
  }
  
  // �c�a����A�f�[�^���擾����
  $sql = "SELECT id, ".implode($column, ", ")." FROM `".$table."`";

  if ($filter <> "") {
    $sql .= " WHERE ".$filter;
  }
  if ($group <> "") {
    $sql .= " GROUP BY ".$group;
  }
  if ($sort <> "") {
    $sql .= " ORDER BY ".$sort;
  }

  $rs = $db->query($sql);

  // �G���[�����̏ꍇ�A���b�Z�[�W��\�����A�����������f�[�^���Ď擾����
	if ($rs == false) {
    $sql = "SELECT id, ".implode($column, ", ")." FROM `".$table."`";
    $rs = $db->query($sql);
	}

  while ($row = $rs->fetch_assoc()) {
    echo array_to_csv($row);
  }
?>