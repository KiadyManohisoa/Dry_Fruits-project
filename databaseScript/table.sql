CREATE TABLE cat_product(
   id_cat_product SERIAL,
   wording VARCHAR(20)  NOT NULL,
   PRIMARY KEY(id_cat_product),
   UNIQUE(wording)
);

CREATE TABLE cat_fruit(
   id_cat_fruit SERIAL,
   wording VARCHAR(25)  NOT NULL,
   PRIMARY KEY(id_cat_fruit),
   UNIQUE(wording)
);

CREATE TABLE Product(
   id_product SERIAL,
   image_link VARCHAR(50)  NOT NULL,
   description VARCHAR(75) ,
   creation_date TIMESTAMP DEFAULT NOW(),
   status SMALLINT DEFAULT 1,
   id_cat_product INTEGER NOT NULL,
   id_cat_fruit INTEGER NOT NULL,
   PRIMARY KEY(id_product),
   FOREIGN KEY(id_cat_product) REFERENCES cat_product(id_cat_product),
   FOREIGN KEY(id_cat_fruit) REFERENCES cat_fruit(id_cat_fruit)
);
ALTER TABLE product ALTER COLUMN image_link DROP NOT NULL;

CREATE TABLE stock(
   id_stock VARCHAR(50) DEFAULT ('STK') || LPAD(nextval('stock_sequence')::TEXT, 4, '0'),
   renewal_date TIMESTAMP DEFAULT NOW(),
   quantity_kg NUMERIC(9,2)  CHECK (quantity_kg >= 0),
   id_product INTEGER NOT NULL,
   PRIMARY KEY(id_stock),
   FOREIGN KEY(id_product) REFERENCES Product(id_product)
);

CREATE TABLE clients_account(
   id_client VARCHAR(20) DEFAULT ('CTL') || LPAD(nextval('client_account_sequence')::TEXT, 4, '0'),
   full_name VARCHAR(100)  NOT NULL,
   mail VARCHAR(50) ,
   password VARCHAR(50)  NOT NULL,
   phone_number VARCHAR(20)  NOT NULL,
   user_image TEXT,
   PRIMARY KEY(id_client)
);

CREATE TABLE administrators(
   id_admin SERIAL,
   pseudo_name VARCHAR(25) ,
   password VARCHAR(50)  NOT NULL,
   status CHAR(1) NOT NULL,
   PRIMARY KEY(id_admin),
   UNIQUE(pseudo_name)
);

CREATE TABLE delivery(
   id_delivery VARCHAR(50) DEFAULT ('DLV') || LPAD(nextval('delivery_sequence')::TEXT, 4, '0'),
   delivery_date TIMESTAMP DEFAULT now(),
   delivery_address VARCHAR(100)  NOT NULL,
   cost NUMERIC(10,2) CHECK (cost >=0),
   status SMALLINT NOT NULL,
   PRIMARY KEY(id_delivery)
);

CREATE TABLE client_favorite_products(
   id_client_favorite_products VARCHAR(50) DEFAULT ('FAV') || LPAD(nextval('client_favorite_products_sequence')::TEXT, 4, '0'),
   id_client VARCHAR(20)  NOT NULL,
   id_product INTEGER NOT NULL,
   PRIMARY KEY(id_client_favorite_products),
   FOREIGN KEY(id_client) REFERENCES clients_account(id_client),
   FOREIGN KEY(id_product) REFERENCES Product(id_product)
);

CREATE TABLE detail_movement(
   id_detail_movement VARCHAR(50) DEFAULT ('MVD') || LPAD(nextval('movement_detail_sequence')::TEXT, 4, '0'),
   movement_date TIMESTAMP DEFAULT NOW(),
   price NUMERIC(14,2)  CHECK (price >=0),
   reduction SMALLINT CHECK(reduction >=0),
   id_product INTEGER NOT NULL,
   PRIMARY KEY(id_detail_movement),
   FOREIGN KEY(id_product) REFERENCES Product(id_product)
);

CREATE TABLE wholesale_movement(
   id_wholesale_movement VARCHAR(50) DEFAULT ('MVW') || LPAD(nextval('movement_wholesale_sequence')::TEXT, 4, '0'),
   movement_date TIMESTAMP DEFAULT NOW(),
   price NUMERIC(14,2)  CHECK(price >=0),
   reduction SMALLINT CHECK(reduction >=0),
   id_product INTEGER NOT NULL,
   PRIMARY KEY(id_wholesale_movement),
   FOREIGN KEY(id_product) REFERENCES Product(id_product)
);

CREATE TABLE bulk_movement(
   id_bulk_movement VARCHAR(50) DEFAULT ('MVB') || LPAD(nextval('movement_bulk_sequence')::TEXT, 4, '0'),
   movement_date TIMESTAMP DEFAULT NOW(),
   price NUMERIC(14,2)  CHECK (price >=0),
   reduction SMALLINT CHECK(reduction >=0),
   id_product INTEGER NOT NULL,
   PRIMARY KEY(id_bulk_movement),
   FOREIGN KEY(id_product) REFERENCES Product(id_product)
);

CREATE TABLE charges_kg_movement(
   id_charges_movement VARCHAR(50) DEFAULT ('MVC') || LPAD(nextval('movement_charges_sequence')::TEXT, 4, '0'),
   movement_date TIMESTAMP DEFAULT NOW(),
   price NUMERIC(14,2)  CHECK(price >=0),
   id_product INTEGER NOT NULL,
   PRIMARY KEY(id_charges_movement),
   FOREIGN KEY(id_product) REFERENCES Product(id_product)
);

CREATE TABLE client_products_review(
   id_product_review VARCHAR(50) DEFAULT ('CPR') || LPAD(nextval('client_products_review_sequence')::TEXT, 4, '0'),
   stars SMALLINT CHECK (stars >=0 AND stars <= 5),
   comment TEXT,
   id_client VARCHAR(20)  NOT NULL,
   id_product INTEGER NOT NULL,
   review_date TIMESTAMP DEFAULT NOW(),
   PRIMARY KEY(id_product_review),
   FOREIGN KEY(id_client) REFERENCES clients_account(id_client),
   FOREIGN KEY(id_product) REFERENCES Product(id_product)
);

CREATE TABLE client_services_review(
   id_service_review VARCHAR(50) DEFAULT ('CSR') || LPAD(nextval('client_services_review_sequence')::TEXT, 4, '0'),
   stars SMALLINT CHECK (stars >=0 AND stars <= 5),
   comment TEXT,
   id_client VARCHAR(20)  NOT NULL,
   review_date TIMESTAMP DEFAULT NOW(),
   PRIMARY KEY(id_service_review),
   FOREIGN KEY(id_client) REFERENCES clients_account(id_client)
);

CREATE TABLE payement(
   id_payement VARCHAR(35) DEFAULT ('PMT') || LPAD(nextval('payement_sequence')::TEXT, 4, '0'),
   mode VARCHAR(15)  NOT NULL,
   phone_number VARCHAR(20) ,
   PRIMARY KEY(id_payement)
);

CREATE TABLE orders(
   id_order VARCHAR(35) DEFAULT ('ORD') || LPAD(nextval('ordered_product_sequence')::TEXT, 4, '0'),
   reduction SMALLINT CHECK (reduction >=0),
   ordering_date TIMESTAMP DEFAULT NOW(),
   id_payement VARCHAR(35)  NOT NULL,
   id_delivery VARCHAR(50)  NOT NULL,
   id_client VARCHAR(20)  NOT NULL,
   PRIMARY KEY(id_order),
   FOREIGN KEY(id_payement) REFERENCES payement(id_payement),
   FOREIGN KEY(id_delivery) REFERENCES delivery(id_delivery),
   FOREIGN KEY(id_client) REFERENCES clients_account(id_client)
);

CREATE TABLE products_ordered(
   id_product_ordered VARCHAR(75) DEFAULT ('PRO') || LPAD(nextval('products_ordered_sequence')::TEXT, 4, '0'),
   sales_type CHAR(1) NOT NULL,
   quantity NUMERIC(14,2) CHECK(quantity > 0),
   id_order VARCHAR(35)  NOT NULL,
   id_product INTEGER NOT NULL,
   PRIMARY KEY(id_product_ordered),
   FOREIGN KEY(id_order) REFERENCES orders(id_order),
   FOREIGN KEY(id_product) REFERENCES Product(id_product)
);
