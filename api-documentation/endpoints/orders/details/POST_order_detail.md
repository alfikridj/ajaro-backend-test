# Order Resources

```bash
POST order/detail
```
## Description
add new order detail to the list order detail

_only user as customer can use this_
***
## Example

**Request**

```bash
http://127.0.0.1:8000/api/v1/order/detail
```
- Headers
    - ###### Authorization
        Bearer _your_api_token_ 
    - ###### Content-Type
        multipart/form-data
- Body
    - ###### order_id
    - ###### product_id
    - ###### quantity

**Response**

```bash
{
    "data": {
        "id": 1,
        "order_id": 1,
        "product_id": 2,
        "quantity": "1",
        "created_at": "2019-02-22 13:42:46",
        "updated_at": "2019-02-22 13:42:46",
        "product_name": "Gitar Yamaha C315",
        "product_price": "1500000",
        "product_stock": "1"
    }
}
```
