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
* �擾�p?�M��
*******************************************************************/
  function setUvo($value) {
  	/* SESSION */
  	$_SESSION["UVO"] = serialize($value);
  }

/******************************************************************
* �擾�p?�M��
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
