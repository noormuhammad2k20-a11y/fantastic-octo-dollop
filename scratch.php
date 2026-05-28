<?php
$file = 'resources/views/tools/interactive/files.txt';
$content = file_get_contents($file);
$slugs = ['pdf-to-image', 'pdf-to-xml', 'pdf-to-pub', 'pdf-to-heic', 'pdf-to-ofx', 'facebook-video-downloader', 'facebook-reels-downloader', 'hd-video-downloader', 'youtube-thumbnail-grabber', 'tiktok-video-downloader', 'instagram-video-downloader', 'regex-tester-pro', 'json-formatter-pro', 'creatine-dosage-pro', 'battery-runtime-pro', 'torque-calculator-pro', 'spring-constant-pro', 'antenna-length-pro', 'crypto-staking-pro'];
foreach ($slugs as $slug) {
    $content = str_replace($slug . '.blade.php' . "\r\n", '', $content);
    $content = str_replace($slug . '.blade.php' . "\n", '', $content);
}
file_put_contents($file, $content);
echo "Removed slugs from files.txt\n";
