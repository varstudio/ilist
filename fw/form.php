<?php
  /*******************************************************************
   * �g�s�l�k�R���g���[����\������
   * 
   * �p�����[�^�F�i�P�j���
   *             �i�Q�j���O
   *             �i�R�j�R�[�h���X�g�ԍ�
   *             �i�S�j�ݒ�l
   *             �i�T�j���
   * 
   * �߂�l�F�Ȃ�
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
   * �p�����[�^�F�i�P�j�h�c
   *             �i�Q�j���
   *             �i�R�j���O
   *             �i�S�j�R�[�h���X�g�ԍ�
   *             �i�T�j�ݒ�l
   *             �i�U�j���
   * 
   * �߂�l�F�Ȃ�
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
   * �O���[�v���`�F�b�N�{�b�N�X��\������
   ******************************************************************/
  function display_group_checkbox($name, $code, $value, $status) {

  	// �R�[�h���X�g��`
    global $codelist;
    $code_keys = $codelist->get_code_keys($code);

    // �R�[�h���X�g�ɂ��A�S�̌J��Ԃ�
    $loop_count = 1;
    foreach ($code_keys as $code_key) {

      // [id]���󔒂̏ꍇ�A��\������
    	$id_display = "id=\"".$name."_".$loop_count."\"";
      $id_label_display = "id=\"".$name."_".$loop_count."_label\"";

      // �\�����
      $status_display = "";
	    if ($status == STATUS_DISPLAY || $status == STATUS_DISABLE) {
        $status_display = "disabled";
      }

      // �I����Ԃ�ݒ肷��
      $checked_display = "";
      if ($value == $code_key) {
        $checked_display = "checked";
      }

      // �`�F�b�N�{�b�N�X��\������
      echo "<input type=\"checkbox\" $id_display name=\"$name\" value=\"$code_key\" $checked_display $status_display onclick=\"javascript:checkbox_onclick(this);\" />\n";

      // �`�F�b�N�{�b�N�X�̃��x����\������
      $label_display = $codelist->get_code_value($code, $code_key);
      echo "<label $id_label_display for=\"$name"."_"."$loop_count\">$label_display</label>\n";

      // ���̃R�[�h���X�g�ԍ�
      $loop_count++;
    }

    // �����I��
    return;
  }

  /*******************************************************************
   *  �{�^����\������
   ******************************************************************/
  function display_button($id, $name, $code, $value, $status, $extra) {

    // [id]���󔒂̏ꍇ�A��\������
    $id_display = "";
    if($id != "") {
    	$id_display = "id=\"".$id."\"";
    }

    // �{�^����\������
    echo "<input type=\"button\" $id_display name=\"$name\" value=\"$value\" $extra />\n";

    return;
  }

  /*******************************************************************
   * �`�F�b�N�{�b�N�X��\������
   ******************************************************************/
  function display_checkbox($id, $name, $code, $value, $status, $extra) {

  	// �R�[�h���X�g��`
    global $codelist;
    $code_keys = $codelist->get_code_keys($code);

    // �R�[�h���X�g�ɂ��A�S�̌J��Ԃ�
    $loop_count = 1;
    foreach ($code_keys as $code_key) {

      // [id]���󔒂̏ꍇ�A��\������
      $id_display = "";
      $id_label_display = "";
      if($id != "") {
      	$id_display = "id=\"".$id."_".$loop_count."\"";
        $id_label_display = "id=\"".$id."_".$loop_count."_label\"";
      }

      // �\�����
      $status_display = "";
	    if ($status == STATUS_DISPLAY || $status == STATUS_DISABLE) {
        $status_display = "disabled";
      }

      // �I����Ԃ�ݒ肷��
      $checked_display = "";
      if ($value == $code_key) {
        $checked_display = "checked";
      }

      // �`�F�b�N�{�b�N�X��\������
      echo "<input type=\"checkbox\" $id_display name=\"$name\" value=\"$code_key\" $checked_display $status_display $extra />\n";

      // �`�F�b�N�{�b�N�X�̃��x����\������
      $label_display = $codelist->get_code_value($code, $code_key);
      echo "<label $id_label_display for=\"$id"."_"."$loop_count\">$label_display</label>\n";

      // ���̃R�[�h���X�g�ԍ�
      $loop_count++;
    }

    // �����I��
    return;
  }

  /*******************************************************************
   * �e�L�X�g�{�b�N�X��\������
   ******************************************************************/
  function display_text($id, $name, $value, $status, $extra) {

    // [id]���󔒂̏ꍇ�A��\������
    $id_display = "";
    if($id != "") {
    	$id_display = "id=\"".$id."\"";
    }

    // �\���̏ꍇ�A�������o�͂���
    if ($status == STATUS_DISPLAY) {
      echo nl2br(htmlentities($value, ENT_COMPAT, "UTF-8"));
      return;
    }

    // �\�����
    $status_display = "";
    if ($status == STATUS_DISABLE) {
      $status_display = "disabled";
    }

    // �e�L�X�g�{�b�N�X��\������
    echo "<input type=\"text\" $id_display name=\"$name\" class=\"text\" value=\"$value\" $status_display $extra />\n";

    // �����I��
    return;
  }

  /*******************************************************************
   * �e�L�X�g�{�b�N�X��\������
   ******************************************************************/
  function display_text_nocss($name, $value, $status, $extra) {

    // [id]���󔒂̏ꍇ�A��\������
  	$id_display = "id=\"".$name."\"";

    // �\���̏ꍇ�A�������o�͂���
    if ($status == STATUS_DISPLAY) {
      echo htmlentities($value, ENT_COMPAT, "UTF-8");
      return;
    }

    // �\�����
    $status_display = "";
    if ($status == STATUS_DISABLE) {
      $status_display = "disabled";
    }

    // �e�L�X�g�{�b�N�X��\������
    echo "<input type=\"text\" $id_display name=\"$name\" value=\"$value\" $status_display $extra />\n";

    // �����I��
    return;
  }

  /*******************************************************************
   * �e�L�X�g�G���A��\������
   ******************************************************************/
  function display_textarea($id, $name, $value, $status, $extra) {

    // [id]���󔒂̏ꍇ�A��\������
    $id_display = "";
    if($id != "") {
    	$id_display = "id=\"".$id."\"";
    }

    // �\���̏ꍇ�A�������o�͂���
    if ($status == STATUS_DISPLAY) {
      echo "<pre>";
      echo htmlentities($value, ENT_COMPAT, "UTF-8");
      echo "</pre>";
      return;
    }

    // �\�����
    $status_display = "";
    if ($status == STATUS_DISABLE) {
      $status_display = "disabled";
    }

    // $style_display = "style=\"height:".count(split("\n", $value))."em;\"";

    // �e�L�X�g�G���A��\������
    echo "<textarea $id_display name=\"$name\" class=\"textarea\" $status_display $extra />\n";
    echo $value;
    echo "</textarea>\n";

    // �����I��
    return;
  }
  
  /*******************************************************************
   * �e�L�X�g�G���A��\������
   ******************************************************************/
  function display_textarea_nocss($name, $value, $status, $extra) {

    // [id]���󔒂̏ꍇ�A��\������
   	$id_display = "id=\"".$name."\"";

    // �\���̏ꍇ�A�������o�͂���
    if ($status == STATUS_DISPLAY) {
      echo "<pre>";
      echo htmlentities($value, ENT_COMPAT, "UTF-8");
      echo "</pre>";
      return;
    }

    // �\�����
    $status_display = "";
    if ($status == STATUS_DISABLE) {
      $status_display = "disabled";
    }

    // $style_display = "style=\"height:".count(split("\n", $value))."em;\"";

    // �e�L�X�g�G���A��\������
    echo "<textarea $id_display name=\"$name\" $status_display $extra />\n";
    echo $value;
    echo "</textarea>\n";

    // �����I��
    return;
  }
  
  /*******************************************************************
   * �p�X���[�h��\������
   ******************************************************************/
  function display_password($id, $name, $value, $status, $extra) {
    
    // [id]���󔒂̏ꍇ�A��\������
    $id_display = "";
    if($id != "") {
    	$id_display = "id=\"".$id."\"";
    }

    // �\���̏ꍇ�A�������o�͂���
    if ($status == STATUS_DISPLAY) {
      echo "********";
      return;
    }

    // �\�����
    $status_display = "";
    if ($status == STATUS_DISABLE) {
      $status_display = "disabled";
    }

    // �e�L�X�g�{�b�N�X��\������
    echo "<input type=\"password\" $id_display name=\"$name\" class=\"text\" value=\"$value\" $status_display $extra />\n";

    // �����I��
    return;
  }

  /*******************************************************************
   * ���W�I�{�^����\������
   ******************************************************************/
  function display_radio($id, $name, $code, $value, $status, $extra) {
    
  	// �R�[�h���X�g��`
    global $codelist;
    $code_keys = $codelist->get_code_keys($code);

    // �R�[�h���X�g�ɂ��A�S�̌J��Ԃ�
    $loop_count = 1;
    foreach ($code_keys as $code_key) {

      // [id]���󔒂̏ꍇ�A��\������
      $id_display = "";
      $id_label_display = "";
      if($id != "") {
      	$id_display = "id=\"".$id."_".$loop_count."\"";
        $id_label_display = "id=\"".$id."_".$loop_count."_label\"";
      }

      // �\�����
      $status_display = "";
	    if ($status == STATUS_DISPLAY || $status == STATUS_DISABLE) {
        $status_display = "disabled";
      }

      // �I����Ԃ�ݒ肷��
      $checked_display = "";
      if ($value == $code_key) {
        $checked_display = "checked";
      }

      // �`�F�b�N�{�b�N�X��\������
      echo "<input type=\"radio\" $id_display name=\"$name\" value=\"$code_key\" $checked_display $status_display $extra />\n";

      // �`�F�b�N�{�b�N�X�̃��x����\������
      $label_display = $codelist->get_code_value($code, $code_key);
      echo "<label $id_label_display for=\"$id"."_"."$loop_count\">$label_display</label>\n";

      // ���̃R�[�h���X�g�ԍ�
      $loop_count++;
    }

    // �����I��
    return;
  }

  /*******************************************************************
   * ���W�I�{�^����\������
   ******************************************************************/
  function display_hidden($id, $name, $value, $extra) {

    // �e�L�X�g�{�b�N�X��\������
    echo "<input type=\"hidden\" $id name=\"$name\" value=\"$value\" />\n";

    return;
  }

  /*******************************************************************
   * �i���v���O���X�o�[��\������
   ******************************************************************/
  function display_progress($id, $name, $value, $extra) {

    // �l���}�C�i�X�̏ꍇ
    if ($value <= 0) {

      // �������ŕ\��
      echo "<img src=\"./images/p_right_black.png\" height=\"70%\" width=\"100%\">\n";

    // �l���}�C�i�X�̏ꍇ
    } else if ($value >= 100) {

      // �����ς݂ŕ\��
      echo "<img src=\"./images/p_left_green.png\"  height=\"70%\" width=\"100%\">\n";

    // �����p�Z���g�\��
    } else {

      // �����p�Z���g�\��
      echo "<img src=\"./images/p_left_green.png\" height=\"70%\" width=\"".$value."%\">";
      echo "<img src=\"./images/p_right_black.png\"  height=\"70%\" width=\"".(100-$value)."%\">\n";
    }

    // �����I��
    return;
  }
  
  /*******************************************************************
   * �ҏW�\�i���v���O���X�o�[��\������
   ******************************************************************/
  function display_progress_edit($id, $name, $value, $status, $extra) {

    // �\���̏ꍇ
    if ($status == STATUS_DISPLAY) {
      display_progress($id, $name, $value, $extra);

    // �ҏW�̏ꍇ
    } else {
      display_text($id, $name, $value, $status, $extra);
    }
  }

  /*******************************************************************
   * �I�����X�g��\������
   ******************************************************************/
  function display_select($id, $name, $code, $value, $status, $extra) {
  	// �R�[�h���X�g��`
    global $codelist;

    // [id]���󔒂̏ꍇ�A��\������
    $id_display = "";
    if($id != "") {
    	$id_display = "id=\"".$id."\"";
    }

    // �\���̏ꍇ
    if ($status == STATUS_DISPLAY) {
      echo $codelist->get_code_value($code, $value);

    // �ҏW�̏ꍇ
    } else {

      // �\�����
      $status_display = "";
      if ($status == STATUS_DISABLE) {
        $status_display = "disabled";
      }

      // �I�����X�g��\������
      echo "<select $id_display name=\"$name\" class=\"select\" $status_display $extra>\n";

      // �󔒑I������\������
      echo "<option value=\"\"></option>\n";

      // �R�[�h���X�g�̑I������\������
      echo $codelist->get_code_select($code, $value);

      // �I�����X�g�\���I��
      echo "</select>\n";
    }

    // �����I��
    return;
  }
?>
