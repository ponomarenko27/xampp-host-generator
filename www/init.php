<?php
require_once( dirname( __FILE__ ) . '/config.php' );

$default_config = array(
	'domains_root' => dirname( __FILE__, 3 ),
	'x_host_generator_dir' => dirname( __FILE__ ),
	'x_host_generator_domain' => 'x-host-generator.com',
	'generated_opening' => "\n" . '### START x-host-generator ###',
	'generated_closing' => '### END x-host-generator ###' . "\n",
	'server_admin_email' => 'ponomarenko27@gmail.com',
	'hosts_file_path' => 'C:\Windows\System32\drivers\etc\hosts',
	'vhosts_file_path' => 'C:\xampp\apache\conf\extra\httpd-vhosts.conf',
	'operating_system' => 'windows',
	'generate_https_vhosts' => true, // true or false.
);

// set variables before config merge.
$default_config[ 'operating_system' ] = 'windows';

$sys_dir_sep = DIRECTORY_SEPARATOR;
if ( $sys_dir_sep == '/' ) {
	$default_config[ 'operating_system' ] = 'macintosh';
	$default_config[ 'hosts_file_path' ] = '/etc/hosts';
	$default_config[ 'vhosts_file_path' ] = '/Applications/XAMPP/xamppfiles/etc/extra/httpd-vhosts.conf';
}

// config merge.
foreach ( $config as $key => $value ) {
	if ( $value === '' ) {
		unset( $config[ $key ] );
	}
}
$config = array_merge( $default_config, $config );

// set variables after config merge.
if ( !strpos( $config[ 'generated_opening' ], "\n" ) !== false ) {
	$config[ 'generated_opening' ] = "\n" . $config[ 'generated_opening' ];
}
if ( !strpos( $config[ 'generated_closing' ], "\n" ) !== false ) {
	$config[ 'generated_closing' ] = $config[ 'generated_closing' ] . "\n";
}

// add templates to the config.
require_once( dirname( __FILE__ ) . '/templates.php' );

$config[ 'hosts_pattern' ] = $hosts_pattern;
$config[ 'vhosts_pattern_http' ] = $vhosts_pattern_http;
$config[ 'vhosts_pattern_https' ] = $vhosts_pattern_https;
$config[ 'default_hosts' ] = $default_hosts_windows;
$config[ 'default_vhosts_http' ] = $default_vhosts_http;
$config[ 'default_vhosts_https' ] = $default_vhosts_https;
if ( $sys_dir_sep == '/' ) {
	$config[ 'default_hosts' ] = $default_hosts_macintosh;
}

// 
function domains_from_root ( $config = array() ) {
	$first_lvl_domains = array();
	$domains = array();
	if ( $domains_dir = opendir( $config[ 'domains_root' ] ) ) {
		while( ( $single_domain = readdir( $domains_dir ) ) !== false ) {
			$first_lvl_domains[] = $single_domain;
		}
		asort( $first_lvl_domains );
		foreach( $first_lvl_domains as $single_domain ) {
			if ( 
				$single_domain != '.' 
				&& $single_domain != '..' 
				&& ( $single_domain[ 0 ] != '.' )
				&& ( strpos( $single_domain, '.' ) !== false )
				&& ( strpos( $single_domain, ' ' ) === false )
				&& ( strpos( $single_domain, '_' ) === false )
			) { 
				// domain
				if ( file_exists( $config[ 'domains_root' ] . DIRECTORY_SEPARATOR . $single_domain . DIRECTORY_SEPARATOR . 'www' ) ) {
					$domains[] = array( 
						'name' => $single_domain,
						'path' => $config[ 'domains_root' ] . DIRECTORY_SEPARATOR . $single_domain . DIRECTORY_SEPARATOR . 'www',
					);
					// subdomains
					if ( $subdomains_dir = opendir( $config[ 'domains_root' ] . DIRECTORY_SEPARATOR . $single_domain ) ) {
						while( ( $single_subdomain = readdir( $subdomains_dir ) ) !== false ) {
							$second_lvl_domains[] = $single_subdomain;
						}
						asort( $second_lvl_domains );
						foreach( $second_lvl_domains as $single_subdomain ) {
							if ( 
								$single_subdomain != '.' 
								&& $single_subdomain != '..' 
								&& $single_subdomain != 'www' 
								&& ( $single_subdomain[ 0 ] != '.' )
								&& ( strpos( $single_subdomain, ' ' ) === false )
								&& ( strpos( $single_subdomain, '_' ) === false )
								&& is_dir( $config[ 'domains_root' ] . DIRECTORY_SEPARATOR . $single_domain . DIRECTORY_SEPARATOR . $single_subdomain )
							) { 
								$domains[] = array( 
									'name' => $single_subdomain . '.' . $single_domain,
									'path' => $config[ 'domains_root' ] . DIRECTORY_SEPARATOR . $single_domain . DIRECTORY_SEPARATOR . $single_subdomain,
								);
							} // if
						} // while
					} // if opendir
					closedir( $subdomains_dir );
				} // if
			} // if
		} // while
	} // if opendir
	closedir( $domains_dir );
	return $domains;
}

function remove_generated_content ( $config = array(), $file_type = 'hosts_file_path' ) {
	$file_content = file_get_contents( $config[ $file_type ] );
	$generated_opening_pos = stripos( $file_content, $config[ 'generated_opening' ] );
	$generated_closing_pos = strripos( $file_content, $config[ 'generated_closing' ] ) + ( strlen( $config[ 'generated_closing' ] ) );
	echo '<pre>';
	if ( 
		$generated_opening_pos !== false
		&& $generated_closing_pos !== false
	) {
		$new_file_content = substr( $file_content, 0, $generated_opening_pos ) . substr( $file_content, $generated_closing_pos );
		$new_file_content = str_replace( "\n\n\n", "\n\n", $new_file_content );
		if ( file_put_contents( $config[ $file_type ], $new_file_content ) ) {
			echo '<strong>Done. The file is cleaned up from previously generated hosts.</strong>' . "\n";
		} else {
			echo '<strong>Something went wrong in "' . __FILE__ . '"!</strong>' . "\n";
		}
	} else {
		echo '<strong>No previously generated hosts has been found. The file has not been changed.</strong>' . "\n";
	}
	echo '</pre>' . "\n";
}