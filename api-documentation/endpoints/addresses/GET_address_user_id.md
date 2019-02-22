# Address Resources

```bash
GET address/user/:id
```
## Description
show address with id of address
***
## Example

**Request**

```bash
http://127.0.0.1:8000/api/v1/address/user/2
```
- Headers
    - ###### Authorization
        Bearer _your_api_token_

**Response**

```bash
{
    "data": [
        {
            "id": 1,
            "user_id": 2,
            "city": "Purwokerto",
            "state": "Jawa Tengah",
            "zip": "53123",
            "country": "Indonesia",
            "address": "Gg. Gunung Semeru No. 17",
            "description": "Deket tukang jahit",
            "phone": "089838291823",
            "created_at": "2019-02-21 16:12:23",
            "updated_at": "2019-02-21 16:25:23",
            "user_name": "John Paris"
        },
        {
            "id": 2,
            "user_id": 2,
            "city": "Sleman",
            "state": "Yogyakarta",
            "zip": "55281",
            "country": "Indonesia",
            "address": "Jl Apel No. 21 Ngleles",
            "description": "Belakang rumah penjahitan",
            "phone": "087837687816",
            "created_at": "2019-02-22 08:53:53",
            "updated_at": "2019-02-22 08:53:53",
            "user_name": "John Paris"
        }
    ]
}
```
