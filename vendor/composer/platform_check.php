<?php

// platform_check.php @generated by Composer

$issues = array();

if (!(PHP_VERSION_ID >= 70300)) {
    $issues[] = 'Your Composer dependencies require a PHP version ">= 7.3.0". You are running ' . PHP_VERSION  .  '.';
}

$missingExtensions = array();
extension_loaded('ctype') || $missingExtensions[] = 'ctype';
extension_loaded('date') || $missingExtensions[] = 'date';
extension_loaded('dom') || $missingExtensions[] = 'dom';
extension_loaded('filter') || $missingExtensions[] = 'filter';
extension_loaded('gd') || $missingExtensions[] = 'gd';
extension_loaded('hash') || $missingExtensions[] = 'hash';
extension_loaded('json') || $missingExtensions[] = 'json';
extension_loaded('libxml') || $missingExtensions[] = 'libxml';
extension_loaded('mbstring') || $missingExtensions[] = 'mbstring';
extension_loaded('pcre') || $missingExtensions[] = 'pcre';
extension_loaded('pdo') || $missingExtensions[] = 'pdo';
extension_loaded('session') || $missingExtensions[] = 'session';
extension_loaded('simplexml') || $missingExtensions[] = 'simplexml';
extension_loaded('spl') || $missingExtensions[] = 'spl';
extension_loaded('tokenizer') || $missingExtensions[] = 'tokenizer';
extension_loaded('xml') || $missingExtensions[] = 'xml';
extension_loaded('zlib') || $missingExtensions[] = 'zlib';

if ($missingExtensions) {
    $issues[] = 'Your Composer dependencies require the following PHP extensions to be installed: ' . implode(', ', $missingExtensions);
}

if ($issues) {
    echo 'Composer detected issues in your platform:' . "\n\n" . implode("\n", $issues);
    exit(104);
}
