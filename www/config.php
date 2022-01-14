<?php
$domains_root = dirname( __FILE__, 3 );
$server_admin_email = 'ponomarenko27@gmail.com';

$hosts_file_path = 'C:\Windows\System32\drivers\etc\hosts';
$vhosts_file_path = 'F:\xampp\apache\conf\extra\httpd-vhosts.conf';

$generated_opening = "\n" . '### START x-host-generator ###';
$generated_closing = '### END x-host-generator ###' . "\n";

require_once( dirname( __FILE__ ) . '/templates.php' );
