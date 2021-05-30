#!/bin/bash

docker run -it -e STATIC_APP_1=172.17.0.2:80 -e STATIC_APP_2=172.17.0.5:80 -e DYNAMIC_APP_1=172.17.0.3:3000 -e DYNAMIC_APP_2=172.17.0.y:3000 --name apache_reverse http_infra_sauge_viotti/reverse_proxy /bin/bash

