#!/bin/bash

docker stop phoenixstats
docker rm phoenixstats
docker build . -t phoenixstats
docker run -d --name='phoenixstats' -e TZ="Australia/Melbourne" -p 127.0.0.1:80:80/tcp phoenixstats #
docker logs phoenixstats -f