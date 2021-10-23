docker stop phoenixstats
docker rm phoenixstats
docker build . -t phoenixstats
docker run -d --name='phoenixstats' -e TZ="Europe/Berlin" -e S_NAME="Unraid" -e S_HOST="192.168.2.254" -e S_PORT="5450" -p 127.0.0.1:80:80/tcp phoenixstats #
docker logs phoenixstats -f
