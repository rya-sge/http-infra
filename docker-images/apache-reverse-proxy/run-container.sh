#!/bin/bash

docker run -d -e STATIC_APP=172.17.0.x:80 -e DYNAMIC_APP=172.17.0.y:3000 --name apache_reverse -p 8080:80 http_infra_sauge_viotti/reverse_proxy
