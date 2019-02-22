# Order Detail Resources

```bash
GET order/detail/:id
```
## Description
show order detail with id of order detail
***
## Example

**Request**

```bash
http://127.0.0.1:8000/api/v1/order/detail/1
```
- Headers
    - ###### Authorization
        Bearer _your_api_token_

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
