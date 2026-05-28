<?php
/**
 * Script to update 20 crypto/hashing tools from pro_calculator to interactive
 * Run: php scripts/update_crypto_tools_config.php
 */

$configPath = __DIR__ . '/../config/tools.php';
$content = file_get_contents($configPath);

$toolSlugs = [
    'argon2-hash-generator',
    'md5-hash-generator',
    'sha2-generator',
    'blake2b-hash-generator',
    'whirlpool-hash-generator',
    'ripemd160-hash-generator',
    'sha1-hash-generator',
    'fnv1a-hash-generator',
    'murmurhash3-generator',
    'rsa-encryption-simulator',
    'sha3-generator',
    'sha224-hash-generator',
    'sha256-hash-generator',
    'sha384-hash-generator',
    'sha512-hash-generator',
    'sha3-256-hash-generator',
    'sha3-384-hash-generator',
    'sha3-512-hash-generator',
    'rsa-encryption-step-by-step-simulator',
    'fnv-1a-hash-generator',
];

$updated = 0;

foreach ($toolSlugs as $slug) {
    // Find the tool entry and update type and processor
    $pattern = "/('$slug'\s*=>\s*\n\s*array\s*\(\n(?:.*?\n)*?\s*'type'\s*=>\s*)'[^']*'/s";
    if (preg_match($pattern, $content)) {
        $content = preg_replace($pattern, "\${1}'interactive'", $content, 1);
    }
    
    $pattern2 = "/('$slug'\s*=>\s*\n\s*array\s*\(\n(?:.*?\n)*?\s*'processor'\s*=>\s*)'[^']*'/s";
    if (preg_match($pattern2, $content)) {
        $content = preg_replace($pattern2, "\${1}'interactive'", $content, 1);
        $updated++;
    }
}

file_put_contents($configPath, $content);
echo "Updated $updated tools to interactive type.\n";
