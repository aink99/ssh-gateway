Make your OpenSSH fly on Alpine
Overview
Use this Dockerfile / -image to start a sshd-server upon a lightweight Alpine container.

Features


Basic Usage

docker   run -d  --name=ssh-gw \
--hostname ssh-gw \
-e IP=192.168.0.0/24 \
-p 1337:22  \
-p 8822-8900:8822-8900  \
aink99/ssh-gateway


From a host initiate a reverse tunnel, in this example  we reverse are owe in ssh server to our docker Image .
ssh -Nnf   -o ServerAliveInterval=60 -o ServerAliveCountMax=60 -R 9922:localhost:22  autossh@PublicIP -p 1337 -i autokey

The from your home lan you can know connect  to your remote host. Usefull if you do not or cannot  open or  NAT your remoye Host

ssh -p 
