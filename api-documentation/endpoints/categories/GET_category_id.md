# Category Resources

```bash
GET category/:id
```
## Description
show category with id of category
***
## Example

**Request**

```bash
http://127.0.0.1:8000/api/v1/category/1
```
- Headers
    - ###### Authorization
        Bearer _your_api_token_

**Response**

```bash
{
    "data": {
        "id": 1,
        "name": "Food",
        "created_at": "2019-02-21 18:55:20",
        "updated_at": "2019-02-21 18:55:20"
    }
}
```
