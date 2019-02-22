# User Resources

```bash
GET user
```
## Description
show of user
***
## Example

**Request**

```bash
http://127.0.0.1:8000/api/v1/user
```
- Headers
    - ###### Authorization
        Bearer _your_api_token_

**Response**

```bash
{
    "data": {
        "id": 1,
        "name": "John Paris",
        "email": "jparis@email.com",
        "email_verified_at": null,
        "phone": "087238374712",
        "image": "Travis-Kalanick.jpg",
        "role": "customer",
        "created_at": "2019-02-21 16:07:10",
        "updated_at": "2019-02-22 07:42:12"
    }
}
```
