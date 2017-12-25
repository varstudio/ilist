<?php
  /* 
   * 
   */
  function getRequestOrSesssion($key) {

    // リクエストから、データを取得
    if (isset($_GET[$key])) {
      $value = $_GET[$key];
    } else {
      $value = "";
    }
    
    // ポストから、データを取得
    if ($value == "" && isset($_POST[$key])) {
      $value = $_POST[$key];
    }
    
    // sessionから、データを取得
    if ($value == "" && isset($_SESSION[$key])) {
      $value = $_SESSION[$key];
    }
    
    // 戻る
    return $value;
  }
  
  /* 
   * 
   */
  function getArrayRequestOrSesssion($key) {

    // データを取得
    $arrValue = getRequestOrSesssion($key);
    
    // 複数の場合、分割
    if ($arrValue != "") {
      $retArray = explode(",", $arrValue);
    } else {
      $retArray = explode(",", "");;
    }
    
    // 戻る
    return $retArray;
  }
?>
