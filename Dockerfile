FROM alpine:latest

LABEL maintainer="Seb Chartrand <chartrand.sebastien@gmail.com"


RUN apk update	&& apk upgrade && apk add openssh \
		&& adduser -S autossh \
		&& passwd -u autossh \
		&& rm -rf /var/cache/apk/* /tmp/*



COPY entrypoint.sh /
COPY sshd_config /etc/ssh/sshd_config
COPY  authorized_keys /home/autossh/.ssh/authorized_keys

EXPOSE 22

#ENTRYPOINT ["sh /entrypoint.sh"]
CMD  sh /entrypoint.sh
