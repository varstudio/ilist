<?php
  /* 
   * 
   */
  function getRequestOrSesssion($key) {

    // ���N�G�X�g����A�f�[�^���擾
    if (isset($_GET[$key])) {
      $value = $_GET[$key];
    } else {
      $value = "";
    }
    
    // �|�X�g����A�f�[�^���擾
    if ($value == "" && isset($_POST[$key])) {
      $value = $_POST[$key];
    }
    
    // session����A�f�[�^���擾
    if ($value == "" && isset($_SESSION[$key])) {
      $value = $_SESSION[$key];
    }
    
    // �߂�
    return $value;
  }
  
  /* 
   * 
   */
  function getArrayRequestOrSesssion($key) {

    // �f�[�^���擾
    $arrValue = getRequestOrSesssion($key);
    
    // �����̏ꍇ�A����
    if ($arrValue != "") {
      $retArray = explode(",", $arrValue);
    } else {
      $retArray = explode(",", "");;
    }
    
    // �߂�
    return $retArray;
  }
?>
