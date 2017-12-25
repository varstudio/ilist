<?php @session_start(); ?>
<?php include_once("../config.php"); ?>
<?php include_once("./const.php"); ?>
<?php include_once("./fw-api.php"); ?>
<?php
//var_dump($_POST);
//exit;
  // ユーザ情報
  $uvo = getUvo();

  // 送信内容をチェックする
  if (!array_key_exists("action_type", $_POST))
  {
    logger::errorlog($uvo, "送信内容エラー：アクション種類未設定。");
    exit();
  }

  // 送信内容を取得する
  $action_type = $_POST["action_type"];
  $table_name = $_POST["table_name"];

  // 操作対象ＩＤをチェックする
  if (($action_type == DB_ACTION_UPDATE ||
       $action_type == DB_ACTION_DELETE ||
       $action_type == DB_ACTION_COPY)
      && $_POST['action_id'] == NULL) {
    logger::errorlog($uvo, "送信内容エラー：操作対象未設定。");
    exit();
  }

  // システムの管理権限チェック
  if (in_array($table_name, $system_admin_tables)) {
	  if ($uvo->admin != SYSTEM_ADMIN_ARI) {
      logger::errorlog($uvo, "システムの管理員権限がありません。");
      exit();
	  }
  }

  // 取消操作以外の場合
  if ($action_type != "") {

    // 操作対象を取得する
    $action_id = $_POST['action_id'];
    if (!is_array($action_id)) {
      unset($action_id);
      $action_id[] = $_POST['action_id'];
    }

    // 送信内容を取得する
    $keys_array = array_keys($_POST);
    $values_array = array_values($_POST);
    
    // 送信データ件数により、繰り返し
    for($loop_record=0; $loop_record<count($action_id); $loop_record++) {

      // 初期化
      unset($post_data);

      // 送信データにより、繰り返し
      for($loop_data=0; $loop_data<count($_POST); $loop_data++) {

        // 送信データ名
        // データベース対象以外の場合、次データを取得する
        if (in_array($keys_array[$loop_data], $expend_post_array)) {
          continue;
        }

        // 複数レコードの場合
        if (is_array($values_array[$loop_data])) {
          $value = $values_array[$loop_data][$loop_record];
        } else {
          $value = $values_array[$loop_data];
        }

        // 結果保存
        $key = $keys_array[$loop_data];
        $post_data[$key] = $value;
      }

      // コピーの場合
      if ($action_type == DB_ACTION_COPY) {

        // 設定された内容をクリアする
        unset($post_data);

        // ＤＢからデータ取得
        $sql = "SELECT * FROM $table_name WHERE id = $action_id[$loop_record]";
        $rs = $db->query($sql);

        // 全列名と値取得
  		  if ($row = $rs->fetch_assoc()) {
    			unset($row["id"]);
    			$keys_array = array_keys($row);
    			$values_array = array_values($row);
  		  }

        // ＤＢからのデータを転義
        for($i=0; $i<count($values_array); $i++) {
          $post_data[$keys_array[$i]] = $db->escape_string($values_array[$i]);
        }
      }

      // SQL文作成
      $columns = "";
      $values = "";
      $updatesets = "";
      if ($action_type != DB_ACTION_DELETE) {
        foreach ($post_data as $key => $value) {
          $columns .= "`$key`,";
          $values .= "'$value',";
          $updatesets .= "`$key` = '$value',";
        }
        $columns = substr($columns, 0, strlen($columns)-1);
        $values = substr($values, 0, strlen($values)-1);
        $updatesets = substr($updatesets, 0, strlen($updatesets)-1);
      }

      // SQL文作成
      $sql = "";
      switch ($action_type) {
        case DB_ACTION_INSERT:
        case DB_ACTION_COPY:
          $sql = "INSERT INTO $table_name ($columns) VALUES ($values)";
          break;
        case DB_ACTION_DELETE:
          // 実行前、古いデータをログに出力する
          logger::sqlback($uvo, $table_name, $action_type, $action_id[$loop_record], $sql);
          $sql = "DELETE FROM $table_name WHERE id = $action_id[$loop_record]";
          break;
        case DB_ACTION_UPDATE:
          // 実行前、古いデータをログに出力する
          logger::sqlback($uvo, $table_name, $action_type, $action_id[$loop_record], $sql);
          $sql = "UPDATE $table_name SET $updatesets WHERE id = $action_id[$loop_record]";
          break;
      }

      // SQL実行
      $result=$db->query($sql);
      if ($result != 1) {
        // ログ出力
        logger::errorlog($uvo, "データベース更新エラー：$table_name, $sql");
        exit;
      } else {
        // ログ出力
        logger::sqllog($uvo, $table_name, $action_type, $db->insert_id, $sql);

        // 登録の場合、ROLLBACKログに出力する
        if ($action_type == DB_ACTION_INSERT || $action_type == DB_ACTION_COPY) {
          logger::sqlback($uvo, $table_name, $action_type, $db->insert_id, $sql);
        }
      }
    }
  }

  // unlock
  $tableid = getSession("table");
  $sql = "DELETE FROM sys_lock WHERE tableid = $tableid AND userid = $uvo->id";
  $result = $db->query($sql);

  // 遷移先に遷移する
	$redirurl=$_POST["action_url"];
	header("Location: $redirurl");
?>
