<?php
include("classes/dbh.classes.php");
include("classes/content-repo.classes.php");


$getContent = new ContentRepository;

$products = $getContent->getProducts();

$hero = $getContent->getSection('wfb', "hero");
$table = $getContent->getSection('wfb', "tablecontent");
$wfb = $getContent->getSection('wfb', "wfb");
$designs = $getContent->getSection('wfb', "designs");
$dimensions = $getContent->getSection('wfb', "dimensions");
$strength = $getContent->getSection('wfb', "strength");
$img = $getContent->getImages('wfb');



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
  <link rel="stylesheet" href="/website/assets/styles/base/wall-form-blocks.css">
</head>

<body>
  <!-- includes HTML for navigation -->
  <?php require 'partials/navigation.php' ?>

  <!-- includes HTML for sidebar -->
  <?php require 'partials/sidebar.php' ?>

  <!-- main content starts here -->

  <section class="hero-section" style="background-image: url('admin/has-precast/images/hero/wfb/wfbHeroDefault.webp');">
    <div>
      <h1 class="hero-head"><?php echo $hero[0]['object']; ?></h1>
      <p><?php echo $hero[1]['object']; ?></p>
      <a href="#designs"><button><?php echo $hero[2]['object']; ?></button></a>
    </div>
  </section>

  <section class="table-of-contents">
    <h1><?php echo $table[0]['object']; ?></h1>
    <ul>
      <li>
        <div>1</div><a href="#about-the-product"><?php echo $table[1]['object']; ?></a>
      </li>
      <li>
        <div>2</div><a href="#designs"><?php echo $table[2]['object']; ?></a>
      </li>
      <li>
        <div>3</div><a href="#dimensions"><?php echo $table[3]['object']; ?></a>
      </li>
      <li>
        <div>4</div><a href="#strength"><?php echo $table[4]['object']; ?></a>
      </li>
      <li>
        <div>5</div><a href="#advantages"><?php echo $table[5]['object']; ?></a>
      </li>
      <li>
        <div>6</div><a href="#comparative"><?php echo $table[6]['object']; ?></a>
      </li>
    </ul>
  </section>
    
  <section class="wfb" id="about-the-product">
    <h1><?php echo $wfb[0]['object']; ?></h1>
    <div>
      <div class="wfb-content">
        <div class="wfb-paragraph"> 
          <p>
          <?php echo $wfb[1]['object']; ?>
          <br><br>
          <?php echo $wfb[2]['object']; ?>
          <br><br>
          <?php echo $wfb[3]['object']; ?>
          <br><br>
          <?php echo $wfb[4]['object']; ?>
          <br><br>
          <?php echo $wfb[5]['object']; ?>
        </p>
        </div>

        <div class="wfb-admin/has-precast/images">
          <img src="admin/has-precast/images/wall-form-blocks/<?php echo $img[0]['object']; ?>" alt="">
          <img src="admin/has-precast/images/wall-form-blocks/<?php echo $img[1]['object']; ?>" alt="">
        </div>
      </div>
    </div>
  </section>

  <section class="designs-wrapper" id="designs">
    <h1><?php echo $designs[0]['object']; ?></h1>

    <div class="designs">
    
      <?php 
        foreach($products as $content){
          echo "
          <div class='card-design'>
            <img src='admin/has-precast/images/products/$content[wfb_image]' alt=''>
            <div>
              <h1>$content[design_name]</h1>
              <p>$content[description]</p>
            </div>
          </div>
          ";}
      ?>

    </div>
    
 
  </section>

  <section class="dimension" id="dimensions">
    <h1><?php echo $dimensions[0]['object']; ?></h1>
    <div class="dimension-wrapper">
      <div class="dimension-content">
        <div class="light">
          <img src="admin/has-precast/images/wall-form-blocks/light-default.webp" alt="">
        </div>
        <p>
        <?php echo $dimensions[1]['object']; ?>
        <br><br>
        <?php echo $dimensions[2]['object']; ?>
        <br><br>
        <?php echo $dimensions[3]['object']; ?>
        </p>
      </div>
      <div class="img">
        <img class="main-img" src="admin/has-precast/images/wall-form-blocks/<?php echo $img[2]['object']; ?>" alt="">
      </div>
    </div>
  </section>

  <section class="dimension" id="strength">
    <h1><?php echo $strength[0]['object']; ?></h1>
    <div class="dimension-wrapper">
      <div class="dimension-content">
        <div class="light">
          <img src="admin/has-precast/images/wall-form-blocks/light-default.webp" alt="">
        </div>
        <p>
        <?php echo $strength[1]['object']; ?>
        <br><br>
        <?php echo $strength[2]['object']; ?>
        <br><br><br>
        <?php echo $strength[3]['object']; ?>
        <br><br>
        <?php echo $strength[4]['object']; ?>
        </p>
      </div>
      <div class="img">
        <img class="main-img" src="admin/has-precast/images/wall-form-blocks/<?php echo $img[3]['object']; ?>" alt="">
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
                <img src="admin/has-precast/images/wall-form-blocks/installation.webp" alt="Advantage 1">
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
                <img src="admin/has-precast/images/wall-form-blocks/sanding.webp" alt="Advantage 2">
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
                <img src="admin/has-precast/images/wall-form-blocks/smooth_surface.webp" alt="Advantage 3">
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
                <img src="admin/has-precast/images/wall-form-blocks/electrical.webp" alt="Advantage 4">
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
                <img src="admin/has-precast/images/wall-form-blocks/working_condition.webp" alt="Advantage 5">
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
                <img src="admin/has-precast/images/wall-form-blocks/less_debris.webp" alt="Advantage 5">
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
                <img src="admin/has-precast/images/wall-form-blocks/speed_up.webp" alt="Advantage 6">
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
                <img src="admin/has-precast/images/wall-form-blocks/cracks_eliminated.webp" alt="Advantage 7">
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
                <img src="admin/has-precast/images/wall-form-blocks/Ellipse 18.webp" alt="Advantage 8">
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
                <img src="admin/has-precast/images/wall-form-blocks/min_skilled_worker.webp" alt="Advantage 9">
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
                <img src="admin/has-precast/images/wall-form-blocks/sturdy_walls.webp" alt="Advantage 10">
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
                <img src="admin/has-precast/images/wall-form-blocks/high_quality.webp" alt="Advantage 11">
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
                <img src="admin/has-precast/images/wall-form-blocks/concrete_mix.webp" alt="Advantage 12">
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
                <img src="admin/has-precast/images/wall-form-blocks/aesthetic.webp" alt="Advantage 13">
              </div>
              <div class="details">
                <p class="desc_installation">Aesthetically-pleasing</p>
              </div>

            </div>
          </div>
          <div class="card">
            <div class="content">
              <div class="img">
                <img src="admin/has-precast/images/wall-form-blocks/Ellipse 17.webp" alt="Advantage 14">
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
                <img src="admin/has-precast/images/wall-form-blocks/cost.webp" alt="Advantage 15">
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
                <img src="admin/has-precast/images/wall-form-blocks/no_curing.webp" alt="Advantage 16">
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
                <img src="admin/has-precast/images/wall-form-blocks/fire_water.webp" alt="Advantage 16">
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

  <section id="comparative">
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

  </section>

  <!-- includes HTML for footer -->
  <?php require 'partials/footer.php' ?>
</body>

</html>