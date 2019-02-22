# Category Resources

```bash
POST category
```
## Description
add new category to the list category

_only user as admin can use this_
***
## Example

**Request**

```bash
http://127.0.0.1:8000/api/v1/category
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
        "name": "Food",
        "updated_at": "2019-02-22 07:59:28",
        "created_at": "2019-02-22 07:59:28",
        "id": 1
    }
}
```
