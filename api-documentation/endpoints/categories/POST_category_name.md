# Category Resources

```bash
POST category/name
```
## Description
show category with name of category
***
## Example

**Request**

```bash
http://127.0.0.1:8000/api/v1/category/name
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
    "data": [
        {
            "id": 1,
            "name": "Food",
            "created_at": "2019-02-22 07:59:28",
            "updated_at": "2019-02-22 07:59:28"
        }
    ]
}
```
