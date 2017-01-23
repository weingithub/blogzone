# pre-install

## php
`yum -y install php`

## mysql
`yum -y install  mysql-server` 

## mysql-driver
`yum -y install php-mysql`

## apache config
if we want to hide index.php, we do thing like this:
* move `htaccess` file to apache's webroot, such as /var/www/html, then change file name to `.htaccess`. `.htaccess` file set the rule that apache to rewrite<br>
* modify `httpd.conf`, webroot's Directory config,such as <Directory "/var/www/html">. change AllowOverride value from None to  All, so that the rule in `.htaccess` become effective.

## CI  
copy index.php in CodeIgniter-3.0.2-blog to apache's webroot. then change system_path and application_folder 's value 
