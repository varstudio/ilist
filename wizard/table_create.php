<?php @session_start(); ?>
<?php include_once("../config.php"); ?>
<?php include_once("../fw/fw-api.php"); ?>
<?php
  $table_id = $_POST["table_id"];
  $table_name = $_POST["table_name"];
  $column_id = "";
  $column_name = "";
  $column_align = "";
  $column_width = "";
  $column_type = "";
  $column_code = "";
  $column_status = "";
  
  for($i=0; $i<count($_POST["column_id"]); $i++)
  {
    if ($_POST["column_id"][$i] != "")
    {
      $column_id[$i] = $_POST["column_id"][$i];
      $column_name[$i] = $_POST["column_name"][$i];
      $column_align[$i] = $_POST["column_align"][$i];
      $column_width[$i] = $_POST["column_width"][$i];
      $column_type[$i] = $_POST["column_type"][$i];
      $column_code[$i] = $_POST["column_code"][$i];
      $column_status[$i] = $_POST["column_status"][$i];
    } else {
      break;
    }
  }
  
  $log_count = 0;
  
  $sql  = "INSERT INTO sys_table";
  $sql .= " ( ";
  $sql .= " `table`, name ";
  $sql .= " ) values ( ";
  $sql .= " '".$table_id."', ";
  $sql .= " '".$table_name."' ";
  $sql .= " ) ";

$log[$log_count++] = $sql;

  $result = $db->query($sql);
  if ($result != 1) {
    echo $sql."<br>INSERT ERROR!";
    exit;
  }

  $tableid = mysqli_insert_id($db);

  for($i=0; $i<count($column_id); $i++)
  {
    $sql  = "INSERT INTO sys_list";
    $sql .= " ( ";
    $sql .= " `tableid`, no, `column`, `name`, width, align, type, code, display ";
    $sql .= " ) values ( ";
    $sql .= " '".$tableid."', ";
    $sql .= " '".(($i+1) * 10)."', ";
    $sql .= " '".$column_id[$i]."', ";
    $sql .= " '".$column_name[$i]."', ";
    $sql .= " '".$column_width[$i]."', ";
    $sql .= " '".$column_align[$i]."', ";
    $sql .= " '".$column_type[$i]."', ";
    $sql .= " '".$column_code[$i]."', ";
    $sql .= " '".$column_status[$i]."' ";
    $sql .= " ) ";
    
$log[$log_count++] = $sql;

    $result = $db->query($sql);
    if ($result != 1) {
      echo $sql."<br>INSERT ERROR!";
      exit;
    }
  }

  $sql  = "CREATE TABLE IF NOT EXISTS ";
  $sql .= $table_id;
  $sql .= " ( ";
  $sql .= " `id` int(11) NOT NULL AUTO_INCREMENT, ";
  $sql .= implode(" text, ", $column_id);
  $sql .= " text, ";
  $sql .= " PRIMARY KEY (`id`) ";
  $sql .= " ) DEFAULT CHARSET=utf8 ";
  
$log[$log_count++] = $sql;

  $result = $db->query($sql);
  if ($result != 1) {
    echo $sql."<br>INSERT ERROR!";
    exit;
  }

  if ($_POST["codelist1"] != "") {
    insert_codelist($_POST["codelist1_code"], $_POST["codelist1"], $db);
  }
  if ($_POST["codelist2"] != "") {
    insert_codelist($_POST["codelist2_code"], $_POST["codelist2"], $db);
  }
  if ($_POST["codelist3"] != "") {
    insert_codelist($_POST["codelist3_code"], $_POST["codelist3"], $db);
  }
  if ($_POST["codelist4"] != "") {
    insert_codelist($_POST["codelist4_code"], $_POST["codelist4"], $db);
  }

  $sql  = "INSERT INTO sys_menu";
  $sql .= " ( ";
  $sql .= " name, tableid, status, status_admin ";
  $sql .= " ) values ( ";
  $sql .= " '".$table_name."', ";
  $sql .= " '".$tableid."', ";
  $sql .= " '1', ";
  $sql .= " '2' ";
  $sql .= " ) ";

$log[$log_count++] = $sql;

  $result = $db->query($sql);
  if ($result != 1) {
    echo $sql."<br>INSERT ERROR!";
    exit;
  }
    

  function insert_codelist($codeid, $codelist_text, $db) {

    global $log;
    global $log_count;

    $codelist1 = explode("\r\n", $codelist_text);
    
    $code = explode(",", $codelist1[0]);
    
    $code_type = "";
    $code_table = "";
    if ($code[1] != "DB") {
      $code_type = "1";
    } else {
      $code_type = "2";
      $code_table = $code[2];
    }
    
    $sql  = "INSERT INTO sys_code";
    $sql .= " ( ";
    $sql .= " code, type, `table`, name ";
    $sql .= " ) values ( ";
    $sql .= " '".$codeid."', ";
    $sql .= " '".$code_type."', ";
    $sql .= " '".$code_table."', ";
    $sql .= " '".$code[0]."' ";
    $sql .= " ) ";

$log[$log_count++] = $sql;

    $result = $db->query($sql);
    if ($result != 1) {
      echo $sql."<br>INSERT ERROR!";
      exit;
    }

    $codeid = mysqli_insert_id($db);
    for($i=1; $i<count($codelist1); $i++) {
	    $code = explode(",", $codelist1[$i]);
    	
    	$sql = "";
    	$sql .= "INSERT INTO sys_codevalue";
	    $sql .= " ( ";
	    $sql .= " code, value, name ";
	    $sql .= " ) values ( ";
	    $sql .= " '".$codeid."', ";
	    $sql .= " '".$code[0]."', ";
	    $sql .= " '".$code[1]."' ";
	    $sql .= " ) ";

$log[$log_count++] = $sql;

      $result = $db->query($sql);
  	  if ($result != 1) {
  	    echo $sql."<br>INSERT ERROR!";
  	    exit;
  	  }
    }
  }

?>
<html>
<head>
  <title><?php echo $T_WIZARD_TITLE; ?></title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <link href="../css/list.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="container">
<div class="title"><?php echo $T_WIZARD_TITLE; ?></div>
<form name="frmMain" action="create_table.php" method="post" target="_self">
  <table id="list_table" class="tblList">
    <tr><th width="100px">SQL LOG</th></tr>
<?php $line_style = "odd";
      foreach ($log as $logvalue) {
        echo "<tr class=\"$line_style\"><td>$logvalue</td></tr>\n";
        $line_style=="odd"?$line_style="even":$line_style="odd";
      }
      echo "<tr class=\"$line_style\"><td style=\"color:red;\">$T_WIZARD_FISISH</td></tr>\n";
?>
  </table>
</form>
</div>
</body>
</html>