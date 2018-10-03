#!/bin/sh

# generate host keys if not present
ssh-keygen -A

sed -i  "s|216.191.104.36|$IP|g" /home/autossh/.ssh/authorized_keys

# check wether a random root-password is provided
if [ ! -z "${ROOT_PASSWORD}" ] && [ "${ROOT_PASSWORD}" != "root" ]; then
    echo "root:${ROOT_PASSWORD}" | chpasswd
fi

# do not detach (-D), log to stderr (-e), passthrough other arguments
exec /usr/sbin/sshd -D -e "$@"
