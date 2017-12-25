<?php
  
  function setSession($key, $value) {
    $_SESSION[$key] = $value;
  }
  
  function getSession($key) {
    if (isset($_SESSION[$key])) {
      return $_SESSION[$key];
    } else {
      return "";
    }
  }


/******************************************************************
* 取得用?信息
*******************************************************************/
  function setUvo($value) {
  	/* SESSION */
  	$_SESSION["UVO"] = serialize($value);
  }

/******************************************************************
* 取得用?信息
*******************************************************************/
  function getUvo() {
  	/* SESSION */
  	if (isset($_SESSION["UVO"])) {
  		return unserialize($_SESSION["UVO"]);
  	} else {
  		return null;
  	}
  }
?>
