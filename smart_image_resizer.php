<?php
  function smart_image_resizer($src_image, $dst_image, $size, $quality = 100){

  // Get image info
  if(!$imagesize = getimagesize($src_image)) return "Unsupported picture type!";

  // Get file type
  $type = $imagesize['mime'];

  // Keep real paths
  $src_path = $src_image;
  $dst_path = $dst_image;

  // Get file extensions
  $src_extension = pathinfo($src_image)['extension'] ?? false;
  $dst_extension = pathinfo($dst_image)['extension'] ?? false;
  $extension = mb_strtolower($src_extension, 'UTF-8');

  // Check file extensions
  if (!$src_extension || !$dst_extension || ($src_extension != $dst_extension)) {
  return "Source file extension and target file extension doesn't match or doesn't exist!";
  } elseif ($type === 'image/jpeg' && !($extension === 'jpg' || $extension === 'jpeg')) {
  return "Image MIME type '$type' and image extension '$extension' doesn't match!";
  } elseif ($type === 'image/png' && !($extension === 'png')) {
  return "Image MIME type '$type' and image extension '$extension' doesn't match!";
  } elseif ($type === 'image/bmp' && !($extension === 'bmp')) {
  return "Image MIME type '$type' and image extension '$extension' doesn't match!";
  } elseif ($type === 'image/gif' && !($extension === 'gif')) {
  return "Image MIME type '$type' and image extension '$extension' doesn't match!";
  }

  // Define imagecopyresampled variables
  $src_w = $imagesize[0];
  $src_h = $imagesize[1];
  $dst_w = null;
  $dst_h = null;
  $dst_x = 0;
  $dst_y = 0;
  $src_x = 0;
  $src_y = 0;

  // Create image
  switch($type){
  case 'image/jpeg': $src_image = imagecreatefromjpeg($src_image); break;
  case 'image/png': $src_image = imagecreatefrompng($src_image); break;
  case 'image/bmp': $src_image = imagecreatefrombmp($src_image); break;
  case 'image/gif': $src_image = imagecreatefromgif($src_image); break;
  default : return "Unsupported picture type!";
  }

  // Fix image rotation
  if ($type === 'image/jpeg') {
  $exif = exif_read_data($src_path);
  }
  $orientation = $exif["Orientation"] ?? false;
  if ($orientation) {
  switch ($orientation) {
  case 3:
  $src_image = imagerotate($src_image, 180, 0);
  break;
  case 6:
  $src_image = imagerotate($src_image, -90, 0);
  break;
  case 8:
  $src_image = imagerotate($src_image, 90, 0);
  break;
  default:
  // Don't rotate
  }

  // Adjust update new sizes
  $src_w  = imagesx($src_image);
  $src_h = imagesy($src_image);
  }

  // Calculate new dimensions and preserve aspect ratio
  if ($src_w > $src_h) {
  $dst_w = $size;
  $dst_h = $src_h * $size / $src_w;
  } else {
  $dst_w = $src_w * $size / $src_h;
  $dst_h = $size;
  }

  // Create canvas
  $dst_image = imagecreatetruecolor($dst_w, $dst_h);

  // Preserve transparent background
  if ($type === 'image/png') {
  imagealphablending($dst_image, false);
  imagesavealpha($dst_image, true);
  }

  // Resample image
  $resample = imagecopyresampled ($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y ,$dst_w, $dst_h, $src_w, $src_h);

  // Save image
  switch($type){
  case 'image/jpeg': $output = imagejpeg($dst_image, $dst_path, $quality); break;
  case 'image/png': $output = imagepng($dst_image, $dst_path, round($quality * 9 / 100)); break;
  case 'image/bmp': $output = imagebmp($dst_image, $dst_path); break;
  case 'image/gif': $output = imagegif($dst_image, $dst_path); break;
  default : return "Unsupported picture type!";
  }

  // Return true:string
  if ($resample && $output) { return true; } else { return "There is an error while converting image."; }
  }
?>
