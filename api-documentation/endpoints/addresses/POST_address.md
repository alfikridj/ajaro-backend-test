# Address Resources

```bash
POST address
```
## Description
add new address to the list address

_only user as customer can use this_
***
## Example

**Request**

```bash
http://127.0.0.1:8000/api/v1/address
```
- Headers
    - ###### Authorization
        Bearer _your_api_token_ 
    - ###### Content-Type
        multipart/form-data
- Body
    - ###### user_id
    - ###### city
    - ###### state
    - ###### zip
    - ###### country
    - ###### address
    - ###### description
    - ###### phone

**Response**

```bash
{
    "data": {
        "id": 2,
        "user_id": 2,
        "city": "Sleman",
        "state": "Yogyakarta",
        "zip": "53123",
        "country": "Indonesia",
        "address": "Jl Apel No. 21",
        "description": "Deket tukang jahit",
        "phone": "089838291823",
        "created_at": "2019-02-21 16:12:23",
        "updated_at": "2019-02-21 16:25:23",
        "user_name": "John Paris"
    }
}
```
