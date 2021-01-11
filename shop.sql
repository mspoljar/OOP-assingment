drop database if exists shop;
create database shop default character set utf8;
#c:\xampp\mysql\bin\mysql.exe -uspoljo -pcaau.99F --default_character_set=utf8 < "D:\PP20\OOP\shop1\shop.sql"
use shop;

create table catalog(
    id                  int primary key auto_increment not null,
    product_name        varchar(50) not null,
    price               float(10,2) not null,
    sku                 int,
    quantity            int default(0),
    UNIQUE KEY          (sku) 
);