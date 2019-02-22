# Category Resources

```bash
POST category/:id
```
## Description
update category with id of category
***
## Example

**Request**

```bash
http://127.0.0.1:8000/api/v1/category/1
```
- Headers
    - ###### Authorization
        Bearer _your_api_token_ 
    - ###### Content-Type
        multipart/form-data
- Body
    - ###### name

**Response**

```bash
{
    "data": {
        "id": 1,
        "name": "Drink",
        "created_at": "2019-02-21 18:55:20",
        "updated_at": "2019-02-22 08:10:17"
    }
}
```
