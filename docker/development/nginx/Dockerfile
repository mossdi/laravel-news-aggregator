FROM nginx:alpine

RUN mkdir -p /var/www/app/public && \
    echo "<?php die('done!');" > /var/www/app/public/index.php

EXPOSE 80
