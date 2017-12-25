<?php
/**********************************************************************
							logger
***********************************************************************/
class logger {
	
	/******************************************************************
	* SQL BACKUP LOG
	*******************************************************************/
	public static function sqlback($uvo, $table_name, $action, $id, $sql) {

        // データベースに接続する
        global $db;

        // 古い内容を読み込み
        $sqllog = "";
        if (file_exists(FW_DATABACK_FILENAME)) {
            $sqllog = file_get_contents(FW_DATABACK_FILENAME);
        }

        // ログ出力開始
        $fd_sqllog = @fopen(FW_DATABACK_FILENAME, "w");

        // 時間
        fputs($fd_sqllog, "-- ".date("[Y-m-d H:i:s]"));
        
        // ユーザ
        fputs($fd_sqllog, "[".$uvo->user."]");

        // テーブル名
        fputs($fd_sqllog, "[".$table_name."]");

        // テーブル名
        fputs($fd_sqllog, "[".$action."]");

        // ID
        fputs($fd_sqllog, "[".$id."]");

        // SQL
        fputs($fd_sqllog, "\r\n");

        // sql rollback
        switch($action) {
            case DB_ACTION_INSERT:
            case DB_ACTION_COPY:
                fputs($fd_sqllog, "DELETE FROM $table_name WHERE id = $id;");
                break;
            case DB_ACTION_UPDATE:
                $sql = "SELECT * FROM $table_name WHERE id = $id";
                $rs = $db->query($sql);

        	      if ($row = $rs->fetch_assoc()) {
        		      $keys_array = array_keys($row);
        		      $values_array = array_values($row);
          		  }

                $updatesql = "";
                for($i=0; $i<count($keys_array); $i++) {
                  $key = $keys_array[$i];
                  $value = $db->escape_string($values_array[$i]);

                  if($updatesql == "") {
                    $updatesql = "`".$key."` = '".$value."' ";
                  } else {
                    $updatesql = $updatesql.", `".$key."` = '".$value."' ";
                  }
                }

                $sql = "UPDATE ".$table_name." SET ".$updatesql." WHERE id = ".$id.";";
                fputs($fd_sqllog, $sql);
                break;

            case DB_ACTION_DELETE:
                $sql = "SELECT * FROM $table_name WHERE id = $id";
                $rs = $db->query($sql);

        	    if ($row = $rs->fetch_assoc()) {
        		   $keys_array = array_keys($row);
        		   $values_array = array_values($row);
        		}

                for($i=0; $i<count($values_array); $i++) {
                    $values_array[$i] = $db->escape_string($values_array[$i]);
                }
                
        	    $sql = "INSERT INTO ".$table_name." ( `".implode($keys_array, "`, `")."` ) values ( '".implode($values_array, "', '")."' );";
                fputs($fd_sqllog, $sql);
                break;
        }

        // 改行
        fputs($fd_sqllog, "\r\n");

        // 古い内容を書き込み
        fputs($fd_sqllog, $sqllog);

        // ログ出力終了
        fclose($fd_sqllog); 
	}

	/******************************************************************
	* SQL LOG
	*******************************************************************/
	public static function sqllog($uvo, $table_name, $action, $id, $sql) {

        // ログ出力開始
        $fd_log = @fopen(FW_LOG_FILENAME, "a");

        // 時間
        fputs($fd_log, date("[Y-m-d H:i:s]"));
        
        // ユーザ
        fputs($fd_log, "[".$uvo->user."]");

        // テーブル名
        fputs($fd_log, "[".$table_name."]");

        // テーブル名
        fputs($fd_log, "[".$action."]");

        // ID
        fputs($fd_log, "[".$id."]");

        // SQL
        fputs($fd_log, "[".str_replace("\r\n", "\\r\\n", $sql)."]");

        // 改行
        fputs($fd_log, "\r\n");

        // ログ出力終了
        fclose($fd_log); 
	}

	/******************************************************************
	* ERROR LOG
	*******************************************************************/
	public static function errorlog($uvo, $error) {

        // ログ出力開始
        $fd_log = @fopen(FW_LOG_FILENAME, "a");

        // 時間
        fputs($fd_log, date("[Y-m-d H:i:s]"));
        
        // ユーザ
        fputs($fd_log, "[".$uvo->user."]");

        // エラー内容
        fputs($fd_log, "[".$error."]");

        // 改行
        fputs($fd_log, "\r\n");

        // ログ出力終了
        fclose($fd_log); 
        
        echo "<html>";
        echo "<head>";
        echo "  <title>ERROR</title>";
        echo "  <meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
        echo "  <link href=\"../css/list.css\" rel=\"stylesheet\" type=\"text/css\">";
        echo "</head>";
        echo "<body>";
        echo "<h1>$error</h1>";
        echo "</body>";
        echo "</html>";
	}
}
?>
