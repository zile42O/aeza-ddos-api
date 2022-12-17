# aeza-ddos-api
 Rest API for watching last DDoS Detection from your service on Aeza Network.
 This is useful for creating a third party monitoring of DDoS Attacks if you using aeza.net

### The official Aeza API is avaiable at https://github.com/AezaGroup/dev-docs

## Usage

First for interacting to Aeza network you need to generate a Bearer token, the token is available for 30 days.
I created for you the simple bash script for getting a token
* Change first the email & password into bash file.

```bash
sh ./aeza_token.sh
```
After that you need specific service id to get info about attacks, you can find it in Aeza panel in section services.

### Example of API call

```web
https://example.com/aeza-ddos-api/api.php?token=TOKEN&service=SERVICE_ID
```

### Example of output

```json
[
    {
        "service": "1337",
        "last_id": 420,
        "type": "udp_flood",
        "protocol": "udp",
        "start_time": "6:00 pm",
        "end_time": "6:30 pm",
        "attack_power": "900 MBs"
    }
]
```
* With this info with basic knowledge you can create a app which will follow `last_id` and waiting for new updates and you get latest attacks logged.
