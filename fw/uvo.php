<?php
/**********************************************************************
							uvo
***********************************************************************/
class Uvo {
  
	public $id;						  /* 用??号 */
	public $user;					  /* 用?名 */
	public $name;				  	/* 用?姓名 */
	public $admin;			  	/* 管理者権限 */
	public $ip;				   		/* IP */
	public $leve;			  		/*  */
	public $tel;				    /* 電話 */
	public $dept;				    /* 電話 */
	public $terminal;				/* 端末 */
	public $team;					  /* チーム */
	public $role;				  	/* 用?角色 */
	public $mode;				  	/* 管理者権限 */
	
	/******************************************************************
	* ?建用?信息
	*******************************************************************/
	function Uvo($user, $password) {
    
    // データベースに接続する
    global $db;
    
		/* 取得用?信息 */
   	$rs = $db->query("SELECT * FROM sys_user WHERE user = '".$user."'");
		
		/* 没有取得 */
		if (!($row = $rs->fetch_assoc())) {
			return false;
		}
		
		/* 密??? */
		if ($password != $row["password"]) {
			return false;
		}
		
		/* 用?情??定 */
		$this->id = $row["id"];
		$this->user = $user;
		$this->name = $row["name"];
		$this->admin = $row["admin"];
		$this->ip = $row["ip"];
		$this->level = $row["level"];
		$this->tel = $row["tel"];
		$this->dept = "金融部";
    
		$this->terminal = $row["terminal"];

		//$this->role = $row["role"];
    if ($row["admin"] == "1") {
      $this->mode = "c";
    } else {
      $this->mode = "";
    }

		/* 取得用?信息 */
   	$rs = $db->query("SELECT teamid FROM sys_team WHERE userid = $this->id");

		/* 没有取得 */
    $team = "";
		if (!($row = $rs->fetch_assoc())) {
			$team = "0";
		} else {
      $team = $row["teamid"];
      while($row = $rs->fetch_assoc()) {
        $team .= ",".$row["teamid"];
      }
    }
		$this->team = $team;

		/* 用?情?保持 */
		setUvo($this);
		
		/* ??成功 */
		return true;
	}

	/******************************************************************
	* ??用????限
	*******************************************************************/
	function access($url) {
		/* 取得用?信息 */
	    $db = new Database(DATABASE);
    	$rs = $db->executeQuery("SELECT * FROM sys_access WHERE user = '".$this->id."' AND url='".$url."'");
		
		/* 没有取得 */
		if (!$rs->next()) {
			return false;
		}
		
		/* 履?表更新 */
		//NewHistory($this, $url);
		
		/* ??成功 */
		return true;
	}
}

if (!isset($_SERVER['PHP_AUTH_USER'])) {
  header('WWW-Authenticate: Basic realm=""');
  header('HTTP/1.0 401 Unauthorized');
  echo "登録操作は取消しました。";
  exit;
} else {
  if (!isset($_SESSION['UVO'])) {
    $uvo = new Uvo($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);
    
    if (!isset($_SESSION['UVO'])) {
      header('WWW-Authenticate: Basic realm=""');
      header('HTTP/1.0 401 Unauthorized');
      echo "登録操作は取消しました。";
      exit;
    }
  }
}

?>
