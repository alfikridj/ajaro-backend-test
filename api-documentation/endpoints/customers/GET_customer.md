# Customer Resources

```bash
GET customer
```
## Description
show all list of customer
***
## Example

**Request**

```bash
http://127.0.0.1:8000/api/v1/customer
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
           "name": "John Paris",
           "email": "jparis@email.com",
           "email_verified_at": null,
           "phone": "087238374712",
           "image": "https://github.com/identicons/lF.png",
           "role": "customer",
           "created_at": "2019-02-21 16:07:57",
           "updated_at": "2019-02-21 16:07:57"
        },
    ]
}
```
