# User Resources

```bash
POST update/customer
```
## Description
update the user as customer to edit the account
***
## Example

**Request**

```bash
http://127.0.0.1:8000/api/v1/update/customer
```
- Headers
    - ###### Authorization
        Bearer _your_api_token_ 
    - ###### Content-Type
        multipart/form-data
- Body
    - ###### name
    - ###### email
    - ###### phone
    - ###### image 

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
