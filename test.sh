docker stop phoenixstats
docker rm phoenixstats
docker build . -t prometheus-phoenixstats
docker run -d --name='prometheus-phoenixstats' -e TZ="Europe/Berlin" -e S_NAME="Unraid" -e S_HOST="192.168.2.254" -e S_PORT="5450" -p 127.0.0.1:80:80/tcp prometheus-phoenixstats #
docker logs prometheus-phoenixstats -f
