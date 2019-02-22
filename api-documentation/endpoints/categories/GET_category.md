# Category Resources

```bash
GET category
```
## Description
show all list of category
***
## Example

**Request**

```bash
http://127.0.0.1:8000/api/v1/category
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
            "name": "Food",
            "created_at": "2019-02-21 18:55:20",
            "updated_at": "2019-02-21 18:55:20"
        },
        {
            "id": 2,
            "name": "Sport",
            "created_at": "2019-02-21 18:55:46",
            "updated_at": "2019-02-21 18:55:46"
        },
        {
            "id": 3,
            "name": "Music",
            "created_at": "2019-02-22 07:59:28",
            "updated_at": "2019-02-22 07:59:28"
        }
    ]
}
```
