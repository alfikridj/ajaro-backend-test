# Product Resources

```bash
DELETE product/:id
```
## Description
delete product with id of product

_only user as admin can use this_
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
    "message": "product id 1 successfully removed"
}
```
