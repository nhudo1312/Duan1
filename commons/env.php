<?php 

// Biến môi trường, dùng chung toàn hệ thống
// Khai báo dưới dạng HẰNG SỐ để không phải dùng $GLOBALS

define('BASE_URL'       , 'http://localhost/duan1/website-vdk/');
//Duong dan cho phan ADMIN
define('BASE_URL_ADMIN'       , 'http://localhost/duan1/website-vdk/admin/');

define('DB_HOST'    , 'localhost');
define('DB_PORT'    , 3306);
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME'    , 'website_vdk');  // Tên database

define('PATH_ROOT'    , __DIR__ . '/../');
