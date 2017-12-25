<?php @session_start(); ?>
<?php include_once("../config.php"); ?>
<?php include_once("../fw/fw-api.php"); ?>
<?php
  // テーブル名を取得する
  $level = getRequestOrSesssion("level");

  // アクションを取得する
  $parent = getRequestOrSesssion("parent");

  if ($level != "1" && $parent == "") {
    echo "<option value=\"\"></option>\n";
    return;
  }
  
  $sql = "";
  if ($level == "1") {
    $sql = "SELECT level1id, level1name FROM mst_sizai GROUP BY level1id";
  } else {
    $sql = "SELECT level".$level."id, level".$level."name FROM mst_sizai WHERE level".($level-1)."id = '".$parent."'  GROUP BY level".$level."id";
  }
  
  $rs = $db->query($sql);
  if ($level != "6") {
    echo "<option value=\"\"></option>\n";
    while ($row = $rs->fetch_row()) {
      echo "<option value=\"".$row[0]."\">".$row[1]."</option>\n";
    }
  } else {
    $row = $rs->fetch_row();
    echo $row[1];
  }
?>