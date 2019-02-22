# Address Resources

```bash
DELETE address/:id
```
## Description
delete address with id of address

_only user as customer can use this_
***
## Example

**Request**

```bash
http://127.0.0.1:8000/api/v1/address/1
```
- Headers
    - ###### Authorization
        Bearer _your_api_token_

**Response**

```bash
{
    "message": "address id 1 successfully removed"
}
```
