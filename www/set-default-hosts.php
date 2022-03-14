<?php
require_once( dirname( __FILE__ ) . '/init.php' );

echo '<pre>';
if ( file_put_contents( $config[ 'hosts_file_path' ], $config[ 'default_hosts' ] ) ) {
	echo '<strong>Done. The file is set to its default value.</strong>

<strong>The file content after update:</strong>
' . file_get_contents( $config[ 'hosts_file_path' ] ) . "\n\n";
} else {
	echo '<strong>Something went wrong!</strong>';
}
echo '</pre>';
