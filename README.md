Make your OpenSSH fly on Alpine

Overview

Use this Dockerfile/image to start an SSH server on a lightweight Alpine container.

Features

Basic Usage

```
docker   run -d  --name=ssh-gw \
--hostname ssh-gw \
-e IP=192.168.0.0/24 \
-p 1337:22  \
-p 8822-8900:8822-8900  \
aink99/ssh-gateway
```

From a host, initiate a reverse tunnel. In this example, we reverse our own SSH server to our Docker image:
```bash
ssh -Nnf   -o ServerAliveInterval=60 -o ServerAliveCountMax=60 -R 9922:localhost:22  autossh@PublicIP -p 1337 -i autokey
```

Then, from your home LAN, you can now connect to your remote host. This is useful if you do not or cannot open or NAT your remote host
ssh -p
