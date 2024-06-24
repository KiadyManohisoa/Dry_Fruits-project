--produit avec nom_fruit et nom_categorie
    CREATE OR REPLACE VIEW v_product_detail AS 
        SELECT product.id_product, (cat_product.wording || ' ' || cat_fruit.wording) as product_name, product.image_link
            FROM product LEFT JOIN cat_product ON product.id_cat_product=cat_product.id_cat_product
            LEFT JOIN cat_fruit ON product.id_cat_fruit=cat_fruit.id_cat_fruit;

--alliage des informations des produits
CREATE OR REPLACE VIEW v_product_categories AS
SELECT 
    p.id_product AS product_id,
    p.image_link AS product_image_link,
    p.description AS product_description,
    p.creation_date AS product_creation_date,
    p.status AS product_status,
    cp.wording AS product_category,
    cf.wording AS fruit_category
FROM Product p
INNER JOIN cat_product cp ON p.id_cat_product = cp.id_cat_product
INNER JOIN cat_fruit cf ON p.id_cat_fruit = cf.id_cat_fruit;

--calcul du stock et vente pour chaque produit
CREATE OR REPLACE VIEW v_product_stock AS
SELECT 
    pc.product_id,
    s.quantity_kg AS stock_quantity,
    COALESCE(po.order_quantity,0) AS order_quantity
FROM v_product_categories pc
LEFT JOIN (select id_product, COALESCE(sum(quantity_kg),0) as quantity_kg from stock group by (id_product)) s ON pc.product_id = s.id_product
LEFT JOIN (select po.id_product, COALESCE(sum(po.order_quantity),0) as order_quantity from 
		   (select id_product, CASE 
        WHEN sales_type = 'D' THEN quantity * 0.1
        WHEN sales_type = 'W' THEN quantity * 0.1
        WHEN sales_type = 'B' THEN quantity
        ELSE 0
    END AS order_quantity from products_ordered) as po group by (po.id_product)) po ON pc.product_id = po.id_product;


--calcul du stock et vente pour chaque produit
CREATE OR REPLACE VIEW v_product_stock_by_day AS
SELECT 
    pc.product_id,
    s.quantity_kg AS stock_quantity,
    COALESCE(po.order_quantity,0) AS order_quantity
FROM v_product_categories pc
LEFT JOIN (select id_product, COALESCE(sum(quantity_kg),0) as quantity_kg from stock where DATE(renewal_date) <= '2024-06-24' group by (id_product)) s ON pc.product_id = s.id_product
LEFT JOIN (select po.id_product, COALESCE(sum(po.order_quantity),0) as order_quantity from 
		   (select id_product, CASE 
        WHEN sales_type = 'D' THEN quantity * 0.1
        WHEN sales_type = 'W' THEN quantity * 0.1
        WHEN sales_type = 'B' THEN quantity
        ELSE 0
    END AS order_quantity from products_ordered where id_order in (select id_order from orders where DATE(ordering_date) <= '2024-06-24')) as po group by (po.id_product)) po ON pc.product_id = po.id_product;

--configuration finale de chaque produit 
CREATE OR REPLACE VIEW v_product_configuration AS
SELECT 
    pc.product_id,
    pc.product_image_link,
    pc.product_description,
    pc.product_creation_date,
    pc.product_category,
    pc.fruit_category,
    s.stock_quantity - s.order_quantity AS stock_quantity,
    d.id_detail_movement,
    d.movement_date as date_detail_movement,
    d.price AS detail_price,
    d.reduction AS detail_reduction,
    c.id_charges_movement,
    c.price AS charges_price,
    w.id_wholesale_movement,
    w.price AS wholesale_price,
    w.movement_date AS wholesale_movement_date,
    w.reduction AS wholesale_reduction,
    b.id_bulk_movement,
    b.price AS bulk_price,
    b.movement_date AS bulk_movement_date,
    b.reduction AS bulk_reduction
FROM v_product_categories pc
LEFT JOIN v_product_stock s ON pc.product_id = s.product_id
LEFT JOIN detail_movement d ON pc.product_id = d.id_product
LEFT JOIN charges_kg_movement c ON pc.product_id = c.id_product
LEFT JOIN wholesale_movement w ON pc.product_id = w.id_product
LEFT JOIN bulk_movement b ON pc.product_id = b.id_product
WHERE pc.product_status = 1
AND d.movement_date = (SELECT MAX(movement_date) FROM detail_movement WHERE detail_movement.id_product = pc.product_id)
AND w.movement_date = (SELECT MAX(movement_date) FROM wholesale_movement WHERE wholesale_movement.id_product = pc.product_id)
AND c.movement_date = (SELECT MAX(movement_date) FROM charges_kg_movement WHERE charges_kg_movement.id_product = pc.product_id)
AND b.movement_date = (SELECT MAX(movement_date) FROM bulk_movement WHERE bulk_movement.id_product = pc.product_id);

/*Detail des produits*/
-- select product_category,fruit_category,stock_quantity,charges_price,detail_price,wholesale_price,bulk_price from v_product_configuration;

CREATE OR REPLACE VIEW v_delivery_info AS
SELECT
    l.id_delivery AS delivery_id,
    l.delivery_date AS delivery_date,
    l.delivery_address AS delivery_address,
    l.cost AS delivery_cost,
    l.status AS delivery_status,
    o.id_client AS id_client,
    o.id_order AS order_id,
    o.reduction AS order_reduction,
    o.ordering_date AS order_date,
    cc.full_name AS client_full_name,
    cc.mail AS client_email,
    cc.phone_number AS client_phone_number,
    po.sales_type AS product_ordered_sales_type,
    po.quantity AS product_ordered_quantity,
    p.id_product AS product_id,
    p.image_link AS product_image_link,
    p.description AS product_description,
    p.creation_date AS product_creation_date,
    prt_c.product_category AS product_category,
    prt_c.fruit_category AS fruit_category
FROM delivery l
LEFT JOIN orders o ON l.id_delivery = o.id_delivery
LEFT JOIN products_ordered po ON o.id_order = po.id_order
LEFT JOIN Product p ON po.id_product = p.id_product
LEFT JOIN v_product_categories prt_c ON p.id_product = prt_c.product_id
LEFT JOIN clients_account cc ON o.id_client = cc.id_client;

-- Commande client 
CREATE or replace VIEW v_client_orders as 
select 
clients_account.id_client as id_client , 
orders.id_order as id_order ,
orders.reduction as reduction ,
orders.ordering_date as ordering_date ,
payement.mode as payement_mode , 
payement.phone_number as phone_number , 
delivery.delivery_date as delivery_date , 
delivery.delivery_address as delivery_address , 
delivery.cost as delivery_cost ,
delivery.status as delivery_status
from 
orders join payement on orders.id_payement = payement.id_payement 
join delivery on orders.id_delivery = delivery.id_delivery 
join clients_account on orders.id_client = clients_account.id_client ;


--View Detail_livraison_Commande_Client*/
CREATE OR REPLACE VIEW v_order_delivery_info AS
SELECT 
    l.id_delivery AS delivery_id,
    l.delivery_date AS delivery_date,
    l.delivery_address AS delivery_address,
    l.cost AS delivery_cost,
    l.status AS delivery_status,
    o.id_order AS order_id,
    o.reduction AS order_reduction,
    o.ordering_date AS order_date,
    cc.id_client AS client_id,  
    cc.full_name AS client_full_name,
    cc.mail AS client_email,
    cc.phone_number AS client_phone_number,
    po.sales_type AS product_ordered_sales_type,
    po.quantity AS product_ordered_quantity,
    p.id_product AS product_id,
    p.image_link AS product_image_link,
    p.description AS product_description,
    p.creation_date AS product_creation_date,
    prt_c.product_name AS product_name
FROM delivery l
LEFT JOIN orders o ON l.id_delivery = o.id_delivery
LEFT JOIN products_ordered po ON o.id_order = po.id_order
LEFT JOIN product p ON po.id_product = p.id_product
LEFT JOIN v_product_detail prt_c ON p.id_product = prt_c.id_product
LEFT JOIN clients_account cc ON o.id_client = cc.id_client;


-- /*Produit livraison en attente*/
-- SELECT 
--     delivery_date, 
--     delivery_address 
-- FROM 
--     v_delivery_info 
-- WHERE 
--     delivery_status = 0;
-- /*Produit livrer*/
-- SELECT 
--     delivery_date, 
--     delivery_address 
-- FROM 
--     v_delivery_info 
-- WHERE 
--     delivery_status = 1;

-- /*Livraison Info*/
-- SELECT 
--     cc.full_name AS client_full_name,
--     l.delivery_address AS delivery_address,
--     p.description AS product_description,
--     l.status AS delivery_status
-- FROM 
--     delivery l
-- INNER JOIN 
--     orders o ON l.id_order = o.id_order
-- INNER JOIN 
--     clients_account cc ON o.id_client = cc.id_client
-- INNER JOIN 
--     products_ordered po ON o.id_order = po.id_order
-- INNER JOIN 
--     Product p ON po.id_product = p.id_product
-- WHERE 
--     EXTRACT(MONTH FROM l.delivery_date) = 6 
--     AND EXTRACT(YEAR FROM l.delivery_date) = 2023;

CREATE or REPLACE VIEW v_product_comment as 
SELECT clients_account.full_name as client, client_products_review.* 
FROM client_products_review join clients_account on 
client_products_review.id_client = clients_account.id_client ; 


CREATE or REPLACE VIEW v_services_comment as 
SELECT clients_account.full_name as client, client_services_review.* 
FROM client_services_review join clients_account on 
client_services_review.id_client = clients_account.id_client ; 


-- sales Mensuels

CREATE OR REPLACE VIEW v_sale_bulk AS 
SELECT DISTINCT ON (orders.ordering_date,orders.id_order)
orders.id_order,orders.reduction order_reduction,orders.ordering_date,bulk_movement.movement_date,bulk_movement.price,bulk_movement.reduction,products_ordered.id_product,products_ordered.quantity,products_ordered.sales_type, products_ordered.id_product_ordered
FROM products_ordered 
JOIN orders ON products_ordered.id_order= orders.id_order
JOIN bulk_movement ON products_ordered.id_product = bulk_movement.id_product   WHERE products_ordered.sales_type='B' AND orders.ordering_date>=bulk_movement.movement_date ORDER BY orders.ordering_date,orders.id_order,bulk_movement ASC;

CREATE OR REPLACE VIEW v_sale_wholesale AS 
SELECT DISTINCT ON (orders.ordering_date,orders.id_order)
orders.id_order,orders.reduction order_reduction,orders.ordering_date,wholesale_movement.movement_date,wholesale_movement.price,wholesale_movement.reduction,products_ordered.id_product,products_ordered.quantity,products_ordered.sales_type, products_ordered.id_product_ordered
FROM products_ordered 
JOIN orders ON products_ordered.id_order= orders.id_order
JOIN wholesale_movement ON products_ordered.id_product = wholesale_movement.id_product   WHERE products_ordered.sales_type='W' AND orders.ordering_date>=wholesale_movement.movement_date ORDER BY orders.ordering_date,orders.id_order,wholesale_movement ASC;

CREATE OR REPLACE VIEW v_sale_detail AS 
SELECT DISTINCT ON (orders.ordering_date,orders.id_order)
orders.id_order,orders.reduction order_reduction,orders.ordering_date,detail_movement.movement_date,detail_movement.price,detail_movement.reduction,products_ordered.id_product,products_ordered.quantity,products_ordered.sales_type, products_ordered.id_product_ordered
FROM products_ordered 
JOIN orders ON products_ordered.id_order= orders.id_order
JOIN detail_movement ON products_ordered.id_product = detail_movement.id_product   WHERE products_ordered.sales_type='D' AND orders.ordering_date>=detail_movement.movement_date ORDER BY orders.ordering_date,orders.id_order,detail_movement ASC;

CREATE OR REPLACE VIEW v_sales AS 
SELECT * FROM v_sale_wholesale UNION ALL SELECT * FROM v_sale_bulk UNION ALL SELECT * FROM v_sale_detail;

CREATE OR REPLACE VIEW v_sales_price AS 
SELECT *,( price-(reduction*price/100))*quantity price_final FROM v_sales;

CREATE OR REPLACE VIEW v_sales_price_sum AS 
SELECT id_order, SUM(price_final) FROM v_sales_price GROUP BY id_order;

CREATE OR REPLACE VIEW v_sales_final AS 
SELECT DISTINCT ON (v_sales_price_sum.id_order,orders.id_order)v_sales_price_sum.id_order,orders.ordering_date,orders.reduction,v_sales_price_sum.sum total,orders.id_client  FROM v_sales_price_sum
JOIN orders ON v_sales_price_sum.id_order = orders.id_order;



-- Dépenses mensuels       
create or replace view v_stock_charges as select id_product, sum(stock_out) as quantity_kg, ordering_date as renewal_date from (select po.id_product , case 
when po.sales_type IN ('W','D') then po.quantity*0.1
else po.quantity END as stock_out
,o.ordering_date from products_ordered po join orders o on po.id_order=o.id_order) as stock_out group by id_product, ordering_date;                        

CREATE OR REPLACE VIEW v_temporary_stock_dep1 AS
SELECT charges_kg_movement.movement_date,stock.renewal_date,charges_kg_movement.price,charges_kg_movement.id_product,stock.quantity_kg FROM charges_kg_movement JOIN v_stock_charges as stock ON charges_kg_movement.id_product = stock.id_product;

CREATE OR REPLACE VIEW v_temporary_stock_dep2 AS
SELECT * FROM v_temporary_stock_dep1 WHERE DATE(movement_date) <= DATE(renewal_date);

CREATE OR REPLACE VIEW v_charges AS
SELECT DISTINCT ON (renewal_date,id_product)*
FROM v_temporary_stock_dep2
ORDER BY renewal_date,id_product,movement_date ASC;

