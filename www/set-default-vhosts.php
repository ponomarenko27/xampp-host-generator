<?php
require_once( dirname( __FILE__ ) . '/init.php' );

echo '<pre>';
$default_vhosts = $config[ 'default_vhosts_http' ];
if ( $config[ 'generate_https_vhosts' ] !== false ) {
	$default_vhosts .= $config[ 'default_vhosts_https' ];
}
$default_vhosts = sprintf( $default_vhosts, $config[ 'x_host_generator_domain' ], $config[ 'x_host_generator_dir' ], $config[ 'server_admin_email' ] );
if ( file_put_contents( $config[ 'vhosts_file_path' ], $default_vhosts ) ) {
	echo '<strong>Done. The file is set to its default value.</strong>

<strong>The file content after update:</strong>
' . file_get_contents( $config[ 'vhosts_file_path' ] ) . "\n\n";
} else {
	echo '<strong>Something went wrong!</strong>';
}
echo '</pre>';
