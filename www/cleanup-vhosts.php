<?php
require_once( dirname( __FILE__ ) . '/config.php' );
$file_content = file_get_contents( $vhosts_file_path );
$generated_opening_pos = stripos( $file_content, $generated_opening );
$generated_closing_pos = strripos( $file_content, $generated_closing ) + ( strlen( $generated_closing ) );
echo "<pre>";
if ( 
	$generated_opening_pos !== false
	&& $generated_closing_pos !== false
) {
	$new_file_content = substr( $file_content, 0, $generated_opening_pos ) . substr( $file_content, $generated_closing_pos );
	$new_file_content = str_replace( "\n\n\n", "\n\n", $new_file_content );
	if ( file_put_contents( $vhosts_file_path, $new_file_content ) ) {
		echo "<strong>Done. The file is cleaned up from previously generated vhosts.</strong>\n";
	} else {
		echo "<strong>Something went wrong!</strong>\n";
	}

} else {
	echo "<strong>No previously generated vhosts has been found. The file has not been changed.</strong>\n";
}
echo "</pre>" . "\n";
