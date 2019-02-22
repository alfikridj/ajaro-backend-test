# Order Resources

```bash
POST order/:id/trackingnumber
```
## Description
update product with id of product

_only user as admin can use this_
***
## Example

**Request**

```bash
http://127.0.0.1:8000/api/v1/order/1/trackingnumber
```
- Headers
    - ###### Authorization
        Bearer _your_api_token_ 
    - ###### Content-Type
        multipart/form-data
- Body
    - ###### tracking_number

**Response**

```bash
{
    "data": {
        "id": 1,
        "user_id": 2,
        "amount": "1720000",
        "address_id": 2,
        "shipping": "16000",
        "tax": "25800",
        "tracking_number": "030003437484",
        "created_at": "2019-02-22 13:41:10",
        "updated_at": "2019-02-22 13:46:51",
        "user_name": "John Paris",
        "address_city": "Sleman"
    }
}
```
