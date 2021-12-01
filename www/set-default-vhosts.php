<?php
require_once( dirname( __FILE__ ) . '/config.php' );

if ( file_put_contents( $vhosts_file_path, $default_vhosts ) ) {
echo "<pre><strong>Done. The file is set to its default value.</strong>

<strong>The file content after update:</strong>
" . file_get_contents( $vhosts_file_path ) . 
"</pre>";
} else {
	echo "<strong>Something went wrong!</strong>";
}
