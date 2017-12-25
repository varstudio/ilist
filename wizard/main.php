<?php @session_start(); ?>
<?php include_once("../config.php"); ?>
<?php include_once("../fw/fw-api.php"); ?>
<?php
  // コードリスト
  $codelist = new CodeList();
  
  $rs = $db->query("SELECT max(`code`) as maxcode FROM sys_code WHERE `code` < 'CODE_900'");
  $max_codelist = "";
  if ($row = $rs->fetch_assoc()) {
    $max_codelist = $row["maxcode"];
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
<form name="frmMain" action="table_create.php" method="post" target="_self">
<?php
  /* テーブルの列名を取得する */
  $loopcnt = 0;
  $rs = $db->query("SELECT * FROM sys_list WHERE `tableid` = 2 order by id");
  while($row = $rs->fetch_assoc()) {
    $column[$loopcnt++] = $row["name"];
  }
?>
  <table id="list_table" class="tblList">
    <tr>
      <th width="100px"><?php echo $column[0]; ?></th>
      <td width="180px"><?php display_form(FORM_TYPE_TEXT, "table_id", "", "", STATUS_INPUT); ?></td>
      <th width="100px"><?php echo $column[1]; ?></th>
      <td width="278px"><?php display_form(FORM_TYPE_TEXT, "table_name", "", "", STATUS_INPUT); ?></td>
    </tr>
  </table>
<?php
  /* 一覧の列名を取得する */
  $loopcnt = 0;
  $rs = $db->query("SELECT * FROM sys_list WHERE `tableid` = 3 order by id");
  while($row = $rs->fetch_assoc()) {
    $column[$loopcnt++] = $row["name"];
  }
?>
  <table id="list_table" class="tblList">
    <tr height="5px">
    </tr>
    <tr>
      <th width="100px"><?php echo $column[2]; ?></th>
      <th width="159px"><?php echo $column[3]; ?></th>
      <th width="70px"><?php echo $column[4]; ?></th>
      <th width="60px"><?php echo $column[5]; ?></th>
      <th width="80px"><?php echo $column[6]; ?></th>
      <th width="80px"><?php echo $column[7]; ?></th>
      <th width="80px"><?php echo $column[8]; ?></th>
    </tr>
<?php for($i=0; $i<$CONFIG_CREATE_TABLE_LINES; $i++) { ?>
    <tr>
      <td width="100px"><?php display_form(FORM_TYPE_TEXT, "column_id[]", "", "", STATUS_INPUT); ?></td>
      <td width="159px"><?php display_form(FORM_TYPE_TEXT, "column_name[]", "", "", STATUS_INPUT); ?></td>
      <td width="70px"><?php display_form(FORM_TYPE_SELECT, "column_align[]", "CODE_913", "", STATUS_INPUT); ?></td>
      <td width="60px"><?php display_form(FORM_TYPE_TEXT, "column_width[]", "", "", STATUS_INPUT); ?></td>
      <td width="80px"><?php display_form(FORM_TYPE_SELECT, "column_type[]", "CODE_906", "", STATUS_INPUT); ?></td>
      <td width="80px">
        <select class="select" name="column_code[]">
          <option value=""></option>
          <?php echo $codelist->get_code_select("CODE_904", ""); ?>
          <option value="">=============</option>
          <option value="CODE_<?php echo str_pad((substr($max_codelist, 5, 3) + 1), 3, "0", STR_PAD_LEFT); ?>"><?php echo $T_WIZARD_CODELIST1; ?></option>
          <option value="CODE_<?php echo str_pad((substr($max_codelist, 5, 3) + 2), 3, "0", STR_PAD_LEFT); ?>"><?php echo $T_WIZARD_CODELIST2; ?></option>
          <option value="CODE_<?php echo str_pad((substr($max_codelist, 5, 3) + 3), 3, "0", STR_PAD_LEFT); ?>"><?php echo $T_WIZARD_CODELIST3; ?></option>
          <option value="CODE_<?php echo str_pad((substr($max_codelist, 5, 3) + 4), 3, "0", STR_PAD_LEFT); ?>"><?php echo $T_WIZARD_CODELIST4; ?></option>
        </select>
      </td>
      <td width="80px"><?php display_form(FORM_TYPE_SELECT, "column_status[]", "CODE_908", "1", STATUS_INPUT); ?></td>
    </tr>
<?php } ?>
  </table>
  <table id="list_table" class="tblList">
    <tr height="5px">
    </tr>
    <tr>
      <th width="127px"><?php echo $T_WIZARD_CODELIST1; ?></th>
      <th width="127px"><?php echo $T_WIZARD_CODELIST2; ?></th>
      <th width="127px"><?php echo $T_WIZARD_CODELIST3; ?></th>
      <th width="127px"><?php echo $T_WIZARD_CODELIST4; ?></th>
      <th width="127px"><?php echo $T_WIZARD_CODELIST_SAMP; ?></th>
    </tr>
    <tr height="100px">
      <td width="127px">
        <input type="hidden" name="codelist1_code" value="CODE_<?php echo str_pad((substr($max_codelist, 5, 3) + 1), 3, "0", STR_PAD_LEFT); ?>">
        <?php display_form(FORM_TYPE_TEXTAREA, "codelist1", "", "", STATUS_INPUT); ?>
      </td>
      <td width="127px">
        <input type="hidden" name="codelist2_code" value="CODE_<?php echo str_pad((substr($max_codelist, 5, 3) + 2), 3, "0", STR_PAD_LEFT); ?>">
        <?php display_form(FORM_TYPE_TEXTAREA, "codelist2", "", "", STATUS_INPUT); ?>
      </td>
      <td width="127px">
        <input type="hidden" name="codelist3_code" value="CODE_<?php echo str_pad((substr($max_codelist, 5, 3) + 3), 3, "0", STR_PAD_LEFT); ?>">
        <?php display_form(FORM_TYPE_TEXTAREA, "codelist3", "", "", STATUS_INPUT); ?>
      </td>
      <td width="127px">
        <input type="hidden" name="codelist4_code" value="CODE_<?php echo str_pad((substr($max_codelist, 5, 3) + 4), 3, "0", STR_PAD_LEFT); ?>">
        <?php display_form(FORM_TYPE_TEXTAREA, "codelist4", "", "", STATUS_INPUT); ?>
      </td>
      <td width="127px">
        <textarea readonly="true" class="textarea"><?php echo $T_WIZARD_CODELIST_SAMPTEXT; ?></textarea>
      </td>
    </tr>
  </table>
  <center><input type="button" name="btnSubmit" value="<?php echo $T_WIZARD_CREATE; ?>" OnClick="javascript:frmMain.submit();" /></center>
</form>
</div>
</body>
</html>