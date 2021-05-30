#!/bin/bash

docker run -e STATIC_APP=172.17.0.x:80 -e DYNAMIC_APP=172.17.0.y:3000 -it --name apache_reverse http_infra_sauge_viotti/reverse_proxy /bin/bash

