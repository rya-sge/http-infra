#!/bin/bash
#Run the container with port redirection
docker run -d -p 3000:3000 http_infra_sauge_viotti/express_dynamic
