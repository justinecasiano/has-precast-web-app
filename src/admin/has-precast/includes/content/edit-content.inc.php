<?php

require('../image-handler.php');

if (isset($_POST['cancel'])) {
  header("location: ../../../has-precast/content-management-hero.php");
  exit();
}

if ($_POST['submit'] === "cancel") {
  header("location: ../../../has-precast/content-management-products.php");
  exit();
}

if (isset($_POST['submit'])) {
  include("../../classes/dbh.classes.php");
  include("../../classes/content-repo.classes.php");

  $setContents = new ContentRepository;

  include("../../classes/default-repo.php");

  $default = new DefaultRepository;


  if ($_GET['page'] === "hero") {
    $id = $_POST['id'];
    $getContent = new ContentRepository;

    $name = $_POST['name'];
    $page = $_POST['page'];

    if (!empty($_FILES['object']['name'])) {
      $object = $_FILES['object'];

      $hero = fileHandler2($object, "$page", "{$name}");
    } else {
      $object = $_POST['objectOrig'];

      $hero['newName'] = heroCopy1($object, $page, $name);
    }


    $result = $getContent->setHeroUseID($page, $hero['newName'], $id);

    $message = urlencode('Hero Image &#34;' . $name . '&#34; Updated Successfully!');
    header("location: ../../../has-precast/content-management-hero.php?message={$message}&top=10&type=success");
    exit();
  }

  if ($_GET['page'] === "products") {
    $id = $_POST['id'];
    $getContent = new ContentRepository;

    $name = $_POST['name'];


    $desc = $_POST['desc'];
    $status = $_POST['status'];

    if (!empty($_FILES['cart_image']['name'])) {
      $cart_image = $_FILES['cart_image'];

      $cart = designHandler1($_FILES['cart_image'], "cart_$name");
    } else {
      $cart = $_POST['cartImg'];
    }

    if (!empty($_FILES['wfb_image']['name'])) {
      $wfb_image = $_FILES['wfb_image'];

      $wfb = designHandler1($_FILES['wfb_image'], "wfb_$name");
    } else {
      $wfb = $_POST['wfbImg'];
    }


    $result = $getContent->setProductUseID($name, $desc, $cart, $wfb, $status, $id);

    $message = urlencode('Product &#34;' . $name . '&#34; Updated Successfully!');
    header("location: ../../../has-precast/content-management-products.php?message={$message}&top=10&type=success");
    exit();
  }

  if ($_GET["page"] === "about") {
    $hero_title1 = $_POST['hero-TITLE1'];
    $hero_caption1 = $_POST['hero-CAPTION1'];
    $hero_button = $_POST['hero-BUTTON'];

    $abt_title1 = $_POST["about-TITLE1"];

    $abt_par1 = $_POST["about-PARAGRAPH1"];
    $abt_par2 = $_POST["about-PARAGRAPH2"];
    $abt_par3 = $_POST["about-PARAGRAPH3"];
    $abt_par4 = $_POST["about-PARAGRAPH4"];
    $abt_par5 = $_POST["about-PARAGRAPH5"];

    $abt_img1 = $_POST["about-IMAGE1"];
    $abt1 = imageCopy("../../../has-precast/$abt_img1", "about-us", "abouts");

    $mv_title1 = $_POST["mv-TITLE1"];

    $mv_sbtitle1 = $_POST["mv-SUBTITLE1"];
    $mv_par1 = $_POST["mv-PARAGRAPH1"];

    $mv_sbtitle2 = $_POST["mv-SUBTITLE2"];
    $mv_par2 = $_POST["mv-PARAGRAPH2"];

    $mv_img1 = $_POST["mv-IMAGE1"];
    $mv1 = imageCopy("../../../has-precast/$mv_img1", "about-us", "mv-background");

    $result = $setContents->setContentsAbout(
      $hero_title1,
      $hero_caption1,
      $hero_button,
      $abt_title1,
      $abt_par1,
      $abt_par2,
      $abt_par3,
      $abt_par4,
      $abt_par5,
      $abt1,
      $mv_title1,
      $mv_sbtitle1,
      $mv_par1,
      $mv_sbtitle2,
      $mv_par2,
      $mv1
    );

    $message = urlencode('About Page Updated Successfully!');
    header("location: ../../../has-precast/content-management-about.php?message={$message}&top=10&type=success");
    exit();
  }

  if ($_GET['page'] === 'home') {
    $hero_caption1 = $_POST['hero-CAPTION1'];


    $wfb_caption1 = $_POST['wfb-CAPTION1'];
    $wfb_caption2 = $_POST['wfb-CAPTION2'];
    $wfb_button = $_POST['wfb-BUTTON'];

    $wfb_image1 = imageCopy2("../../../has-precast/{$_POST["wfb-IMAGE1"]}", "index", "wfb1");


    $prj_title1 = $_POST['prj-TITLE1'];

    $prj_caption1 = $_POST['prj-CAPTION1'];
    $prj_caption2 = $_POST['prj-CAPTION2'];
    $prj_caption3 = $_POST['prj-CAPTION3'];
    $prj_caption4 = $_POST['prj-CAPTION4'];

    $prj_button1 = $_POST['prj-BUTTON1'];
    $prj_button2 = $_POST['prj-BUTTON2'];
    $prj_button3 = $_POST['prj-BUTTON3'];
    $prj_button4 = $_POST['prj-BUTTON4'];

    $prj_image1 = imageCopy2("../../../has-precast/{$_POST["prj-IMAGE1"]}", "index", "prj1");
    $prj_image2 = imageCopy2("../../../has-precast/{$_POST["prj-IMAGE2"]}", "index", "prj2");
    $prj_image3 = imageCopy2("../../../has-precast/{$_POST["prj-IMAGE3"]}", "index", "prj3");
    $prj_image4 = imageCopy2("../../../has-precast/{$_POST["prj-IMAGE4"]}", "index", "prj4");


    $contact_caption1 = $_POST['contact-CAPTION1'];
    $contact_button1 = $_POST['contact-BUTTON1'];

    $contact_image1 = imageCopy2("../../../has-precast/{$_POST["contact-IMAGE1"]}", "index", "contact1");

    $setContents->setContentsHome(
      $hero_caption1,
      $wfb_caption1,
      $wfb_caption2,
      $wfb_button,
      $wfb_image1,
      $prj_title1,
      $prj_caption1,
      $prj_caption2,
      $prj_caption3,
      $prj_caption4,
      $prj_button1,
      $prj_button2,
      $prj_button3,
      $prj_button4,
      $prj_image1,
      $prj_image2,
      $prj_image3,
      $prj_image4,
      $contact_caption1,
      $contact_button1,
      $contact_image1
    );

    $message = urlencode('Homepage Updated Successfully!');
    header("location: ../../../has-precast/content-management-home.php?message={$message}&top=10&type=success");
    exit();
  }

  if ($_GET["page"] === "wfb") {

    if (isset($_POST['cancel'])) {
      header("location: ../../../has-precast/content-management-wfb.php?e");
    }

    $hero_TITLE1 = $_POST['hero-TITLE1'];
    $hero_CAPTION1 = $_POST['hero-CAPTION1'];
    $hero_BUTTON = $_POST['hero-BUTTON'];

    $table_TITLE1 = $_POST['table-TITLE1'];
    $table_CONTENT1 = $_POST['table-CONTENT1'];
    $table_CONTENT2 = $_POST['table-CONTENT2'];
    $table_CONTENT3 = $_POST['table-CONTENT3'];
    $table_CONTENT4 = $_POST['table-CONTENT4'];
    $table_CONTENT5 = $_POST['table-CONTENT5'];
    $table_CONTENT6 = $_POST['table-CONTENT6'];

    $wfb_TITLE1 = $_POST['wfb-TITLE1'];
    $wfb_PARAGRAPH1 = $_POST['wfb-PARAGRAPH1'];
    $wfb_PARAGRAPH2 = $_POST['wfb-PARAGRAPH2'];
    $wfb_PARAGRAPH3 = $_POST['wfb-PARAGRAPH3'];
    $wfb_PARAGRAPH4 = $_POST['wfb-PARAGRAPH4'];
    $wfb_PARAGRAPH5 = $_POST['wfb-PARAGRAPH5'];
    $wfb_IMAGE1 = imageCopy2("../../../has-precast/{$_POST["wfb-IMAGE1"]}", "wall-form-blocks", "wfb1");
    $wfb_IMAGE2 = imageCopy2("../../../has-precast/{$_POST["wfb-IMAGE2"]}", "wall-form-blocks", "wfb1");

    $dsgn_TITLE1 = $_POST['dsgn-TITLE1'];

    $dmsn_TITLE1 = $_POST['dmsn-TITLE1'];
    $dmsn_DETAIL1 = $_POST['dmsn-DETAIL1'];
    $dmsn_DETAIL2 = $_POST['dmsn-DETAIL2'];
    $dmsn_DETAIL3 = $_POST['dmsn-DETAIL3'];
    $dmsn_IMAGE1 = imageCopy2("../../../has-precast/{$_POST["dmsn-IMAGE1"]}", "wall-form-blocks", "dmsn1");

    $str_TITLE1 = $_POST['str-TITLE1'];
    $str_LABEL1 = $_POST['str-LABEL1'];
    $str_DETAIL1 = $_POST['str-DETAIL1'];
    $str_LABEL2 = $_POST['str-LABEL2'];
    $str_DETAIL2 = $_POST['str-DETAIL2'];
    $str_IMAGE1 = imageCopy2("../../../has-precast/{$_POST["str-IMAGE1"]}", "wall-form-blocks", "str1");

    $setContents->setContentsWFB(
      $hero_TITLE1,
      $hero_CAPTION1,
      $hero_BUTTON,
      $table_TITLE1,
      $table_CONTENT1,
      $table_CONTENT2,
      $table_CONTENT3,
      $table_CONTENT4,
      $table_CONTENT5,
      $table_CONTENT6,
      $wfb_TITLE1,
      $wfb_PARAGRAPH1,
      $wfb_PARAGRAPH2,
      $wfb_PARAGRAPH3,
      $wfb_PARAGRAPH4,
      $wfb_PARAGRAPH5,
      $wfb_IMAGE1,
      $wfb_IMAGE2,
      $dsgn_TITLE1,
      $dmsn_TITLE1,
      $dmsn_DETAIL1,
      $dmsn_DETAIL2,
      $dmsn_DETAIL3,
      $dmsn_IMAGE1,
      $str_TITLE1,
      $str_LABEL1,
      $str_DETAIL1,
      $str_LABEL2,
      $str_DETAIL2,
      $str_IMAGE1
    );

    $message = urlencode('Wall Form Blocks Page Updated Successfully!');
    header("location: ../../../has-precast/content-management-wfb.php?message={$message}&top=10&type=success");
    exit();
  }


  if ($_GET["page"] === "userGuide") {

    $hero_title1 = $_POST['hero-TITLE1'];
    $hero_caption1 = $_POST['hero-CAPTION1'];
    $hero_button = $_POST['hero-BUTTON'];

    $pre_title1 = $_POST['pre-TITLE1'];
    $pre_paragraph1 = $_POST['pre-PARAGRAPH1'];
    $pre_paragraph2 = $_POST['pre-PARAGRAPH2'];

    $table_title1 = $_POST['table-TITLE1'];
    $table_content1 = $_POST['table-CONTENT1'];
    $table_content2 = $_POST['table-CONTENT2'];

    $ct1_TITLE1 = $_POST['ct1-TITLE1'];
    $ct1_STEP1 = $_POST['ct1-STEP1'];
    $ct1_PARAGRAPH1 = $_POST['ct1-PARAGRAPH1'];
    $ct1_STEP2 = $_POST['ct1-STEP2'];
    $ct1_PARAGRAPH2 = $_POST['ct1-PARAGRAPH2'];
    $ct1_STEP3 = $_POST['ct1-STEP3'];
    $ct1_PARAGRAPH3 = $_POST['ct1-PARAGRAPH3'];
    $ct1_STEP4 = $_POST['ct1-STEP4'];
    $ct1_PARAGRAPH4 = $_POST['ct1-PARAGRAPH4'];
    $ct1_STEP5 = $_POST['ct1-STEP5'];
    $ct1_PARAGRAPH5 = $_POST['ct1-PARAGRAPH5'];
    $ct1_STEP6 = $_POST['ct1-STEP6'];
    $ct1_PARAGRAPH6 = $_POST['ct1-PARAGRAPH6'];

    $ct1_IMAGE1 = imageCopy2("../../../has-precast/{$_POST["ct1-IMAGE1"]}", "user-guide", "step1");
    $ct1_IMAGE2 = imageCopy2("../../../has-precast/{$_POST["ct1-IMAGE2"]}", "user-guide", "step2");
    $ct1_IMAGE3 = imageCopy2("../../../has-precast/{$_POST["ct1-IMAGE3"]}", "user-guide", "step3");
    $ct1_IMAGE4 = imageCopy2("../../../has-precast/{$_POST["ct1-IMAGE4"]}", "user-guide", "step4");
    $ct1_IMAGE5 = imageCopy2("../../../has-precast/{$_POST["ct1-IMAGE5"]}", "user-guide", "step5");
    $ct1_IMAGE6 = imageCopy2("../../../has-precast/{$_POST["ct1-IMAGE6"]}", "user-guide", "step6");

    $ct2_TITLE1 = $_POST['ct2-TITLE1'];
    $ct2_STEP1 = $_POST['ct2-STEP1'];
    $ct2_PARAGRAPH1 = $_POST['ct2-PARAGRAPH1'];
    $ct2_STEP2 = $_POST['ct2-STEP2'];
    $ct2_PARAGRAPH2 = $_POST['ct2-PARAGRAPH2'];
    $ct2_STEP3 = $_POST['ct2-STEP3'];
    $ct2_PARAGRAPH3 = $_POST['ct2-PARAGRAPH3'];
    $ct2_STEP4 = $_POST['ct2-STEP4'];
    $ct2_PARAGRAPH4 = $_POST['ct2-PARAGRAPH4'];
    $ct2_STEP5 = $_POST['ct2-STEP5'];
    $ct2_PARAGRAPH5 = $_POST['ct2-PARAGRAPH5'];
    $ct2_STEP6 = $_POST['ct2-STEP6'];
    $ct2_PARAGRAPH6 = $_POST['ct2-PARAGRAPH6'];
    $ct2_STEP7 = $_POST['ct2-STEP7'];
    $ct2_PARAGRAPH7 = $_POST['ct2-PARAGRAPH7'];
    $ct2_NOTE = $_POST['ct2-NOTE'];

    $ct2_VIDEO1 = videoCopy1("../../../has-precast/{$_POST["ct2-VIDEO1"]}", "user-guide", "video");

    $setContents->setContentsUserGuide(
      $hero_title1,
      $hero_caption1,
      $hero_button,
      $pre_title1,
      $pre_paragraph1,
      $pre_paragraph2,
      $table_title1,
      $table_content1,
      $table_content2,
      $ct1_TITLE1,
      $ct1_STEP1,
      $ct1_PARAGRAPH1,
      $ct1_IMAGE1,
      $ct1_STEP2,
      $ct1_PARAGRAPH2,
      $ct1_IMAGE2,
      $ct1_STEP3,
      $ct1_PARAGRAPH3,
      $ct1_IMAGE3,
      $ct1_STEP4,
      $ct1_PARAGRAPH4,
      $ct1_IMAGE4,
      $ct1_STEP5,
      $ct1_PARAGRAPH5,
      $ct1_IMAGE5,
      $ct1_STEP6,
      $ct1_PARAGRAPH6,
      $ct1_IMAGE6,
      $ct2_TITLE1,
      $ct2_STEP1,
      $ct2_PARAGRAPH1,
      $ct2_STEP2,
      $ct2_PARAGRAPH2,
      $ct2_STEP3,
      $ct2_PARAGRAPH3,
      $ct2_STEP4,
      $ct2_PARAGRAPH4,
      $ct2_STEP5,
      $ct2_PARAGRAPH5,
      $ct2_STEP6,
      $ct2_PARAGRAPH6,
      $ct2_STEP7,
      $ct2_PARAGRAPH7,
      $ct2_NOTE,
      $ct2_VIDEO1
    );

    $message = urlencode('User Guide Page Updated Successfully!');
    header("location: ../../../has-precast/content-management-user-guide.php?message={$message}&top=10&type=success");
    exit();
  }

  if ($_GET["page"] === "projects") {

    $hero_title1 = $_POST['hero-TITLE1'];
    $hero_caption1 = $_POST['hero-CAPTION1'];
    $hero_button = $_POST['hero-BUTTON'];
    $prj_title1 = $_POST['prj-TITLE1'];


    $setContents->setContentsProjects($hero_title1, $hero_caption1, $hero_button, $prj_title1);

    $message = urlencode('Projects Page Updated Successfully!');
    header("location: ../../../has-precast/content-management-projects.php?message={$message}&top=10&type=success");
    exit();
  }

  if ($_GET["page"] === "contact") {

    $hero_title1 = $_POST['hero-TITLE1'];
    $contact_gmaps = $_POST['contact-GMAPSEMBED'];
    $contact_add = $_POST['contact-ADDRESS'];
    $contact_email = $_POST['contact-EMAIL'];
    $contact_no1 = $_POST['contact-CONTACTNO1'];
    $contact_no2 = $_POST['contact-CONTACTNO2'];

    $setContents->setContentsContact($hero_title1, $contact_gmaps, $contact_add, $contact_email, $contact_no1, $contact_no2);

    $message = urlencode('Contact Us Page Updated Successfully!');
    header("location: ../../../has-precast/content-management-contact.php?message={$message}&top=10&type=success");
    exit();
  }
} else {
  $message = urlencode('An Error Updating the Contents Occured');
  header("location: ../../../has-precast/content-management-products.php?message={$message}&top=10&type=error");
  exit();
}
