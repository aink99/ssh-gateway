FROM alpine:latest

LABEL maintainer="Seb Chartrand <chartrand.sebastien@gmail.com"


RUN apk update	&& apk upgrade && apk add \
                openssh \
                supervisor \
                nginx \
                php7 \
                php7-fpm \
		&& adduser -S autossh \
		&& passwd -u autossh \
		# forward request and error logs to docker log collector
	        && ln -sf /dev/stdout /var/log/nginx/access.log \
	        && ln -sf /dev/stderr /var/log/nginx/error.log \
		&& rm -rf /var/cache/apk/* /tmp/*



COPY nginx.conf /etc/nginx/nginx.conf
COPY entrypoint.sh /
COPY sshd_config /etc/ssh/sshd_config
COPY authorized_keys /home/autossh/.ssh/authorized_keys
COPY supervisord.conf /config/

EXPOSE 22

#ENTRYPOINT ["sh /entrypoint.sh"]
#CMD  sh /entrypoint.sh

ENTRYPOINT ["supervisord", "-c", "/config/supervisord.conf"]
