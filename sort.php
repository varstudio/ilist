<?php @session_start(); ?>
<?php include_once("./config.php"); ?>
<?php include_once("./fw/fw-api.php"); ?>
<?php
  // テーブル名を取得する
  $tableid = getRequestOrSesssion("table");
  if ($tableid == "") {
    exit;
  }
  
  // コードリスト
  $codelist = new CodeList();

  // ユーザ情報
  $uvo = getUvo();
?>
<html>
<head>
  <base target="_self"/>
  <title>ソート／フィルタ</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <link href="./css/list.css" rel="stylesheet" type="text/css">
  <link rel="shortcut icon" href="./images/icon.png" type="image/png" />
  <script type="text/javascript" src="./script/jquery.min.js"></script>
<?php
  $finish = getRequestOrSesssion("finish");
  if ($finish == "true") {
    echo "<script language=\"javascript\">\n";
    echo "  if (window.opener != undefined) {\n";
    echo "    window.opener.returnValue=\"finish\";\n";
    echo "  } else {\n";
    echo "    window.returnValue=\"finish\";\n";
    echo "  }\n";
    echo "  window.close();\n";
    echo "</script>\n";
  }
?>
  <script language="javascript">
    $(document).ready(function(){
      $(".groupby").slideToggle(0);

      $("#switch_mode").click(function(){
        $(".groupby").slideToggle(100);
      });
    });
  </script>
</head>
<body>
<div id="container">
<?php
  // テーブル情報を取得する
  $rs = $db->query("SELECT * FROM sys_table WHERE `id` = '".$tableid."'");
  if ($row = $rs->fetch_assoc()) {
    $table_name = $row["name"];
  } else {
    exit;
  }
  
  $column_count = 0;
?>

<div class="title"><?php echo $table_name; ?></div>
  <table border="0"><tr valign="top"><td>
    <table class="tblList">
        <tr>
          <th width="100"><?php echo $T_DATABSET_COLUMN_NAME; ?></th>
          <th width="120"><?php echo $T_SCREEN_COLUMN_NAME; ?></th>
          <th width="180"><?php echo $T_CODELIST_VALUE; ?></th>
        </tr>
<?php
        $loop_count = 1;
        
        // リスト定義情報を取得し、出力する
        $rs = $db->query("SELECT * FROM sys_list WHERE tableid = ".$tableid." ORDER BY no");
        while ($row = $rs->fetch_assoc()) {

          // 行スタイル設定
		      if ($loop_count % 2 == 1) {
            echo "<tr class=\"odd\">\n";
		      } else {
            echo "<tr class=\"even\">\n";
          }

          echo "<td>".$row["column"]."</td>\n";
          echo "<td>".$row["name"]."</td>\n";
          if ($row["type"] == FORM_TYPE_SELECT ||
              $row["type"] == FORM_TYPE_DSELECT) {
            echo "<td>";
            $codelist->display_codelist($row["code"]);
            echo "</td>\n";
          } else {
            echo "<td></td>\n";
          }
          echo "</tr>\n";
          
          $loop_count++;
        }
        ?>
  </table>
  </td>
  <td></td>
  <td>
  <form name="frmDisabled" action="./fw/dbaction.php" method="post">
  <input type="hidden" name="table_name" value="sys_sort">
  <input type="hidden" name="action_type" value="update">
  <input type="hidden" name="action_url" value="../sort.php?finish=true">
  <?php
  // ソート定義情報を取得し、出力する
  $id = "";
  $rs = $db->query("SELECT * FROM sys_sort WHERE `tableid` = $tableid AND `userid` = $uvo->id ORDER BY updtime desc");
  while ($row = $rs->fetch_assoc()) {
    $id = $row["id"];
?>
  <input type="hidden" name="action_id[]" value="<?php echo $id; ?>">
  <input type="hidden" name="enabled[]" value="0">
  <input type="hidden" name="updtime[]" value="<?php echo time(); ?>">
<?php
  }
  
  if ($id != "") {
?>
  <table class="tbl_noborder">
    <tr>
      <td width="264px" align="center">
        <input type="button" class="orange_wide" name="displayMode" value="<?php echo $T_SORT_DISPLAY_MODE; ?>" id="switch_mode">
        <input type="button" class="orange_wide" name="frmSubmit" value="<?php echo $T_SORTFILTER_DISABLE; ?>" onclick="javascript:frmDisabled.submit();">
      </td>
    </tr>
  </table>
<?php
  }
?>
  </form>
<?php
  $i=0;
  $rs->data_seek(0);
  while ($row = $rs->fetch_assoc()) {
    $id = $row["id"];
    $sort = $row["sort"];
    $group = $row["group"];
    $filter = $row["filter"];
    $memo = $row["memo"];
  ?>
  <form name="frmMain<?php echo $i; ?>" action="./fw/dbaction.php" method="post">
  <input type="hidden" name="table_name" value="sys_sort">
  <input type="hidden" name="action_type" value="update">
  <input type="hidden" name="action_url" value="../sort.php?finish=true">
  <input type="hidden" name="action_id" value="<?php echo $id; ?>">
  <input type="hidden" name="tableid" value="<?php echo $tableid; ?>">
  <input type="hidden" name="userid" value="<?php echo $uvo->id; ?>">
  <input type="hidden" name="updtime" value="<?php echo time(); ?>">
  <input type="hidden" name="enabled" value="1">
  <table class="tblList">
    <tr height="35">
      <th width="100"><?php echo $T_SORTFILTER_WHERE; ?></th>
      <td width="200" id="orderby">
        <textarea name="filter" class="textarea_s" col="60" row="3"><?php echo $filter ?></textarea>
      </td>
    </tr>
    <tr height="35" class="groupby">
      <th><?php echo $T_SORTFILTER_GROUPBY; ?></th>
      <td>
        <textarea name="group" class="textarea_s" col="60" row="3"><?php echo $group ?></textarea>
      </td>
    </tr>
    <tr height="35" class="groupby">
      <th><?php echo $T_SORTFILTER_ORDERBY; ?></th>
      <td >
        <textarea name="sort" class="textarea_s" col="60" row="3"><?php echo $sort ?></textarea>
      </td>
    </tr>
    <tr height="35" class="groupby">
      <th><?php echo $T_SORTFILTER_MEMO; ?></th>
      <td >
        <textarea name="memo" class="textarea_s" col="60" row="3"><?php echo $memo ?></textarea>
      </td>
    </tr>
    <tr height="35">
      <td colspan="2">
        <input type="button" class="orange_wide" name="frmSubmit" value="<?php echo $T_SORTFILTER_ENABLE; ?>" onclick="javascript:frmMain<?php echo $i; ?>.submit();">
        <input type="button" class="orange" name="delete" value="<?php echo $T_BUTTON_DELETE; ?>" onclick="javascript:frmMain<?php echo $i; ?>.action_type.value='delete';frmMain<?php echo $i; ?>.submit();">
      </td>
    </tr>
  </table>
  </form>
  <?php
    $i++;
  }
  ?>

  <form name="frmMain" action="./fw/dbaction.php" method="post">
  <input type="hidden" name="table_name" value="sys_sort">
  <input type="hidden" name="action_type" value="insert">
  <input type="hidden" name="action_url" value="../sort.php?finish=true">
  <input type="hidden" name="action_id" value="">
  <input type="hidden" name="tableid" value="<?php echo $tableid; ?>">
  <input type="hidden" name="userid" value="<?php echo $uvo->id; ?>">
  <input type="hidden" name="updtime" value="<?php echo time(); ?>">
  <input type="hidden" name="enabled" value="1">
  <table class="tblList">
    <tr height="35">
      <th width="100"><?php echo $T_SORTFILTER_WHERE; ?></th>
      <td width="200">
        <textarea name="filter" class="textarea_s" col="60" row="3"></textarea>
      </td>
    </tr>
    <tr height="35">
      <th><?php echo $T_SORTFILTER_GROUPBY; ?></th>
      <td>
        <textarea name="group" class="textarea_s" col="60" row="3"></textarea>
      </td>
    </tr>
    <tr height="35">
      <th><?php echo $T_SORTFILTER_ORDERBY; ?></th>
      <td >
        <textarea name="sort" class="textarea_s" col="60" row="3"></textarea>
      </td>
    </tr>
    <tr height="35">
      <th><?php echo $T_SORTFILTER_MEMO; ?></th>
      <td >
        <textarea name="memo" class="textarea_s" col="60" row="3"></textarea>
      </td>
    </tr>
    <tr height="35">
      <td colspan="2">
        <input type="submit" class="orange_wide" name="submit" value="<?php echo $T_SORTFILTER_ENABLE; ?>">
      </td>
    </tr>
  </table>
</form>
</td></tr></table>
</div>
</body>
</html>
