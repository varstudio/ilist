<?php @session_start(); ?>
<?php include_once("./config.php"); ?>
<?php include_once("./fw/fw-api.php"); ?>
<?php
  // テーブル名を取得する
  $tableid = getRequestOrSesssion("table");
  
  // アクションを取得する
  $action = getRequestOrSesssion("act");
  
  // 対象レコードを取得する
  $id = getArrayRequestOrSesssion("id");
  
  // 対象レコードを取得する
  $mode = getRequestOrSesssion("mode");
  
  // コードリスト
  $codelist = new CodeList();
  
  // ユーザ情報
  $uvo = getUvo();
?>
<html>
<head>
  <title><?php echo $T_SYSTEM_NAME; ?></title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <link href="./css/list.css" rel="stylesheet" type="text/css">
  <link rel="shortcut icon" href="./images/icon.png" type="image/png" />
  <script type="text/javascript" src="./script/jquery.min.js"></script>
  <script language="javascript">
    // 一覧表示エリアのスクロールバー調整
  	$(window).resize(function() {
      var windowheight = document.body.clientHeight;
      var menuheight = $("#divtags").height();
      var buttonheight = $("#CommandArea").height();
      $("#list_bx").height(windowheight - menuheight - buttonheight - 35);
    });

    // 一覧表示エリアのスクロールバー調整
    $(document).ready(function() {
      var windowheight = document.body.clientHeight;
      var menuheight = $("#divtags").height();
      var buttonheight = $("#CommandArea").height();
      $("#list_bx").height(windowheight - menuheight - buttonheight - 35);
      
      // 操作対象レコードへ遷移
      location.hash="focus_line";
    });
  </script>
  <script language="javascript">
    // 全選択操作
    function selectAll(checked) {
      var sel = document.getElementsByName("selFlg");
	    for(i=0;i<sel.length;i++) {
	      sel[i].checked = checked;
	    }
    }
  </script>
  <script language="javascript">
    // メッセージ表示
    function showMsg() {
      var returnValue = window.showModalDialog(
                    "./message.php",
                    "",
                    "dialogWidth=800px;dialogHeight=600px;toolbar=no,menubar=no,scrollbars=auto,resizable=no,location=no,status=no"
                    );
      window.location.reload();
    }

    // テーブル作成
    function create_table() {
      var returnValue = window.showModalDialog(
                    "./wizard/main.php",
                    "",
                    "dialogWidth=700px;dialogHeight=600px;toolbar=no,menubar=no,scrollbars=auto,resizable=no,location=no,status=no"
                    );
      window.location.reload();
    }
  </script>
  <script language="javascript">
    // 機能ボタンの操作
<?php
    // ＤＢから、アクションScriptを取得する
    $rs = $db->query("SELECT * FROM sys_action");
    while ($row = $rs->fetch_assoc()) {
      echo "    // ".$row["name"]."\n";
      echo "    function action_".$row["action"]." (action) {\n";
      echo "      ".implode("\n          ", split("\n", $row["script"]))."\n";
      echo "    }\n\n";
    }
?>
  </script>
</head>
<body>
<div id="container">
  <div id="divtags">
  <ul id="tags">
<?php
      // 管理者モード判定と切替
      if ($uvo != null && $uvo->admin == "1") {
        if ($mode != "") {
          $uvo->mode = $mode;
          setUvo($uvo);
          $tableid = "";
        }
      }

      // モードにより、メニューから、表示項目を取得する
      $menu_status = "";
      if ($uvo->mode == "a") {
        $menu_status = "status_admin";
      } else {
        $menu_status = "status";
      }

      // 全体メニューを取得する
      $sql = "SELECT * FROM sys_menu WHERE $menu_status = '1'";
      $rs = $db->query($sql);
      while ($row = $rs->fetch_assoc()) {
      	$list_table = $row["tableid"];
      	$list_table_name = $row["name"];
        if ($list_table == $tableid) {
      	  $selmenu = " class=\"selecttag\"";
        } else {
      	  $selmenu = "";
        }
        
        // メニューリンクを作成する
        echo "    <li$selmenu><a href=\"index.php?table=$list_table\" target=\"_self\">$list_table_name</a></li>\n";
      }
      
      // メッセージ通信
      $message_count = 0;
      // $sql = "SELECT count(1) as recnum FROM sys_message WHERE status = '1' and ((sendtype='1' and recver = $uvo->id) or (sendtype='2' and recver in ($uvo->team)))";
      $sql = "SELECT count(1) as recnum FROM sys_message ";
      $sql .= "   LEFT JOIN sys_msgstatus ";
      $sql .= "          ON sys_message.id = sys_msgstatus.msgid ";
      $sql .= "         AND sys_msgstatus.user = $uvo->id ";
      $sql .= "       WHERE (status = '1' OR status is null) ";
      $sql .= "         AND ((sendtype='1' and recver = $uvo->id) OR (sendtype='2' and recver in ($uvo->team)))";

      $sql = "SELECT count(1) as recnum FROM ( ";
      $sql .= "SELECT count(1) FROM sys_message ";
      $sql .= "   LEFT JOIN sys_msgstatus ";
      $sql .= "          ON sys_message.id = sys_msgstatus.msgid ";
      $sql .= "         AND sys_msgstatus.user = $uvo->id ";
      $sql .= "  WHERE (sendtype='1' AND recver = $uvo->id) OR (sendtype='2' AND recver IN ($uvo->team)) ";
      $sql .= "GROUP BY sys_message.id, ";
      $sql .= "        sys_message.sendtype, ";
      $sql .= "        sys_message.sendtime, ";
      $sql .= "        sys_message.sender, ";
      $sql .= "        sys_message.recver, ";
      $sql .= "        sys_message.content ";
      $sql .= "HAVING MAX(sys_msgstatus.status) = '1' OR MAX(sys_msgstatus.status) IS NULL ";
      $sql .= " ) as a ";

      $rs = $db->query($sql);
      if ($row = $rs->fetch_assoc()) {
      	$message_count = $row["recnum"];
      }

      // メッセージ件数により、表示色を設定する
      if ($message_count != 0) {
        echo "    <li><a href=\"#\" style=\"color:blue;\" onclick=\"showMsg();\">$T_MESSAGE(".$message_count."$T_MESSAGE_COUNT)</a></li>\n";
      } else {
        echo "    <li><a href=\"#\" onclick=\"showMsg();\">$T_MESSAGE</a></li>\n";
      }

      // 管理者権限あるの場合、モード切替リンクを作成する
      if ($uvo != null && $uvo->admin == "1") {
        if ($uvo->mode == "a") {
          echo "    <li><a href=\"#\" onclick=\"create_table();\">$T_CREATETABLE</a></li>\n";
          echo "    <li><a href=\"index.php?mode=c\">$T_OPERATE_MODE</a></li>\n";
        } elseif ($uvo->mode  == "c") {
          echo "    <li><a href=\"index.php?mode=a\">$T_ADMIN_MODE</a></li>\n";
        }
      }
?>
  </ul>
</div>
<?php
  // 初期表示時、メニューだけ表示する
  if ($tableid == "") {
    exit;
  } else {
    setSession("table", $tableid);
  }

  // テーブル情報を取得する
  $rs = $db->query("SELECT * FROM sys_table WHERE `id` = '".$tableid."'");
  if ($row = $rs->fetch_assoc()) {
    $table_name = $row["table"];
  } else {
    exit;
  }
?>

<div id="CommandArea" class="CommandArea">
  <form name="frmCommand" action="index.php?table=<?php echo $tableid; ?>" target="_self" method="post">
    <input type="hidden" name="id" value="">
    <input type="hidden" name="act" value="insert">
<?php
  // 該当テーブルのコマンドボタンを取得する
  $rs = $db->query("SELECT * FROM sys_command WHERE `tableid` = '".$tableid."' ORDER BY no");
  if (!$rs || $rs->num_rows == 0) {
	  $rs = $db->query("SELECT * FROM sys_command WHERE `tableid` = 1 ORDER BY no");
  }
  
  // 順番に、ボタンを表示する。
  while ($row = $rs->fetch_assoc()) {
	  $disable = "";
	  if (($action != "" && $row["enable"] == "1" )
          || ($action == "" && $row["enable"] == "2")) {
		  $disable = "disabled";
	  }

    if ($disable == "") {
      echo "    <input type=\"button\" class=\"orange\" name=\"btnCommand\" value=\"";
      echo $row["name"];
      echo "\" onclick=\"javascript:action_".$row["action"]."('".$row["action"]."')\"";
      echo ">\n";
    }
  }
?>
  </form>
</div>
<?php
  // ソート、フィルタ情報を取得する
  $rs = $db->query("SELECT * FROM sys_sort WHERE `tableid` = $tableid AND `userid` = $uvo->id AND enabled='1' ORDER BY updtime desc");
  if ($row = $rs->fetch_assoc()) {
    $group = $row["group"];
    $sort = $row["sort"];
    $filter = $row["filter"];
  } else {
    $group = "";
    $sort = "";
    $filter = "";
  }

  // スタイル定義情報を取得する。
  $styleColumn = "";
  $styleType = "";
  $styleValue = "";
  $style = "";

  $rs = $db->query("SELECT * FROM sys_style WHERE `tableid` = '".$tableid."'");
  if ($row = $rs->fetch_assoc()) {
    $styleColumn = $row["column"];
    $styleType = $row["style_type"];
    $styleValue = $row["value"];
    $style = $row["style"];
  }
  
  /* 繰り返し変数を初期化する */
  $column_count = 0;
?>

<form name="frmMain" action="./fw/dbaction.php" method="post" target="_self">
  <input type="hidden" name="table_name" value="<?php echo $table_name ?>">
  <input type="hidden" name="action_type" value="<?php echo $action ?>">
  <input type="hidden" name="action_url" value="../index.php?table=<?php echo $tableid ?>">
  <div id="list_bx" class="list_bx">
    <table id="list_table" class="tblList">
      <col style="width: 30px;" />
      <col style="width: 30px;" />
<?php
      // テーブル一覧表示定義を取得する
      $rs = $db->query("SELECT * FROM sys_list WHERE tableid = ".$tableid." AND display = 1 ORDER BY no");

      // 各列幅を設定する
      while ($row = $rs->fetch_assoc()) {
          echo "      <col style=\"width: ".$row["width"]."px;\" />\n";
      }
      
      // タイトル行を表示する
      echo "      <tr>\n";
      echo "        <th></th>\n";

      // 全選択チェックボックスを出力する
      echo "        <th>";
      if ($action == "") {
          echo "<input type=\"checkbox\" name=\"checkAll\" onclick=\"javascript:selectAll(this.checked)\">";
      }
      echo "</th>\n";
      
      // １レコード目から、タイトルを表示する
      $rs->data_seek(0);
      while ($row = $rs->fetch_assoc()) {
        $column[$column_count] = $row["column"];
        $column_type[$column_count] = $row["type"];
        $column_code[$column_count] = $row["code"];
        $column_align[$column_count] = $row["align"];
        
        echo "        <th>".$row["name"]."</th>\n";
        
        $column_count++;
      }
      echo "      </tr>\n";

      // ＤＢから、ロックデータを取得する
      if ($action != "") {
        $lockid[] = "";
        $sql = "SELECT recordid  FROM sys_lock WHERE tableid = $tableid AND userid <> $uvo->id AND locktime >=".(time()-FW_LOCK_TIME);
        $rs = $db->query($sql);
        while ($row = $rs->fetch_assoc()) {
          $lockid[] = $row["recordid"];
        }
        
        // 本回対象をロックする
        foreach($id as $value) {
          $sql = "INSERT INTO sys_lock ( tableid, userid, recordid, locktime ) VALUES ( $tableid, $uvo->id, $value, ".time().")";
  	      $result=$db->query($sql);
        }
        
        // 操作対象から、ロックされているデータを除く
        $resultid = array_diff($id, $lockid);
        if (count($id) != count($resultid)) {
    			echo "<li class=\"message\">$T_LOCK_ERROR_MESSAGE</li>\n";
          $id = $resultid;
        }
      } else {
        // unlock
        $sql = "DELETE FROM sys_lock WHERE tableid = $tableid AND userid = $uvo->id";
        $result = $db->query($sql);
      }

      // ＤＢから、データを取得する
      $sql = "SELECT id, ".implode($column, ", ")." FROM `".$table_name."`";
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
  			echo "<li class=\"message\">$T_SORT_ERROR_MESSAGE</li>\n";
	      $sql = "SELECT id, ".implode($column, ", ")." FROM `".$table_name."`";
 	      $rs = $db->query($sql);
  		}

      // 全体列名を取得する
  		if ($rs != false) {
  		  $i = 0;
  		  $finfo = $rs->fetch_fields();
  		  foreach ($finfo as $val) {
  			if ($i == 0) { $i++; continue; }
          $column[$i-1] = $val->name;
          $i++;
  		  }
  		}

      // 初期化、繰り返す
      $record_count = 0;
      while ($row = $rs->fetch_assoc()) {
        
        // 最大表示レコード数を制御する
        // if ($record_count++ > 1000) break;
        $record_count++;
        
        // 操作により、行色を設定する
        echo "      ";
        if ($action == "delete" && in_array($row["id"], $id)) {
          // 削除の場合、赤色
          echo "<tr class=\"delete\">\n";
        } else if ($action == "copy" && in_array($row["id"], $id)) {
          // コピーの場合、緑色
          echo "<tr class=\"copy\">\n";
  		  } else if ($styleColumn != "" && $styleType = "1" && $row[$styleColumn] == $styleValue) {
          // 自定スータイルあれば、設定
          echo "<tr class=\"".$style."\">\n";
	 	    } else if ($record_count % 2 == 1) {
          // 奇数行
          echo "<tr class=\"odd\">\n";
		    } else {
          // 偶数行
           echo "<tr class=\"even\">\n";
        }

        // 行番号
        echo "        <td align=\"center\">$record_count</td>\n";

        // 選択列を表示する
        echo "        <td class=\"list_check\">";
        $stauts = STATUS_DISPLAY;
        switch($action) {
          // 新規の場合、表示しない
          case "insert":
            break;
          // 更新の場合、選択済レコードのＩＤを出力する
          case "update":
            if (in_array($row["id"], $id)) {
              $stauts = STATUS_INPUT;
              echo "<input type=\"hidden\" name=\"action_id[]\" value=\"".$row["id"]."\">";
              echo "<a id=\"focus_line\" href=\"#\"></a>";
            }
            break;
          // 削除の場合、選択済レコードのＩＤを出力する
          case "delete":
            if (in_array($row["id"], $id)) {
              echo "<input type=\"hidden\" name=\"action_id[]\" value=\"".$row["id"]."\">";
              echo "<a id=\"focus_line\" href=\"#\"></a>";
            }
            break;
          case "copy":
            if (in_array($row["id"], $id)) {
              echo "<input type=\"hidden\" name=\"action_id[]\" value=\"".$row["id"]."\">";
              echo "<a id=\"focus_line\" href=\"#\"></a>";
            }
            break;
          // 上記以外の場合、表示する
          default:
            echo "<input name=\"selFlg\" id=\"check\" type=\"checkbox\" ";
            echo "value=\"".$row["id"]."\">";
            break;
        }
        echo "</td>\n";
        
        // データを出力する
        for($i=0; $i < $column_count; $i++) {
          //echo "<td class=\"list_string\"";
          echo "        <td ";
          switch($column_align[$i]) {
            case 1:echo "align=\"left\"";
                   break;
            case 2:echo "align=\"center\"";
                   break;
            case 3:echo "align=\"right\"";
                   break;
            case 4:echo "align=\"justify\"";
                   break;
            default:
                   break;
          }
          echo ">";

          // 列内容を表示する
          display_form($column_type[$i], $column[$i]."[]", $column_code[$i], $row[$column[$i]], $stauts);
          echo "</td>\n";
        }
        echo "      </tr>\n";
      }
      
      // 行番号をカウンタする
      $record_count++;

      // 登録の場合、入力エリアを表示する
      if ($action == "insert") {
        
        // 登録件数を取得
        $id = getRequestOrSesssion("id");

        // 未設定の場合、１件登録
        if ($id == "") {
          echo "      <tr>\n";
          echo "        <td align=\"center\">$record_count</td>\n";
          echo "        <td>";
          echo "<a id=\"focus_line\" href=\"#\"></a>";
          echo "</td>\n";
          for($i=0; $i < $column_count; $i++) {
            echo "<td class=\"list_string\">";
            display_form($column_type[$i], $column[$i], $column_code[$i], "", STATUS_INPUT);
            echo "</td>\n";
          }
          echo "      </tr>\n";
        } else {
          $insertNum = $id;

          // 複数件登録
          for($j=0; $j<$insertNum; $j++) {
            echo "      <tr>\n";
            echo "        <td align=\"center\">$record_count</td>\n";
            echo "        <td>";
              echo "<input type=\"hidden\" name=\"action_id[]\" value=\"".$j."\">";
              if ($j==0) {
              	echo "<a id=\"focus_line\" href=\"#\"></a>";
              }
              echo "</td>\n";
            for($i=0; $i < $column_count; $i++) {
              echo "        <td class=\"list_string\">";
              display_form($column_type[$i], $column[$i]."[]", $column_code[$i], "", STATUS_INPUT);
              echo "</td>\n";
            }
            echo "      </tr>\n";
            $record_count++;
          }
        }
      }
      ?>
  </table>
</div>
</form>
</div>
</body>
</html>
