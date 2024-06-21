
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

