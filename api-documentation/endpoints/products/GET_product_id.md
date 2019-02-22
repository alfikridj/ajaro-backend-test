# Product Resources

```bash
GET product/:id
```
## Description
show product with id of product
***
## Example

**Request**

```bash
http://127.0.0.1:8000/api/v1/product/1
```
- Headers
    - ###### Authorization
        Bearer _your_api_token_

**Response**

```bash
{
    "data": {
        "id": 1,
        "name": "Bola Rugby - Gilbert GTR 3000 Indonesia",
        "price": "220000",
        "weight": "500",
        "description": "The latest in rugby ball innovation from Gilbert UK. the GTR balls feature a unique Tri-Grip technology to create a premium feel and grip to once ordinary training balls.",
        "image": "http://127.0.0.1:8000/images/products/noimage.png",
        "category_id": 2,
        "stock": "100",
        "created_at": "2019-02-21 18:55:59",
        "updated_at": "2019-02-21 20:57:55",
        "category_name": "Sport"
    }
}
```
