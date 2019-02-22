# Customer Resources

```bash
DELETE customer/:id
```
## Description
delete customer with id of customer
***
## Example

**Request**

```bash
http://127.0.0.1:8000/api/v1/customer/1
```
- Headers
    - ###### Authorization
        Bearer _your_api_token_

**Response**

```bash
{
    "message": "customer id 1 successfully removed"
}
```
