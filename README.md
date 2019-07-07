# placeToPayStoreApi
 
Summary on video: https://youtu.be/pSseQnbQoyg
 
First, we need to create a DataBase called 'placetopay'. The following SQL will necessary.

```Sql
CREATE DATABASE placetopay; 
USE placetopay;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(80) DEFAULT NULL,
  `customer_email` varchar(120) DEFAULT NULL,
  `customer_mobile` varchar(40) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `request_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
    
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_code` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `url_pic` varchar(200) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8

INSERT INTO products (unique_code, name, description, url_pic, price) VALUES ('324354651', 'The Joy of PHP: A Beginner\'s Guide to Programming Interactive Web Applications with PHP and mySQL', 'Author – Alan Forbes, Latest Edition – Fifth Edition, Publisher – Plum Island Publishing LLC', 'https://hackr.io/blog/wp-content/uploads/2019/01/PHP-Beginners-Guide-226x300.jpg', 18.95);
```
By default, the current database connection info is:
```PHP
    'db' => [
        'adapters' => [
            'Mysql' => [
                'database' => 'placetopay',
                'driver' => 'PDO_Mysql',
                'hostname' => 'localhost',
                'username' => 'root',
                'password' => 'root',
                'port' => '5432',
            ],
        ],
    ],
```
Please, consider to modify this file if you requiere */placeToPayStoreApi/config/autoload/local.php*

So, after to clone the project enter into project directory and then run the php server.

php -S 0.0.0.0:8082 -t public
