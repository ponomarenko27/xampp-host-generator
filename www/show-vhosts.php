<?php
require_once( dirname( __FILE__ ) . '/init.php' );
$domains = domains_from_root( $config );

if ( count( $domains ) > 0 ) {
	echo '<ol>';
	foreach ( $domains as $domain_args ) {
		echo '<li><a href="http://' . $domain_args[ 'name' ] . '">' . $domain_args[ 'name' ] . '</a>' . "<br /><br /></li>\n";
	}
	echo '</ol>';
}
