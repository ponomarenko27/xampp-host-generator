<?php
require_once( dirname( __FILE__ ) . '/init.php' );

echo '<pre><strong>The file content:</strong>
' . file_get_contents( $config[ 'hosts_file_path' ] ) . "\n\n";
echo '</pre>';
