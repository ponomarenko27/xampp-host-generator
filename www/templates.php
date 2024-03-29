<?php
$hosts_pattern = '127.0.0.1		%1$s' . "\n" . '127.0.0.1		www.%1$s' . "\n";

$vhosts_pattern_http = '<VirtualHost *:80>
	ServerName %1$s
	ServerAlias www.%1$s
	ErrorLog "logs/%1$s-error.log"
	CustomLog "logs/%1$s-access.log" common
	DocumentRoot "%2$s"
	<Directory "%2$s">
		Options Indexes FollowSymLinks Includes ExecCGI
		AllowOverride All
		Order allow,deny
		Allow from all
		Require all granted
	</Directory>
	ServerAdmin %3$s
</VirtualHost>' . "\n";

$vhosts_pattern_https = '<VirtualHost *:443>
	ServerName %1$s
	ServerAlias www.%1$s
	ErrorLog "logs/%1$s-error.log"
	CustomLog "logs/%1$s-access.log" common
	DocumentRoot "%2$s"
	<Directory "%2$s">
		Options Indexes FollowSymLinks Includes ExecCGI
		AllowOverride All
		Order allow,deny
		Allow from all
		Require all granted
	</Directory>
	ServerAdmin %3$s
	SSLEngine on
	SSLCertificateFile "conf/ssl.crt/server.crt"
	SSLCertificateKeyFile "conf/ssl.key/server.key"
	<FilesMatch "\.(cgi|shtml|phtml|php)$">
		SSLOptions +StdEnvVars
	</FilesMatch>
</VirtualHost>' . "\n";

$default_hosts_windows = "# Copyright (c) 1993-2009 Microsoft Corp.
#
# This is a sample HOSTS file used by Microsoft TCP/IP for Windows.
#
# This file contains the mappings of IP addresses to host names. Each
# entry should be kept on an individual line. The IP address should
# be placed in the first column followed by the corresponding host name.
# The IP address and the host name should be separated by at least one
# space.
#
# Additionally, comments (such as these) may be inserted on individual
# lines or following the machine name denoted by a '#' symbol.
#
# For example:
#
#      102.54.94.97     rhino.acme.com          # source server
#       38.25.63.10     x.acme.com              # x client host

# localhost name resolution is handled within DNS itself.
#	127.0.0.1       localhost
#	::1             localhost

127.0.0.1 		localhost
127.0.0.1 		x-host-generator.com
127.0.0.1 		www.x-host-generator.com" . "\n";

$default_hosts_macintosh = "##
# Host Database
#
# localhost is used to configure the loopback interface
# when the system is booting.  Do not change this entry.
##
127.0.0.1   localhost
255.255.255.255 broadcasthost
::1             localhost

127.0.0.1       x-host-generator.com
127.0.0.1 		www.x-host-generator.com" . "\n";

$default_vhosts_http = '# Virtual Hosts
#
# Required modules: mod_log_config

# If you want to maintain multiple domains/hostnames on your
# machine you can setup VirtualHost containers for them. Most configurations
# use only name-based virtual hosts so the server doesn’t need to worry about
# IP addresses. This is indicated by the asterisks in the directives below.
#
# Please see the documentation at 
# <URL:http://httpd.apache.org/docs/2.4/vhosts/>
# for further details before you try to setup virtual hosts.
#
# You may use the command line option \'-S\' to verify your virtual host
# configuration.

#
# Use name-based virtual hosting.
#
NameVirtualHost *:80
#
# VirtualHost example:
# Almost any Apache directive may go into a VirtualHost container.
# The first VirtualHost section is used for all requests that do not
# match a ##ServerName or ##ServerAlias in any <VirtualHost> block.
#

<VirtualHost *:80>
    ServerName %1$s
    ServerAlias www.%1$s
    ErrorLog "logs/%1$s-error.log"
    CustomLog "logs/%1$s-access.log" common
    DocumentRoot "%2$s"
    <Directory "%2$s">
        Options Indexes FollowSymLinks Includes ExecCGI
        AllowOverride All
        Order allow,deny
        Allow from all
        Require all granted
    </Directory>
    ServerAdmin %3$s
</VirtualHost>
' . "\n";

$default_vhosts_https = '<VirtualHost *:443>
    ServerName %1$s
    ServerAlias www.%1$s
    ErrorLog "logs/%1$s-error.log"
    CustomLog "logs/%1$s-access.log" common
    DocumentRoot "%2$s"
    <Directory "%2$s">
        Options Indexes FollowSymLinks Includes ExecCGI
        AllowOverride All
        Order allow,deny
        Allow from all
        Require all granted
    </Directory>
    ServerAdmin %3$s
    SSLEngine on
    SSLCertificateFile "conf/ssl.crt/server.crt"
    SSLCertificateKeyFile "conf/ssl.key/server.key"
    <FilesMatch "\.(cgi|shtml|phtml|php)$">
        SSLOptions +StdEnvVars
    </FilesMatch>
</VirtualHost>
' . "\n";
