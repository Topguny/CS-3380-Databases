DROP TABLE IF EXISTS order_item;
DROP TABLE IF EXISTS `order`;
DROP TABLE IF EXISTS person;
DROP TABLE IF EXISTS product;

CREATE TABLE `person`(
	Name varchar(50),
	person_id int,
	PRIMARY KEY(`person_id`)
);

CREATE TABLE `product`(
	Name varchar(50),
	sku varchar(50),
	product_id int,
	PRIMARY KEY(`product_id`)
);

CREATE TABLE `order`(
	order_number int,
	order_date date,
	order_id int,
	PRIMARY KEY(`order_id`),
	person_person_id int,
	FOREIGN KEY(`person_person_id`) REFERENCES person(person_id)
);

CREATE TABLE `order_item`(
	quantity int,
	PRIMARY KEY(`quantity`),
	product_product_id int,
	FOREIGN KEY(`product_product_id`) REFERENCES product(product_id),
	order_order_id int,
	FOREIGN KEY(`order_order_id`) REFERENCES `order`(order_id)
	
);