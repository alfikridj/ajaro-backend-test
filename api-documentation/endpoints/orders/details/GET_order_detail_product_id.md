# Order Resources

```bash
GET order/detail/product/:id
```
## Description
show order detail with product id of order detail

_only user as admin can use this_
***
## Example

**Request**

```bash
http://127.0.0.1:8000/api/v1/order/detail/product/1
```
- Headers
    - ###### Authorization
        Bearer _your_api_token_

**Response**

```bash
{
    "data": [
        {
            "id": 2,
            "order_id": 1,
            "product_id": 1,
            "quantity": "1",
            "created_at": "2019-02-22 13:42:46",
            "updated_at": "2019-02-22 13:42:46",
            "product_name": "Bola Rugby - Gilbert GTR 3000 Indonesia",
            "product_price": "220000",
            "product_stock": "2"
        }
    ]
}
```
