
set -o allexport
[[ -f ../.env ]] && source ../.env
set +o allexport

data_path="./data/certbot"

echo "### Creating dummy certificate for $domains ..."
path="/etc/letsencrypt/live/all"
mkdir -p "$data_path/conf/live/all"
docker-compose run --rm --entrypoint "\
  openssl req -x509 -nodes -newkey rsa:1024 -days 1\
    -keyout '$path/privkey.pem' \
    -out '$path/fullchain.pem' \
    -subj '/CN=localhost'" certbot
echo

