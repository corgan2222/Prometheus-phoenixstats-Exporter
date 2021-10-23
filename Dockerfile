FROM php:7.4.25-apache-buster

#Build args
ARG VCS_REF
ARG BUILD_DATE
#Adding Labels of build
LABEL maintainer="Stefan Knaak <github.com/corgan2222>"
LABEL org.label-schema.build-date=$BUILD_DATE
LABEL org.label-schema.vcs-url="https://github.com/corgan2222/Prometheus-phoenixstats-Exporter"
LABEL org.label-schema.vcs-ref=$VCS_REF

COPY * /var/www/html/
WORKDIR /var/www/html/
RUN chmod +x /var/www/html/init.sh; \
    echo "" >> /etc/apache2/apache2.conf; \
    echo "# Set ServerName globally to supress warnings" >> /etc/apache2/apache2.conf;\
    echo "ServerName phoenixstats" >> /etc/apache2/apache2.conf;
EXPOSE 80
CMD ["./init.sh"]