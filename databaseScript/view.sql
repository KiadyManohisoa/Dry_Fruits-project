--produit avec nom_fruit et nom_categorie
    CREATE OR REPLACE VIEW v_product_detail AS 
        SELECT product.id_product, (cat_product.wording || ' ' || cat_fruit.wording) as product_name
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

-- CREATE OR REPLACE VIEW v_delivery_info AS
-- SELECT 
--     l.id_delivery AS delivery_id,
--     l.delivery_date AS delivery_date,
--     l.delivery_address AS delivery_address,
--     l.cost AS delivery_cost,
--     l.status AS delivery_status,
--     o.id_order AS order_id,
--     o.reduction AS order_reduction,
--     o.ordering_date AS order_date,
--     cc.full_name AS client_full_name,
--     cc.mail AS client_email,
--     cc.phone_number AS client_phone_number,
--     po.sales_type AS product_ordered_sales_type,
--     po.quantity AS product_ordered_quantity,
--     p.id_product AS product_id,
--     p.image_link AS product_image_link,
--     p.description AS product_description,
--     p.creation_date AS product_creation_date,
--     prt_c.product_category AS product_category,
--     prt_c.fruit_category AS fruit_category
-- FROM delivery l
-- LEFT JOIN orders o ON l.id_order = o.id_order
-- LEFT JOIN products_ordered po ON o.id_order = po.id_order
-- LEFT JOIN Product p ON po.id_product = p.id_product
-- LEFT JOIN Product_Categories prt_c ON p.id_product = prt_c.product_id
-- LEFT JOIN clients_account cc ON o.id_client = cc.id_client;

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
