INSERT INTO cat_product (wording) VALUES
('dried'),
('candied');

INSERT INTO cat_fruit (wording) VALUES
('apple'),
('banana'),
('cherry'),
('date'),
('elderberry');

INSERT INTO Product (image_link, description, creation_date, status, id_cat_product, id_cat_fruit) VALUES
('link_to_image1.jpg', 'Dried apple slices', NOW() + INTERVAL '1 second', 1, 1, 1),
('link_to_image2.jpg', 'Dried banana chips', NOW() + INTERVAL '2 seconds', 1, 1, 2),
('link_to_image3.jpg', 'Dried cherries', NOW() + INTERVAL '3 seconds', 1, 1, 3),
('link_to_image4.jpg', 'Candied dates', NOW() + INTERVAL '4 seconds', 1, 2, 4),
('link_to_image5.jpg', 'Dried elderberries', NOW() + INTERVAL '5 seconds', 1, 1, 5);

INSERT INTO stock (renewal_date, quantity_kg, id_product) VALUES
(NOW() + INTERVAL '1 second', 100.00, 1),
(NOW() + INTERVAL '2 seconds', 150.50, 2),
(NOW() + INTERVAL '3 seconds', 200.75, 3),
(NOW() + INTERVAL '4 seconds', 120.30, 4),
(NOW() + INTERVAL '5 seconds', 180.45, 5);

INSERT INTO clients_account (full_name, mail, password, phone_number, user_image) VALUES
('Alice Johnson', 'alice@example.com', MD5('password1'), '123-456-7890', 'alice.jpg'),
('Bob Smith', 'bob@example.com', MD5('password2'), '098-765-4321', 'bob.jpg'),
('Charlie Brown', 'charlie@example.com', MD5('password3'), '555-555-5555', 'charlie.jpg'),
('Diana Prince', 'diana@example.com', MD5('password4'), '444-444-4444', 'diana.jpg'),
('Eve Adams', 'eve@example.com', MD5('password5'), '333-333-3333', 'eve.jpg');

INSERT INTO administrators (pseudo_name, password, status) VALUES
('admin1', MD5('admin1'), 'A'),
('admin2', MD5('admin2'), 'A'),
('admin3', MD5('admin3'), 'D');

INSERT INTO client_favorite_products (id_client, id_product) VALUES
('CTL0001', 1),
('CTL0001', 2),
('CTL0002', 3),
('CTL0002', 4),
('CTL0003', 5);

INSERT INTO detail_movement (movement_date, price, reduction, id_product) VALUES
(NOW() + INTERVAL '1 second', 2500, 0, 1),
(NOW() + INTERVAL '2 seconds', 3000, 10, 2),
(NOW() + INTERVAL '3 seconds', 3500, 5, 3),
(NOW() + INTERVAL '4 seconds', 2200, 20, 4),
(NOW() + INTERVAL '5 seconds', 3800, 25, 5);

INSERT INTO wholesale_movement (movement_date, price, reduction, id_product) VALUES
(NOW() + INTERVAL '1 second', 1500, 0, 1),
(NOW() + INTERVAL '2 seconds', 3000, 10, 2),
(NOW() + INTERVAL '3 seconds', 4000, 5, 3),
(NOW() + INTERVAL '4 seconds', 2500, 20, 4),
(NOW() + INTERVAL '5 seconds', 5000, 25, 5);

INSERT INTO bulk_movement (movement_date, price, reduction, id_product) VALUES
(NOW() + INTERVAL '1 second', 5000, 0, 1),
(NOW() + INTERVAL '2 seconds', 3000, 10, 2),
(NOW() + INTERVAL '3 seconds', 7000, 5, 3),
(NOW() + INTERVAL '4 seconds', 4000, 20, 4),
(NOW() + INTERVAL '5 seconds', 6000, 15, 5);

INSERT INTO charges_kg_movement (movement_date, price, id_product) VALUES
(NOW() + INTERVAL '1 second', 2000, 1),
(NOW() + INTERVAL '2 seconds', 1500, 2),
(NOW() + INTERVAL '3 seconds', 2500, 3),
(NOW() + INTERVAL '4 seconds', 3000, 4),
(NOW() + INTERVAL '5 seconds', 2200, 5);

INSERT INTO delivery (delivery_date, delivery_address, cost, status) VALUES
(NOW() + INTERVAL '1 second', '123 Main Street', 50.00, 1),
(NOW() + INTERVAL '2 seconds', '456 Elm Street', 75.00, 0),
(NOW() + INTERVAL '3 seconds', '789 Oak Street', 100.00, 0);

INSERT INTO delivery (delivery_date, delivery_address, cost, status) VALUES
(NOW() + INTERVAL '1 DAY' + INTERVAL '1 second', '123 Main Street', 50.00, 1),
(NOW() + INTERVAL '1 DAY' + INTERVAL '2 seconds', '456 Elm Street', 75.00, 0),
(NOW() + INTERVAL '1 DAY' + INTERVAL '3 seconds', '789 Oak Street', 100.00, 0);

INSERT INTO payement (mode, phone_number) VALUES
('PayPal', ''),
('Mobile Money', '20-2233-2311-02'),
('Mobile Money', '20-2230-2311-03');

INSERT INTO payement (mode, phone_number) VALUES
('PayPal', ''),
('Mobile Money', '20-2233-2311-02'),
('Mobile Money', '20-2230-2311-03');

INSERT INTO orders (reduction, ordering_date, id_client, id_delivery, id_payement) VALUES
(10, NOW() + INTERVAL '1 second', 'CTL0001', 'DLV0001', 'PMT0001'),
(15, NOW() + INTERVAL '2 seconds', 'CTL0002', 'DLV0002', 'PMT0002'),
(5, NOW() + INTERVAL '3 seconds', 'CTL0003', 'DLV0003', 'PMT0003');

INSERT INTO orders (reduction, ordering_date, id_client, id_delivery, id_payement) VALUES
(0, NOW() + INTERVAL '1 DAY' + INTERVAL '1 second', 'CTL0001', 'DLV0004', 'PMT0004'),
(10, NOW() + INTERVAL '1 DAY' + INTERVAL '2 seconds', 'CTL0002', 'DLV0005', 'PMT0005'),
(20, NOW() + INTERVAL '1 DAY' + INTERVAL '3 seconds', 'CTL0003', 'DLV0006', 'PMT0006');

INSERT INTO products_ordered (sales_type, quantity, id_order, id_product) VALUES
('D', 100, 'ORD0001', 1),
('W', 10, 'ORD0002', 2),
('B', 5, 'ORD0003', 3),
('D', 100, 'ORD0001', 1);

INSERT INTO products_ordered (sales_type, quantity, id_order, id_product) VALUES
('W', 10, 'ORD0004', 1),
('D', 100, 'ORD0005', 1),
('B', 15, 'ORD0006', 2);

INSERT INTO client_products_review (review_date, stars, comment, id_client, id_product) VALUES
(NOW() + INTERVAL '1 second', 4, 'It is really good!', 'CTL0001', 1),
(NOW() + INTERVAL '2 seconds', 3, 'It is really good!', 'CTL0003', 1),
(NOW() + INTERVAL '3 seconds', 5, 'It is really awesome!', 'CTL0002', 1);

INSERT INTO client_products_review (review_date, stars, comment, id_client, id_product) VALUES
(NOW() + INTERVAL '1 second', 3, 'It is really good!', 'CTL0004', 1),
(NOW() + INTERVAL '2 seconds', 5, 'It is really good!', 'CTL0005', 1);

INSERT INTO client_services_review (stars,comment,id_client) VALUES 
(4, 'Great product!','CTL0001'),
(2, 'A little bit of delay!','CTL0001'),
(5, 'So happy for my order','CTL0001'),
(1, 'Too late','CTL0001'),
(5, 'I recommand it','CTL0001');

