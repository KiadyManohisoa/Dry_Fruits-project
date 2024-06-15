INSERT INTO cat_product (wording) VALUES
('dried'),
('candied');

INSERT INTO cat_fruit (wording) VALUES
('apple'),
('banana'),
('cherry'),
('date'),
('elderberry');

INSERT INTO Product (image_link, description, creation_date, status,id_cat_product, id_cat_fruit) VALUES
('link_to_image1.jpg', 'Dried apple slices', NOW(),1, 1, 1),
('link_to_image2.jpg', 'Candied banana chips', NOW(),1, 2, 2),
('link_to_image3.jpg', 'Dried cherries', NOW(), 1,1, 3),
('link_to_image4.jpg', 'Candied dates', NOW(), 1,2, 4),
('link_to_image5.jpg', 'Dried elderberries', NOW(),1, 1, 5);

INSERT INTO stock (renewal_date, quantity_kg, id_product) VALUES
(NOW(), 100.00, 1),
(NOW(), 150.50, 2),
(NOW(), 200.75, 3),
(NOW(), 120.30, 4),
(NOW(), 180.45, 5);

INSERT INTO clients_account (full_name, mail, password, phone_number, user_image) VALUES
('Alice Johnson', 'alice@example.com', 'password1', '123-456-7890', 'alice.jpg'),
('Bob Smith', 'bob@example.com', 'password2', '098-765-4321', 'bob.jpg'),
('Charlie Brown', 'charlie@example.com', 'password3', '555-555-5555', 'charlie.jpg'),
('Diana Prince', 'diana@example.com', 'password4', '444-444-4444', 'diana.jpg'),
('Eve Adams', 'eve@example.com', 'password5', '333-333-3333', 'eve.jpg');

INSERT INTO administrators (pseudo_name, password) VALUES
('admin1', 'adminpassword1'),
('admin2', 'adminpassword2'),
('admin3', 'adminpassword3');

INSERT INTO client_favorite_products (id_client, id_product) VALUES
('CTL0001', 1),
('CTL0001', 2),
('CTL0002', 3),
('CTL0002', 4),
('CTL0003', 5);

INSERT INTO detail_movement (movement_date, price, reduction, id_product) VALUES
(NOW(), 2500, 0, 1),
(NOW(), 3000, 10, 2),
(NOW(), 3500, 5, 3),
(NOW(), 2200, 20, 4),
(NOW(), 3800, 25, 5);

INSERT INTO wholesale_movement (movement_date, price, reduction, id_product) VALUES
(NOW(), 1500, 0, 1),
(NOW(), 3000, 10, 2),
(NOW(), 4000, 5, 3),
(NOW(), 2500, 20, 4),
(NOW(), 5000, 25, 5);

INSERT INTO bulk_movement (movement_date, price, reduction, id_product) VALUES
(NOW(), 5000, 0, 1),
(NOW(), 3000, 10, 2),
(NOW(), 7000, 5, 3),
(NOW(), 4000, 20, 4),
(NOW(), 6000, 15, 5);

INSERT INTO charges_kg_movement (movement_date, price, id_product) VALUES
(NOW(), 2000, 1),
(NOW(), 1500, 2),
(NOW(), 2500, 3),
(NOW(), 3000, 4),
(NOW(), 2200, 5);

INSERT INTO orders (reduction, ordering_date, id_client) VALUES
(10, NOW(), 'CTL0001'),
(15, NOW(), 'CTL0002'),
(5, NOW(), 'CTL0003');
INSERT INTO orders (reduction, ordering_date, id_client) VALUES
(0, NOW() + INTERVAL '1 DAY', 'CTL0001'),
(10, NOW() + INTERVAL '1 DAY', 'CTL0002'),
(20, NOW() + INTERVAL '1 DAY', 'CTL0003');


INSERT INTO delivery (delivery_date, delivery_address, cost, status, id_order) VALUES
(NOW(), '123 Main Street', 50.00, 1, 'ORD0001'),
(NOW(), '456 Elm Street', 75.00, 0, 'ORD0002'),
(NOW(), '789 Oak Street', 100.00, 0, 'ORD0003');

INSERT INTO products_ordered (sales_type, quantity, id_order, id_product) VALUES
('D', 100, 'ORD0001', 1),
('W', 10, 'ORD0002', 2),
('B', 5, 'ORD0003', 3),
('D', 100, 'ORD0001', 1);
INSERT INTO products_ordered (sales_type, quantity, id_order, id_product) VALUES
('W', 10, 'ORD0004', 1),
('D', 100, 'ORD0005', 1),
('B', 15, 'ORD0006', 2);