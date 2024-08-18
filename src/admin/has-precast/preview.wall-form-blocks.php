<?php
  session_start();

  if(!isset($_POST['submit'])){
    header("location: ../has-precast/content-management-wfb.php");
  }

  include("classes/dbh.classes.php");
  include("classes/content-repo.classes.php");


  $getContent = new ContentRepository;

  $products = $getContent->getProducts();

  require("includes/image-handler.php");

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

  if(!empty($_FILES['wfb-IMAGE1']['name'])){
    $wfb_image1 = $_FILES["wfb-IMAGE1"];

    $wfb1 = imageHandler4($wfb_image1, "wall-form-blocks", "wfb1-temp");
  }
  else{
    $wfb1['newName'] = $_POST["wfb-img1"];
    $wfb1['destination'] = "images/wall-form-blocks/".$wfb1['newName'];
  }



  if(!empty($_FILES['wfb-IMAGE2']['name'])){
    $wfb_image2 = $_FILES["wfb-IMAGE2"];

    $wfb2 = imageHandler4($wfb_image2, "wall-form-blocks", "wfb2-temp");
  }
  else{
    $wfb2['newName'] = $_POST["wfb-img2"];
    $wfb2['destination'] = "images/wall-form-blocks/".$wfb2['newName'];
  }


  $dsgn_TITLE1 = $_POST['dsgn-TITLE1'];
  
  
  

  $dmsn_TITLE1 = $_POST['dmsn-TITLE1'];
  $dmsn_DETAIL1 = $_POST['dmsn-DETAIL1'];
  $dmsn_DETAIL2 = $_POST['dmsn-DETAIL2'];
  $dmsn_DETAIL3 = $_POST['dmsn-DETAIL3'];

  if(!empty($_FILES['dmsn-IMAGE1']['name'])){
    $dmsn_image1 = $_FILES["dmsn-IMAGE1"];

    $dmsn1 = imageHandler4($dmsn_image1, "wall-form-blocks", "dmsn1-temp");
  }
  else{
    $dmsn1['newName'] = $_POST["dmsn-img1"];
    $dmsn1['destination'] = "images/wall-form-blocks/".$dmsn1['newName'];
  }



  $str_TITLE1 = $_POST['str-TITLE1'];
  $str_LABEL1 = $_POST['str-LABEL1'];
  $str_DETAIL1 = $_POST['str-DETAIL1'];
  $str_LABEL2 = $_POST['str-LABEL2'];
  $str_DETAIL2 = $_POST['str-DETAIL2'];

  if(!empty($_FILES['str-IMAGE1']['name'])){
    $str_image1 = $_FILES["str-IMAGE1"];

    $str1 = imageHandler4($str_image1, "wall-form-blocks", "str1-temp");
  }
  else{
    $str1['newName'] = $_POST["str-img1"];
    $str1['destination'] = "images/wall-form-blocks/".$str1['newName'];
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wall Form Blocks</title>

  <!-- includes fonts, stylesheets and site icon used -->
  <?php require 'partials/head.php' ?>

  <!-- link stylesheet for wall-form-blocks HTML -->
  <link rel="stylesheet" href="styles/base/wall-form-blocks2.css">
</head>

<body>
  <!-- includes HTML for navigation -->
  <?php require 'partials/navigation.php' ?>

  <!-- includes HTML for sidebar -->
  <?php require 'partials/sidebar.php' ?>

  <!-- main content starts here -->

  <section class="hero-section" style="background-image: url('images/hero/wfb/wfbHeroDefault.webp');">
    <div>
      <h1 class="hero-head"><?php echo $hero_TITLE1; ?></h1>
      <p><?php echo $hero_CAPTION1; ?></p>
      <a href="about-us#about-us-content-wrapper"><button><?php echo $hero_BUTTON; ?></button></a>
    </div>
  </section>

  <section class="table-of-contents">
    <h1><?php echo $table_TITLE1; ?></h1>
    <ul>
      <li>
        <div>1</div><a href="#about-the-product"><?php echo $table_CONTENT1; ?></a>
      </li>
      <li>
        <div>2</div><a href="#designs"><?php echo $table_CONTENT2; ?></a>
      </li>
      <li>
        <div>3</div><a href="#dimensions"><?php echo $table_CONTENT3; ?></a>
      </li>
      <li>
        <div>4</div><a href="#strength"><?php echo $table_CONTENT4; ?></a>
      </li>
      <li>
        <div>5</div><a href="#advantages"><?php echo $table_CONTENT5; ?></a>
      </li>
      <li>
        <div>6</div><a href="#comparative"><?php echo $table_CONTENT6; ?></a>
      </li>
    </ul>
  </section>
    
  <section class="wfb">
    <h1><?php echo $wfb_TITLE1; ?></h1>
    <div>
      <div class="wfb-content">
        <div class="wfb-paragraph"> 
          <p>
          <?php echo $wfb_PARAGRAPH1; ?>
          <br><br>
          <?php echo $wfb_PARAGRAPH2; ?>
          <br><br>
          <?php echo $wfb_PARAGRAPH3; ?>
          <br><br>
          <?php echo $wfb_PARAGRAPH4; ?>
          <br><br>
          <?php echo $wfb_PARAGRAPH5; ?>
        </p>
        </div>

        <div class="wfb-images">
          <img src="<?php echo $wfb1['destination']; ?>" alt="">
          <img src="<?php echo $wfb2['destination']; ?>" alt="">
        </div>
      </div>
    </div>
  </section>

  <section class="designs-wrapper">
    <h1>Wall Form Blocks Designs</h1>

    <div class="designs">
    
      <?php 
        foreach($products as $content){
          echo "
          <div class='card-design'>
            <img src='images/products/$content[wfb_image]' alt=''>
            <div>
              <h1>$content[design_name]</h1>
              <p>$content[description]</p>
            </div>
          </div>
          ";}
      ?>

    </div>
    
 
  </section>

  <section class="dimension">
    <h1><?php echo $dmsn_TITLE1; ?></h1>
    <div class="dimension-wrapper">
      <div class="dimension-content">
        <div class="light">
          <img src="images/wall-form-blocks/light-default.webp" alt="">
        </div>
        <p>
        <?php echo $dmsn_DETAIL1; ?>
        <br><br>
        <?php echo $dmsn_DETAIL2; ?>
        <br><br>
        <?php echo $dmsn_DETAIL3; ?>
        </p>
      </div>
      <div class="img">
        <img class="main-img" src="<?php echo $dmsn1['destination']; ?>" alt="">
      </div>
    </div>
  </section>

  <section class="dimension">
    <h1><?php echo $str_TITLE1; ?></h1>
    <div class="dimension-wrapper">
      <div class="dimension-content">
        <div class="light">
          <img src="images/wall-form-blocks/light-default.webp" alt="">
        </div>
        <p>
        <?php echo $str_LABEL1; ?>
        <br><br>
        <?php echo $str_DETAIL1; ?>
        <br><br><br>
        <?php echo $str_LABEL2; ?>
        <br><br>
        <?php echo $str_DETAIL2; ?>
        </p>
      </div>
      <div class="img">
        <img class="main-img" src="<?php echo $str1['destination']; ?>" alt="">
      </div>
    </div>
  </section>

  <section id="advantages">
    <h1 class="advantage_heading">Advantages</h1>
    <div class="container">
      <input type="radio" name="dot" id="one">
      <input type="radio" name="dot" id="two">
      <input type="radio" name="dot" id="three">
      <input type="radio" name="dot" id="four">
      <input type="radio" name="dot" id="five">
      <input type="radio" name="dot" id="six">

      <div class="main-card">
        <div class="cards">
          <div class="card">
            <div class="content">
              <div class="img">
                <img src="images/wall-form-blocks/installation.webp" alt="Advantage 1">
              </div>
              <div class="details">
                <p class="desc_installation">Easier and faster
                  installation – 3x faster
                  than CHB laying</p>
              </div>

            </div>
          </div>
          <div class="card">
            <div class="content">
              <div class="img">
                <img src="images/wall-form-blocks/sanding.webp" alt="Advantage 2">
              </div>
              <div class="details">
                <p class="desc_installation">Minimize sanding
                  works</p>
              </div>

            </div>
          </div>
          <div class="card">
            <div class="content">
              <div class="img">
                <img src="images/wall-form-blocks/smooth_surface.webp" alt="Advantage 3">
              </div>
              <div class="details">
                <p class="desc_installation">Smooth surface (no
                  plastering needed)</p>
              </div>

            </div>
          </div>
        </div>
        <div class="cards">
          <div class="card">
            <div class="content">
              <div class="img">
                <img src="images/wall-form-blocks/electrical.webp" alt="Advantage 4">
              </div>
              <div class="details">
                <p class="desc_installation">Electrical, plumbing
                  pipes and cable wires
                  can be embedded</p>
              </div>

            </div>
          </div>
          <div class="card">
            <div class="content">
              <div class="img">
                <img src="images/wall-form-blocks/working_condition.webp" alt="Advantage 5">
              </div>
              <div class="details">
                <p class="desc_installation">Better working condition
                  on site - less scaffoldings
                  and flatforms</p>
              </div>

            </div>
          </div>
          <div class="card">
            <div class="content">
              <div class="img">
                <img src="images/wall-form-blocks/less_debris.webp" alt="Advantage 5">
              </div>
              <div class="details">
                <p class="desc_installation">Less debris and wastage</p>
              </div>

            </div>
          </div>
        </div>
        <div class="cards">
          <div class="card">
            <div class="content">
              <div class="img">
                <img src="images/wall-form-blocks/speed_up.webp" alt="Advantage 6">
              </div>
              <div class="details">
                <p class="desc_installation">Speed up construction
                  and saves time</p>
              </div>

            </div>
          </div>
          <div class="card">
            <div class="content">
              <div class="img">
                <img src="images/wall-form-blocks/cracks_eliminated.webp" alt="Advantage 7">
              </div>
              <div class="details">
                <p class="desc_installation">Cracks are eliminated
                  compared to plastering</p>
              </div>

            </div>
          </div>
          <div class="card">
            <div class="content">
              <div class="img">
                <img src="images/wall-form-blocks/Ellipse 18.webp" alt="Advantage 8">
              </div>
              <div class="details">
                <p class="desc_installation">Has variety of sizes and design</p>
              </div>

            </div>
          </div>
        </div>
        <div class="cards">
          <div class="card">
            <div class="content">
              <div class="img">
                <img src="images/wall-form-blocks/min_skilled_worker.webp" alt="Advantage 9">
              </div>
              <div class="details">
                <p class="desc_installation">Minimal skilled worker
                  needed</p>
              </div>

            </div>
          </div>
          <div class="card">
            <div class="content">
              <div class="img">
                <img src="images/wall-form-blocks/sturdy_walls.webp" alt="Advantage 10">
              </div>
              <div class="details">
                <p class="desc_installation">Sturdy wall system
                  (strong and solid)</p>
              </div>

            </div>
          </div>
          <div class="card">
            <div class="content">
              <div class="img">
                <img src="images/wall-form-blocks/high_quality.webp" alt="Advantage 11">
              </div>
              <div class="details">
                <p class="desc_installation">High quality alternative
                  for CHB (Concrete Hollow Blocks)</p>
              </div>

            </div>
          </div>
        </div>
        <div class="cards">
          <div class="card">
            <div class="content">
              <div class="img">
                <img src="images/wall-form-blocks/concrete_mix.webp" alt="Advantage 12">
              </div>
              <div class="details">
                <p class="desc_installation">Concrete mix infilled
                  instead of mortar mix
                </p>
              </div>

            </div>
          </div>
          <div class="card">
            <div class="content">
              <div class="img">
                <img src="images/wall-form-blocks/aesthetic.webp" alt="Advantage 13">
              </div>
              <div class="details">
                <p class="desc_installation">Aesthetically-pleasing</p>
              </div>

            </div>
          </div>
          <div class="card">
            <div class="content">
              <div class="img">
                <img src="images/wall-form-blocks/Ellipse 17.webp" alt="Advantage 14">
              </div>
              <div class="details">
                <p class="desc_installation">5 times stronger than chb (2500 to 3500 psi)</p>
              </div>

            </div>
          </div>
        </div>
        <div class="cards">
          <div class="card">
            <div class="content">
              <div class="img">
                <img src="images/wall-form-blocks/cost.webp" alt="Advantage 15">
              </div>
              <div class="details">
                <p class="desc_installation">Cost-effective (bigger
                  savings)</p>
              </div>

            </div>
          </div>
          <div class="card">
            <div class="content">
              <div class="img">
                <img src="images/wall-form-blocks/no_curing.webp" alt="Advantage 16">
              </div>
              <div class="details">
                <p class="desc_installation">No curing, ready to
                  skincoat and paint
                </p>
              </div>

            </div>
          </div>
          <div class="card">
            <div class="content">
              <div class="img">
                <img src="images/wall-form-blocks/fire_water.webp" alt="Advantage 16">
              </div>
              <div class="details">
                <p class="desc_installation">Fire and water resistant</p>
              </div>

            </div>
          </div>
        </div>
      </div>

      <div class="carousel-button">
        <label for="one" class="active one"></label>
        <label for="two" class="two"></label>
        <label for="three" class="three"></label>
        <label for="four" class="four"></label>
        <label for="five" class="five"></label>
        <label for="six" class="six"></label>
      </div>
    </div>

  </section>

  <section id="comparative-cost-analysis">
    <h1 class="headofthis1">Cost Comparative Analysis</h1>
    <table>
      <tr>
        <th colspan="2">Using CHB 6" Load Bearing-700 PSI</th>
        <th colspan="2">Using Concrete Wall Form Block (CWFB)</th>
      </tr>

      <tr class="slim">
        <td>MATERIALS</td>
        <td>COST</td>
        <td>MATERIALS</td>
        <td>COST</td>
      </tr>

      <tr class="noborder">
        <td>CHB - 12.5 PCS @ PHP 21.00<br>
          Mortar
          (0.104m3)<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(0.15m3)<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp0.119m3
        </td>
        <td>PHP 262.50</td>
        <td>0.125 x 0.250 x 1.00m<br>&nbsp 4 set per sq.m.</td>
        <td>PHP 550.00</td>
      </tr>

      <tr class="noborder">
        <td>CEMENT (1:3): 1.25 @ PHP 182.00
          SAND<br><br><br><br>PLASTERING (0.05m3)</td>
        <td>PHP 227.50<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp55.00</td>
        <td>INFILL MATERIALS<br>
          CEMENT<br>
          SAND<br>
          G-3/8<br>
          GROUT<br></td>
        <td>PHP 109.20<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp35.00<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp68.00<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp10.00<br>
        </td>
      </tr>

      <tr class="noborder">
        <td>CEMENT : 0.50 @ PHP 182.00
          SAND</td>
        <td>PHP 91.00<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp15.00<br>
        </td>
        <td> </td>
        <td>PHP 91.00<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp15.00<br>
        </td>

      </tr>

      <tr class="noborder">
        <td>STEEL BAR<br>
          &nbsp&nbsp&nbspVERTICAL BAR 12mmo<br>
          &nbsp&nbsp&nbspHORIZONTAL BAR 12mmo</td>
        <td>PHP 87.00<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp54.00
        </td>
        <td>STEEL BAR<br>
          &nbsp&nbsp&nbspVERTICAL BAR 12mmo<br>
          &nbsp&nbsp&nbspHORIZONTAL BAR 12mmo</td>
        <td>PHP 87.00<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp54.00
        </td>
      </tr>

      <tr class="noborder">
        <td>MATERIALS</td>
        <td>PHP 792.00</td>
        <td>MATERIALS</td>
        <td>PHP 913.20</td>
      </tr>

      <tr class="noborder">
        <td>LABOR<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp1. CHB - LAYING<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp2. SAND SCREENING<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp3. HAULING<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp4. STEEL BAR INSTALLATION<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp5. PLASTERING</td>
        <td>PHP 120.00<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp25.00<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp15.00<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp30.00<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp160.00<br>

        </td>
        <td>LABOR<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp1. CHB - LAYING<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp2. SAND SCREENING<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp3. HAULING<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp4. STEEL BAR INSTALLATION<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp5. PLASTERING</td>
        <td>PHP 120.00<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp10.00<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp30.00<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp55.00<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp5.00<br>

        </td>

      </tr>
      <tr class="noborder">
        <td>LABOR</td>
        <td>PHP 350.00</td>
        <td>LABOR</td>
        <td>PHP 220.00</td>
      </tr>

      <tr class="slim">
        <td>TOTAL LABOR - MATERIALS</td>
        <td>PHP 1,142.00</td>
        <td>TOTAL LABOR - MATERIALS</td>
        <td>PHP 1,133.00</td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td colspan="2">NOTE:<br>
          &nbsp&nbsp&nbsp&nbspPRICES ARE VARIABLE ON CASE TO BASIS
        </td>
        <td colspan="2">ADVANTAGES<br>
          FOR PAINTING<br>
          MINIMIZE SANDING WORKS<br>
          SMOOTH SURFACE<br>
          3x FASTER THAN CHB LAYING<br>
          ELECTRICAL, PLUMBING APES, COMMUNICATION <br>
          FEE<br>
          CABLES, etc. CAN BE EMBEDDED<br>
          BETTER CONDITION WORKING ONSITE<br>
          FASTER CONSTRUCTION<br>
          LESS DEBRIS AND WASTAGE<br>
          CRACKS ARE ELIMINATED COMPARED TO<br>
          PLASTERING</td>

      </tr>


    </table>

    <form action="includes/content/edit-content.inc.php?page=wfb" method="post">
      <input type="hidden" name="hero-TITLE1" value="<?php echo $hero_TITLE1; ?>">
      <input type="hidden" name="hero-CAPTION1" value="<?php echo $hero_CAPTION1; ?>">
      <input type="hidden" name="hero-BUTTON" value="<?php echo $hero_BUTTON; ?>">

      <input type="hidden" name="table-TITLE1" value="<?php echo $table_TITLE1; ?>">
      <input type="hidden" name="table-CONTENT1" value="<?php echo $table_CONTENT1; ?>">
      <input type="hidden" name="table-CONTENT2" value="<?php echo $table_CONTENT2; ?>">
      <input type="hidden" name="table-CONTENT3" value="<?php echo $table_CONTENT3; ?>">
      <input type="hidden" name="table-CONTENT4" value="<?php echo $table_CONTENT4; ?>">
      <input type="hidden" name="table-CONTENT5" value="<?php echo $table_CONTENT5; ?>">
      <input type="hidden" name="table-CONTENT6" value="<?php echo $table_CONTENT6; ?>">

      <input type="hidden" name="wfb-TITLE1" value="<?php echo $wfb_TITLE1; ?>">
      <input type="hidden" name="wfb-PARAGRAPH1" value="<?php echo $wfb_PARAGRAPH1; ?>">
      <input type="hidden" name="wfb-PARAGRAPH2" value="<?php echo $wfb_PARAGRAPH2; ?>">
      <input type="hidden" name="wfb-PARAGRAPH3" value="<?php echo $wfb_PARAGRAPH3; ?>">
      <input type="hidden" name="wfb-PARAGRAPH4" value="<?php echo $wfb_PARAGRAPH4; ?>">
      <input type="hidden" name="wfb-PARAGRAPH5" value="<?php echo $wfb_PARAGRAPH5; ?>">
      <input type="hidden" name="wfb-IMAGE1" value="<?php echo $wfb1['destination']; ?>">
      <input type="hidden" name="wfb-IMAGE2" value="<?php echo $wfb2['destination']; ?>">

      <input type="hidden" name="dsgn-TITLE1" value="<?php echo $dsgn_TITLE1; ?>">
      <input type="hidden" name="dsgn-DESIGN1" value="<?php echo $dsgn_DESIGN1; ?>">
      <input type="hidden" name="dsgn-DESCRIPTION1" value="<?php echo $dsgn_DESCRIPTION1; ?>">
      <input type="hidden" name="dsgn-IMAGE1" value="<?php echo $dsgn1['destination']; ?>">
      <input type="hidden" name="dsgn-DESIGN2" value="<?php echo $dsgn_DESIGN2; ?>">
      <input type="hidden" name="dsgn-DESCRIPTION2" value="<?php echo $dsgn_DESCRIPTION2; ?>">
      <input type="hidden" name="dsgn-IMAGE2" value="<?php echo $dsgn2['destination']; ?>">
      <input type="hidden" name="dsgn-DESIGN3" value="<?php echo $dsgn_DESIGN3; ?>">
      <input type="hidden" name="dsgn-DESCRIPTION3" value="<?php echo $dsgn_DESCRIPTION3; ?>">
      <input type="hidden" name="dsgn-IMAGE3" value="<?php echo $dsgn3['destination']; ?>">

      <input type="hidden" name="dmsn-TITLE1" value="<?php echo $dmsn_TITLE1; ?>">
      <input type="hidden" name="dmsn-DETAIL1" value="<?php echo $dmsn_DETAIL1; ?>">
      <input type="hidden" name="dmsn-DETAIL2" value="<?php echo $dmsn_DETAIL2; ?>">
      <input type="hidden" name="dmsn-DETAIL3" value="<?php echo $dmsn_DETAIL3; ?>">
      <input type="hidden" name="dmsn-IMAGE1" value="<?php echo $dmsn1['destination']; ?>">
      
      <input type="hidden" name="str-TITLE1" value="<?php echo $str_TITLE1; ?>">
      <input type="hidden" name="str-LABEL1" value="<?php echo $str_LABEL1 ?>">
      <input type="hidden" name="str-DETAIL1" value="<?php echo $str_DETAIL1; ?>">
      <input type="hidden" name="str-LABEL2" value="<?php echo $str_LABEL2 ?>">
      <input type="hidden" name="str-DETAIL2" value="<?php echo $str_DETAIL2; ?>">
      <input type="hidden" name="str-IMAGE1" value="<?php echo $str1['destination']; ?>">

      
      
      <div class="button">
        <button type="submit" name="submit" class="submit">SAVE</button>
      </div>
    </form>
    <div class="button-cancel">
      <a href="content-management-wfb.php"><button class="cancel" name="cancel" type="submit">CANCEL</button></a>
    </div>
  </section>

  <!-- includes HTML for footer -->
  <?php require 'partials/footer.php' ?>
</body>

</html>