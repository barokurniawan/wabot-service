FROM nginx:1.15
WORKDIR /var/www
ADD ./docker/nginx.conf /etc/nginx/conf.d/default.conf