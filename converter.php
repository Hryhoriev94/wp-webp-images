<?php
// Hook into the attachment metadata generation process
add_filter('wp_generate_attachment_metadata', 'convert_to_webp_and_copy', 10, 2);

// Function to convert images to WebP format and copy them to the appropriate directory
function convert_to_webp_and_copy($metadata, $attachment_id) {
// Get the file path of the attached image
$file = get_attached_file($attachment_id);

// Get the upload directory paths
$upload_dir = wp_upload_dir();
$upload_base_dir = dirname($upload_dir['basedir']);
$upload_base_url = $upload_dir['baseurl'];

// Set the directory for WebP images
$webp_dir = $upload_base_dir . '/uploads-webp';

// Create the WebP directory if it doesn't exist
if(!file_exists($webp_dir)) {
wp_mkdir_p($webp_dir);
}

// Determine the MIME type of the image file
$file_type = mime_content_type($file);

// Convert PNG images to WebP
if ($file_type === 'image/png') {
png_to_webp($file, $webp_dir, $upload_base_url);
}
// Convert JPEG/JPG images to WebP
elseif (in_array($file_type, ['image/jpeg', 'image/jpg'])) {
jpg_to_webp($file, $webp_dir, $upload_base_url);
}

return $metadata;
}