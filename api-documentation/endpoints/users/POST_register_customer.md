# User Resources

```bash
POST register/customer
```
## Description
register the user as customer to create new account
***
## Example

**Request**

```bash
http://127.0.0.1:8000/api/v1/register/customer
```
- Headers
    - ###### Content-Type
        multipart/form-data
- Body
    - ###### name
    - ###### email
    - ###### password
    - ###### password_confirmation
    - ###### phone

**Response**

```bash
{
    "data": {
        "name": "John Paris",
        "email": "jparis@email.com",
        "phone": "087238374712",
        "image": "https://github.com/identicons/lF.png",
        "role": "customer",
        "updated_at": "2019-02-21 16:07:59",
        "created_at": "2019-02-21 16:07:59",
        "id": 1
    },
    "message": "login here http://127.0.0.1:8000/api/v1/login"
}
```
