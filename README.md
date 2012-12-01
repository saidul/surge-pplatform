surge-pplatform
===============

Sanitation Hackathon 2012 Peer Platform ...

Installation Instruction:

create app/config/parameters.ini from parameters.ini.dist and add database info there.

To Install vendors
```
$ bin/vendors install
```

To create/update database structure
```
$ app/console doctrine:schema:update --force
```

