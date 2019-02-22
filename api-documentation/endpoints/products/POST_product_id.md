# Product Resources

```bash
POST product/:id
```
## Description
update product with id of product

_only user as admin can use this_
***
## Example

**Request**

```bash
http://127.0.0.1:8000/api/v1/product/2
```
- Headers
    - ###### Authorization
        Bearer _your_api_token_ 
    - ###### Content-Type
        multipart/form-data
- Body
    - ###### name
    - ###### price
    - ###### weight
    - ###### description
    - ###### image
    - ###### category_id
    - ###### stock

**Response**

```bash
{
    "data": {
        "id": 2,
        "name": "Gitar Yamaha C332",
        "price": "1500000",
        "weight": "1000",
        "description": "Gitar clasic Yamaha C315 ini mungkin menjadi salah satu ukuran penuh model klasik paling murah Yamaha, tapi kualitas dan nada yang luar biasa. Benar-benar murah untuk pemula.",
        "image": "YAMAHA_Gitar_Classic_C-315.JPG",
        "category_id": 3,
        "stock": "5",
        "created_at": "2019-02-22 08:23:05",
        "updated_at": "2019-02-22 08:23:05",
        "category_name": "Music"
    }
}
```
