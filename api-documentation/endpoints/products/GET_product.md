# Product Resources

```bash
GET product
```
## Description
show all list of product
***
## Example

**Request**

```bash
http://127.0.0.1:8000/api/v1/product
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
        },
        {
            "id": 2,
            "name": "Gitar Yamaha C315",
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
    ]
}
```
