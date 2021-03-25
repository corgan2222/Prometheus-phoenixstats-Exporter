FROM php:7.4.16-apache-buster

COPY * /var/www/html/
WORKDIR /var/www/html/
RUN chmod +x /var/www/html/init.sh; \
    echo "" >> /etc/apache2/apache2.conf; \
    echo "# Set ServerName globally to supress warnings" >> /etc/apache2/apache2.conf;\
    echo "ServerName phoenixstats" >> /etc/apache2/apache2.conf;
EXPOSE 80
CMD ["./init.sh"]