#!/bin/bash


docker run -e STATIC_APP_1=172.17.0.2:80 -e STATIC_APP_2=172.17.0.3:80 -e DYNAMIC_APP_1=172.17.0.4:3000 -e DYNAMIC_APP_2=172.17.0.6:3000 --name apache_reverse http_infra_sauge_viotti/reverse_proxy

