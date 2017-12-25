<?php @session_start(); ?>
<?php include_once("./config.php"); ?>
<?php include_once("./fw/fw-api.php"); ?>
<?php
  // アクションを取得する
  $action = getRequestOrSesssion("act");
  
  // 対象レコードを取得する
  $id = getArrayRequestOrSesssion("id");
  
  // 対象レコードを取得する
  $tab = getRequestOrSesssion("tab");
  if ($tab == "") {
    $tab = "1";
  }
  
  // コードリスト
  $codelist = new CodeList();
  
  // user info
  $uvo = getUvo();
  
  // アクションを取得する
  $search = getRequestOrSesssion("search");
  
  $mode = "";
  // replyの場合
  if ($action == "reply") {
    $action = "insert";
    $tab = "4";
    $mode = "reply";

    $sql = "INSERT INTO sys_msgstatus (msgid, user, status) VALUES ($id[0], $uvo->id, 2)";
    $result = $db->query($sql);
  }

  // resendの場合
  elseif ($action == "resend") {
    $action = "insert";
    
    $sendtype = "";
    $sql = "SELECT * FROM sys_message WHERE id = $id[0]";
    $rs = $db->query($sql);
    if ($row = $rs->fetch_assoc()) {
      $sendtype = $row["sendtype"];
    }
    
    if ($sendtype == "2") {
      $tab = "5";
    } else {
      $tab = "4";
    }
    $mode = "resend";
  }
?>
<html>
<head>
  <base target="_self"/>
  <title><?php echo $T_MESSAGE; ?></title>
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
    // 機能ボタンの操作
    function btnClick(action) {

        // 送信
        if (action == "send") {
          frmMain.action_type.value = "insert";
          frmMain.submit();
        }

        // 済みに
        if (action == "readed") {
          var id = "";
          if (frmMain.selFlg == null) { return false; }
          for(i=0;i<frmMain.selFlg.length;i++) {
            if (frmMain.selFlg[i].checked == true) {
              if (id == "") {
                id = frmMain.selFlg[i].value;
              } else {
                id = id + "," + frmMain.selFlg[i].value;
              }
            }
          }
          if (id == "") {
            if (frmMain.selFlg.checked == true)
              id = frmMain.selFlg.value;
            }
          if (id == "") { return false; }
          frmCommand.id.value = id;
          frmCommand.act.value = action;
          frmCommand.submit();
        }

        // reply
        if (action == "reply") {
          var id = "";
          if (frmMain.selFlg == null) { return false; }
          for(i=0;i<frmMain.selFlg.length;i++) {
            if (frmMain.selFlg[i].checked == true) {
              if (id == "") {
                id = frmMain.selFlg[i].value;
                break;
              }
            }
          }
          if (id == "") { if (frmMain.selFlg.checked == true) id = frmMain.selFlg.value; }
          if (id == "") { return false; }
          frmCommand.id.value = id;
          frmCommand.act.value = action;
          frmCommand.submit();
        }

        // reply
        if (action == "resend") {
          var id = "";
          if (frmMain.selFlg == null) { return false; }
          for(i=0;i<frmMain.selFlg.length;i++) {
            if (frmMain.selFlg[i].checked == true) {
              if (id == "") {
                id = frmMain.selFlg[i].value;
                break;
              }
            }
          }
          if (id == "") { if (frmMain.selFlg.checked == true) id = frmMain.selFlg.value; }
          if (id == "") { return false; }
          frmCommand.id.value = id;
          frmCommand.act.value = action;
          frmCommand.submit();
        }

        // 削除
        if (action == "delete") {
          var id = "";
          if (frmMain.selFlg == null) { return false; }
          for(i=0;i<frmMain.selFlg.length;i++) {
            if (frmMain.selFlg[i].checked == true) {
              if (id == "") {
                id = frmMain.selFlg[i].value;
              } else {
              id = id + "," + frmMain.selFlg[i].value;
              }
            }
          }
          if (id == "") { if (frmMain.selFlg.checked == true) id = frmMain.selFlg.value; }
          if (id == "") { return false; }
          frmCommand.id.value = id;
          frmCommand.act.value = action;
          frmCommand.submit();
        }
        
        // 検索
        if (action == "search") {
          frmCommand.submit();
        }
        
        // 取消
        if (action == "cancel") {
          frmCommand.id.value = "";
          frmCommand.act.value = "";
          frmCommand.submit();
        }

        // 確定
        if (action == "confirm") {
          frmMain.submit();
        }
    }
  </script>
</head>
<body>
<div id="container">

<div id="divtags">
  <ul id="tags">
<?php
    $selmenu[1] = "";
    $selmenu[2] = "";
    $selmenu[3] = "";
    $selmenu[4] = "";
    $selmenu[5] = "";
    $selmenu[6] = "";
    if ($tab == "") {
      $selmenu[1] = " class=\"selecttag\"";
    } else {
      $selmenu[$tab] = " class=\"selecttag\"";
    }
    
    // メニューリンクを作成する
    echo "    <li$selmenu[1]><a href=\"message.php?tab=1\">$T_MESSAGE_TAB_UNREAD</a></li>\n";
    echo "    <li$selmenu[2]><a href=\"message.php?tab=2\">$T_MESSAGE_TAB_READED</a></li>\n";
    echo "    <li$selmenu[3]><a href=\"message.php?tab=3\">$T_MESSAGE_TAB_SENT</a></li>\n";
    echo "    <li$selmenu[4]><a href=\"message.php?tab=4\">$T_MESSAGE_TAB_SEND2P</a></li>\n";
    echo "    <li$selmenu[5]><a href=\"message.php?tab=5\">$T_MESSAGE_TAB_SEND2T</a></li>\n";
    echo "    <li$selmenu[6]><a href=\"message.php?tab=6\">$T_MESSAGE_TAB_SEARCH</a></li>\n";
?>
  </ul>
</div>
<div id="CommandArea" class="CommandArea">
  <form name="frmCommand" action="message.php" method="post">
    <input type="hidden" name="id" value="">
    <input type="hidden" name="act" value="insert">
    <input type="hidden" name="tab" value="<?php echo $tab; ?>">
<?php if ($action != "" && $tab != "4" && $tab != "5" && $tab != "6") { ?>
    <input type="button" class="orange" name="btnCommand" value="<?php echo $T_BUTTON_CANCEL; ?>" onclick="javascript:btnClick('cancel')" >
    <input type="button" class="orange" name="btnCommand" value="<?php echo $T_BUTTON_OK; ?>" onclick="javascript:btnClick('confirm')" >
<?php } else if ($tab == "1") { ?>
    <input type="button" class="orange_wide" name="btnCommand" value="<?php echo $T_MESSAGE_MARK_READED; ?>" onclick="javascript:btnClick('readed')" >
    <input type="button" class="orange" name="btnCommand" value="<?php echo $T_BUTTON_DELETE; ?>" onclick="javascript:btnClick('delete')" >
    <input type="button" class="orange" name="btnCommand" value="<?php echo $T_MESSAGE_REPLY; ?>" onclick="javascript:btnClick('reply')" >
<?php } else if ($tab == "2") { ?>
    <input type="button" class="orange" name="btnCommand" value="<?php echo $T_BUTTON_DELETE; ?>" onclick="javascript:btnClick('delete')" >
    <input type="button" class="orange" name="btnCommand" value="<?php echo $T_MESSAGE_REPLY; ?>" onclick="javascript:btnClick('reply')" >
<?php } else if ($tab == "3") { ?>
    <input type="button" class="orange" name="btnCommand" value="<?php echo $T_MESSAGE_RESEND; ?>" onclick="javascript:btnClick('resend')" >
    <input type="button" class="orange" name="btnCommand" value="<?php echo $T_BUTTON_DELETE; ?>" onclick="javascript:btnClick('delete')" >
<?php } else if ($tab == "4" || $tab == "5") { ?>
    <input type="button" class="orange" name="btnCommand" value="<?php echo $T_MESSAGE_SEND; ?>" onclick="javascript:btnClick('send')" >
<?php } else if ($tab == "6") { ?>
    <input type="button" class="orange" name="btnCommand" value="<?php echo $T_MESSAGE_SEARCH; ?>" onclick="javascript:btnClick('search')" >
    <input type="text" name="search" value="<?php echo $search; ?>">
<?php } ?>
  </form>
</div>

<form name="frmMain" action="./fw/dbaction.php" method="post">
<?php if ($tab == "1" || $tab == "2" || $tab == "3") { ?>
  <input type="hidden" name="table_name" value="sys_msgstatus">
<?php } else { ?>
  <input type="hidden" name="table_name" value="sys_message">
<?php } ?>
  <input type="hidden" name="action_type" value="insert">
  <input type="hidden" name="action_url" value="../message.php?tab=<?php echo $tab; ?>">
<?php
  if ($tab == "4") {
    echo "<input type=\"hidden\" name=\"sender\" value=\"$uvo->id\">";
    echo "<input type=\"hidden\" name=\"sendtype\" value=\"1\">";
  } elseif ($tab == "5") {
    echo "<input type=\"hidden\" name=\"sender\" value=\"$uvo->id\">";
    echo "<input type=\"hidden\" name=\"sendtype\" value=\"2\">";
  }
?>
  <div id="list_bx" class="list_bx">
    <table id="list_table" class="tblList">
<?php
      if ($tab == "" || $tab == "1" ||  $tab == "2" || $tab == "3") {
        echo "      <col style=\"width:30px;\" />\n";
        echo "      <col style=\"width:30px;\" />\n";
        echo "      <col style=\"width:60px;\" />\n";
        echo "      <col style=\"width:100px;\" />\n";
        
        if ($tab == "3") {
          // 状態
          echo "      <col style=\"width:60px;\" />\n";
        }
        echo "      <col style=\"width:400px;\" />\n";

        // 全選択チェックボックスを出力する
        echo "      <tr>\n";
        echo "        <th>$T_MESSAGE_NUMBER</th>\n";
        if ($action == "") {
          echo "        <th><input type=\"checkbox\" name=\"checkAll\" onclick=\"javascript:selectAll(this.checked)\"></th>\n";
        } else {
        echo "        <th></th>\n";
        }

        if ($tab == "" || $tab == "1" ||  $tab == "2") {
          // 送信者
          echo "        <th>$T_MESSAGE_SENDER</th>\n";
        } elseif ($tab == "3") {
          // 受信者
          echo "        <th>$T_MESSAGE_RECVER</th>\n";
          // 状態
          echo "        <th>$T_MESSAGE_STATUS</th>\n";
        }
        echo "        <th>$T_MESSAGE_SENDTIME</th>\n";
        echo "        <th>$T_MESSAGE_CONTENT</th>\n";
        echo "      </tr>\n";

        // テーブル一覧表示定義を取得する
        $sql = "SELECT sys_message.*, sys_msgstatus.status as status FROM sys_message ";
        $sql .= "   LEFT JOIN sys_msgstatus ";
        $sql .= "          ON sys_message.id = sys_msgstatus.msgid ";
        $sql .= "         AND sys_msgstatus.user = $uvo->id ";
        $sql_groupby = "GROUP BY sys_message.id, ";
        $sql_groupby .= "        sys_message.sendtype, ";
        $sql_groupby .= "        sys_message.sendtime, ";
        $sql_groupby .= "        sys_message.sender, ";
        $sql_groupby .= "        sys_message.recver, ";
        $sql_groupby .= "        sys_message.content ";
        if ($tab == "1") {
          $sql .= "WHERE (sendtype='1' AND recver = $uvo->id) OR (sendtype='2' AND recver IN ($uvo->team)) ";
          $sql .= $sql_groupby;
          $sql .= "HAVING MAX(sys_msgstatus.status) = '1' OR MAX(sys_msgstatus.status) IS NULL ";
        } elseif ($tab == "2") {
          $sql .= "WHERE (sendtype='1' AND recver = $uvo->id) OR (sendtype='2' AND recver IN ($uvo->team)) ";
          $sql .= $sql_groupby;
          $sql .= "HAVING MAX(sys_msgstatus.status) = '2' ";
        } elseif ($tab == "3") {
          $sql .= "WHERE sender = $uvo->id ";
          $sql .= $sql_groupby;
          $sql .= "HAVING MAX(sys_msgstatus.status) <> '3' OR MAX(sys_msgstatus.status) IS NULL ";
        }
        $sql .= " ORDER BY sys_msgstatus.id DESC, sys_message.id DESC ";

        $rs = $db->query($sql);

        // １レコード目から、列幅を設定する
        $record_count = 1;
        while ($row = $rs->fetch_assoc()) {

          // 操作により、行色を設定する
          echo "      ";
          if ($action == "readed" && in_array($row["id"], $id)) {
            // 済みにの場合、緑色
            echo "<tr class=\"copy\">\n";
          } elseif ($action == "delete" && in_array($row["id"], $id)) {
            // 削除の場合、赤色
            echo "<tr class=\"delete\">\n";
  	 	    } elseif ($record_count % 2 == 1) {
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
            case "readed":
              if (in_array($row["id"], $id)) {
                $stauts = STATUS_INPUT;
                echo "<input type=\"hidden\" name=\"action_id[]\" value=\"\">";
                echo "<input type=\"hidden\" name=\"msgid[]\" value=\"".$row["id"]."\">";
                echo "<input type=\"hidden\" name=\"user[]\" value=\"".$uvo->id."\">";
                echo "<input type=\"hidden\" name=\"status[]\" value=\"2\">";
                echo "<a id=\"focus_line\" href=\"#\"></a>";
              }
              break;
            // 削除の場合、選択済レコードのＩＤを出力する
            case "delete":
              if (in_array($row["id"], $id)) {
                echo "<input type=\"hidden\" name=\"action_id[]\" value=\"\">";
                echo "<input type=\"hidden\" name=\"msgid[]\" value=\"".$row["id"]."\">";
                echo "<input type=\"hidden\" name=\"user[]\" value=\"".$uvo->id."\">";
                echo "<input type=\"hidden\" name=\"status[]\" value=\"3\">";
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
          
          if ($tab == "1" ||  $tab == "2") {
            // 送信者
            echo "<td align=\"center\">";
            echo $codelist->get_code_value("CODE_901", $row["sender"]);
            echo "</td>";
          } elseif ($tab == "3") {
            
            // 個人へ送信の場合
            if ($row["sendtype"] == "1") {
              // 受信者
              echo "<td align=\"center\">";
              echo $codelist->get_code_value("CODE_901", $row["recver"]);
              echo "</td>";

              // 状態
              echo "<td align=\"center\">";
              $sql = " SELECT max(status) as status FROM sys_msgstatus ";
              $sql .= " WHERE msgid = ".$row["id"];
              $rs_status = $db->query($sql);
              if ($row_status = $rs_status->fetch_assoc()) {
                echo $codelist->get_code_value("CODE_911", $row_status["status"]);
              } else {
                echo $codelist->get_code_value("CODE_911", "");
              }
              echo "</td>";

            // チームへ送信の場合
            } else {
              // 受信者
              echo "<td align=\"center\">";
              echo $codelist->get_code_value("CODE_912", $row["recver"]);

              // チーム人員数を取得する
              $team_num = 0;
              $sql = " SELECT count(1) as recnum FROM sys_team ";
              $sql .= " WHERE teamid = ".$row["recver"];
              $rs_status = $db->query($sql);
              if ($row_status = $rs_status->fetch_assoc()) {
                $team_num = $row_status["recnum"];
              }
              echo "($team_num)";
              echo "</td>";

              // 状態
              echo "<td align=\"center\">";
              $sql = " SELECT count(1) as recnum FROM sys_msgstatus ";
              $sql .= " WHERE msgid = ".$row["id"];
              $sql .= "   AND status = '2'";
              $rs_status = $db->query($sql);
              if ($row_status = $rs_status->fetch_assoc()) {
                echo "$T_MESSAGE_STATUS_READED(".$row_status["recnum"].")";
              }

              $sql = " SELECT count(1) as recnum FROM sys_msgstatus ";
              $sql .= " WHERE msgid = ".$row["id"];
              $sql .= "   AND status = '3'";
              $rs_status = $db->query($sql);
              if ($row_status = $rs_status->fetch_assoc()) {
                echo "<br>$T_MESSAGE_STATUS_DELETED(".$row_status["recnum"].")";
              }
              echo "</td>";
            }
          }

          // 送信時間
          echo "<td align=\"center\">".$row["sendtime"]."</td>";

          // 送信内容
          echo "<td>";
          display_form(FORM_TYPE_TEXTAREA, "content", "", $row["content"], STATUS_DISPLAY);
          echo "</td>";

          echo "      </tr>\n";
          
          // 行番号をカウンタする
          $record_count++;
        }
      } elseif ($tab == "4") {
        
        $sender = "";
        $recver = "";
        $content = "";
        
        // テーブル一覧表示定義を取得する
        if ($mode == "reply" || $mode == "resend") {
          $sql = "SELECT * FROM sys_message WHERE id = $id[0]";

          $rs = $db->query($sql);

          if ($row = $rs->fetch_assoc()) {
            $sender = $row["sender"];
            $recver = $row["recver"];
            if ($mode == "resend") {
              $content = $row["content"];
            } else {
              $content .= ">".implode("\r\n>", split("\r\n", $row["content"]))."\r\n";
              $content .= "\n";
            }
          }
        }

        echo "      <tr>\n";
        echo "        <th width=\"100px\">$T_MESSAGE_RECVER</th>\n";
        echo "        <td width=\"500px\">";
        if ($mode == "reply" || $mode =="") {
          display_form(FORM_TYPE_SELECT, "recver", "CODE_901", $sender, STATUS_INPUT);
        } elseif ($mode == "resend") {
          display_form(FORM_TYPE_SELECT, "recver", "CODE_901", $recver, STATUS_INPUT);
        }
        echo "</td>\n";
        echo "      </tr>\n";

        echo "      <tr height=\"200px\">\n";
        echo "        <th width=\"100px\">$T_MESSAGE_CONTENT</th>\n";
        echo "        <td>";
        display_form(FORM_TYPE_TEXTAREA, "content", "", $content, STATUS_INPUT);
        echo "</td>\n";
        echo "      </tr>\n";
        
        echo "      <input type=\"hidden\" name=\"sendtime\" value=\"".date("m/d H:i")."\">\n";
      } elseif ($tab == "5") {
        $sender = "";
        $recver = "";
        $content = "";
        
        // テーブル一覧表示定義を取得する
        if ($mode == "reply" || $mode == "resend") {
          $sql = "SELECT * FROM sys_message WHERE id = $id[0]";

          $rs = $db->query($sql);

          if ($row = $rs->fetch_assoc()) {
            $sender = $row["sender"];
            $recver = $row["recver"];
            
            if ($mode == "resend") {
              $content = $row["content"];
            } else {
              $content .= ">".implode("\r\n>", split("\r\n", $row["content"]))."\r\n";
              $content .= "\n";
            }
          }
        }

        echo "      <tr>\n";
        echo "        <th width=\"100px\">$T_MESSAGE_RECVER</th>\n";
        echo "        <td width=\"500px\">";
        if ($mode == "resend" || $mode == "") {
          display_form(FORM_TYPE_SELECT, "recver", "CODE_912", $recver, STATUS_INPUT);
        }
        echo "</td>\n";
        echo "      </tr>\n";

        echo "      <tr height=\"200px\">\n";
        echo "        <th width=\"100px\">$T_MESSAGE_CONTENT</th>\n";
        echo "        <td>";
        display_form(FORM_TYPE_TEXTAREA, "content", "", $content, STATUS_INPUT);
        echo "</td>\n";
        echo "      </tr>\n";
        echo "      <input type=\"hidden\" name=\"sendtime\" value=\"".date("m/d H:i")."\">\n";
      
      // search
      } elseif ($tab == "6" && $search != null) {
        echo "      <col style=\"width:30px;\" />\n";
        echo "      <col style=\"width:100px;\" />\n";
        echo "      <col style=\"width:100px;\" />\n";
        echo "      <col style=\"width:60px;\" />\n";
        echo "      <col style=\"width:60px;\" />\n";
        echo "      <col style=\"width:400px;\" />\n";

        echo "      <tr>\n";
        echo "        <th>$T_MESSAGE_NUMBER</th>\n";
        echo "        <th>$T_MESSAGE_SENDER</th>\n";
        echo "        <th>$T_MESSAGE_RECVER</th>\n";
        echo "        <th>$T_MESSAGE_STATUS</th>\n";
        echo "        <th>$T_MESSAGE_SENDTIME</th>\n";
        echo "        <th>$T_MESSAGE_CONTENT</th>\n";
        echo "      </tr>\n";

        $sql = "SELECT * FROM sys_message WHERE ((sendtype='1' and recver = $uvo->id) or (sendtype='2' and recver in ($uvo->team)) or (sender = $uvo->id)) and content like '%$search%'";
        $sql .= " ORDER BY id DESC ";
        $rs = $db->query($sql);

        // １レコード目から、列幅を設定する
        $record_count = 1;
        while ($row = $rs->fetch_assoc()) {

          // 操作により、行色を設定する
          echo "      ";
  	 	    if ($record_count % 2 == 1) {
            // 奇数行
            echo "<tr class=\"odd\">\n";
  		    } else {
            // 偶数行
             echo "<tr class=\"even\">\n";
          }

          // 行番号
          echo "        <td align=\"center\">$record_count</td>\n";
          
          // 送信者
          echo "<td align=\"center\">";
          echo $codelist->get_code_value("CODE_901", $row["sender"]);
          echo "</td>";

          // 個人へ送信の場合
          if ($row["sendtype"] == "1") {
            // 受信者
            echo "<td align=\"center\">";
            echo $codelist->get_code_value("CODE_901", $row["recver"]);
            echo "</td>";

            // 状態
            echo "<td align=\"center\">";
            $sql = " SELECT max(status) as status FROM sys_msgstatus ";
            $sql .= " WHERE msgid = ".$row["id"];
            $rs_status = $db->query($sql);
            if ($row_status = $rs_status->fetch_assoc()) {
              echo $codelist->get_code_value("CODE_911", $row_status["status"]);
            } else {
              echo $codelist->get_code_value("CODE_911", "");
            }
            echo "</td>";

          // チームへ送信の場合
          } else {
            // 受信者
            echo "<td align=\"center\">";
            echo $codelist->get_code_value("CODE_912", $row["recver"]);

            // チーム人員数を取得する
            $team_num = 0;
            $sql = " SELECT count(1) as recnum FROM sys_team ";
            $sql .= " WHERE teamid = ".$row["recver"];
            $rs_status = $db->query($sql);
            if ($row_status = $rs_status->fetch_assoc()) {
              $team_num = $row_status["recnum"];
            }
            echo "($team_num)";
            echo "</td>";

            // 状態
            echo "<td align=\"center\">";
            $sql = " SELECT count(1) as recnum FROM sys_msgstatus ";
            $sql .= " WHERE msgid = ".$row["id"];
            $sql .= "   AND status = '2'";
            $rs_status = $db->query($sql);
            if ($row_status = $rs_status->fetch_assoc()) {
              echo "$T_MESSAGE_STATUS_READED(".$row_status["recnum"].")";
            }

            $sql = " SELECT count(1) as recnum FROM sys_msgstatus ";
            $sql .= " WHERE msgid = ".$row["id"];
            $sql .= "   AND status = '3'";
            $rs_status = $db->query($sql);
            if ($row_status = $rs_status->fetch_assoc()) {
              echo "<br>$T_MESSAGE_STATUS_DELETED(".$row_status["recnum"].")";
            }
            echo "</td>";
          }
          
          // 送信時間
          echo "<td align=\"center\">".$row["sendtime"]."</td>";

          // 送信内容
          echo "<td>";
          display_form(FORM_TYPE_TEXTAREA, "content", "", $row["content"], STATUS_DISPLAY);
          echo "</td>";

          echo "      </tr>\n";
          
          // 行番号をカウンタする
          $record_count++;
        }
      }
      ?>
  </table>
</div>
</form>
</div>
</body>
</html>
