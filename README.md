# pre-install

at first, you need have a php development environment.
1. yum -y install php

then, use mysql as db to store data.
2. yum -y install  mysql-server 

now, we have db, and php, but our php can't manipulate db, so, we need install db-driver
3. yum -y install php-mysql

