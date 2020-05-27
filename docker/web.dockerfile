FROM nginx:1.15

ADD ./docker/vhost.conf /etc/nginx/conf.d/default.conf
WORKDIR /var/www