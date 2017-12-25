<?php @session_start(); ?>
<?php include_once("../config.php"); ?>
<?php include_once("../fw/fw-api.php"); ?>
<?php
  // モードを取得する
  $step = getRequestOrSesssion("step");

  // 処理対象IDを取得する
  $id = getRequestOrSesssion("id");

  // コードリスト
  $codelist = new CodeList();
  
  // ユーザ情報
  $uvo = getUvo();
  
  if ($id == "") {
    $sql = "desc tbl_bug";
    $rs = $db->query($sql);
    
    while ($row = $rs->fetch_assoc()) {
      $$row["Field"] = "";
    }
  } else {
    $sql = "SELECT * FROM tbl_bug WHERE id = $id";
    $rs = $db->query($sql);
    
    while ($row = $rs->fetch_assoc()) {
      foreach($row as $key => $value){
        $$key = $value;
      }
    }
  
    $step2_item0001 = "UT_BUG_".str_pad($id, 4, "0", STR_PAD_LEFT);
  }
  
  // 管理状態の更新
  switch($step) {
    case "1":
      $step1_item0002 = "起票中";
      $step1_item0001 = "故障管理システム（試験）";
      $step1_item0003 = "故障管理";
      $step1_item0004 = "HT-TCPIP";
      $step2_item0001 = "未採番";
      $step2_item0002 = date("Y/m/d");
      $step2_item0003 = date("h:i");
      $step2_item0004 = date("Y/m/d");
      $step2_item0005 = $uvo->dept;
      $step2_item0006 = $uvo->name;
      $step2_item0007 = $uvo->tel;
      break;
    case "2":
      $step1_item0002 = "発行中";
      break;
    case "3":
      $step1_item0002 = "解析中";
      if ($step4_item0001 == "") {
        $step4_item0001 = date("Y/m/d");
      }
      if ($step7_item0002 == "") {
        $step7_item0002 = date("Y/m/d");
      }
      if ($step7_item0003 == "") {
        $step7_item0003 = $uvo->name;
      }
      if ($step7_item0010 == "") {
        $step7_item0010 = date("Y/m/d");
      }
      if ($step7_item0011 == "") {
        $step7_item0011 = $uvo->name;
      }
      break;
    case "4":
      $step1_item0002 = "処置中";
      if ($step10_item0002 == "") {
        $step10_item0002 = date("Y/m/d");
      }
      break;
    case "5":
      $step1_item0002 = "確認中";
      if ($step11_item0007 == "") {
        $step11_item0007 = date("Y/m/d");
      }
      if ($step11_item0008 == "") {
        $step11_item0008 = $uvo->name;
      }
      break;
    case "6":
      $step1_item0002 = "結了済";
      break;
    default:
      break;
  }
?>
<html>
<head>
  <base target="_self"/>
  <title>故障処理票</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <link href="../css/list.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="../script/jquery.min.js"></script>
<?php
  $finish = getRequestOrSesssion("finish");
  if ($finish == "true") {
    echo "<script language=\"javascript\">\n";
    echo "  if (window.opener != undefined) {\n";
    echo "    window.opener.returnValue=\"finish\";\n";
    echo "  } else {\n";
    echo "    window.returnValue=\"finish\";\n";
    echo "  }\n";
    echo "  window.close();\n";
    echo "</script>\n";
  }
?>
<style>
  body {
    background-image: url(./bug_template.png);
    background-repeat: no-repeat;
  }

  label {
    font-family:"ＭＳ Ｐゴシック"; 
    font-size:8pt;
    white-space: pre;
  }

  input {
    padding-left: 3px;
    font-family:"ＭＳ Ｐゴシック"; 
    font-size:8pt;
  }

  select {
    font-family:"ＭＳ Ｐゴシック"; 
    font-size:8pt;
  }

  textarea {
    padding-left: 3px;
    font-family:"ＭＳ Ｐゴシック"; 
    font-size:8pt;
  }

  /* 起票 step1 */
  #step1_item0001 { position:absolute; border: 1px solid black; left:120px; top:40px; width:451px; height:31px; }
  #step1_item0002 { position:absolute; border: 1px solid black; left:630px; top:40px; width:200px; height:31px; text-align:center; }
  #step1_item0003 { position:absolute; border: 1px solid black; left:120px; top:70px; width:451px; height:31px; }
  #step1_item0004 { position:absolute; border: 1px solid black; left:630px; top:70px; width:200px; height:31px; z-index: 1; }
  #step1_item0005 { position:absolute; border: 1px 0px 1px 0px solid black; left:121px; top:100px; width:449px; height:31px; }
  #step1_item0006 { position:absolute; border: 1px 0px 1px 0px solid black; left:121px; top:130px; width:449px; height:31px; }
  #step1_item0007 { position:absolute; border: 1px 0px 1px 0px solid black; left:121px; top:160px; width:449px; height:31px; }
  #step1_item0008 { position:absolute; border: 1px 0px 1px 0px solid black; left:121px; top:190px; width:449px; height:31px; }
  #step1_item0009 { position:absolute; border: 1px solid black; left:120px; top:220px; width:171px; height:31px; }
  #step1_item0010 { position:absolute; border: 1px solid black; left:400px; top:220px; width:171px; height:31px; }
  #step1_item0011 { position:absolute; border: 1px solid black; left:120px; top:250px; width:451px; height:30px; }

  #step1_item0012_box { position:absolute; border: 1px solid black; left:630px; top:100px; width:200px; height:31px; }
  #step1_item0012_1 { position:absolute; left:631px; top:99px; }
  #step1_item0012_1_label { position:absolute; left:651px; top:105px;}
  #step1_item0012_2 { position:absolute; left:631px; top:113px; }
  #step1_item0012_2_label { position:absolute; left:651px; top:119px;}

  #step1_item0013_box { position:absolute; border: 1px solid black; left:630px; top:130px; width:200px; height:150px; }
  #step1_item0013_1 { position:absolute; left:631px; top:137px; }
  #step1_item0013_1_label { position:absolute; left:651px; top:143px;}
  #step1_item0013_2 { position:absolute; left:631px; top:156px; }
  #step1_item0013_2_label { position:absolute; left:651px; top:162px;}
  #step1_item0013_3 { position:absolute; left:631px; top:175px; }
  #step1_item0013_3_label { position:absolute; left:651px; top:181px;}
  #step1_item0013_4 { position:absolute; left:631px; top:194px; }
  #step1_item0013_4_label { position:absolute; left:651px; top:202px;}
  #step1_item0013_5 { position:absolute; left:631px; top:213px; }
  #step1_item0013_5_label { position:absolute; left:651px; top:219px;}
  #step1_item0013_6 { position:absolute; left:631px; top:232px; }
  #step1_item0013_6_label { position:absolute; left:651px; top:238px;}
  #step1_item0013_text { position:absolute; border: 0px solid black; left:700px; top:234px; width:85px; height:20px; }

  /* 起票 step2 */
  #step2_item0001 { position:absolute; border: 1px solid black; left:930px; top:40px; width:140px; height:41px; text-align:center; }
  #step2_item0002 { position:absolute; border: 1px solid black; left:930px; top:80px; width:140px; height:21px; }
  #step2_item0003 { position:absolute; border: 1px solid black; left:930px; top:100px; width:140px; height:21px; }
  #step2_item0004 { position:absolute; border: 1px solid black; left:930px; top:120px; width:140px; height:31px; }
  #step2_item0005 { position:absolute; border: 1px solid black; left:930px; top:150px; width:140px; height:21px; }
  #step2_item0006 { position:absolute; border: 1px solid black; left:930px; top:170px; width:140px; height:21px; }
  #step2_item0007 { position:absolute; border: 1px solid black; left:930px; top:190px; width:140px; height:21px; }

  #step2_item0008_box { position:absolute; border: 1px solid black; left:880px; top:210px; width:190px; height:50px; }
  #step2_item0008_1 { position:absolute; left:882px; top:216px; }
  #step2_item0008_1_label { position:absolute; left:902px; top:222px;}
  #step2_item0008_2 { position:absolute; left:928px; top:216px; }
  #step2_item0008_2_label { position:absolute; left:948px; top:222px;}
  #step2_item0008_3 { position:absolute; left:882px; top:235px; }
  #step2_item0008_3_label { position:absolute; left:902px; top:241px;}
  #step2_item0008_4 { position:absolute; left:928px; top:235px; }
  #step2_item0008_4_label { position:absolute; left:948px; top:241px;}
  #step2_item0008_5 { position:absolute; left:975px; top:235px; }
  #step2_item0008_5_label { position:absolute; left:995px; top:241px;}

  /* 起票 step3 */
  #step3_item0001 { position:absolute; border: 1px solid black; left:70px; top:280; width:670px; height:61px; z-index:100; }
  #step3_item0002 { position:absolute; border: 1px solid black; left:70px; top:340; width:670px; height:121px; z-index:99; }

  #step3_item0003_box { position:absolute; border: 1px solid black; left:130px; top:458px; width:46px; height:32px; }
  #step3_item0003_1 { position:absolute; left:131px; top:459px; }
  #step3_item0003_1_label { position:absolute; left:151px; top:465px;}
  #step3_item0003_2 { position:absolute; left:131px; top:472px; }
  #step3_item0003_2_label { position:absolute; left:151px; top:477px;}

  #step3_item0004_box { position:absolute; border: 1px solid black; left:215px; top:458px; width:46px; height:32px; }
  #step3_item0004_1 { position:absolute; left:216px; top:459px; }
  #step3_item0004_1_label { position:absolute; left:236px; top:465px;}
  #step3_item0004_2 { position:absolute; left:216px; top:472px; }
  #step3_item0004_2_label { position:absolute; left:236px; top:478px;}
  #step3_item0005 { position:absolute; border: 1px solid black; left:315px; top:460px; width:185px; height:30px; }
  #step3_item0006 { position:absolute; border: 1px solid black; left:499px; top:460px; width:32px; height:30px; }
  #step3_item0007 { position:absolute; border: 1px solid black; left:600px; top:460px; width:140px; height:30px; }

  /* 解析 step4 */
  #step4_item0001 { position:absolute; border: 1px solid black; left:870px; top:280px; width:200px; height:30px; }

  /* 持ち回り情報 step5 */
  #step5_item0001 { position:absolute; border: 1px solid black; left:770px; top:340px; width:101px; height:31px; }
  #step5_item0002 { position:absolute; border: 1px solid black; left:870px; top:340px; width:51px; height:31px; }
  #step5_item0003 { position:absolute; border: 1px solid black; left:920px; top:340px; width:51px; height:31px; }
  #step5_item0004 { position:absolute; border: 1px solid black; left:970px; top:340px; width:100px; height:31px; }
  #step5_item0005 { position:absolute; border: 1px solid black; left:770px; top:370px; width:101px; height:31px; }
  #step5_item0006 { position:absolute; border: 1px solid black; left:870px; top:370px; width:51px; height:31px; }
  #step5_item0007 { position:absolute; border: 1px solid black; left:920px; top:370px; width:51px; height:31px; }
  #step5_item0008 { position:absolute; border: 1px solid black; left:970px; top:370px; width:100px; height:31px; }
  #step5_item0009 { position:absolute; border: 1px solid black; left:770px; top:400px; width:101px; height:31px; }
  #step5_item0010 { position:absolute; border: 1px solid black; left:870px; top:400px; width:51px; height:31px; }
  #step5_item0011 { position:absolute; border: 1px solid black; left:920px; top:400px; width:51px; height:31px; }
  #step5_item0012 { position:absolute; border: 1px solid black; left:970px; top:400px; width:100px; height:31px; }
  #step5_item0013 { position:absolute; border: 1px solid black; left:770px; top:430px; width:101px; height:31px; }
  #step5_item0014 { position:absolute; border: 1px solid black; left:870px; top:430px; width:51px; height:31px; }
  #step5_item0015 { position:absolute; border: 1px solid black; left:920px; top:430px; width:51px; height:31px; }
  #step5_item0016 { position:absolute; border: 1px solid black; left:970px; top:430px; width:100px; height:31px; }
  #step5_item0017 { position:absolute; border: 1px solid black; left:770px; top:460px; width:101px; height:30px; }
  #step5_item0018 { position:absolute; border: 1px solid black; left:870px; top:460px; width:51px; height:30px; }
  #step5_item0019 { position:absolute; border: 1px solid black; left:920px; top:460px; width:51px; height:30px; }
  #step5_item0020 { position:absolute; border: 1px solid black; left:970px; top:460px; width:100px; height:30px; }
  
  /* 解析 step6 */
  #step6_item0001_box { position:absolute; border: 1px solid black; left:40px; top:580px; width:171px; height:120px; }
  #step6_item0002_box { position:absolute; border: 1px solid black; left:210px; top:580px; width:251px; height:120px; }
  #step6_item0003_box { position:absolute; border: 1px solid black; left:460px; top:580px; width:91px; height:120px; }
  #step6_item0004_box { position:absolute; border: 1px solid black; left:550px; top:580px; width:220px; height:120px; }
  #step6_item0005_box { position:absolute; border: 1px solid black; left:40px; top:720px; width:170px; height:111px; }
  #step6_item0006_box { position:absolute; border: 1px solid black; left:40px; top:850px; width:170px; height:166px; }
  #step6_item0007_box { position:absolute; border: 1px solid black; left:40px; top:1035px; width:170px; height:150px; }
  #step6_item0008_box { position:absolute; border: 1px solid black; left:260px; top:720px; width:271px; height:161px; }
  #step6_item0009_box { position:absolute; border: 1px solid black; left:560px; top:720px; width:270px; height:161px; }
  #step6_item0010_box { position:absolute; border: 1px solid black; left:260px; top:900px; width:191px; height:145px; }
  #step6_item0011_box { position:absolute; border: 1px solid black; left:450px; top:900px; width:191px; height:145px; }
  #step6_item0012_box { position:absolute; border: 1px solid black; left:640px; top:900px; width:190px; height:145px; }
  #step6_item0001_1 { position:absolute; left:41px; top:586px; }
  #step6_item0001_1_label { position:absolute; left:61px; top:592px;}
  #step6_item0001_2 { position:absolute; left:41px; top:603px; }
  #step6_item0001_2_label { position:absolute; left:61px; top:609px;}
  #step6_item0001_3 { position:absolute; left:41px; top:620px; }
  #step6_item0001_3_label { position:absolute; left:61px; top:626px;}
  #step6_item0001_4 { position:absolute; left:41px; top:637px; }
  #step6_item0001_4_label { position:absolute; left:61px; top:643px;}
  #step6_item0001_5 { position:absolute; left:41px; top:654px; }
  #step6_item0001_5_label { position:absolute; left:61px; top:660px;}
  #step6_item0001_6 { position:absolute; left:41px; top:671px; }
  #step6_item0001_6_label { position:absolute; left:61px; top:677px;}
  #step6_item0002_1 { position:absolute; left:211px; top:586px; }
  #step6_item0002_1_label { position:absolute; left:231px; top:592px;}
  #step6_item0002_2 { position:absolute; left:211px; top:603px; }
  #step6_item0002_2_label { position:absolute; left:231px; top:609px;}
  #step6_item0002_3 { position:absolute; left:211px; top:620px; }
  #step6_item0002_3_label { position:absolute; left:231px; top:626px;}
  #step6_item0002_4 { position:absolute; left:211px; top:637px; }
  #step6_item0002_4_label { position:absolute; left:231px; top:643px;}
  #step6_item0002_5 { position:absolute; left:211px; top:654px; }
  #step6_item0002_5_label { position:absolute; left:231px; top:660px;}
  #step6_item0002_6 { position:absolute; left:211px; top:671px; }
  #step6_item0002_6_label { position:absolute; left:231px; top:677px;}
  #step6_item0002_text { position:absolute; border: 0px solid black; left:279px; top:673px; width:107px; height:20px; }
  #step6_item0003_1 { position:absolute; left:461px; top:586px; }
  #step6_item0003_1_label { position:absolute; left:481px; top:592px;}
  #step6_item0003_2 { position:absolute; left:461px; top:603px; }
  #step6_item0003_2_label { position:absolute; left:481px; top:609px;}
  #step6_item0003_3 { position:absolute; left:461px; top:620px; }
  #step6_item0003_3_label { position:absolute; left:481px; top:626px;}
  #step6_item0003_4 { position:absolute; left:461px; top:637px; }
  #step6_item0003_4_label { position:absolute; left:481px; top:643px;}
  #step6_item0003_5 { position:absolute; left:461px; top:654px; }
  #step6_item0003_5_label { position:absolute; left:481px; top:660px;}
  #step6_item0004_1 { position:absolute; left:551px; top:586px; }
  #step6_item0004_1_label { position:absolute; left:571px; top:592px;}
  #step6_item0004_2 { position:absolute; left:551px; top:603px; }
  #step6_item0004_2_label { position:absolute; left:571px; top:609px;}
  #step6_item0004_3 { position:absolute; left:551px; top:620px; }
  #step6_item0004_3_label { position:absolute; left:571px; top:626px;}
  #step6_item0004_4 { position:absolute; left:551px; top:637px; }
  #step6_item0004_4_label { position:absolute; left:571px; top:643px;}
  #step6_item0004_5 { position:absolute; left:551px; top:654px; }
  #step6_item0004_5_label { position:absolute; left:571px; top:660px;}
  #step6_item0004_text { position:absolute; border: 0px solid black; left:620px; top:656px; width:100px; height:20px;}
  #step6_item0005_1 { position:absolute; left:41px; top:727px; }
  #step6_item0005_1_label { position:absolute; left:61px; top:732px;}
  #step6_item0005_2 { position:absolute; left:41px; top:745px; }
  #step6_item0005_2_label { position:absolute; left:61px; top:750px;}
  #step6_item0005_3 { position:absolute; left:41px; top:763px; }
  #step6_item0005_3_label { position:absolute; left:61px; top:768px;}
  #step6_item0005_4 { position:absolute; left:41px; top:781px; }
  #step6_item0005_4_label { position:absolute; left:61px; top:786px;}
  #step6_item0005_5 { position:absolute; left:41px; top:799px; }
  #step6_item0005_5_label { position:absolute; left:61px; top:804px;}
  #step6_item0005_text { position:absolute; border: 0px solid black; left:115px; top:801px; width:75px; height:20px; }
  #step6_item0006_1 { position:absolute; left:41px; top:857px; }
  #step6_item0006_1_label { position:absolute; left:61px; top:863px;}
  #step6_item0006_2 { position:absolute; left:41px; top:875px; }
  #step6_item0006_2_label { position:absolute; left:61px; top:881px;}
  #step6_item0006_3 { position:absolute; left:41px; top:893px; }
  #step6_item0006_3_label { position:absolute; left:61px; top:899px;}
  #step6_item0006_4 { position:absolute; left:41px; top:911px; }
  #step6_item0006_4_label { position:absolute; left:61px; top:917px;}
  #step6_item0006_5 { position:absolute; left:41px; top:929px; }
  #step6_item0006_5_label { position:absolute; left:61px; top:935px;}
  #step6_item0006_6 { position:absolute; left:41px; top:947px; }
  #step6_item0006_6_label { position:absolute; left:61px; top:953px;}
  #step6_item0006_7 { position:absolute; left:41px; top:965px; }
  #step6_item0006_7_label { position:absolute; left:61px; top:971px;}
  #step6_item0006_8 { position:absolute; left:41px; top:983px; }
  #step6_item0006_8_label { position:absolute; left:61px; top:989px;}
  #step6_item0006_text { position:absolute; border: 0px solid black; left:116px; top:985px; width:75px; height:20px; }
  #step6_item0007_1 { position:absolute; left:41px; top:1040px; }
  #step6_item0007_1_label { position:absolute; left:61px; top:1049px;}
  #step6_item0007_2 { position:absolute; left:41px; top:1057px; }
  #step6_item0007_2_label { position:absolute; left:61px; top:1063px;}
  #step6_item0007_3 { position:absolute; left:41px; top:1074px; }
  #step6_item0007_3_label { position:absolute; left:61px; top:1080px;}
  #step6_item0007_4 { position:absolute; left:41px; top:1091px; }
  #step6_item0007_4_label { position:absolute; left:61px; top:1097px;}
  #step6_item0007_5 { position:absolute; left:41px; top:1108px; }
  #step6_item0007_5_label { position:absolute; left:61px; top:1114px;}
  #step6_item0007_6 { position:absolute; left:41px; top:1125px; }
  #step6_item0007_6_label { position:absolute; left:61px; top:1131px;}
  #step6_item0007_7 { position:absolute; left:41px; top:1142px; }
  #step6_item0007_7_label { position:absolute; left:61px; top:1148px;}
  #step6_item0007_8 { position:absolute; left:41px; top:1159px; }
  #step6_item0007_8_label { position:absolute; left:61px; top:1165px;}
  #step6_item0007_text { position:absolute; border: 0px solid black; left:116px; top:1161px; width:75px; height:20px; }
  #step6_item0008_1 { position:absolute; left:261px; top:727px; }
  #step6_item0008_1_label { position:absolute; left:281px; top:733px;}
  #step6_item0008_2 { position:absolute; left:261px; top:747px; }
  #step6_item0008_2_label { position:absolute; left:281px; top:753px;}
  #step6_item0008_3 { position:absolute; left:261px; top:767px; }
  #step6_item0008_3_label { position:absolute; left:281px; top:773px;}
  #step6_item0008_4 { position:absolute; left:261px; top:787px; }
  #step6_item0008_4_label { position:absolute; left:281px; top:793px;}
  #step6_item0008_5 { position:absolute; left:261px; top:807px; }
  #step6_item0008_5_label { position:absolute; left:281px; top:813px;}
  #step6_item0008_6 { position:absolute; left:261px; top:827px; }
  #step6_item0008_6_label { position:absolute; left:281px; top:833px;}
  #step6_item0008_text { position:absolute; border: 0px solid black; left:330px; top:829px; width:85px; height:20px; }
  #step6_item0009_1 { position:absolute; left:561px; top:727px; }
  #step6_item0009_1_label { position:absolute; left:581px; top:733px;}
  #step6_item0009_2 { position:absolute; left:561px; top:743px; }
  #step6_item0009_2_label { position:absolute; left:581px; top:749px;}
  #step6_item0009_3 { position:absolute; left:561px; top:759px; }
  #step6_item0009_3_label { position:absolute; left:581px; top:765px;}
  #step6_item0009_4 { position:absolute; left:561px; top:775px; }
  #step6_item0009_4_label { position:absolute; left:581px; top:781px;}
  #step6_item0009_5 { position:absolute; left:561px; top:791px; }
  #step6_item0009_5_label { position:absolute; left:581px; top:797px;}
  #step6_item0009_6 { position:absolute; left:561px; top:807px; }
  #step6_item0009_6_label { position:absolute; left:581px; top:813px;}
  #step6_item0009_7 { position:absolute; left:561px; top:823px; }
  #step6_item0009_7_label { position:absolute; left:581px; top:829px;}
  #step6_item0009_8 { position:absolute; left:561px; top:839px; }
  #step6_item0009_8_label { position:absolute; left:581px; top:845px;}
  #step6_item0009_9 { position:absolute; left:561px; top:855px; }
  #step6_item0009_9_label { position:absolute; left:581px; top:861px;}
  #step6_item0009_text { position:absolute; border: 0px solid black; left:631px; top:857px; width:85px; height:20px; }
  #step6_item0010_1 { position:absolute; left:261px; top:910px; }
  #step6_item0010_1_label { position:absolute; left:281px; top:916px;}
  #step6_item0010_2 { position:absolute; left:261px; top:926px; }
  #step6_item0010_2_label { position:absolute; left:281px; top:932px;}
  #step6_item0010_3 { position:absolute; left:261px; top:942px; }
  #step6_item0010_3_label { position:absolute; left:281px; top:948px;}
  #step6_item0010_4 { position:absolute; left:261px; top:958px; }
  #step6_item0010_4_label { position:absolute; left:281px; top:964px;}
  #step6_item0010_5 { position:absolute; left:261px; top:974px; }
  #step6_item0010_5_label { position:absolute; left:281px; top:980px;}
  #step6_item0010_6 { position:absolute; left:261px; top:990px; }
  #step6_item0010_6_label { position:absolute; left:281px; top:996px;}
  #step6_item0010_7 { position:absolute; left:261px; top:1006px; }
  #step6_item0010_7_label { position:absolute; left:281px; top:1012px;}
  #step6_item0010_text { position:absolute; border: 0px solid black; left:337px; top:1008px; width:85px; height:20px; }
  #step6_item0011_1 { position:absolute; left:451px; top:910px; }
  #step6_item0011_1_label { position:absolute; left:471px; top:916px;}
  #step6_item0011_2 { position:absolute; left:451px; top:926px; }
  #step6_item0011_2_label { position:absolute; left:471px; top:932px;}
  #step6_item0011_3 { position:absolute; left:451px; top:942px; }
  #step6_item0011_3_label { position:absolute; left:471px; top:948px;}
  #step6_item0011_4 { position:absolute; left:451px; top:958px; }
  #step6_item0011_4_label { position:absolute; left:471px; top:964px;}
  #step6_item0011_5 { position:absolute; left:451px; top:974px; }
  #step6_item0011_5_label { position:absolute; left:471px; top:980px;}
  #step6_item0011_text { position:absolute; border: 0px solid black; left:525px; top:976px; width:85px; height:20px; }
  #step6_item0012_1 { position:absolute; left:641px; top:910px; }
  #step6_item0012_1_label { position:absolute; left:661px; top:916px;}
  #step6_item0012_2 { position:absolute; left:641px; top:926px; }
  #step6_item0012_2_label { position:absolute; left:661px; top:932px;}
  #step6_item0012_3 { position:absolute; left:641px; top:942px; }
  #step6_item0012_3_label { position:absolute; left:661px; top:948px;}
  #step6_item0012_4 { position:absolute; left:641px; top:958px; }
  #step6_item0012_4_label { position:absolute; left:661px; top:964px;}
  #step6_item0012_5 { position:absolute; left:641px; top:974px; }
  #step6_item0012_5_label { position:absolute; left:661px; top:980px;}
  #step6_item0012_6 { position:absolute; left:641px; top:990px; }
  #step6_item0012_6_label { position:absolute; left:661px; top:996px;}
  #step6_item0012_7 { position:absolute; left:641px; top:1006px; }
  #step6_item0012_7_label { position:absolute; left:661px; top:1012px;}
  #step6_item0012_text { position:absolute; border: 0px solid black; left:718px; top:1008px; width:85px; height:20px; }
  
  /* 解析 step7 */
  #step7_item0001_box { position:absolute; border: 1px solid black; left:800px; top:510px; width:100px; height:70px; }
  #step7_item0001_1 { position:absolute; left:805px; top:513px; }
  #step7_item0001_1_label { position:absolute; left:825px; top:519px;}
  #step7_item0001_2 { position:absolute; left:805px; top:534px; }
  #step7_item0001_2_label { position:absolute; left:825px; top:540px;}
  #step7_item0001_3 { position:absolute; left:805px; top:555px; }
  #step7_item0001_3_label { position:absolute; left:825px; top:561px;}
  #step7_item0002 { position:absolute; border: 1px solid black; left:970px; top:510px; width:100px; height:30px; }
  #step7_item0003 { position:absolute; border: 1px solid black; left:970px; top:538px; width:100px; height:42px; }  
  #step7_item0004 { position:absolute; border: 1px 0px 1px 0px solid black; left:861px; top:580px; width:208px; height:21px;}
  #step7_item0005 { position:absolute; border: 1px 0px 1px 0px solid black; left:861px; top:600px; width:208px; height:21px;}
  #step7_item0006 { position:absolute; border: 1px 0px 1px 0px solid black; left:861px; top:620px; width:208px; height:21px;}
  #step7_item0007 { position:absolute; border: 1px 0px 1px 0px solid black; left:861px; top:640px; width:208px; height:21px;}
  #step7_item0008 { position:absolute; border: 1px 0px 1px 0px solid black; left:861px; top:660px; width:208px; height:21px;}
  #step7_item0009 { position:absolute; border: 1px solid black; left:860px; top:680px; width:210px; height:20px; }
  #step7_item0010 { position:absolute; border: 1px solid black; left:930px; top:700px; width:140px; height:31px; }
  #step7_item0011 { position:absolute; border: 1px solid black; left:930px; top:730px; width:140px; height:31px; }
  #step7_item0012 { position:absolute; border: 1px solid black; left:930px; top:760px; width:140px; height:31px; }
  #step7_item0013 { position:absolute; border: 1px solid black; left:930px; top:790px; width:140px; height:31px; }
  #step7_item0014 { position:absolute; border: 1px solid black; left:850px; top:850px; width:220px; height:30px; }
  
  /* 解析 step8 */
  #step8_item0001_box { position:absolute; border: 1px solid black; left:40px; top:1185px; width:170px; height:51px; }
  #step8_item0001_1 { position:absolute; left:40px; top:1191px; }
  #step8_item0001_1_label { position:absolute; left:60px; top:1197px;}
  #step8_item0001_2 { position:absolute; left:40px; top:1208px; }
  #step8_item0001_2_label { position:absolute; left:60px; top:1214px;}
  #step8_item0002 { position:absolute; border: 1px solid black; left:40px; top:1255px; width:170px; height:31px; }
  #step8_item0003 { position:absolute; border: 1px solid black; left:10px; top:1305px; width:200px; height:50px; z-index:98; }
  
  /* 解析 step9 */
  #step9_item0001 { position:absolute; border: 1px solid black; left:240px; top:1065; width:830px; height:290px; z-index:97; }
  
  /* 処置 step10 */
  #step10_item0001 { position:absolute; border: 1px solid black; left:40px; top:1355; width:780px; height:91px; z-index:96; }
  #step10_item0002 { position:absolute; border: 1px solid black; left:160px; top:1444px; width:660px; height:31px; }

  /* 確認 step11 */
  #step11_item0001 { position:absolute; border: 1px solid black; left:40px; top:1475; width:780px; height:90px; z-index:95; }
  #step11_item0002 { position:absolute; border: 1px solid black; left:40px; top:1565; width:780px; height:91px; z-index:94; }
  #step11_item0003 { position:absolute; border: 1px solid black; left:109px; top:1655px; width:72px; height:30px; }
  #step11_item0004 { position:absolute; border: 1px solid black; left:180px; top:1655px; width:71px; height:30px; }
  #step11_item0005 { position:absolute; border: 1px solid black; left:250px; top:1655px; width:71px; height:30px; }
  #step11_item0006 { position:absolute; border: 1px solid black; left:320px; top:1655px; width:71px; height:30px; }
  #step11_item0007 { position:absolute; border: 1px solid black; left:499px; top:1655px; width:112px; height:30px; }
  #step11_item0008 { position:absolute; border: 1px solid black; left:709px; top:1655px; width:111px; height:30px; }

  /* 結了 step12 */
  #step12_item0001 { position:absolute; border: 1px solid black; left:930px; top:1355px; width:140px; height:31px; }
  #step12_item0002 { position:absolute; border: 1px solid black; left:930px; top:1385px; width:140px; height:31px; }
  #step12_item0003 { position:absolute; border: 1px solid black; left:930px; top:1415px; width:140px; height:30px; }
  #step12_item0004 { position:absolute; border: 1px solid black; left:930px; top:1445px; width:140px; height:31px; }
  #step12_item0005 { position:absolute; border: 1px solid black; left:930px; top:1475px; width:140px; height:31px; }
  #step12_item0006 { position:absolute; border: 1px solid black; left:930px; top:1505px; width:140px; height:31px; }
  #step12_item0007 { position:absolute; border: 1px solid black; left:930px; top:1535px; width:140px; height:31px; }
  #step12_item0008 { position:absolute; border: 1px solid black; left:930px; top:1565px; width:140px; height:31px; }
  #step12_item0009 { position:absolute; border: 1px solid black; left:930px; top:1595px; width:140px; height:30px; }
  #step12_item0010 { position:absolute; border: 1px solid black; left:930px; top:1625px; width:140px; height:31px; }
  #step12_item0011 { position:absolute; border: 1px solid black; left:930px; top:1655px; width:140px; height:30px; }

  #btnSubmit { position:absolute; left:985px; top:5px; }
  #btnSubmit2 { position:absolute; left:985px; top:1690px; }
</style>

<script type="text/javascript">
  
  // チェックボックスの選択処理
  function checkbox_onclick(target)
  {
  	var x=document.getElementsByName(target.name);
  	var i = 0;
  	for(i = 0; i < x.length; i++){
  		if(target != x[i]){
    		x[i].checked = false; 
  		}
  	}
  }
  
  // 初期化処理
  $(document).ready(function() {

    // すべて内容を入力不能
    $("*[id^='step']").attr("disabled","true");
    $("*[id^='step1_item0002']").removeAttr("disabled");
    $("*[id^='step1_item0002']").css("background", "#EBEBE4");

    // 処理により、分岐する
    switch("<?php echo $step; ?>") {

      // 起票
      case "1":
        $("*[id^='step1_']").css("background","yellow");
        $("*[id^='step2_']").css("background","yellow");
        $("*[id^='step3_']").css("background","yellow");
        $("*[id^='step1_']").removeAttr("disabled");
        $("*[id^='step2_']").removeAttr("disabled");
        $("*[id^='step3_']").removeAttr("disabled");
        
        $("*[id^='step1_item0001']").css("background", "#EBEBE4");
        $("*[id^='step1_item0002']").css("background", "#EBEBE4");
        $("*[id^='step1_item0003']").css("background", "#EBEBE4");
        $("*[id^='step1_item0004']").css("background", "#EBEBE4");
        $("*[id^='step2_item0001']").css("background", "#EBEBE4");
        break;

      // 発行
      case "2":
        break;

      // 解析
      case "3":
        $("*[id^='step4_']").css("background","yellow");
        $("*[id^='step5_']").css("background","yellow");
        $("*[id^='step6_']").css("background","yellow");
        $("*[id^='step7_']").css("background","yellow");
        $("*[id^='step8_']").css("background","yellow");
        $("*[id^='step9_']").css("background","yellow");
        $("*[id^='step4_']").removeAttr("disabled");
        $("*[id^='step5_']").removeAttr("disabled");
        $("*[id^='step6_']").removeAttr("disabled");
        $("*[id^='step7_']").removeAttr("disabled");
        $("*[id^='step8_']").removeAttr("disabled");
        $("*[id^='step9_']").removeAttr("disabled");
        break;

      // 処置
      case "4":
        $("*[id^='step10_']").css("background","yellow");
        $("*[id^='step10_']").removeAttr("disabled");
        break;

      // 確認
      case "5":
        $("*[id^='step11_']").css("background","yellow");
        $("*[id^='step11_']").removeAttr("disabled");
        break;

      // 結了
      case "6":
        $("*[id^='step12_']").css("background","yellow");
        $("*[id^='step12_']").removeAttr("disabled");
        break;

      // 参照
      case "ref":
        break;

      case "edit":
        // すべて内容を入力可能
        $("*[id^='step']").removeAttr("disabled");
        $("*[id^='step']").css("background","yellow");
        $("*[id^='step1_item0001']").css("background", "#EBEBE4");
        $("*[id^='step1_item0002']").css("background", "#EBEBE4");
        $("*[id^='step1_item0003']").css("background", "#EBEBE4");
        $("*[id^='step1_item0004']").css("background", "#EBEBE4");
        $("*[id^='step2_item0001']").css("background", "#EBEBE4");
        break;

      default:
        break;
    }

    // 発生対象レベル1名の選択リストを作成する
    $.get("./ajax_sizai.php", { level: "1", parent: "" },
      function(data){
        $("#step1_item0005").html(data);
        if ("<?php echo $step1_item0005; ?>" != "") {
          $("#step1_item0005").val("<?php echo $step1_item0005; ?>");
        }
    });

    $.get("./ajax_sizai.php", { level: "2", parent: "<?php echo $step1_item0005; ?>" },
      function(data){
        $("#step1_item0006").html(data);
        if ("<?php echo $step1_item0006; ?>" != "") {
          $("#step1_item0006").val("<?php echo $step1_item0006; ?>");
        }
    });

    $.get("./ajax_sizai.php", { level: "3", parent: "<?php echo $step1_item0006; ?>" },
      function(data){
        $("#step1_item0007").html(data);
        if ("<?php echo $step1_item0007; ?>" != "") {
          $("#step1_item0007").val("<?php echo $step1_item0007; ?>");
        }
    });

    $.get("./ajax_sizai.php", { level: "4", parent: "<?php echo $step1_item0007; ?>" },
      function(data){
        $("#step1_item0008").html(data);
        if ("<?php echo $step1_item0008; ?>" != "") {
          $("#step1_item0008").val("<?php echo $step1_item0008; ?>");
        }
    });

    // 故障対象レベル1名の選択リストを作成する
    $.get("./ajax_sizai.php", { level: "1", parent: "" },
      function(data){
        $("#step7_item0004").html(data);
        if ("<?php echo $step7_item0004; ?>" != "") {
          $("#step7_item0004").val("<?php echo $step7_item0004; ?>");
        }
    });

    $.get("./ajax_sizai.php", { level: "2", parent: "<?php echo $step7_item0004; ?>" },
      function(data){
        $("#step7_item0005").html(data);
        if ("<?php echo $step7_item0005; ?>" != "") {
          $("#step7_item0005").val("<?php echo $step7_item0005; ?>");
        }
    });

    $.get("./ajax_sizai.php", { level: "3", parent: "<?php echo $step7_item0005; ?>" },
      function(data){
        $("#step7_item0006").html(data);
        if ("<?php echo $step7_item0006; ?>" != "") {
          $("#step7_item0006").val("<?php echo $step7_item0006; ?>");
        }
    });

    $.get("./ajax_sizai.php", { level: "4", parent: "<?php echo $step7_item0006; ?>" },
      function(data){
        $("#step7_item0007").html(data);
        if ("<?php echo $step7_item0007; ?>" != "") {
          $("#step7_item0007").val("<?php echo $step7_item0007; ?>");
        }
    });

    $.get("./ajax_sizai.php", { level: "5", parent: "<?php echo $step7_item0007; ?>" },
      function(data){
        $("#step7_item0008").html(data);
        if ("<?php echo $step7_item0008; ?>" != "") {
          $("#step7_item0008").val("<?php echo $step7_item0008; ?>");
        }
    });
  });
  
  function step1_item0005_onchange(value) {
    $.get("./ajax_sizai.php", { level: "2", parent: value },
      function(data){
        $("#step1_item0006").html(data);
        $("#step1_item0006").val("");
        $("#step1_item0007").html("<option value=\"\"></option>");
        $("#step1_item0007").val("");
        $("#step1_item0008").html("<option value=\"\"></option>");
        $("#step1_item0008").val("");
    });
  }

  function step1_item0006_onchange(value) {
    $.get("./ajax_sizai.php", { level: "3", parent: value },
      function(data){
        $("#step1_item0007").html(data);
        $("#step1_item0007").val("");
        $("#step1_item0008").html("<option value=\"\"></option>");
        $("#step1_item0008").val("");
    });
  }

  function step1_item0007_onchange(value) {
    $.get("./ajax_sizai.php", { level: "4", parent: value },
      function(data){
        $("#step1_item0008").html(data);
        $("#step1_item0008").val("");
    });
  }

  function step7_item0004_onchange(value) {
    $.get("./ajax_sizai.php", { level: "2", parent: value },
      function(data){
        $("#step7_item0005").html(data);
        $("#step7_item0006").html("<option value=\"\"></option>");
        $("#step7_item0007").html("<option value=\"\"></option>");
        $("#step7_item0008").html("<option value=\"\"></option>");
        $("#step7_item0005").val("");
        $("#step7_item0006").val("");
        $("#step7_item0007").val("");
        $("#step7_item0008").val("");
        $("#step7_item0009").val("");
    });
  }

  function step7_item0005_onchange(value) {
    $.get("./ajax_sizai.php", { level: "3", parent: value },
      function(data){
        $("#step7_item0006").html(data);
        $("#step7_item0007").html("<option value=\"\"></option>");
        $("#step7_item0008").html("<option value=\"\"></option>");
        $("#step7_item0006").val("");
        $("#step7_item0007").val("");
        $("#step7_item0008").val("");
        $("#step7_item0009").val("");
    });
  }

  function step7_item0006_onchange(value) {
    $.get("./ajax_sizai.php", { level: "4", parent: value },
      function(data){
        $("#step7_item0007").html(data);
        $("#step7_item0008").html("<option value=\"\"></option>");
        $("#step7_item0007").val("");
        $("#step7_item0008").val("");
        $("#step7_item0009").val("");
    });
  }
  
  function step7_item0007_onchange(value) {
    $.get("./ajax_sizai.php", { level: "5", parent: value },
      function(data){
        $("#step7_item0008").html(data);
        $("#step7_item0008").val("");
        $("#step7_item0009").val("");
    });
  }
  
  function step7_item0008_onchange(value) {
    $.get("./ajax_sizai.php", { level: "6", parent: value },
      function(data){
        $("#step7_item0009").val(data);
    });
  }
</script>
</head>
<body>
<form name="frmBug" action="../fw/dbaction.php" method="post">
<input type="hidden" name="table_name" value="tbl_bug">
<?php if ($id == "") { ?>
<input type="hidden" name="action_type" value="insert">
<?php } else { ?>
<input type="hidden" name="action_type" value="update">
<?php } ?>
<input type="hidden" name="action_url" value="../extension/bug.php?finish=true">
<input type="hidden" name="action_id" value="<?php echo $id; ?>">

<!-- **********************↓↓↓ 起票 step1 開始 ↓↓↓************************ -->
<!-- 開発システム名 -->
<?php display_text_nocss("step1_item0001", $step1_item0001, STATUS_INPUT, "readonly"); ?>
<!-- 管理状態 -->
<?php display_text_nocss("step1_item0002", $step1_item0002, STATUS_INPUT, "readonly"); ?>
<!-- 作業項目名 -->
<?php display_text_nocss("step1_item0003", $step1_item0003, STATUS_INPUT, "readonly"); ?>
<!-- システムID -->
<?php display_text_nocss("step1_item0004", $step1_item0004, STATUS_INPUT, "readonly"); ?>
<!-- 発生対象レベル1名 -->
<select id="step1_item0005" name="step1_item0005" onchange="step1_item0005_onchange(this.value);"></select>
<!-- 発生対象レベル2名 -->
<select id="step1_item0006" name="step1_item0006" onchange="step1_item0006_onchange(this.value);"></select>
<!-- 発生対象レベル3名 -->
<select id="step1_item0007" name="step1_item0007" onchange="step1_item0007_onchange(this.value);"></select>
<!-- 発生対象レベル4名 -->
<select id="step1_item0008" name="step1_item0008"></select>
<!-- 使用マシン -->
<?php display_text_nocss("step1_item0009", $step1_item0009, STATUS_INPUT, ""); ?>
<!-- 端末ID -->
<?php display_text_nocss("step1_item0010", $step1_item0010, STATUS_INPUT, ""); ?>
<!-- 使用ファイル（V/R） -->
<?php display_text_nocss("step1_item0011", $step1_item0011, STATUS_INPUT, ""); ?>
<!-- 発見手段 -->
<input type="text" id="step1_item0012_box" readonly>
<?php display_group_checkbox("step1_item0012", "CODE_920", $step1_item0012, STATUS_INPUT); ?>
<!-- 事象 -->
<input type="text" id="step1_item0013_box" readonly>
<?php display_group_checkbox("step1_item0013", "CODE_921", $step1_item0013, STATUS_INPUT); ?>
<?php display_text_nocss("step1_item0013_text", $step1_item0013_text, STATUS_INPUT, ""); ?>
<!-- **********************↑↑↑ 起票 step1 終了 ↑↑↑************************ -->

<!-- **********************↓↓↓ 起票 step2 開始 ↓↓↓************************ -->
<!-- 発行元故障処理票番号 -->
<?php display_text_nocss("step2_item0001", $step2_item0001, STATUS_INPUT, "readonly"); ?>
<!-- 発見日付 -->
<?php display_text_nocss("step2_item0002", $step2_item0002, STATUS_INPUT, ""); ?>
<!-- 発見時分 -->
<?php display_text_nocss("step2_item0003", $step2_item0003, STATUS_INPUT, ""); ?>
<!-- 起票日 -->
<?php display_text_nocss("step2_item0004", $step2_item0004, STATUS_INPUT, ""); ?>
<!-- 発行者所属 -->
<?php display_text_nocss("step2_item0005", $step2_item0005, STATUS_INPUT, ""); ?>
<!-- 発行者氏名 -->
<?php display_text_nocss("step2_item0006", $step2_item0006, STATUS_INPUT, ""); ?>
<!-- 発行者電話 -->
<?php display_text_nocss("step2_item0007", $step2_item0007, STATUS_INPUT, ""); ?>
<!-- 発見試験名 -->
<input type="text" id="step2_item0008_box" readonly>
<?php display_group_checkbox("step2_item0008", "CODE_922", $step2_item0008, STATUS_INPUT); ?>
<!-- **********************↑↑↑ 起票 step2 終了 ↑↑↑************************ -->

<!-- **********************↓↓↓ 起票 step3 開始 ↓↓↓************************ -->
<?php display_textarea_nocss("step3_item0001", $step3_item0001, STATUS_INPUT, ""); ?>
<?php display_textarea_nocss("step3_item0002", $step3_item0002, STATUS_INPUT, ""); ?>
<!-- 添付資料有無 -->
<input type="text" id="step3_item0003_box" readonly>
<?php display_group_checkbox("step3_item0003", "CODE_923", $step3_item0003, STATUS_INPUT); ?>
<!-- 添付資料返却 -->
<input type="text" id="step3_item0004_box" readonly>
<?php display_group_checkbox("step3_item0004", "CODE_924", $step3_item0004, STATUS_INPUT); ?>
<!-- 添付資料名 -->
<?php display_text_nocss("step3_item0005", $step3_item0005, STATUS_INPUT, ""); ?>
<!-- 添付資料枚数 -->
<?php display_text_nocss("step3_item0006", $step3_item0006, STATUS_INPUT, ""); ?>
<!-- 添付資料返却先 -->
<?php display_text_nocss("step3_item0007", $step3_item0007, STATUS_INPUT, ""); ?>
<!-- **********************↑↑↑ 起票 step3 終了 ↑↑↑************************ -->

<!-- **********************↓↓↓ 解析 step4 開始 ↓↓↓************************ -->
<!-- 解析開始日 -->
<?php display_text_nocss("step4_item0001", $step4_item0001, STATUS_INPUT, ""); ?>
<!-- **********************↑↑↑ 解析 step4 終了 ↑↑↑************************ -->

<!-- **********************↓↓↓ 持ち回り情報 step5 開始 ↓↓↓**************** -->
<!-- 持ち回り先情報１ -->
<!-- 持ち回り先 -->
<?php display_text_nocss("step5_item0001", $step5_item0001, STATUS_INPUT, ""); ?>
<!-- 受領日 -->
<?php display_text_nocss("step5_item0002", $step5_item0002, STATUS_INPUT, ""); ?>
<!-- 受領者 -->
<?php display_text_nocss("step5_item0003", $step5_item0003, STATUS_INPUT, ""); ?>
<!-- 故障処理票番号 -->
<?php display_text_nocss("step5_item0004", $step5_item0004, STATUS_INPUT, ""); ?>
<!-- 持ち回り先情報２ -->
<?php display_text_nocss("step5_item0005", $step5_item0005, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step5_item0006", $step5_item0006, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step5_item0007", $step5_item0007, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step5_item0008", $step5_item0008, STATUS_INPUT, ""); ?>
<!-- 持ち回り先情報３ -->
<?php display_text_nocss("step5_item0009", $step5_item0009, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step5_item0010", $step5_item0010, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step5_item0011", $step5_item0011, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step5_item0012", $step5_item0012, STATUS_INPUT, ""); ?>
<!-- 持ち回り先情報４ -->
<?php display_text_nocss("step5_item0013", $step5_item0013, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step5_item0014", $step5_item0014, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step5_item0015", $step5_item0015, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step5_item0016", $step5_item0016, STATUS_INPUT, ""); ?>
<!-- 持ち回り先情報５ -->
<?php display_text_nocss("step5_item0017", $step5_item0017, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step5_item0018", $step5_item0018, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step5_item0019", $step5_item0019, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step5_item0020", $step5_item0020, STATUS_INPUT, ""); ?>
<!-- **********************↑↑↑ 持ち回り情報 step5 終了 ↑↑↑**************** -->

<!-- **********************↓↓↓ 分析 step6 開始 ↓↓↓************************ -->
<!-- エラーを作り込んだ工程 -->
<input type="text" id="step6_item0001_box" readonly>
<input type="text" id="step6_item0002_box" readonly>
<input type="text" id="step6_item0003_box" readonly>
<input type="text" id="step6_item0004_box" readonly>
<input type="text" id="step6_item0005_box" readonly>
<input type="text" id="step6_item0006_box" readonly>
<input type="text" id="step6_item0007_box" readonly>
<input type="text" id="step6_item0008_box" readonly>
<input type="text" id="step6_item0009_box" readonly>
<input type="text" id="step6_item0010_box" readonly>
<input type="text" id="step6_item0011_box" readonly>
<input type="text" id="step6_item0012_box" readonly>
<?php display_group_checkbox("step6_item0001", "CODE_925", $step6_item0001, STATUS_INPUT); ?>
<!-- 設計工程で摘出できなかった要因 -->
<?php display_group_checkbox("step6_item0002", "CODE_926", $step6_item0002, STATUS_INPUT); ?>
<?php display_text_nocss("step6_item0002_text", $step6_item0002_text, STATUS_INPUT, ""); ?>
<!-- バグを本来摘出すべき試験工程 -->
<?php display_group_checkbox("step6_item0003", "CODE_927", $step6_item0003, STATUS_INPUT); ?>
<!-- 試験工程で摘出できなかった要因 -->
<?php display_group_checkbox("step6_item0004", "CODE_928", $step6_item0004, STATUS_INPUT); ?>
<?php display_text_nocss("step6_item0004_text", $step6_item0004_text, STATUS_INPUT, ""); ?>
<!-- 環境バグ -->
<?php display_group_checkbox("step6_item0005", "CODE_929", $step6_item0005, STATUS_INPUT); ?>
<?php display_text_nocss("step6_item0005_text", $step6_item0005_text, STATUS_INPUT, ""); ?>
<!-- ハードウェア -->
<?php display_group_checkbox("step6_item0006", "CODE_930", $step6_item0006, STATUS_INPUT); ?>
<?php display_text_nocss("step6_item0006_text", $step6_item0006_text, STATUS_INPUT, ""); ?>
<!-- その他の要因 -->
<?php display_group_checkbox("step6_item0007", "CODE_931", $step6_item0007, STATUS_INPUT); ?>
<?php display_text_nocss("step6_item0007_text", $step6_item0007_text, STATUS_INPUT, ""); ?>
<!-- バグ現象 -->
<?php display_group_checkbox("step6_item0008", "CODE_932", $step6_item0008, STATUS_INPUT); ?>
<?php display_text_nocss("step6_item0008_text", $step6_item0008_text, STATUS_INPUT, ""); ?>
<!-- 処理機能 -->
<?php display_group_checkbox("step6_item0009", "CODE_933", $step6_item0009, STATUS_INPUT); ?>
<?php display_text_nocss("step6_item0009_text", $step6_item0009_text, STATUS_INPUT, ""); ?>
<!--バグ原因 1:仕様書不備の問題 -->
<?php display_group_checkbox("step6_item0010", "CODE_934", $step6_item0010, STATUS_INPUT); ?>
<?php display_text_nocss("step6_item0010_text", $step6_item0010_text, STATUS_INPUT, ""); ?>
<!--バグ原因 2:仕様からの展開の問題 -->
<?php display_group_checkbox("step6_item0011", "CODE_935", $step6_item0011, STATUS_INPUT); ?>
<?php display_text_nocss("step6_item0011_text", $step6_item0011_text, STATUS_INPUT, ""); ?>
<!--バグ原因 3:仕様関連以外の問題点 -->
<?php display_group_checkbox("step6_item0012", "CODE_936", $step6_item0012, STATUS_INPUT); ?>
<?php display_text_nocss("step6_item0012_text", $step6_item0012_text, STATUS_INPUT, ""); ?>
<!-- **********************↑↑↑ 分析 step6 終了 ↑↑↑************************ -->

<!-- **********************↓↓↓ 分析 step7 開始 ↓↓↓************************ -->
<!-- 発生箇所 -->
<input type="text" id="step7_item0001_box" readonly>
<?php display_group_checkbox("step7_item0001", "CODE_937", $step7_item0001, STATUS_INPUT); ?>
<!-- 回答元日付 -->
<?php display_text_nocss("step7_item0002", $step7_item0002, STATUS_INPUT, ""); ?>
<!-- 回答元確認者 -->
<?php display_text_nocss("step7_item0003", $step7_item0003, STATUS_INPUT, ""); ?>
<!-- 故障レベル1名 -->
<select id="step7_item0004" name="step7_item0004" onchange="step7_item0004_onchange(this.value);"></select>
<!-- 故障レベル2名 -->
<select id="step7_item0005" name="step7_item0005" onchange="step7_item0005_onchange(this.value);"></select>
<!-- 故障レベル3名 -->
<select id="step7_item0006" name="step7_item0006" onchange="step7_item0006_onchange(this.value);"></select>
<!-- 故障レベル4名 -->
<select id="step7_item0007" name="step7_item0007" onchange="step7_item0007_onchange(this.value);"></select>
<!-- 故障レベル5名 -->
<select id="step7_item0008" name="step7_item0008" onchange="step7_item0008_onchange(this.value);"></select>
<!-- ソフトウェア種別 -->
<?php display_text_nocss("step7_item0009", $step7_item0009, STATUS_INPUT, ""); ?>
<!-- 解析日付 -->
<?php display_text_nocss("step7_item0010", $step7_item0010, STATUS_INPUT, ""); ?>
<!-- 解析担当者 -->
<?php display_text_nocss("step7_item0011", $step7_item0011, STATUS_INPUT, ""); ?>
<!-- 解析日付 -->
<?php display_text_nocss("step7_item0012", $step7_item0012, STATUS_INPUT, ""); ?>
<!-- 解析担当者 -->
<?php display_text_nocss("step7_item0013", $step7_item0013, STATUS_INPUT, ""); ?>
<!-- 処置完了予定日 -->
<?php display_text_nocss("step7_item0014", $step7_item0014, STATUS_INPUT, ""); ?>
<!-- **********************↑↑↑ 分析 step7 終了 ↑↑↑************************ -->

<!-- **********************↓↓↓ 分析 step8 開始 ↓↓↓************************ -->
<!-- 仕様変更 -->
<input type="text" id="step8_item0001_box" readonly>
<?php display_group_checkbox("step8_item0001", "CODE_938", $step8_item0001, STATUS_INPUT); ?>
<!-- 仕様変更管理番号等 -->
<?php display_text_nocss("step8_item0002", $step8_item0002, STATUS_INPUT, ""); ?>
<!-- 関連故障処理票番号 -->
<?php display_textarea_nocss("step8_item0003", $step8_item0003, STATUS_INPUT, ""); ?>
<!-- **********************↑↑↑ 分析 step8 終了 ↑↑↑************************ -->

<!-- **********************↓↓↓ 分析 step9 開始 ↓↓↓************************ -->
<?php display_textarea_nocss("step9_item0001", $step9_item0001, STATUS_INPUT, ""); ?>
<!-- **********************↑↑↑ 分析 step9 終了 ↑↑↑************************ -->

<!-- **********************↓↓↓ 処置 step10 開始 ↓↓↓*********************** -->
<?php display_textarea_nocss("step10_item0001", $step10_item0001, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step10_item0002", $step10_item0002, STATUS_INPUT, ""); ?>
<!-- **********************↑↑↑ 処置 step10 終了 ↑↑↑*********************** -->

<!-- **********************↓↓↓ 確認 step11 開始 ↓↓↓*********************** -->
<?php display_textarea_nocss("step11_item0001", $step11_item0001, STATUS_INPUT, ""); ?>
<?php display_textarea_nocss("step11_item0002", $step11_item0002, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step11_item0003", $step11_item0003, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step11_item0004", $step11_item0004, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step11_item0005", $step11_item0005, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step11_item0006", $step11_item0006, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step11_item0007", $step11_item0007, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step11_item0008", $step11_item0008, STATUS_INPUT, ""); ?>
<!-- **********************↑↑↑ 確認 step11 終了 ↑↑↑*********************** -->

<!-- **********************↓↓↓ 結了 step12 開始 ↓↓↓*********************** -->
<?php display_text_nocss("step12_item0001", $step12_item0001, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step12_item0002", $step12_item0002, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step12_item0003", $step12_item0003, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step12_item0004", $step12_item0004, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step12_item0005", $step12_item0005, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step12_item0006", $step12_item0006, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step12_item0007", $step12_item0007, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step12_item0008", $step12_item0008, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step12_item0009", $step12_item0009, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step12_item0010", $step12_item0010, STATUS_INPUT, ""); ?>
<?php display_text_nocss("step12_item0011", $step12_item0011, STATUS_INPUT, ""); ?>
<!-- **********************↑↑↑ 結了 step12 終了 ↑↑↑*********************** -->

<!-- **********************↓↓↓ 操作機能エリア 開始 ↓↓↓******************** -->
<?php if ($step == "1") { ?>
<input type="submit" class="orange" id="btnSubmit" name="btnSubmit" value="  起票  " />
<input type="submit" class="orange" id="btnSubmit2" name="btnSubmit" value="  起票  " />
<?php } else if ($step == "2"){ ?>
<input type="submit" class="orange" id="btnSubmit" name="btnSubmit" value="  発行  " />
<input type="submit" class="orange" id="btnSubmit2" name="btnSubmit" value="  発行  " />
<?php } else if ($step == "ref"){ ?>
<input type="submit" class="orange" id="btnSubmit" name="btnSubmit" value="  閉じる  " />
<input type="submit" class="orange" id="btnSubmit2" name="btnSubmit" value="  閉じる  " />
<?php } else { ?>
<input type="submit" class="orange" id="btnSubmit" name="btnSubmit" value="  更新  " />
<input type="submit" class="orange" id="btnSubmit2" name="btnSubmit" value="  更新  " />
<?php } ?>
<!-- **********************↑↑↑ 操作機能エリア 終了 ↑↑↑******************** -->

</form>
</body>
</html>
