# User Resources

```bash
POST login
```
## Description
login the user as admin or customer to use this api
***
## Example

**Request**

```bash
http://127.0.0.1:8000/api/v1/login
```
- Headers
    - ###### Content-Type
        multipart/form-data
- Body
    - ###### email
    - ###### password

**Response**

```bash
{
    "data": {
        "id": 2,
        "name": "John London",
        "email": "jlondon@email.com",
        "email_verified_at": null,
        "phone": "087238374712",
        "image": "https://github.com/identicons/ri.png",
        "role": "admin",
        "created_at": "2019-02-21 16:07:10",
        "updated_at": "2019-02-21 16:07:10"
    },
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1NTA4MjA2NzIsImV4cCI6MTU1MDgyNDI3MiwibmJmIjoxNTUwODIwNjcyLCJqdGkiOiJLTWpmQXU5WkhQVWt2R0JrIiwic3ViIjoxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.MRT8N-v6iXVE2L0j67xFza3PRjlUXvnTPIvFkRe3MuU"
}
```
