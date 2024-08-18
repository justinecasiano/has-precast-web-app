<?php

class DefaultRepository extends Dbh{

    public function setToDefault($result){

        foreach($result as $content){
            
            $query = $this->connect()->prepare("
            UPDATE content SET object = ? WHERE page = ? AND section = ? AND name = ? AND `default` = 0;
            ");
            
            if(!$query->execute(array($content['object'], $content['page'],  $content['section'], $content['name']))){
                $query = null;
                header("location: ../has-precast-edit-content.php?queryfailed");
                exit();
            }
            
            $query = null;
        }
    }

    public function getDefault($page){

        $query = $this->connect()->prepare("SELECT * FROM content WHERE page =:page AND TYPE != 'hero' AND `default` = 1;");
        $data = [":page" => $page];
        //Checks if the query ran if not sends the user back into the login page
        if(!$query->execute($data)){
            $query = null;
            header("location: ../../edit-content.php?error=queryfailed");
            exit();
        }
        
        if($query->rowCount() == 0){
            $query = null;
            header("location: ../../content-management.php?error=usernotfoundss");
            exit();
        }

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getDefaultObject($page, $section, $name){

        $query = $this->connect()->prepare("SELECT * FROM content WHERE page =:page AND section =:section AND name =:name AND TYPE != 'hero' AND `default` = 1;");
        $data = [":page" => $page, ":section" => $section, "name" => $name];
        //Checks if the query ran if not sends the user back into the login page
        if(!$query->execute($data)){
            $query = null;
            header("location: ../../edit-content.php?error=queryfailed");
            exit();
        }
        
        if($query->rowCount() == 0){
            $query = null;
            header("location: ../../content-management.php?error=usernotfoundss");
            exit();
        }

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    public function setToDefaultProjects($result){

        $query = $this->connect()->prepare("
            DELETE FROM PROJECTS WHERE name NOT IN('card1', 'card2', 'card3', 'card4', 'card5', 'card6', 'card7') AND `default` = 0;
            ");
            
            if(!$query->execute()){
                $query = null;
                header("location: ../has-precast-edit-content.php?queryfailed");
                exit();
            }
            
            $query = null;

        foreach($result as $project){
            
            $query = $this->connect()->prepare("
            UPDATE PROJECTS SET 
            description = ?, 
            type = ?, 
            location = ?, 
            icon = ?, 
            mainImage = ?, 
            subImage1 = ?, 
            subImage2 = ? 
            WHERE name = ? AND `default` = 0;
            ");
            
            if(!$query->execute(array(
                $project['description'], 
                $project['type'],
                $project['location'],
                $project['icon'],
                $project['mainImage'],
                $project['subImage1'],
                $project['subImage2'],
                $project['name'],
                ))){
                $query = null;
                header("location: ../has-precast-edit-content.php?queryfailed");
                exit();
            }
            
            $query = null;
        }

        
    }

    

    public function getDefaultProjects(){

        $query = $this->connect()->prepare("SELECT * FROM PROJECTS WHERE `default`=1;");
        //Checks if the query ran if not sends the user back into the login page
        if(!$query->execute()){
            $query = null;
            header("location: ../../edit-content.php?error=queryfailed");
            exit();
        }
        
        if($query->rowCount() == 0){
            $query = null;
            header("location: ../../content-management.php?error=usernotfoundsss");
            exit();
        }

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function setToDefaultHero($result){

        $query = $this->connect()->prepare("
            DELETE FROM CONTENT WHERE section = 'hero' AND type = 'hero' AND name NOT IN('homeHeroDefault', 'aboutHeroDefault', 'contactHeroDefault', 'projectsHeroDefault', 'userHeroDefault', 'wfbHeroDefault') AND `default` = 0;
            ");
            
            if(!$query->execute()){
                $query = null;
                $message = urlencode('An Error Occurred while Resetting the Hero Images to Default!');
                header("location: ../has-precast/content-management-hero.php?message={$message}&top=10&type=error");
                exit();
            }
            
            $query = null;

        foreach($result as $hero){
            
            $query = $this->connect()->prepare("
            UPDATE content SET 
            page = ?, 
            object = ? 
            WHERE name = ? AND `default` = 0;
            ");
            
            if(!$query->execute(array(
                $hero['page'], 
                $hero['object'],
                $hero['name'],
                ))){
                $query = null;
                $message = urlencode('An Error Occurred while Resetting the Hero Image '. $hero['name'].' to Default!');
                header("location: ../has-precast/content-management-hero.php?message={$message}&top=10&type=error");
                exit();
            }
            
            $query = null;
        }

        
    }

    public function getDefaultHero(){

        $query = $this->connect()->prepare("SELECT * FROM content WHERE `default`=1 AND type = 'hero';");
        //Checks if the query ran if not sends the user back into the login page
        if(!$query->execute()){
            $query = null;
            header("location: ../../content-management-hero.php?error=queryfailed");
            exit();
        }
        
        if($query->rowCount() == 0){
            $query = null;
            header("location: ../../content-management-hero.php?error=usernotfoundsss");
            exit();
        }

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    public function setToDefaultProducts($result){

        $query = $this->connect()->prepare("
            DELETE FROM wall_form_block WHERE name NOT IN('V-Cut', 'Shiplap', 'Conventional') AND `default` = 0;
            ");
            
            if(!$query->execute()){
                $query = null;
                $message = urlencode('An Error Occurred while Resetting the Products to Default!');
                header("location: ../has-precast/content-management-products.php?message={$message}&top=10&type=error");
                exit();
            }
            
            $query = null;

        foreach($result as $product){
            
            $query = $this->connect()->prepare("
            UPDATE wall_form_block SET 
            design_name = ?, 
            description = ?,
            cart_image = ?,
            wfb_image = ?,
            status = ?
            WHERE name = ? AND `default` = 0;
            ");
            
            if(!$query->execute(array(
                $product['design_name'], 
                $product['description'],
                $product['cart_image'],
                $product['wfb_image'],
                $product['status'],
                $product['name']
                ))){
                $query = null;
                $message = urlencode('An Error Occurred while Resetting the Product '. $product['name'].' to Default!');
                header("location: ../has-precast/content-management-hero.php?message={$message}&top=10&type=error");
                exit();
            }
            
            $query = null;
        }

        
    }

    public function getDefaultProducts(){

        $query = $this->connect()->prepare("SELECT * FROM wall_form_block WHERE `default`=1;");
        //Checks if the query ran if not sends the user back into the login page
        if(!$query->execute()){
            $query = null;
            header("location: ../../content-management-product.php?error=queryfailed");
            exit();
        }
        
        if($query->rowCount() == 0){
            $query = null;
            header("location: ../../content-management-product.php?error=usernotfoundsss");
            exit();
        }

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}