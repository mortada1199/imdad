FROM hub.nctr.sd/emdad/emdad-base:latest
WORKDIR /var/www/html/
ADD emdad-backend emdad-backend
ADD certs /etc/ssl/nginx

COPY nginx.conf /etc/nginx/nginx.conf
COPY emdad.conf /etc/nginx/conf.d/emdad.conf

COPY emdad-backend/.env.example2 emdad-backend/.env
RUN rm -rf app && ln -s emdad-backend/ app

COPY ./entrypoint.sh ./
RUN chmod +x ./entrypoint.sh &&  apk add php81-exif php81-gd
#sed -i "/;extension=exif*/c\extension=exif" /etc/php81/php.ini && sed -i "/;extension=mbstring*/c\extension=mbstring" /etc/php81/php.ini
#ENTRYPOINT ["supervisord", "-c", "/etc/supervisord.conf"]
ENTRYPOINT ["./entrypoint.sh"]
