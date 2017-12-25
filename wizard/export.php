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

  // ソート、フィルタ情報を取得する
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

  // テーブル情報を取得する
  $table_id = "";
  $rs = $db->query("SELECT * FROM sys_table WHERE `table` = '".$table."'");
  if ($row = $rs->fetch_assoc()) {
    $table_id = $row["id"];
  } else {
    exit;
  }

  // テーブル一覧表示定義を取得する
  $column_count = 0;
  $rs = $db->query("SELECT * FROM sys_list WHERE tableid = ".$table_id." AND display = 1 ORDER BY no");
  while ($row = $rs->fetch_assoc()) {
    $column[$column_count] = $row["column"];
    $column_count++;
  }
  
  // ＤＢから、データを取得する
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

  // エラー発生の場合、メッセージを表示し、条件を除くデータを再取得する
	if ($rs == false) {
    $sql = "SELECT id, ".implode($column, ", ")." FROM `".$table."`";
    $rs = $db->query($sql);
	}

  while ($row = $rs->fetch_assoc()) {
    echo array_to_csv($row);
  }
?>