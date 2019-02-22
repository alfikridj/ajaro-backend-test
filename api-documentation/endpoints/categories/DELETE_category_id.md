# Category Resources

```bash
DELETE category/:id
```
## Description
delete category with id of category

_only user as admin can use this_
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
    "message": "category id 1 successfully removed"
}
```
