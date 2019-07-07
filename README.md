# placeToPayStoreApi
 
First, we need to create a DataBase called 'placetopay'. The following SQL will necessary.

```Sql
use placetopay;
CREATE TABLE orders (
    id INTEGER PRIMARY KEY AUTOINCREMENT, 
    customer_name varchar(80) NOT NULL, 
    customer_email varchar(120) NOT NULL,
    customer_mobile varchar(40) NOT NULL,
    status varchar(20) NOT NULL,
    created_at datetime NOT NULL,
    updated_at datetime NOT NULL);
    
CREATE TABLE placetopay.products (
    id INTEGER NOT NULL AUTO_INCREMENT,
    unique_code varchar(100) NOT NULL,
    name varchar(100) NOT NULL,
    description TEXT NOT NULL,
    url_pic varchar(200) NOT NULL,
    price FLOAT NOT NULL,
    CONSTRAINT products_PK PRIMARY KEY (id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8
COLLATE=utf8_general_ci;
```
So, after to clone the project enter into project directory and then run the php server.

php -S 0.0.0.0:8082 -t public
