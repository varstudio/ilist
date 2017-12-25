<?php
  /*******************************************************************
   * ＨＴＭＬコントロールを表示する
   * 
   * パラメータ：（１）種類
   *             （２）名前
   *             （３）コードリスト番号
   *             （４）設定値
   *             （５）状態
   * 
   * 戻り値：なし
   ******************************************************************/
  function display_form($type, $name, $code, $value, $status) {
  	$id = "";
    switch($type) {
      case FORM_TYPE_TEXT:
        display_text($id, $name, $value, $status, "");
        break;
      case FORM_TYPE_SELECT:
        display_select($id, $name, $code, $value, $status, "");
        break;
      case FORM_TYPE_TEXTAREA:
        display_textarea($id, $name, $value, $status, "");
        break;
      case FORM_TYPE_PROGRESS_EDIT:
        display_progress_edit($id, $name, round($value,0), $status, "");
        break;
      case FORM_TYPE_PROGRESS:
        display_progress($id, $name, round($value,0), "");
        break;
      case FORM_TYPE_PASSWORD:
        display_password($id, $name, $value, $status, "");
        break;
      case FORM_TYPE_DTEXT:
        display_text($id, $name, $value, STATUS_DISPLAY, "");
        break;
      case FORM_TYPE_DSELECT:
        display_select($id, $name, $code, $value, STATUS_DISPLAY, "");
        break;
      case FORM_TYPE_BUTTON:
        display_button($id, $name, $code, $value, $status, "");
        break;
      case FORM_TYPE_CHECKBOX:
        display_checkbox($id, $name, $code, $value, $status, "");
        break;
      case FORM_TYPE_RADIO:
        display_radio($id, $name, $code, $value, $status, "");
        break;
      case FORM_TYPE_HIDDEN:
        display_hidden($id, $name, $code, $value, $status, "");
        break;
    }
  }

  /*******************************************************************
   * 
   * パラメータ：（１）ＩＤ
   *             （２）種類
   *             （３）名前
   *             （４）コードリスト番号
   *             （５）設定値
   *             （６）状態
   * 
   * 戻り値：なし
   ******************************************************************/
  function display_form_with_id($id, $type, $name, $code, $value, $status, $extra) {
    switch($type) {
      case FORM_TYPE_TEXT:
        display_text($id, $name, $value, $status, $extra);
        break;
      case FORM_TYPE_SELECT:
        display_select($id, $name, $code, $value, $status, $extra);
        break;
      case FORM_TYPE_TEXTAREA:
        display_textarea($id, $name, $value, $status, $extra);
        break;
      case FORM_TYPE_PROGRESS_EDIT:
        display_progress_edit($id, $name, round($value,0), $status, $extra);
        break;
      case FORM_TYPE_PROGRESS:
        display_progress($id, $name, round($value,0), $extra);
        break;
      case FORM_TYPE_PASSWORD:
        display_password($id, $name, $value, $status, $extra);
        break;
      case FORM_TYPE_DTEXT:
        display_text($id, $name, $value, STATUS_DISPLAY, $extra);
        break;
      case FORM_TYPE_DSELECT:
        display_select($id, $name, $code, $value, STATUS_DISPLAY, $extra);
        break;
      case FORM_TYPE_BUTTON:
        display_button($id, $name, $code, $value, $status, $extra);
        break;
      case FORM_TYPE_CHECKBOX:
        display_checkbox($id, $name, $code, $value, $status, $extra);
        break;
      case FORM_TYPE_RADIO:
        display_radio($id, $name, $code, $value, $status, $extra);
        break;
      case FORM_TYPE_HIDDEN:
        display_hidden($id, $name, $code, $value, $status, $extra);
        break;
    }
  }

  /*******************************************************************
   * グループ化チェックボックスを表示する
   ******************************************************************/
  function display_group_checkbox($name, $code, $value, $status) {

  	// コードリスト定義
    global $codelist;
    $code_keys = $codelist->get_code_keys($code);

    // コードリストにより、全体繰り返し
    $loop_count = 1;
    foreach ($code_keys as $code_key) {

      // [id]が空白の場合、非表示する
    	$id_display = "id=\"".$name."_".$loop_count."\"";
      $id_label_display = "id=\"".$name."_".$loop_count."_label\"";

      // 表示状態
      $status_display = "";
	    if ($status == STATUS_DISPLAY || $status == STATUS_DISABLE) {
        $status_display = "disabled";
      }

      // 選択状態を設定する
      $checked_display = "";
      if ($value == $code_key) {
        $checked_display = "checked";
      }

      // チェックボックスを表示する
      echo "<input type=\"checkbox\" $id_display name=\"$name\" value=\"$code_key\" $checked_display $status_display onclick=\"javascript:checkbox_onclick(this);\" />\n";

      // チェックボックスのラベルを表示する
      $label_display = $codelist->get_code_value($code, $code_key);
      echo "<label $id_label_display for=\"$name"."_"."$loop_count\">$label_display</label>\n";

      // 次のコードリスト番号
      $loop_count++;
    }

    // 処理終了
    return;
  }

  /*******************************************************************
   *  ボタンを表示する
   ******************************************************************/
  function display_button($id, $name, $code, $value, $status, $extra) {

    // [id]が空白の場合、非表示する
    $id_display = "";
    if($id != "") {
    	$id_display = "id=\"".$id."\"";
    }

    // ボタンを表示する
    echo "<input type=\"button\" $id_display name=\"$name\" value=\"$value\" $extra />\n";

    return;
  }

  /*******************************************************************
   * チェックボックスを表示する
   ******************************************************************/
  function display_checkbox($id, $name, $code, $value, $status, $extra) {

  	// コードリスト定義
    global $codelist;
    $code_keys = $codelist->get_code_keys($code);

    // コードリストにより、全体繰り返し
    $loop_count = 1;
    foreach ($code_keys as $code_key) {

      // [id]が空白の場合、非表示する
      $id_display = "";
      $id_label_display = "";
      if($id != "") {
      	$id_display = "id=\"".$id."_".$loop_count."\"";
        $id_label_display = "id=\"".$id."_".$loop_count."_label\"";
      }

      // 表示状態
      $status_display = "";
	    if ($status == STATUS_DISPLAY || $status == STATUS_DISABLE) {
        $status_display = "disabled";
      }

      // 選択状態を設定する
      $checked_display = "";
      if ($value == $code_key) {
        $checked_display = "checked";
      }

      // チェックボックスを表示する
      echo "<input type=\"checkbox\" $id_display name=\"$name\" value=\"$code_key\" $checked_display $status_display $extra />\n";

      // チェックボックスのラベルを表示する
      $label_display = $codelist->get_code_value($code, $code_key);
      echo "<label $id_label_display for=\"$id"."_"."$loop_count\">$label_display</label>\n";

      // 次のコードリスト番号
      $loop_count++;
    }

    // 処理終了
    return;
  }

  /*******************************************************************
   * テキストボックスを表示する
   ******************************************************************/
  function display_text($id, $name, $value, $status, $extra) {

    // [id]が空白の場合、非表示する
    $id_display = "";
    if($id != "") {
    	$id_display = "id=\"".$id."\"";
    }

    // 表示の場合、文字を出力する
    if ($status == STATUS_DISPLAY) {
      echo nl2br(htmlentities($value, ENT_COMPAT, "UTF-8"));
      return;
    }

    // 表示状態
    $status_display = "";
    if ($status == STATUS_DISABLE) {
      $status_display = "disabled";
    }

    // テキストボックスを表示する
    echo "<input type=\"text\" $id_display name=\"$name\" class=\"text\" value=\"$value\" $status_display $extra />\n";

    // 処理終了
    return;
  }

  /*******************************************************************
   * テキストボックスを表示する
   ******************************************************************/
  function display_text_nocss($name, $value, $status, $extra) {

    // [id]が空白の場合、非表示する
  	$id_display = "id=\"".$name."\"";

    // 表示の場合、文字を出力する
    if ($status == STATUS_DISPLAY) {
      echo htmlentities($value, ENT_COMPAT, "UTF-8");
      return;
    }

    // 表示状態
    $status_display = "";
    if ($status == STATUS_DISABLE) {
      $status_display = "disabled";
    }

    // テキストボックスを表示する
    echo "<input type=\"text\" $id_display name=\"$name\" value=\"$value\" $status_display $extra />\n";

    // 処理終了
    return;
  }

  /*******************************************************************
   * テキストエリアを表示する
   ******************************************************************/
  function display_textarea($id, $name, $value, $status, $extra) {

    // [id]が空白の場合、非表示する
    $id_display = "";
    if($id != "") {
    	$id_display = "id=\"".$id."\"";
    }

    // 表示の場合、文字を出力する
    if ($status == STATUS_DISPLAY) {
      echo "<pre>";
      echo htmlentities($value, ENT_COMPAT, "UTF-8");
      echo "</pre>";
      return;
    }

    // 表示状態
    $status_display = "";
    if ($status == STATUS_DISABLE) {
      $status_display = "disabled";
    }

    // $style_display = "style=\"height:".count(split("\n", $value))."em;\"";

    // テキストエリアを表示する
    echo "<textarea $id_display name=\"$name\" class=\"textarea\" $status_display $extra />\n";
    echo $value;
    echo "</textarea>\n";

    // 処理終了
    return;
  }
  
  /*******************************************************************
   * テキストエリアを表示する
   ******************************************************************/
  function display_textarea_nocss($name, $value, $status, $extra) {

    // [id]が空白の場合、非表示する
   	$id_display = "id=\"".$name."\"";

    // 表示の場合、文字を出力する
    if ($status == STATUS_DISPLAY) {
      echo "<pre>";
      echo htmlentities($value, ENT_COMPAT, "UTF-8");
      echo "</pre>";
      return;
    }

    // 表示状態
    $status_display = "";
    if ($status == STATUS_DISABLE) {
      $status_display = "disabled";
    }

    // $style_display = "style=\"height:".count(split("\n", $value))."em;\"";

    // テキストエリアを表示する
    echo "<textarea $id_display name=\"$name\" $status_display $extra />\n";
    echo $value;
    echo "</textarea>\n";

    // 処理終了
    return;
  }
  
  /*******************************************************************
   * パスワードを表示する
   ******************************************************************/
  function display_password($id, $name, $value, $status, $extra) {
    
    // [id]が空白の場合、非表示する
    $id_display = "";
    if($id != "") {
    	$id_display = "id=\"".$id."\"";
    }

    // 表示の場合、文字を出力する
    if ($status == STATUS_DISPLAY) {
      echo "********";
      return;
    }

    // 表示状態
    $status_display = "";
    if ($status == STATUS_DISABLE) {
      $status_display = "disabled";
    }

    // テキストボックスを表示する
    echo "<input type=\"password\" $id_display name=\"$name\" class=\"text\" value=\"$value\" $status_display $extra />\n";

    // 処理終了
    return;
  }

  /*******************************************************************
   * ラジオボタンを表示する
   ******************************************************************/
  function display_radio($id, $name, $code, $value, $status, $extra) {
    
  	// コードリスト定義
    global $codelist;
    $code_keys = $codelist->get_code_keys($code);

    // コードリストにより、全体繰り返し
    $loop_count = 1;
    foreach ($code_keys as $code_key) {

      // [id]が空白の場合、非表示する
      $id_display = "";
      $id_label_display = "";
      if($id != "") {
      	$id_display = "id=\"".$id."_".$loop_count."\"";
        $id_label_display = "id=\"".$id."_".$loop_count."_label\"";
      }

      // 表示状態
      $status_display = "";
	    if ($status == STATUS_DISPLAY || $status == STATUS_DISABLE) {
        $status_display = "disabled";
      }

      // 選択状態を設定する
      $checked_display = "";
      if ($value == $code_key) {
        $checked_display = "checked";
      }

      // チェックボックスを表示する
      echo "<input type=\"radio\" $id_display name=\"$name\" value=\"$code_key\" $checked_display $status_display $extra />\n";

      // チェックボックスのラベルを表示する
      $label_display = $codelist->get_code_value($code, $code_key);
      echo "<label $id_label_display for=\"$id"."_"."$loop_count\">$label_display</label>\n";

      // 次のコードリスト番号
      $loop_count++;
    }

    // 処理終了
    return;
  }

  /*******************************************************************
   * ラジオボタンを表示する
   ******************************************************************/
  function display_hidden($id, $name, $value, $extra) {

    // テキストボックスを表示する
    echo "<input type=\"hidden\" $id name=\"$name\" value=\"$value\" />\n";

    return;
  }

  /*******************************************************************
   * 進捗プログレスバーを表示する
   ******************************************************************/
  function display_progress($id, $name, $value, $extra) {

    // 値がマイナスの場合
    if ($value <= 0) {

      // 未処理で表示
      echo "<img src=\"./images/p_right_black.png\" height=\"70%\" width=\"100%\">\n";

    // 値がマイナスの場合
    } else if ($value >= 100) {

      // 処理済みで表示
      echo "<img src=\"./images/p_left_green.png\"  height=\"70%\" width=\"100%\">\n";

    // 処理パセント表示
    } else {

      // 処理パセント表示
      echo "<img src=\"./images/p_left_green.png\" height=\"70%\" width=\"".$value."%\">";
      echo "<img src=\"./images/p_right_black.png\"  height=\"70%\" width=\"".(100-$value)."%\">\n";
    }

    // 処理終了
    return;
  }
  
  /*******************************************************************
   * 編集可能進捗プログレスバーを表示する
   ******************************************************************/
  function display_progress_edit($id, $name, $value, $status, $extra) {

    // 表示の場合
    if ($status == STATUS_DISPLAY) {
      display_progress($id, $name, $value, $extra);

    // 編集の場合
    } else {
      display_text($id, $name, $value, $status, $extra);
    }
  }

  /*******************************************************************
   * 選択リストを表示する
   ******************************************************************/
  function display_select($id, $name, $code, $value, $status, $extra) {
  	// コードリスト定義
    global $codelist;

    // [id]が空白の場合、非表示する
    $id_display = "";
    if($id != "") {
    	$id_display = "id=\"".$id."\"";
    }

    // 表示の場合
    if ($status == STATUS_DISPLAY) {
      echo $codelist->get_code_value($code, $value);

    // 編集の場合
    } else {

      // 表示状態
      $status_display = "";
      if ($status == STATUS_DISABLE) {
        $status_display = "disabled";
      }

      // 選択リストを表示する
      echo "<select $id_display name=\"$name\" class=\"select\" $status_display $extra>\n";

      // 空白選択肢を表示する
      echo "<option value=\"\"></option>\n";

      // コードリストの選択肢を表示する
      echo $codelist->get_code_select($code, $value);

      // 選択リスト表示終了
      echo "</select>\n";
    }

    // 処理終了
    return;
  }
?>
