FROM wabot_interface:latest
WORKDIR /var/www

ADD docker/queue.sh /usr/local/bin/wabot_queue
RUN chmod +x /usr/local/bin/wabot_queue

CMD [ "sh", "/usr/local/bin/wabot_queue" ]