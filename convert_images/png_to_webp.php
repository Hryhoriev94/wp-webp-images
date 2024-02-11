<?php

function png_to_webp($source, $path, $upload_base_url) {
// Create an image resource from the PNG file
$img = imagecreatefrompng($source);
// Convert the image to true color
imagepalettetotruecolor($img);
// Enable alpha blending
imagealphablending($img, true);
// Save alpha channel
imagesavealpha($img, true);

// Get the relative path to the file from the uploads directory
$relative_path = str_replace(wp_normalize_path(wp_upload_dir()['basedir']) . '/', '', $source);
// Get the corresponding uploads-webp directory
$webp_path = wp_normalize_path($path . '/' . $relative_path);
$webp_dir = dirname($webp_path);

// Create the WebP directory if it doesn't exist
if(!file_exists($webp_dir)) {
wp_mkdir_p($webp_dir);
}

// Convert the image to WebP format and save it
imagewebp($img, $webp_path . '.webp', 100);
// Destroy the image resource to free memory
imagedestroy($img);
}