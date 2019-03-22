WORKDIR=$(pwd)
docker build -t aink99/ssh-gateway .
docker rm --force ssh-gw
docker   run -v  $WORKDIR/www:/www -d    --name=ssh-gw --hostname ssh-gw -e IP=192.168.0.0/24 -p 9080:80 -p 1337:22  -p 8822-8900:8822-8900  aink99/ssh-gateway
