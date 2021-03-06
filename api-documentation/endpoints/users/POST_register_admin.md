# User Resources

```bash
POST register/admin
```
## Description
register the user as admin to create new account
***
## Example

**Request**

```bash
http://127.0.0.1:8000/api/v1/register/admin
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
        "name": "John London",
        "email": "jlondon@email.com",
        "phone": "087238374712",
        "image": "https://github.com/identicons/ri.png",
        "role": "admin",
        "updated_at": "2019-02-21 16:07:57",
        "created_at": "2019-02-21 16:07:57",
        "id": 2
    },
    "message": "login here http://127.0.0.1:8000/api/v1/login"
}
```
