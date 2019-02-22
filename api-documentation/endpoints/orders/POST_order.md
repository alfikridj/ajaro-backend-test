# Order Resources

```bash
POST order
```
## Description
add new order to the list order

_only user as customer can use this_
***
## Example

**Request**

```bash
http://127.0.0.1:8000/api/v1/order
```
- Headers
    - ###### Authorization
        Bearer _your_api_token_ 
    - ###### Content-Type
        multipart/form-data
- Body
    - ###### user_id
    - ###### address_id

**Response**

```bash
{
    "data": {
        "id": 1,
        "user_id": 2,
        "amount": "",
        "address_id": 2,
        "shipping": "",
        "tax": "",
        "tracking_number": "",
        "created_at": "2019-02-22 13:41:10",
        "updated_at": "2019-02-22 13:41:10",
        "user_name": "John Paris",
        "address_city": "Sleman"
    }
}
```
