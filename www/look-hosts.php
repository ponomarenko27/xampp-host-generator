<?php
require_once( dirname( __FILE__ ) . '/config.php' );

echo "<pre><strong>The file content:</strong>
" . file_get_contents( $hosts_file_path ) . 
"</pre>";
