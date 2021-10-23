#!/bin/bash

CONF="/var/www/html/docker-conf.php"

echo "Project: Prometheus-phoenixstats"
echo "Author:  Stefan Knaak"
echo "original Author: lnxd"
echo "Base:    Debian Buster"
echo "Target:  Unraid"
echo ""
echo "Server:  ${S_NAME}"
echo "Host:    ${S_HOST}"
echo "Port:    ${S_PORT}"
echo ""
if test -f $CONF; then
    rm $CONF
fi
cp /var/www/html/conf.php $CONF
sed -i 's/Server_1/'${S_NAME}'/' $CONF
sed -i 's/server1.example.com/'${S_HOST}'/' $CONF
sed -i 's/3333/'${S_PORT}'/' $CONF
sed -i "s/'server_1_password'/null/" $CONF
sed -i "s/'gpu_fan_red = 75'/gpu_fan_red = 80/" $CONF
echo ""
apache2-foreground