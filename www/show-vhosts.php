<?php
require_once( dirname( __FILE__ ) . '/config.php' );
$file_content = file_get_contents( $vhosts_file_path );
$generated_opening_pos = stripos( $file_content, $generated_opening );
$generated_closing_pos = strripos( $file_content, $generated_closing ) + ( strlen( $generated_closing ) );
$cleaned_up_file_content = substr( $file_content, 0, $generated_opening_pos ) . substr( $file_content, $generated_closing_pos );

$domains = array();
if ( $domains_dir = opendir( $domains_root ) ) {
	while( ( $single_domain = readdir( $domains_dir ) ) !== false ) {
		if ( 
			$single_domain != "." 
			&& $single_domain != ".." 
			&& ( $single_domain[ 0 ] != '.' )
			&& ( strpos( $single_domain, '.' ) !== false )
			&& ( strpos( $single_domain, ' ' ) === false )
			&& ( strpos( $single_domain, '_' ) === false )
		) { 
			// domain
			if ( file_exists( $domains_root . DIRECTORY_SEPARATOR . $single_domain . DIRECTORY_SEPARATOR . 'www' ) ) {
				$domains[] = array( 
					'name' => $single_domain,
					'path' => $domains_root . DIRECTORY_SEPARATOR . $single_domain . DIRECTORY_SEPARATOR . 'www',
				);
				// subdomains
				if ( $subdomains_dir = opendir( $domains_root . DIRECTORY_SEPARATOR . $single_domain ) ) {
					while( ( $single_subdomain = readdir( $subdomains_dir ) ) !== false ) {
						if ( 
							$single_subdomain != "." 
							&& $single_subdomain != ".." 
							&& $single_subdomain != "www" 
							&& ( $single_subdomain[ 0 ] != '.' )
							&& ( strpos( $single_subdomain, ' ' ) === false )
							&& ( strpos( $single_subdomain, '_' ) === false )
							&& is_dir( $domains_root . DIRECTORY_SEPARATOR . $single_domain . DIRECTORY_SEPARATOR . $single_subdomain )
						) { 
							$domains[] = array( 
								'name' => $single_subdomain . '.' . $single_domain,
								'path' => $domains_root . DIRECTORY_SEPARATOR . $single_domain . DIRECTORY_SEPARATOR . $single_subdomain,
							);
						} // if
					} // while
				} // if
			} // if
		} // if
	} // while
} // if
closedir( $domains_dir );

if ( count( $domains ) > 0 ) {
	$generated_content = '';
	$generated_content .= $generated_opening . "\n";
	foreach ( $domains as $domain_args ) {
		echo '<a href="https://' . $domain_args[ 'name' ] . '">https://' . $domain_args[ 'name' ] . '</a>' . "<br /><br />\n\n";
	}
}
