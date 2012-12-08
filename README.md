README
======

Technology
------------

`Linux` `Nginx/Apache` `PHP 5.4+` `MySQL 5+` `Symfony 1.3.9`

Installation
------------

1) Create `/config/databases.yml` file:

###

    dev:
      propel:
        param:
          classname: DebugPDO
    test:
      propel:
        param:
          classname: DebugPDO
    all:
      propel:
        class: sfPropelDatabase
        param:
          classname: PropelPDO
          dsn: 'mysql:dbname=DBNAME;host=HOST'
          username: USERNAME
          password: 'PASSWORD'
          encoding: utf8
          persistent: true
          pooling: true

2) Execute SQL-queries from `/data/sql` folder.

3) Clear symfony cache:

    ./symfony cc

4) Nginx configuration:

###

    server {
        server_name  etapasvi.com www.etapasvi.com m.etapasvi.com;
        
        set $root /www;    

        set $fastcgi_pass 127.0.0.1:9000; 
        
        include /www/conf/nginx_params.conf;
        include /www/conf/nginx_mainweb.conf;
        include /www/conf/nginx_web.conf;
    }

Contributing
------------

All submissions are welcome:

1. Fork it.

2. Create a branch (`git checkout -b my_contribution`)

3. Commit your changes (`git commit -am "Fixed bug"`)

4. Push to the branch (`git push origin my_contribution`)

5. Create an [Issue][2] with a link to your branch

6. Enjoy a refreshing Tea and wait

Misc
------------

Database archive: [http://www.etapasvi.com/uploads/misc/db.tar.gz.gpg][1] (shared just for backup purposes)

Way Back Machine: [http://wayback.archive.org/web/20091215000000*/http://www.etapasvi.com/en/][3]

[1]: http://www.etapasvi.com/uploads/misc/db.tar.gz.gpg
[2]: https://github.com/etapasvi/etapasvi.com/issues
[3]: http://wayback.archive.org/web/20091215000000*/http://www.etapasvi.com/en/