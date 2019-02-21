# User Resources

```bash
POST user as admin
```

## Example

**Request**

```bash
https://127.0.0.1:8000/api/v1/register/admin
```

**Return shortened for example purpose**

```bash
{
    "data": {
        "name": "John Paris",
        "email": "jparis@email.com",
        "phone": "087238374712",
        "image": "https://github.com/identicons/ri.png",
        "role": "customer",
        "updated_at": "2019-02-21 16:07:57",
        "created_at": "2019-02-21 16:07:57",
        "id": 1
    },
    "message": "login here http://127.0.0.1:8000/api/v1/login"
}
```
