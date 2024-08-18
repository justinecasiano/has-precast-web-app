<?php

class ContentRepository extends Dbh{

    public function getPage($page){

        $query = $this->connect()->prepare("SELECT * FROM content WHERE page =:page AND type != 'HERO' AND `default` = 0;");
        $data = [":page" => $page];
        //Checks if the query ran if not sends the user back into the login page
        if(!$query->execute($data)){
            $query = null;
            if($page === "userGuide"){
                $page = "user-guide";
            }
            header("location: ../../content-management-{$page}.php?error=queryfailed");
            exit();
        }
        
        if($query->rowCount() == 0){
            $query = null;
            header("location: ../../content-management-{$page}.php?error=usernotfounds");
            exit();
        }

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    public function getProducts(){

        $query = $this->connect()->prepare("SELECT * FROM wall_form_block WHERE design_name IS NOT NULL AND `default` = 0;");
        //Checks if the query ran if not sends the user back into the login page
        if(!$query->execute()){
            $query = null;

            header("location: ../../content-management-products.php?error=queryfailed");
            exit();
        }
        
        if($query->rowCount() == 0){
            $query = null;
            header("location: ../../content-management-products.php?error=usernotfounds");
            exit();
        }

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAvailProducts(){

        $query = $this->connect()->prepare("SELECT * FROM wall_form_block WHERE design_name IS NOT NULL AND status = 'AVAIL' AND `default` = 0;");
        //Checks if the query ran if not sends the user back into the login page
        if(!$query->execute()){
            $query = null;

            header("location: ../../content-management-products.php?error=queryfailed");
            exit();
        }
        
        if($query->rowCount() == 0){
            $query = null;
            header("location: ../../content-management-products.php?error=usernotfounds");
            exit();
        }

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    

    

    public function getHero(){

        $query = $this->connect()->prepare("SELECT * FROM content WHERE type = 'HERO' AND object IS NOT NULL AND `default` = 0 ORDER BY page;");
        //Checks if the query ran if not sends the user back into the login page
        if(!$query->execute()){
            $query = null;
            header("location: ../../content-management-hero.php?error=queryfailed");
            exit();
        }
        
        if($query->rowCount() == 0){
            $query = null;
            header("location: ../../content-management-hero.php?error=usernotfounds");
            exit();
        }

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getHeroForPage($page){

        $query = $this->connect()->prepare("SELECT object FROM content WHERE PAGE = ? AND type = 'HERO' AND object IS NOT NULL AND `default` = 0;");
        //Checks if the query ran if not sends the user back into the login page
        if(!$query->execute(array($page))){
            $query = null;
            header("location: ../../content-management-hero.php?error=queryfailed");
            exit();
        }
        
        if($query->rowCount() == 0){
            $query = null;
            header("location: ../../content-management-hero.php?error=usernotfounds");
            exit();
        }

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    

    public function setContentsHome(
        $hero_caption1,
        $wfb_caption1, $wfb_caption2, $wfb_button, $wfb_image1,
        $prj_title1, $prj_caption1, $prj_caption2, $prj_caption3, $prj_caption4,
        $prj_button1, $prj_button2, $prj_button3, $prj_button4,
        $prj_image1, $prj_image2, $prj_image3, $prj_image4,
        $contact_caption1, $contact_button1, $contact_image1
      ){

        //Query to insert the users details into the database
        $query = $this->connect()->prepare("
        
        UPDATE content SET object = ? WHERE page = 'HOME' AND section = 'HERO' AND name = 'CAPTION1' AND `default` = 0;
        UPDATE content SET object = ? WHERE page = 'HOME' AND section = 'WFB' AND name = 'CAPTION1' AND `default` = 0;
        UPDATE content SET object = ? WHERE page = 'HOME' AND section = 'WFB' AND name = 'CAPTION2' AND `default` = 0;
        UPDATE content SET object = ? WHERE page = 'HOME' AND section = 'WFB' AND name = 'BUTTON' AND `default` = 0;
        UPDATE content SET object = ? WHERE page = 'HOME' AND section = 'WFB' AND name = 'IMAGE1' AND `default` = 0;
        UPDATE content SET object = ? WHERE page = 'HOME' AND section = 'PROJECTS' AND name = 'TITLE1' AND `default` = 0;
        UPDATE content SET object = ? WHERE page = 'HOME' AND section = 'PROJECTS' AND name = 'CAPTION1' AND `default` = 0;
        UPDATE content SET object = ? WHERE page = 'HOME' AND section = 'PROJECTS' AND name = 'CAPTION2' AND `default` = 0;
        UPDATE content SET object = ? WHERE page = 'HOME' AND section = 'PROJECTS' AND name = 'CAPTION3' AND `default` = 0;
        UPDATE content SET object = ? WHERE page = 'HOME' AND section = 'PROJECTS' AND name = 'CAPTION4' AND `default` = 0;
        UPDATE content SET object = ? WHERE page = 'HOME' AND section = 'PROJECTS' AND name = 'BUTTON1' AND `default` = 0;
        UPDATE content SET object = ? WHERE page = 'HOME' AND section = 'PROJECTS' AND name = 'BUTTON2' AND `default` = 0;
        UPDATE content SET object = ? WHERE page = 'HOME' AND section = 'PROJECTS' AND name = 'BUTTON3' AND `default` = 0;
        UPDATE content SET object = ? WHERE page = 'HOME' AND section = 'PROJECTS' AND name = 'BUTTON4' AND `default` = 0;
        UPDATE content SET object = ? WHERE page = 'HOME' AND section = 'PROJECTS' AND name = 'IMAGE1' AND `default` = 0;
        UPDATE content SET object = ? WHERE page = 'HOME' AND section = 'PROJECTS' AND name = 'IMAGE2' AND `default` = 0;
        UPDATE content SET object = ? WHERE page = 'HOME' AND section = 'PROJECTS' AND name = 'IMAGE3' AND `default` = 0;
        UPDATE content SET object = ? WHERE page = 'HOME' AND section = 'PROJECTS' AND name = 'IMAGE4' AND `default` = 0;
        UPDATE content SET object = ? WHERE page = 'HOME' AND section = 'CONTACT' AND name = 'CAPTION1' AND `default` = 0;
        UPDATE content SET object = ? WHERE page = 'HOME' AND section = 'CONTACT' AND name = 'BUTTON1' AND `default` = 0;
        UPDATE content SET object = ? WHERE page = 'HOME' AND section = 'CONTACT' AND name = 'IMAGE1' AND `default` = 0;
                                            
        ");

        //Checks if the query ran if not sends the user back into the sign up page
        if(!$query->execute(array(
            $hero_caption1,
            $wfb_caption1, $wfb_caption2, $wfb_button, $wfb_image1,
            $prj_title1, $prj_caption1, $prj_caption2, $prj_caption3, $prj_caption4,
            $prj_button1, $prj_button2, $prj_button3, $prj_button4,
            $prj_image1, $prj_image2, $prj_image3, $prj_image4,
            $contact_caption1, $contact_button1, $contact_image1
          ))){
            $query = null;
            header("location: ../has-precast/content-management-home.php?queryfailed");
            exit();
        }
        
        $query = null;
    }

    public function setContentsAbout($hero_title1, $hero_caption1, $hero_button, $abt_title1, $abt_par1, $abt_par2, $abt_par3, $abt_par4, $abt_par5, $abt_img1,
                                        $mv_title1, $mv_sbtitle1, $mv_par1, $mv_sbtitle2, $mv_par2, $mv_img1){

        //Query to insert the users details into the database
        $query = $this->connect()->prepare("
        
        UPDATE content SET object = ? WHERE PAGE = 'ABOUT' AND section = 'hero' AND name = 'TITLE1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'ABOUT' AND section = 'hero' AND name = 'CAPTION1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'ABOUT' AND section = 'hero' AND name = 'BUTTON' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'ABOUT' AND section = 'about' AND name = 'TITLE1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'ABOUT' AND section = 'about' AND name = 'PARAGRAPH1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'ABOUT' AND section = 'about' AND name = 'PARAGRAPH2' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'ABOUT' AND section = 'about' AND name = 'PARAGRAPH3' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'ABOUT' AND section = 'about' AND name = 'PARAGRAPH4' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'ABOUT' AND section = 'about' AND name = 'PARAGRAPH5' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'ABOUT' AND section = 'about' AND name = 'IMAGE1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'ABOUT' AND section = 'missionvision' AND name = 'TITLE1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'ABOUT' AND section = 'missionvision' AND name = 'SUBTITLE1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'ABOUT' AND section = 'missionvision' AND name = 'PARAGRAPH1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'ABOUT' AND section = 'missionvision' AND name = 'SUBTITLE2' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'ABOUT' AND section = 'missionvision' AND name = 'PARAGRAPH2' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'ABOUT' AND section = 'missionvision' AND name = 'IMAGE1' AND `default` = 0;
                                            
        ");

        //Checks if the query ran if not sends the user back into the sign up page
        if(!$query->execute(array($hero_title1, $hero_caption1, $hero_button, $abt_title1, 
        $abt_par1, $abt_par2, $abt_par3, $abt_par4, $abt_par5,
        $abt_img1,
        $mv_title1,
        $mv_sbtitle1,
        $mv_par1,
        $mv_sbtitle2,
        $mv_par2,
        $mv_img1))){
            $query = null;
            header("location: ../has-precast/content-management-about.php?queryfailed");
            exit();
        }
        
        $query = null;
    }

    public function setContentsWFB(
        $hero_TITLE1, $hero_CAPTION1, $hero_BUTTON,
        $table_TITLE1, $table_CONTENT1, $table_CONTENT2, 
        $table_CONTENT3, $table_CONTENT4, $table_CONTENT5, 
        $table_CONTENT6, $wfb_TITLE1, $wfb_PARAGRAPH1, 
        $wfb_PARAGRAPH2, $wfb_PARAGRAPH3, $wfb_PARAGRAPH4, 
        $wfb_PARAGRAPH5, $wfb_IMAGE1, $wfb_IMAGE2,
        $dsgn_TITLE1, $dmsn_TITLE1,
        $dmsn_DETAIL1, $dmsn_DETAIL2, $dmsn_DETAIL3, 
        $dmsn_IMAGE1, $str_TITLE1, $str_LABEL1, 
        $str_DETAIL1, $str_LABEL2, $str_DETAIL2, 
        $str_IMAGE1
        ){

        //Query to insert the users details into the database
        $query = $this->connect()->prepare("
        
        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'hero' AND name = 'TITLE1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'hero' AND name = 'CAPTION1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'hero' AND name = 'BUTTON' AND `default` = 0;

        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'TABLECONTENT' AND name = 'TITLE1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'TABLECONTENT' AND name = 'CONTENT1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'TABLECONTENT' AND name = 'CONTENT2' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'TABLECONTENT' AND name = 'CONTENT3' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'TABLECONTENT' AND name = 'CONTENT4' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'TABLECONTENT' AND name = 'CONTENT5' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'TABLECONTENT' AND name = 'CONTENT6' AND `default` = 0;

        
        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'WFB' AND name = 'TITLE1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'WFB' AND name = 'PARAGRAPH1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'WFB' AND name = 'PARAGRAPH2' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'WFB' AND name = 'PARAGRAPH3' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'WFB' AND name = 'PARAGRAPH4' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'WFB' AND name = 'PARAGRAPH5' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'WFB' AND name = 'IMAGE1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'WFB' AND name = 'IMAGE2' AND `default` = 0;

        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'DESIGNS' AND name = 'TITLE1' AND `default` = 0;
        
        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'DIMENSIONS' AND name = 'TITLE1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'DIMENSIONS' AND name = 'DETAIL1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'DIMENSIONS' AND name = 'DETAIL2' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'DIMENSIONS' AND name = 'DETAIL3' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'DIMENSIONS' AND name = 'IMAGE1' AND `default` = 0;

        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'STRENGTH' AND name = 'TITLE1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'STRENGTH' AND name = 'LABEL1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'STRENGTH' AND name = 'DETAIL1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'STRENGTH' AND name = 'LABEL2' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'STRENGTH' AND name = 'DETAIL2' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'WFB' AND section = 'STRENGTH' AND name = 'IMAGE1' AND `default` = 0;
                                            
        ");

        //Checks if the query ran if not sends the user back into the sign up page
        if(!$query->execute(array(
            $hero_TITLE1, $hero_CAPTION1, $hero_BUTTON,
            $table_TITLE1, $table_CONTENT1, $table_CONTENT2, 
            $table_CONTENT3, $table_CONTENT4, $table_CONTENT5, 
            $table_CONTENT6, $wfb_TITLE1, $wfb_PARAGRAPH1, 
            $wfb_PARAGRAPH2, $wfb_PARAGRAPH3, $wfb_PARAGRAPH4, 
            $wfb_PARAGRAPH5, $wfb_IMAGE1, $wfb_IMAGE2,
            $dsgn_TITLE1, $dmsn_TITLE1,
            $dmsn_DETAIL1, $dmsn_DETAIL2, $dmsn_DETAIL3, 
            $dmsn_IMAGE1, $str_TITLE1, $str_LABEL1, 
            $str_DETAIL1, $str_LABEL2, $str_DETAIL2, 
            $str_IMAGE1
        ))){
            $query = null;
            header("location: ../has-precast/content-management-wfb.php?queryfailed");
            exit();
        }
        
        $query = null;
    }

    public function setContentsUserGuide(
        $hero_title1, $hero_caption1, $hero_button,
        $pre_title1, $pre_paragraph1, $pre_paragraph2,
        $table_title1, $table_content1, $table_content2,
        $ct1_TITLE1, $ct1_STEP1, $ct1_PARAGRAPH1 ,$ct1_IMAGE1,
        $ct1_STEP2, $ct1_PARAGRAPH2 ,$ct1_IMAGE2,
        $ct1_STEP3, $ct1_PARAGRAPH3 ,$ct1_IMAGE3,
        $ct1_STEP4, $ct1_PARAGRAPH4 ,$ct1_IMAGE4,
        $ct1_STEP5, $ct1_PARAGRAPH5 ,$ct1_IMAGE5,
        $ct1_STEP6, $ct1_PARAGRAPH6 ,$ct1_IMAGE6,
        $ct2_TITLE1, $ct2_STEP1, $ct2_PARAGRAPH1,
        $ct2_STEP2, $ct2_PARAGRAPH2,
        $ct2_STEP3, $ct2_PARAGRAPH3,
        $ct2_STEP4, $ct2_PARAGRAPH4,
        $ct2_STEP5, $ct2_PARAGRAPH5,
        $ct2_STEP6, $ct2_PARAGRAPH6,
        $ct2_STEP7, $ct2_PARAGRAPH7,
        $ct2_NOTE, $ct2_VIDEO1
    ){

        //Query to insert the users details into the database
        $query = $this->connect()->prepare("
        
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'hero' AND name = 'TITLE1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'hero' AND name = 'CAPTION1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'hero' AND name = 'BUTTON' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'precontent' AND name = 'TITLE1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'precontent' AND name = 'PARAGRAPH1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'precontent' AND name = 'PARAGRAPH2' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'tablecontent' AND name = 'TITLE1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'tablecontent' AND name = 'CONTENT1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'tablecontent' AND name = 'CONTENT2' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content1' AND name = 'TITLE1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content1' AND name = 'STEP1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content1' AND name = 'PARAGRAPH1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content1' AND name = 'IMAGE1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content1' AND name = 'STEP2' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content1' AND name = 'PARAGRAPH2' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content1' AND name = 'IMAGE2' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content1' AND name = 'STEP3' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content1' AND name = 'PARAGRAPH3' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content1' AND name = 'IMAGE3' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content1' AND name = 'STEP4' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content1' AND name = 'PARAGRAPH4' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content1' AND name = 'IMAGE4' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content1' AND name = 'STEP5' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content1' AND name = 'PARAGRAPH5' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content1' AND name = 'IMAGE5' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content1' AND name = 'STEP6' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content1' AND name = 'PARAGRAPH6' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content1' AND name = 'IMAGE6' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content2' AND name = 'TITLE1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content2' AND name = 'STEP1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content2' AND name = 'PARAGRAPH1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content2' AND name = 'STEP2' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content2' AND name = 'PARAGRAPH2' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content2' AND name = 'STEP3' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content2' AND name = 'PARAGRAPH3' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content2' AND name = 'STEP4' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content2' AND name = 'PARAGRAPH4' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content2' AND name = 'STEP5' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content2' AND name = 'PARAGRAPH5' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content2' AND name = 'STEP6' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content2' AND name = 'PARAGRAPH6' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content2' AND name = 'STEP7' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content2' AND name = 'PARAGRAPH7' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content2' AND name = 'NOTE' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'USERGUIDE' AND section = 'content2' AND name = 'VIDEO' AND `default` = 0;
        
                                            
        ");

        //Checks if the query ran if not sends the user back into the sign up page
        if(!$query->execute(array(
            $hero_title1, $hero_caption1, $hero_button,
            $pre_title1, $pre_paragraph1, $pre_paragraph2,
            $table_title1, $table_content1, $table_content2,
            $ct1_TITLE1, $ct1_STEP1, $ct1_PARAGRAPH1 ,$ct1_IMAGE1,
            $ct1_STEP2, $ct1_PARAGRAPH2 ,$ct1_IMAGE2,
            $ct1_STEP3, $ct1_PARAGRAPH3 ,$ct1_IMAGE3,
            $ct1_STEP4, $ct1_PARAGRAPH4 ,$ct1_IMAGE4,
            $ct1_STEP5, $ct1_PARAGRAPH5 ,$ct1_IMAGE5,
            $ct1_STEP6, $ct1_PARAGRAPH6 ,$ct1_IMAGE6,
            $ct2_TITLE1, $ct2_STEP1, $ct2_PARAGRAPH1,
            $ct2_STEP2, $ct2_PARAGRAPH2,
            $ct2_STEP3, $ct2_PARAGRAPH3,
            $ct2_STEP4, $ct2_PARAGRAPH4,
            $ct2_STEP5, $ct2_PARAGRAPH5,
            $ct2_STEP6, $ct2_PARAGRAPH6,
            $ct2_STEP7, $ct2_PARAGRAPH7,
            $ct2_NOTE, $ct2_VIDEO1
        ))){
            $query = null;
            header("location: ../has-precast/content-management-user-guide.php?queryfailed");
            exit();
        }
        
        $query = null;
    }

    public function setContentsProjects($hero_title1, $hero_caption1, $hero_button, $prj_TITLE1){

        //Query to insert the users details into the database
        $query = $this->connect()->prepare("
        
        UPDATE content SET object = ? WHERE PAGE = 'PROJECTS' AND section = 'hero' AND name = 'TITLE1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'PROJECTS' AND section = 'hero' AND name = 'CAPTION1' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'PROJECTS' AND section = 'hero' AND name = 'BUTTON' AND `default` = 0;
        UPDATE content SET object = ? WHERE PAGE = 'PROJECTS' AND section = 'PROJECTS' AND name = 'TITLE1' AND `default` = 0;
                            
        ");

        //Checks if the query ran if not sends the user back into the sign up page
        if(!$query->execute(array($hero_title1, $hero_caption1, $hero_button, $prj_TITLE1))){
            $query = null;
            header("location: ../has-precast/content-management-projects.php?queryfailed");
            exit();
        }
        
        $query = null;
    }

    public function setContentsContact($hero_title1, $contact_gmaps, $contact_add, $contact_email, $contact_no1, $contact_no2){

        //Query to insert the users details into the database
        $query = $this->connect()->prepare("
        
        UPDATE content SET object = ? WHERE PAGE = 'CONTACT' AND section = 'HERO' AND name = 'TITLE1' AND `default` = 0;
        UPDATE content SET object = ? WHERE section = 'CONTACTS' AND name = 'GMAPSEMBED' AND `default` = 0;
        UPDATE content SET object = ? WHERE section = 'CONTACTS' AND name = 'ADDRESS' AND `default` = 0;
        UPDATE content SET object = ? WHERE section = 'CONTACTS' AND name = 'EMAIL' AND `default` = 0;
        UPDATE content SET object = ? WHERE section = 'CONTACTS' AND name = 'CONTACTNO1' AND `default` = 0;
        UPDATE content SET object = ? WHERE section = 'CONTACTS' AND name = 'CONTACTNO2' AND `default` = 0;
                                            
        ");

        //Checks if the query ran if not sends the user back into the sign up page
        if(!$query->execute(array($hero_title1, $contact_gmaps, $contact_add, $contact_email, $contact_no1, $contact_no2))){
            $query = null;
            header("location: ../has-precast/content-management-contact.php?queryfailed");
            exit();
        }
        
        $query = null;
    }

    public function addProduct($name, $design, $desc, $cart, $wfb){

        //Query to insert the users details into the database
        $query = $this->connect()->prepare("
        
        INSERT INTO wall_form_block (name, design_name, description, cart_image, wfb_image, `default`)
        VALUES (?, ?, ?, ?, ?, 0);
        ");

        //Checks if the query ran if not sends the user back into the sign up page
        if(!$query->execute(array($name, $design, $desc, $cart, $wfb))){
            
            $errorInfo = $query->errorInfo();
            $query = null;
            exit();
        }
        
        $query = null;
    }

    public function addProject($name, $desc, $type, $loc, $icon, $mainImage, $subImage1, $subImage2){

        //Query to insert the users details into the database
        $query = $this->connect()->prepare("
        
        INSERT INTO PROJECTS (name, description, type, location, icon, mainImage, subImage1, subImage2, `default`)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0);
        ");

        //Checks if the query ran if not sends the user back into the sign up page
        if(!$query->execute(array($name, $desc, $type, $loc, $icon, $mainImage, $subImage1, $subImage2))){
            
            $errorInfo = $query->errorInfo();
            $query = null;
            exit();
        }
        
        $query = null;
    }

    public function getProjectsPage($age){

        $query = $this->connect()->prepare("SELECT * FROM PROJECTS WHERE `default` = 0 AND description IS NOT NULL;");
        //Checks if the query ran if not sends the user back into the login page
        if(!$query->execute()){
            $query = null;
            header("location: ../../content-management-projects.php?error=queryfailed");
            exit();
        }
        
        if($query->rowCount() == 0){
            $query = null;
            header("location: ../../content-management-projects.php?error=contentsnotfound");
            exit();
        }

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getProjectUseID($cardID){

        $query = $this->connect()->prepare("SELECT * FROM PROJECTS WHERE cardID =:card_id AND Description IS NOT NULL;");
        $data = [":card_id" => $cardID];
        //Checks if the query ran if not sends the user back into the login page
        if(!$query->execute($data)){
            $query = null;
            header("location: ../../content-management-projects.php?error=queryfailed");
            exit();
        }
        
        if($query->rowCount() == 0){
            $query = null;
            header("location: ../../ccontent-management-projects.php?error=contentnotfound");
            exit();
        }

        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function setProjectUseID($desc, $type, $loc, $icon, $mainImageName, $subImage1NewName, $subImage2NewName, $cardID){

        $query = $this->connect()->prepare("
        
            UPDATE PROJECTS 
            SET description = ?,
            type = ?,
            location = ?,
            icon = ?,
            mainImage = ?,
            subImage1 = ?,
            subImage2 = ?
            WHERE cardID = ?;
        
        ");
        //Checks if the query ran if not sends the user back into the login page
        if(!$query->execute(array($desc, $type, $loc, $icon, $mainImageName, $subImage1NewName, $subImage2NewName, $cardID))){
            $query = null;
            header("location: ../../content-management-projects.php?error=queryfailed");
            exit();
        }

        $query = null;
    }

    public function deleteProjectUseID($cardID, $name){

        $query = $this->connect()->prepare("
        
            SELECT * FROM PROJECTS WHERE name = ?;
        
        ");
        //Checks if the query ran if not sends the user back into the login page
        
        if(!$query->execute([$name])){
            $query = null;
            header("location: ../../content-management-projects.php?error=queryfailed");
            exit();
        }
        
        if($query->rowCount() > 1){
            $query = $this->connect()->prepare("
        
            UPDATE PROJECTS SET description = NULL WHERE cardID = ? AND `default` = 0;
        
            ");

            if(!$query->execute([$cardID])){
                $query = null;
                header("location: ../../content-management-projects.php?error=queryfailed");
                exit();
            }

            $query = null;
            $message = urlencode('Project Card &#34;'. $name .'&#34; has been Deleted Successfully');
            header("location: ../../content-management-projects.php?message={$message}&top=10&type=success");
            exit();
        }
        elseif($query->rowCount() == 1){
            $query = $this->connect()->prepare("
        
            DELETE FROM PROJECTS WHERE cardID = ?;
        
            ");

            if(!$query->execute([$cardID])){
                $query = null;
                header("location: ../../content-management-projects.php?error=queryfailed");
                exit();
            }

            $query = null;
            $message = urlencode('Project Card &#34;'. $name .'&#34; has been Deleted Successfully');
            header("location: ../../content-management-projects.php?message={$message}&top=10&type=success");
            exit();
        }

        $query = null;
    }

    public function getSection($page, $section){

        $query = $this->connect()->prepare("SELECT * FROM content WHERE page =:page AND section =:section AND type = 'TEXT' AND `default` = 0;");
        $data = [":page" => $page, ":section" => $section];
        //Checks if the query ran if not sends the user back into the login page
        
        if(!$query->execute($data)){
            $query = null;
            if($page === "userGuide"){
                $page = "user-guide";
            }
            header("location: ../../content-management-{$page}.php?error=queryfailed");
            exit();
        }
        
        if($query->rowCount() == 0){
            $query = null;
            header("location: ../../content-management-{$page}.php?error=sectionnotfound");
            exit();
        }

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getImages($page){

        $query = $this->connect()->prepare("SELECT * FROM content WHERE page =:page AND type = 'IMAGE' AND `default` = 0;");
        $data = [":page" => $page];
        
        //Checks if the query ran if not sends the user back into the login page
        if(!$query->execute($data)){
            $query = null;
            if($page === "userGuide"){
                $page = "user-guide";
            }
            header("location: ../../content-management-{$page}.php?error=queryfailed");
            exit();
        }
        
        if($query->rowCount() == 0){
            $query = null;
            header("location: ../../content-management-{$page}.php?error=usernotfoundss");
            exit();
        }

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getVideos($page){

        $query = $this->connect()->prepare("SELECT * FROM content WHERE page =:page AND type = 'VIDEO' AND `default` = 0;");
        $data = [":page" => $page];
        //Checks if the query ran if not sends the user back into the login page
        if(!$query->execute($data)){
            $query = null;
            if($page === "userGuide"){
                $page = "user-guide";
            }
            header("location: ../../content-management-{$page}.php?error=queryfailed");
            exit();
        }
        
        if($query->rowCount() == 0){
            $query = null;
            header("location: ../../content-management-{$page}.php?error=usernotfoundss");
            exit();
        }

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function addHero($name, $page, $media){

        //Query to insert the users details into the database
        $query = $this->connect()->prepare("
        
        INSERT INTO CONTENT (page, section, name, type, object, `default`)
        VALUES (?, 'hero', ?, 'HERO', ?, 0);
        ");

        //Checks if the query ran if not sends the user back into the sign up page
        if(!$query->execute(array($page, $name, $media))){
            
            $errorInfo = $query->errorInfo();
            $query = null;
            exit();
        }
        
        $query = null;
    }

    public function setHeroUseID($page, $object, $id){

        $query = $this->connect()->prepare("
        
            UPDATE CONTENT 
            SET page = ?,
            object = ?
            WHERE id = ?;
        
        ");
        //Checks if the query ran if not sends the user back into the login page
        if(!$query->execute(array($page, $object, $id))){
            $query = null;
            header("location: ../../content-management-hero.php?error=queryfailed");
            exit();
        }

        $query = null;
    }
    
    public function setProductUseID($design_name, $desc, $cart, $wfb, $status, $id){

        $query = $this->connect()->prepare("
        
            UPDATE wall_form_block 
            SET design_name = ?,
            description = ?,
            cart_image = ?,
            wfb_image = ?,
            status = ?
            WHERE id = ?;
        
        ");
        //Checks if the query ran if not sends the user back into the login page
        if(!$query->execute(array($design_name, $desc, $cart, $wfb, $status, $id))){
            $query = null;
            header("location: ../../content-management-hero.php?error=queryfailed");
            exit();
        }

        $query = null;
    }

    public function deleteHeroUseID($id, $name){

        $query = $this->connect()->prepare("
        
            SELECT * FROM CONTENT WHERE name = ?;
        
        ");
        //Checks if the query ran if not sends the user back into the login page
        
        if(!$query->execute([$name])){
            $query = null;
            header("location: ../../content-management-hero.php?error=queryfailed");
            exit();
        }
        
        if($query->rowCount() > 1){
            $query = $this->connect()->prepare("
        
            UPDATE CONTENT SET object = NULL WHERE id = ? AND `default` = 0;
        
            ");

            if(!$query->execute([$id])){
                $query = null;
                header("location: ../../content-management-hero?error=queryfailed");
                exit();
            }

            $query = null;
            header("location: ../../content-management-hero.php?deletedSuccessfully");
            exit();
        }
        elseif($query->rowCount() == 1){
            $query = $this->connect()->prepare("
        
            DELETE FROM CONTENT WHERE id = ?;
        
            ");

            if(!$query->execute([$id])){
                $query = null;
                header("location: ../../content-management-hero.php?error=queryfailed");
                exit();
            }

            $query = null;
            $message = urlencode('Hero Image &#34;'. $name .'&#34; Deleted Successfully');
            header("location: ../../content-management-hero.php?message={$message}&top=10&type=success");
            exit();
        }

        $query = null;
    }

    public function deleteProductUseID($id, $name){

        $query = $this->connect()->prepare("
        
            SELECT * FROM wall_form_block WHERE name = ?;
        
        ");
        //Checks if the query ran if not sends the user back into the login page
        
        if(!$query->execute([$name])){
            $query = null;
            header("location: ../../content-management-product.php?error=queryfailed");
            exit();
        }
        
        if($query->rowCount() > 1){
            $query = $this->connect()->prepare("
        
            UPDATE wall_form_block SET design_name = NULL WHERE id = ? AND `default` = 0;
        
            ");

            if(!$query->execute([$id])){
                $query = null;
                header("location: ../../content-management-products?error=queryfailed");
                exit();
            }

            $query = null;
            $message = urlencode('Project Card &#34;'. $name .'&#34; has been Deleted Successfully');
            header("location: ../../content-management-products.php?message={$message}&top=10&type=success");
            exit();
        }
        elseif($query->rowCount() == 1){
            $query = $this->connect()->prepare("
        
            DELETE FROM wall_form_block WHERE id = ?;
        
            ");

            if(!$query->execute([$id])){
                $query = null;
                header("location: ../../content-management-hero.php?error=queryfailed");
                exit();
            }

            $query = null;
            $message = urlencode('Project Card &#34;'. $name .'&#34; has been Deleted Successfully');
            header("location: ../../content-management-products.php?message={$message}&top=10&type=success");
            exit();
        }

        $query = null;
    }

    public function getProductUseID($ID){

        $query = $this->connect()->prepare("SELECT * FROM wall_form_block WHERE ID =:id;");
        $data = [":id" => $ID];
        //Checks if the query ran if not sends the user back into the login page
        if(!$query->execute($data)){
            $query = null;
            header("location: ../../content-management-products.php?error=queryfailed");
            exit();
        }
        
        if($query->rowCount() == 0){
            $query = null;
            header("location: ../../ccontent-management-products.php?error=contentnotfound");
            exit();
        }

        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getHeroUseID($ID){

        $query = $this->connect()->prepare("SELECT * FROM content WHERE ID =:id AND OBJECT IS NOT NULL;");
        $data = [":id" => $ID];
        //Checks if the query ran if not sends the user back into the login page
        if(!$query->execute($data)){
            $query = null;
            header("location: ../../content-management-projects.php?error=queryfailed");
            exit();
        }
        
        if($query->rowCount() == 0){
            $query = null;
            header("location: ../../ccontent-management-projects.php?error=contentnotfound");
            exit();
        }

        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }


    public function checkHero($name){

        $query = $this->connect()->prepare("
        
        SELECT * FROM content WHERE name = ? AND type = 'hero' AND `default` = 0
        
        ");

  
    //Checks if the query ran if not sends the user back into the sign up page
    if(!$query->execute(array($name))){
        $query = null;
        $message = urlencode('An Error Occurred while Checking Hero Image!');
        header("location: content-management-hero.php?message={$message}&top=10&type=error");
        exit();
    }
    
    //Checks if the query returned a data/row
    
    if($query->rowCount() > 0){
        $message = urlencode('Hero Image Name Already Exists!');
        header("location: content-management-hero.php?message={$message}&top=10&type=error");
        exit();
    }

        $query = null;
    }

    public function checkProduct($name){

        $query = $this->connect()->prepare("
        
        SELECT * FROM wall_form_block WHERE name = ? OR design_name = ? AND `default` = 0
        
        ");

  
    //Checks if the query ran if not sends the user back into the sign up page
    if(!$query->execute(array($name, $name))){
        $query = null;
        $message = urlencode('An Error Occurred while Checking Products!');
        header("location: content-management-products.php?message={$message}&top=10&type=error");
        exit();
    }
    
    //Checks if the query returned a data/row
    
    if($query->rowCount() > 0){
        $message = urlencode('Product/Design Name Already Exists!');
        header("location: content-management-products.php?message={$message}&top=10&type=error");
        exit();
    }

        $query = null;
    }


    public function checkProjectCard($name){

        $query = $this->connect()->prepare("
        
        SELECT * FROM projects WHERE name = ? AND `default` = 0
        
        ");

  
    //Checks if the query ran if not sends the user back into the sign up page
    if(!$query->execute(array($name))){
        $query = null;
        $message = urlencode('An Error Occurred while Checking Project Card!');
        header("location: content-management-projects.php?message={$message}&top=10&type=error");
        exit();
    }
    
    //Checks if the query returned a data/row
    
    if($query->rowCount() > 0){
        $message = urlencode('Project Card Name Already Exists!');
        header("location: content-management-projects.php?message={$message}&top=10&type=error");
        exit();
    }

        $query = null;
    }
}