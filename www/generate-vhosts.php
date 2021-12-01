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
		) { 
			// domain
			if ( file_exists( $domains_root . '\\' . $single_domain . '\\' . 'www' ) ) {
				$domains[] = array( 
					'name' => $single_domain,
					'path' => $domains_root . '\\' . $single_domain . '\\' . 'www',
				);
				// subdomains
				if ( $subdomains_dir = opendir( $domains_root . '\\' . $single_domain ) ) {
					while( ( $single_subdomain = readdir( $subdomains_dir ) ) !== false ) {
						if ( 
							$single_subdomain != "." 
							&& $single_subdomain != ".." 
							&& $single_subdomain != "www" 
							&& ( $single_subdomain[ 0 ] != '.' )
							&& is_dir( $domains_root . '\\' . $single_domain . '\\' . $single_subdomain )
						) { 
							$domains[] = array( 
								'name' => $single_subdomain . '.' . $single_domain,
								'path' => $domains_root . '\\' . $single_domain . '\\' . $single_subdomain,
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
		$generated_content .= sprintf( $vhosts_pattern, $domain_args[ 'name' ], $domain_args[ 'path' ] );
	}
	include( dirname( __FILE__ ) . '/cleanup-vhosts.php' );
	$generated_content .= $generated_closing . "\n";
	$file_content = file_get_contents( $vhosts_file_path );
	$new_file_content = $file_content . $generated_content;
	// write the content into the file.
	if ( file_put_contents( $vhosts_file_path, $new_file_content ) ) {
echo "<pre><strong>Done. The file is updated with generated vhosts.</strong>

<strong>Done. The file content after update:</strong>
" . file_get_contents( $vhosts_file_path ) . 
"</pre>" . "<br />\n";
	} else {
		echo "<strong>Something went wrong!</strong>" . "<br />\n";
	}
}