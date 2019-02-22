# Simple Laravel E-Commerce API 

## Requirements
- Git
- Composer
- PHP 7 or latest
- PostgreSQL
***
## Installation
- Clone this repository using `git`
```bash
git clone git@github.com:alfikridj/ajaro-backend-test.git
```
- Open SQL Shell (pgsql)
```bash
create database ajaro_test;
```
- Edit database on your file env

- Add some table to database
```bash
php artisan migrate
```
- Install dependencies using <code>composer</code>
```bash
composer install
```
***
## Running
To run this API using this command
```bash
cd ajaro-backend-test
php artisan serve
```
***
## Endpoints

<b>User Resources</b>

- **[`POST` register/admin](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/users/POST_register_admin.md)**
- **[`POST` register/customer](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/users/POST_register_customer.md)**
- **[`POST` login](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/users/POST_login.md)**
- **[`GET` user](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/users/GET_user.md)**
- **[`POST` update/admin](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/users/POST_update_admin.md)**
- **[`POST` update/customer](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/users/POST_update_customer.md)**

<b>Customer Resources</b>

- **[`GET` customer](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/customers/GET_customer.md)**
- **[`POST` customer/name](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/customers/POST_customer_name.md)**
- **[`GET` customer/:id](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/customers/GET_customer_id.md)**
- **[`DELETE` customer/:id](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/customers/DELETE_customer_id.md)**

<b>Category Resources</b>

- **[`POST` category](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/categories/POST_category.md)**
- **[`GET` category](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/categories/GET_category.md)**
- **[`GET` category/:id](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/categories/GET_category_id.md)**
- **[`POST` category/name](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/categories/POST_category_name.md)**
- **[`POST` category/:id](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/categories/POST_category_id.md)**
- **[`DELETE` category/:id](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/categories/DELETE_category_id.md)**

<b>Product Resources</b>

- **[`POST` product](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/products/POST_product.md)**
- **[`GET` product](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/products/GET_product.md)**
- **[`GET` product/:id](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/products/GET_product_id.md)**
- **[`GET` product/category/:id](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/products/GET_product_category_id.md)**
- **[`POST` product/name](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/products/POST_product_name.md)**
- **[`POST` product/:id](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/products/POST_product_id.md)**
- **[`DELETE` product/:id](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/products/DELETE_product_id.md)**

<b>Address Resources</b>

- **[`POST` address](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/addresses/GET_address.md)**
- **[`GET` address](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/addresses/GET_address.md)**
- **[`GET` address/:id](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/addresses/GET_address_id.md)**
- **[`GET` address/user/:id](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/addresses/GET_address_user_id.md)**
- **[`POST` address/:id](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/addresses/POST_address_id.md)**
- **[`DELETE` address/:id](https://github.com/alfikridj/ajaro-backend-test/tree/master/api-documentation/endpoints/addresses/DELETE_customer_id.md)**

<b>Order Resources</b>

- **[`POST` order](https://github.com/alfikridj/ajaro-backend-test/api-documentation/master/endpoints/orders/POST_order.md)**
- **[`GET` order](https://github.com/alfikridj/ajaro-backend-test/api-documentation/master/endpoints/orders/GET_order.md)**
- **[`GET` order/:id](https://github.com/alfikridj/ajaro-backend-test/api-documentation/master/endpoints/orders/GET_order_id.md)**
- **[`GET` order/user/:id](https://github.com/alfikridj/ajaro-backend-test/api-documentation/master/endpoints/orders/GET_order_user_id.md)**
- **[`POST` order/:id/trackingnumber](https://github.com/alfikridj/ajaro-backend-test/api-documentation/master/endpoints/orders/POST_order_id_trackingnumber.md)**

<b>Order Detail Resources</b>

- **[`POST` order/detail](https://github.com/alfikridj/ajaro-backend-test/api-documentation/master/endpoints/orders/details/POST_order_detail.md)**
- **[`GET` order/detail/all](https://github.com/alfikridj/ajaro-backend-test/api-documentation/master/endpoints/orders/details/GET_order_detail_all.md)**
- **[`GET` order/detail/:id](https://github.com/alfikridj/ajaro-backend-test/api-documentation/master/endpoints/orders/details/GET_order_detail_id.md)**
- **[`GET` order/detail/order/:id](https://github.com/alfikridj/ajaro-backend-test/api-documentation/master/endpoints/orders/details/GET_order_detail_order_id.md)**
- **[`GET` order/detail/product/:id](https://github.com/alfikridj/ajaro-backend-test/api-documentation/master/endpoints/orders/details/GET_order_detail_product_id.md)**
