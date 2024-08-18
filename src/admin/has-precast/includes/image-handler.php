<?php

function imageHandler($image, $page){

    $imageName = $image['name'];
    $imageTmpName = $image['tmp_name'];
    $imageSize = $image['size'];
    $imageError = $image['error'];
    $imageType = $image['type'];

    $imageExt = explode('.', $imageName);
    $imageActualExt = strtolower(end($imageExt));

    $allowed = array('jpg', 'jpeg', 'png', 'webp', 'tmp');

    if(in_array($imageActualExt, $allowed)){
      if($imageError === 0){
        if($imageSize < 50000000){
          $imageNewName = uniqid('', true).".".$imageActualExt;

          $imageDestination = 'images/temp/'.$page.'/'.$imageNewName;

          move_uploaded_file($imageTmpName, $imageDestination);
        }
        else{
          echo "The file is too big";
        }
      }
      else{
      }
    }
    else{
      echo "You cannot upload {'$imageActualExt'} files";
    }

    return array("newName" => $imageNewName, "destination" => $imageDestination);
}

function designHandler($image, $name){

  $imageName = $image['name'];
  $imageTmpName = $image['tmp_name'];
  $imageSize = $image['size'];
  $imageError = $image['error'];
  $imageType = $image['type'];

  $imageExt = explode('.', $imageName);
  $imageActualExt = strtolower(end($imageExt));

  $allowed = array('jpg', 'jpeg', 'png', 'webp', 'tmp');

  if(in_array($imageActualExt, $allowed)){
    if($imageError === 0){
      if($imageSize < 50000000){
        $imageNewName = $name.".".$imageActualExt;

        $imageDestination = 'images/products/'.$imageNewName;

        move_uploaded_file($imageTmpName, $imageDestination);
      }
      else{
        echo "The file is too big";
      }
    }
    else{
    }
  }
  else{
    echo "You cannot upload {'$imageActualExt'} files";
  }

  return array("newName" => $imageNewName, "destination" => $imageDestination);
}

function designHandler1($image, $name){

  $imageName = $image['name'];
  $imageTmpName = $image['tmp_name'];
  $imageSize = $image['size'];
  $imageError = $image['error'];
  $imageType = $image['type'];

  $imageExt = explode('.', $imageName);
  $imageActualExt = strtolower(end($imageExt));

  $allowed = array('jpg', 'jpeg', 'png', 'webp', 'tmp');

  if(in_array($imageActualExt, $allowed)){
    if($imageError === 0){
      if($imageSize < 50000000){
        $imageNewName = $name."New.".$imageActualExt;

        $imageDestination = '../../../has-precast/images/products/'.$imageNewName;

        move_uploaded_file($imageTmpName, $imageDestination);
      }
      else{
        echo "The file is too big";
      }
    }
    else{
    }
  }
  else{
    echo "You cannot upload {'$imageActualExt'} files";
  }

  return $imageNewName;
}

function imageHandler2($image, $page){

    $imageName = $image['name'];
    $imageTmpName = $image['tmp_name'];
    $imageSize = $image['size'];
    $imageError = $image['error'];
    $imageType = $image['type'];

    $imageExt = explode('.', $imageName);
    $imageActualExt = strtolower(end($imageExt));

    $allowed = array('jpg', 'jpeg', 'png', 'webp', 'tmp');

    if(in_array($imageActualExt, $allowed)){
      if($imageError === 0){
        if($imageSize < 50000000){
          $imageNewName = uniqid('', true).".".$imageActualExt;

          $imageDestination = '../../images/temp/'.$page.'/'.$imageNewName;

          move_uploaded_file($imageTmpName, $imageDestination);
        }
        else{
          echo "The file is too big";
        }
      }
      else{
      }
    }
    else{
      echo "You cannot upload {'$imageActualExt'} files";
    }

    return array("newName" => $imageNewName, "destination" => $imageDestination);
}

function imageHandler3($image, $page, $name){

    $imageName = $image['name'];
    $imageTmpName = $image['tmp_name'];
    $imageSize = $image['size'];
    $imageError = $image['error'];
    $imageType = $image['type'];

    $imageExt = explode('.', $imageName);
    $imageActualExt = strtolower(end($imageExt));

    $allowed = array('jpg', 'jpeg', 'png', 'webp', 'tmp');

    if(in_array($imageActualExt, $allowed)){
      if($imageError === 0){
        if($imageSize < 50000000){
          $imageNewName = "{$name}.".$imageActualExt;

          $imageDestination = 'images/temp/'.$page.'/'.$imageNewName;

          move_uploaded_file($imageTmpName, $imageDestination);
        }
        else{
          echo "The file is too big";
        }
      }
      else{
      }
    }
    else{
      echo "You cannot upload {'$imageActualExt'} files";
    }

    return array("newName" => $imageNewName, "destination" => $imageDestination);
}

function imageHandler4($image, $page, $name){

  $imageName = $image['name'];
  $imageTmpName = $image['tmp_name'];
  $imageSize = $image['size'];
  $imageError = $image['error'];
  $imageType = $image['type'];

  $imageExt = explode('.', $imageName);
  $imageActualExt = strtolower(end($imageExt));

  $allowed = array('jpg', 'jpeg', 'png', 'webp', 'tmp');

  if(in_array($imageActualExt, $allowed)){
    if($imageError === 0){
      if($imageSize < 50000000){
        $imageNewName = "{$name}.".$imageActualExt;

        $imageDestination = 'images/'.$page.'/'.$imageNewName;

        move_uploaded_file($imageTmpName, $imageDestination);
      }
      else{
        echo "The file is too big";
      }
    }
    else{
    }
  }
  else{
    echo "You cannot upload {'$imageActualExt'} files";
  }

  return array("newName" => $imageNewName, "destination" => $imageDestination);
}


function heroImageHandler($image, $page){

  $imageName = $image['name'];
  $imageTmpName = $image['tmp_name'];
  $imageSize = $image['size'];
  $imageError = $image['error'];
  $imageType = $image['type'];

  $imageExt = explode('.', $imageName);
  $imageActualExt = strtolower(end($imageExt));

  $allowed = array('jpg', 'jpeg', 'png', 'webp', 'tmp');

  if(in_array($imageActualExt, $allowed)){
    if($imageError === 0){
      if($imageSize < 50000000){
        $imageNewName = uniqid('', true).".".$imageActualExt;

        $imageDestination = '../../images/hero/'.$page.'/'.$imageNewName;

        move_uploaded_file($imageTmpName, $imageDestination);
      }
      else{
        echo "The file is too big";
      }
    }
    else{
    }
  }
  else{
    echo "You cannot upload {'$imageActualExt'} files";
  }

  return array("newName" => $imageNewName, "destination" => $imageDestination);
}

function videoHandler1($image, $page, $name){

  $imageName = $image['name'];
  $imageTmpName = $image['tmp_name'];
  $imageSize = $image['size'];
  $imageError = $image['error'];
  $imageType = $image['type'];

  $imageExt = explode('.', $imageName);
  $imageActualExt = strtolower(end($imageExt));

  $allowed = array('mp4', 'webm', 'tmp');

  if(in_array($imageActualExt, $allowed)){
    if($imageError === 0){
      if($imageSize < 5000000000){
        $imageNewName = "{$name}.".$imageActualExt;

        $imageDestination = 'videos/'.$page.'/'.$imageNewName;

        move_uploaded_file($imageTmpName, $imageDestination);
      }
      else{
        echo "The file is too big";
      }
    }
    else{
    }
  }
  else{
    echo "You cannot upload {'$imageActualExt'} files";
  }

  return array("newName" => $imageNewName, "destination" => $imageDestination);
}

function imageCopy($source, $destination, $name){
  $imageExt = explode('.', $source);
  $imageActualExt = strtolower(end($imageExt));

  
  $imageNewName = "{$name}.".$imageActualExt;
  $imageDestination = "../../../has-precast/images/temp/$destination/".$imageNewName;

  copy($source, $imageDestination);

  return $imageNewName;
}

function imageCopy2($source, $destination, $name){
  $imageExt = explode('.', $source);
  $imageActualExt = strtolower(end($imageExt));

  
  $imageNewName = "{$name}.".$imageActualExt;
  $imageDestination = "../../../has-precast/images/$destination/".$imageNewName;

  copy($source, $imageDestination);

  return $imageNewName;
}

function videoCopy1($source, $destination, $name){
  $imageExt = explode('.', $source);
  $imageActualExt = strtolower(end($imageExt));

  
  $imageNewName = "{$name}.".$imageActualExt;
  $imageDestination = "../../../has-precast/videos/$destination/".$imageNewName;

  copy($source, $imageDestination);

  return $imageNewName;
}

function fileHandler($image, $page, $name){
  $imageName = $image['name'];
  $imageTmpName = $image['tmp_name'];
  $imageSize = $image['size'];
  $imageError = $image['error'];
  $imageType = $image['type'];

  $imageExt = explode('.', $imageName);
  $imageActualExt = strtolower(end($imageExt));

  $allowed = array('png', 'jpg', 'jpeg', 'tmp', 'webp');

  if(in_array($imageActualExt, $allowed)){
    if($imageError === 0){
      if($imageSize < 5000000000){
        $imageNewName = "{$name}.".$imageActualExt;

        $imageDestination = 'images/hero/'.$page.'/'.$imageNewName;

        move_uploaded_file($imageTmpName, $imageDestination);
      }
      else{
        echo "The file is too big";
      }
    }
    else{
    }
  }
  else{
    echo "You cannot upload {'$imageActualExt'} files";
  }

  return array("newName" => $imageNewName, "destination" => $imageDestination, "ext" => $imageActualExt);
}

function fileHandler2($image, $page, $name){
  $imageName = $image['name'];
  $imageTmpName = $image['tmp_name'];
  $imageSize = $image['size'];
  $imageError = $image['error'];
  $imageType = $image['type'];

  $imageExt = explode('.', $imageName);
  $imageActualExt = strtolower(end($imageExt));

  $allowed = array('png', 'jpg', 'jpeg', 'tmp', 'webp');

  if(in_array($imageActualExt, $allowed)){
    if($imageError === 0){
      if($imageSize < 5000000000){
        $imageNewName = "{$name}.".$imageActualExt;

        $imageDestination = '../../../has-precast/images/hero/'.$page.'/'.$imageNewName;

        move_uploaded_file($imageTmpName, $imageDestination);
      }
      else{
        echo "The file is too big";
      }
    }
    else{
    }
  }
  else{
    echo "You cannot upload {'$imageActualExt'} files";
  }

  return array("newName" => $imageNewName, "destination" => $imageDestination, "ext" => $imageActualExt);
}

function heroCopy1($source, $destination, $name){
  $imageExt = explode('.', $source);
  $imageActualExt = strtolower(end($imageExt));

  $source = "../../".$source;
  
  $imageNewName = "{$name}.".$imageActualExt;
  $imageDestination = "../../images/hero/{$destination}/".$imageNewName;

  if (!copy($source, $imageDestination)) {
    // Handle the error
    header("location: ../../../has-precast/content-management-hero.php?error");
    // You can also use error_log() to log the error or take other actions
  }
  return $imageNewName;
}


function productCopy($source, $name){
  $imageExt = explode('.', $source);
  $imageActualExt = strtolower(end($imageExt));

  $source = "../../".$source;
  
  $imageNewName = "{$name}New.".$imageActualExt;
  $imageDestination = "../../images/products/".$imageNewName;

  if (!copy($source, $imageDestination)) {
    // Handle the error
    header("location: ../../../has-precast/content-management-hero.php?error");
    // You can also use error_log() to log the error or take other actions
  }
  return $imageNewName;
}