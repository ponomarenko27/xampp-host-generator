## OSX Instructions

#### Step 1.
Edit file:
```
/Applications/XAMPP/xamppfiles/etc/httpd.conf
```

Find:
```
# Virtual hosts
#Include /Applications/XAMPP/etc/extra/httpd-vhosts.conf
```
Replace with:
```
# Virtual hosts
Include /Applications/XAMPP/etc/extra/httpd-vhosts.conf
```

#### Step 2.
Edit file:
```
/Applications/XAMPP/xamppfiles/etc/extra/httpd-vhosts.conf
```

Replace the content of the whole file with the following code:
```
# Virtual Hosts
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
    ServerName x-host-generator.com
    ServerAlias www.x-host-generator.com
    ErrorLog "logs/x-host-generator.com-error.log"
    CustomLog "logs/x-host-generator.com-access.log" common
    DocumentRoot "/Applications/XAMPP/htdocs/x-host-generator.com/www"
    <Directory "/Applications/XAMPP/htdocs/x-host-generator.com/www">
        Options Indexes FollowSymLinks Includes ExecCGI
        AllowOverride All
        Order allow,deny
        Allow from all
        Require all granted
    </Directory>
    ServerAdmin your-email@gmail.com
</VirtualHost>
```

#### Step 3.
Open Terminal and run the following command in order to change permissions to the "/etc/hosts" file. That will let this web-app to edit that file and add other host records.
```
sudo chmod 666 /etc/hosts
```

#### Step 4.
Open Terminal and run the following command in order to edit the "/etc/hosts" file.
```
sudo nano /etc/hosts
```
Insert the following code at the end of the file:
```
127.0.0.1       x-host-generator.com
127.0.0.1 		www.x-host-generator.com
```
So the full content of your "hosts" file looks similar to the following:
```
##
# Host Database
#
# localhost is used to configure the loopback interface
# when the system is booting.  Do not change this entry.
##
127.0.0.1   localhost
255.255.255.255 broadcasthost
::1             localhost

127.0.0.1       x-host-generator.com
127.0.0.1 		www.x-host-generator.com
```

#### Step 5.
On OS X creation of vHosts that are using HTTPS and port 443 causes error when Apache starts. So you need to edit config file in the folder of this web-app and disable "https vhosts". Make sure that "generate_https_vhosts" variable is set to the "false".

Edit file: config.php
```
'generate_https_vhosts' => true, // true or false.
```

#### Step 6.
Open XAMPP app and start the Apache. Or restart Apache if it was running. After that go to your browser and open the following link:
```
http://x-host-generator.com/
```



## Windows Instructions

#### Step 1.
Edit file:
```
C:\xampp\apache\conf\extra\httpd-vhosts.conf
```

Replace the content of the whole file with the following code:
```
# Virtual Hosts
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
    ServerName x-host-generator.com
    ServerAlias www.x-host-generator.com
    ErrorLog "logs/x-host-generator.com-error.log"
    CustomLog "logs/x-host-generator.com-access.log" common
    DocumentRoot "D:\x-server\home\var\vhosts\x-host-generator.com\www"
    <Directory "D:\x-server\home\var\vhosts\x-host-generator.com\www">
        Options Indexes FollowSymLinks Includes ExecCGI
        AllowOverride All
        Order allow,deny
        Allow from all
        Require all granted
    </Directory>
    ServerAdmin your-email@gmail.com
</VirtualHost>
```

#### Step 2.
Edit file (as Administrator): 
```
C:\Windows\System32\drivers\etc\hosts
```
Insert the following code at the end of the file:
```
127.0.0.1       x-host-generator.com
127.0.0.1 		www.x-host-generator.com
```
So the full content of your "hosts" file looks similar to the following:
```
# Copyright (c) 1993-2009 Microsoft Corp.
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
127.0.0.1 		www.x-host-generator.com
```

#### Step 3.
Edit if you want. This step is not necessary. This web-app should work without editing this file:
```
config.php
```

#### Step 4.
In order to make this web-app work you should everytime launch XAMPP as Administrator. You can make it easier with the following trick.
Copy "xampp-control.exe" and paste as a "Shortcut". Or edit existing shortcut.
- Right-click (context menu) on the shortcut.
- Properties.
- Shortcut tab.
- Advanced.
- Run As Administrator.
- Ok, Ok.
