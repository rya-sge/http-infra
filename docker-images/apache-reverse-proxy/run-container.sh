#!/bin/bash

docker run -d -e STATIC_APP=172.17.0.2:80 -e STATIC_APP=172.17.0.5:80 -e DYNAMIC_APP=172.17.3.3:3000 DYNAMIC_APP=172.17.3.4:3000- -name apache_reverse http_infra_sauge_viotti/reverse_proxy




