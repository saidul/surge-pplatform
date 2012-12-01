surge-pplatform
===============

Sanitation Hackathon 2012 Peer Platform ...
This package is based on Symfony (https://github.com/symfony/symfony) PHP framework.
Installation Instruction:

create app/config/parameters.ini from parameters.ini.dist and add database info there.

To Install vendors
```
$ bin/vendors install
```

To create/update database structure
Windows
```
$ app/console doctrine:schema:update --force
```
Linux
```
$ php.exe app/console doctrine:schema:update --force
```