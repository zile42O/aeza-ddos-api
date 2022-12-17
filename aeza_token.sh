curl --header "Content-Type: application/json" \
  --request POST \
  --data '{ "method": "credentials", "email": "CHANGE_WITH_YOUR_EMAIL", "password": "CHANGE_WITH_YOUR_PASSWORD" }' \
  https://core.aeza.net/api/auth

sleep 1m