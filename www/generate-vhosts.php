<?php
require_once( dirname( __FILE__ ) . '/init.php' );
$file_content = file_get_contents( $config[ 'vhosts_file_path' ] );
$generated_opening_pos = stripos( $file_content, $config[ 'generated_opening' ] );
$generated_closing_pos = strripos( $file_content, $config[ 'generated_closing' ] ) + ( strlen( $config[ 'generated_closing' ] ) );
$cleaned_up_file_content = substr( $file_content, 0, $generated_opening_pos ) . substr( $file_content, $generated_opening_pos, $generated_closing_pos );

$domains = domains_from_root( $config );
$vhosts_pattern = $config[ 'vhosts_pattern_http' ];
if ( $config[ 'generate_https_vhosts' ] !== false ) {
	$vhosts_pattern .= $config[ 'vhosts_pattern_https' ];
}

if ( count( $domains ) > 0 ) {
	$generated_content = '';
	$generated_content .= $config[ 'generated_opening' ] . "\n";
	foreach ( $domains as $domain_args ) {
		$generated_content .= sprintf( $vhosts_pattern, $domain_args[ 'name' ], $domain_args[ 'path' ], $config[ 'server_admin_email' ] );
	}
	remove_generated_content( $config, 'vhosts_file_path' );
//	include( dirname( __FILE__ ) . '/cleanup-hosts.php' );
	$generated_content .= $config[ 'generated_closing' ] . "\n";
	$file_content = file_get_contents( $config[ 'vhosts_file_path' ] );
	$new_file_content = $file_content . $generated_content;
	// write the content into the file.
	echo '<pre>';
	if ( file_put_contents( $config[ 'vhosts_file_path' ], $new_file_content ) ) {
		echo '<strong>Done. The file is updated with generated hosts.</strong>

<strong>Done. The file content after update:</strong><br />' . "\n\n\n"
 . file_get_contents( $config[ 'vhosts_file_path' ] ) . "\n\n\n";
	} else {
		echo '<strong>Something went wrong!</strong><br />' . "\n";
	}
	echo '</pre>' . "\n";
}
