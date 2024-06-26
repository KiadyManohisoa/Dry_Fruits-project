--production situation report by date 

CREATE OR REPLACE FUNCTION get_Balance_By_Date(date_Search DATE,id_cat_produit INTEGER) 
    RETURNS TABLE (
        id_product  INTEGER,
        product_name TEXT,
        stock NUMERIC(14,2),
        out_production NUMERIC(14,2),
        sales NUMERIC(14,2),
        charges NUMERIC(14,2),
        sales_amount NUMERIC(14,2),
        results NUMERIC(14,2)
    ) AS $$
    BEGIN
        RETURN QUERY EXECUTE 'with v_product_stock_by_day as (
            SELECT 
                pc.product_id,
                COALESCE(s.quantity_kg,0) - COALESCE(pob.order_quantity,0) AS stock_quantity,
                COALESCE(po.order_quantity,0) AS order_quantity
            FROM v_product_categories pc
            LEFT JOIN (select id_product, COALESCE(sum(quantity_kg),0) as quantity_kg from stock where DATE(renewal_date) <= ''' || date_Search || ''' group by (id_product)) s ON pc.product_id = s.id_product
            LEFT JOIN (select po.id_product, COALESCE(sum(po.order_quantity),0) as order_quantity from 
            		   (select id_product, CASE 
                    WHEN sales_type = ''D'' THEN quantity * 0.1
                    WHEN sales_type = ''W'' THEN quantity * 0.1
                    WHEN sales_type = ''B'' THEN quantity
                    ELSE 0
                END AS order_quantity from products_ordered where id_order in (select id_order from orders where DATE(ordering_date) = ''' || date_Search || ''')) as po group by (po.id_product)) po ON pc.product_id = po.id_product
            LEFT JOIN (select pob.id_product, COALESCE(sum(pob.order_quantity),0) as order_quantity from 
            		   (select id_product, CASE 
                    WHEN sales_type = ''D'' THEN quantity * 0.1
                    WHEN sales_type = ''W'' THEN quantity * 0.1
                    WHEN sales_type = ''B'' THEN quantity
                    ELSE 0
                END AS order_quantity from products_ordered where id_order in (select id_order from orders where DATE(ordering_date) < ''' || date_Search || ''')) as pob group by (pob.id_product)) pob ON pc.product_id = pob.id_product
            ) 
        SELECT 
        s.id_product, 
        vpd.product_name, 
        COALESCE(s.stock_quantity, 0) - COALESCE(s.order_quantity, 0) AS stock, 
        COALESCE(s.order_quantity, 0) AS out_production, 
        COALESCE(sales.number_package, 0) AS sales, 
        charges.price * COALESCE(s.order_quantity, 0) AS charges, 
        COALESCE(sales_amount.total_price, 0) AS sales_amount,
        COALESCE(sales_amount.total_price, 0) - charges.price * COALESCE(s.order_quantity, 0) AS results
    FROM (
        SELECT 
            cp.id_cat_product, 
            p.id_product,
            s.stock_quantity,
            s.order_quantity
        FROM cat_product cp
        JOIN Product p ON cp.id_cat_product = p.id_cat_product
        JOIN v_product_stock_by_day s ON p.id_product = s.product_id
        WHERE cp.id_cat_product = ''' || id_cat_produit || '''
    ) s 
    LEFT JOIN v_product_detail vpd ON s.id_product = vpd.id_product
    LEFT JOIN (
        SELECT
            cp.id_cat_product,
            p.id_product, 
            COALESCE(SUM(
                CASE 
                    WHEN po.sales_type IN (''D'',''W'') THEN po.quantity * 0.1
                    WHEN po.sales_type =''B'' THEN po.quantity
                    ELSE 0 
                END
            ), 0) AS total_quantity
        FROM orders o
        JOIN products_ordered po ON o.id_order = po.id_order
        JOIN Product p ON po.id_product = p.id_product
        JOIN cat_product cp ON p.id_cat_product = cp.id_cat_product
        WHERE DATE(o.ordering_date) = ''' || date_Search || '''
            AND cp.id_cat_product = ''' || id_cat_produit || '''
        GROUP BY cp.id_cat_product, p.id_product
    ) o ON s.id_cat_product = o.id_cat_product AND s.id_product = o.id_product
    LEFT JOIN (
        SELECT
            cp.id_cat_product,
            p.id_product,
            SUM(
                CASE 
                    WHEN po.sales_type = ''D'' THEN po.quantity
                    WHEN po.sales_type = ''W'' THEN po.quantity
                    ELSE 0
                END
            ) AS number_package
        FROM orders o
        JOIN products_ordered po ON o.id_order = po.id_order
        JOIN Product p ON po.id_product = p.id_product
        JOIN cat_product cp ON p.id_cat_product = cp.id_cat_product
        WHERE cp.id_cat_product = ''' || id_cat_produit || '''
            AND DATE(o.ordering_date) = ''' || date_Search || '''
            AND (po.sales_type = ''W'' OR po.sales_type = ''D'')
        GROUP BY cp.id_cat_product, p.id_product
    ) sales ON s.id_cat_product = sales.id_cat_product AND s.id_product = sales.id_product
    LEFT JOIN (
    SELECT cp.id_cat_product,p.id_product,
	ckm.price
    FROM (select charges_kg_movement.* from charges_kg_movement join (select id_product, max (movement_date) as movement_date from charges_kg_movement WHERE DATE(movement_date) <= ''' || date_Search || ''' group by  id_product) as max_charges on max_charges.id_product=charges_kg_movement.id_product where max_charges.movement_date=charges_kg_movement.movement_date) ckm
    JOIN Product p ON ckm.id_product = p.id_product
    JOIN cat_product cp ON p.id_cat_product = cp.id_cat_product
    WHERE cp.id_cat_product = ''' || id_cat_produit || '''
    AND ckm.movement_date = (SELECT MAX(movement_date) FROM charges_kg_movement WHERE DATE(movement_date) <= ''' || date_Search || ''' and id_product = p.id_product)
    ) charges ON s.id_cat_product = charges.id_cat_product AND s.id_product = charges.id_product
    LEFT JOIN (
        SELECT
            p.id_cat_product,
            p.id_product,
            SUM(
                CASE 
                    WHEN po.sales_type = ''D'' THEN (dm.price - (dm.price * dm.reduction / 100)) * po.quantity
                    WHEN po.sales_type = ''W'' THEN (wm.price - (wm.price * wm.reduction / 100)) * po.quantity
                    WHEN po.sales_type = ''B'' THEN (bm.price - (bm.price * bm.reduction / 100)) * po.quantity
                    ELSE 0
                END
            ) AS total_price
        FROM orders o
        JOIN products_ordered po ON o.id_order = po.id_order
        LEFT JOIN detail_movement dm ON po.id_product = dm.id_product AND po.sales_type = ''D'' AND dm.movement_date = (
            SELECT MAX(movement_date) 
            FROM detail_movement 
            WHERE movement_date <= o.ordering_date and detail_movement.id_product = po.id_product
        )
        LEFT JOIN wholesale_movement wm ON po.id_product = wm.id_product AND po.sales_type = ''W'' AND wm.movement_date = (
            SELECT MAX(movement_date) 
            FROM wholesale_movement 
            WHERE movement_date <= o.ordering_date and wholesale_movement.id_product = po.id_product
        )
        LEFT JOIN bulk_movement bm ON po.id_product = bm.id_product AND po.sales_type = ''B'' AND bm.movement_date = (
            SELECT MAX(movement_date) 
            FROM bulk_movement 
            WHERE movement_date <= o.ordering_date and bulk_movement.id_product = po.id_product
        )
        JOIN Product p ON po.id_product = p.id_product
        WHERE p.id_cat_product = ''' || id_cat_produit || '''
            AND DATE(o.ordering_date) = ''' || date_Search || '''
        GROUP BY p.id_cat_product, p.id_product
    ) sales_amount ON s.id_cat_product = sales_amount.id_cat_product AND s.id_product = sales_amount.id_product
        ';
    END;
$$ LANGUAGE plpgsql;


--query test 
--select * from get_Balance_By_Date(date(now()),2);

--fonction basket
CREATE OR REPLACE FUNCTION get_basket_link(id_order VARCHAR)
    RETURNS TABLE (
        order_id VARCHAR,
        client_full_name VARCHAR,
        client_email VARCHAR,
        client_phone_number VARCHAR,
        delivery_address VARCHAR,
        delivery_date DATE,
        payment_type VARCHAR,
        payment_phone_number VARCHAR,
        product_name TEXT,
        product_image_link VARCHAR(50),
        type_sales TEXT,
        unit_product_price NUMERIC(14,2),
        quantity_product NUMERIC(14,2),
        reduction_product NUMERIC(14,2),
        price_product_with_reduction NUMERIC(14,2),
        total_price_product NUMERIC(14,2),
        reduction INTEGER,
        result NUMERIC(14,2)
    ) AS $$
BEGIN
    RETURN QUERY EXECUTE '
        SELECT
            ''' || id_order || '''::VARCHAR as order_id,
            vpd.client_full_name,
            vpd.client_email,
            vpd.client_phone_number,
            vpd.delivery_address,
            DATE(vpd.delivery_date) as delivery_date,
            vpd.payment_type,
            vpd.payment_phone_number,
            vod.product_name,
            vod.product_image_link,
            vod.type_sales,
            COALESCE(vod.unit_product_price, 0) AS unit_product_price,
            COALESCE(vod.quantity_product, 0) AS quantity_product,
            COALESCE(vod.reduction_product, 0) AS reduction_product,
            COALESCE(vod.price_product_with_reduction, 0) AS price_product_with_reduction,
            COALESCE(o.total_price_product, 0) AS total_price_product,
            COALESCE(o.reduction, 0) AS reduction,
            COALESCE(o.result, 0) AS result
        FROM (
            SELECT
                o.id_client,
                o.id_order,
                c.full_name AS client_full_name,
                c.mail AS client_email,
                c.phone_number AS client_phone_number,
                d.delivery_address,
                pm.mode AS payment_type,
                pm.phone_number AS payment_phone_number,
                d.delivery_date,
                d.cost AS delivery_cost
            FROM
                orders o
                LEFT JOIN clients_account c ON o.id_client = c.id_client
                LEFT JOIN payement pm ON o.id_payement = pm.id_payement
                LEFT JOIN delivery d ON o.id_delivery = d.id_delivery
            WHERE
                o.id_order = ''' || id_order || '''
        ) vpd
        LEFT JOIN (
            SELECT 
                vod.order_id,
                vod.product_name,
                vod.product_image_link,
                vod.product_ordered_sales_type,
                CASE
                    WHEN vod.product_ordered_sales_type = ''D'' THEN ''Detail''
                    WHEN vod.product_ordered_sales_type = ''W'' THEN ''Wholesale''
                    WHEN vod.product_ordered_sales_type = ''B'' THEN ''Bulk''
                    ELSE ''''
                END AS type_sales,
                COALESCE(
                    CASE
                        WHEN vod.product_ordered_sales_type = ''D'' THEN dm.price
                        WHEN vod.product_ordered_sales_type = ''W'' THEN wm.price
                        WHEN vod.product_ordered_sales_type = ''B'' THEN bm.price
                        ELSE 0
                    END, 0
                ) AS unit_product_price,
                COALESCE(
                    CASE
                        WHEN vod.product_ordered_sales_type = ''D'' THEN vod.product_ordered_quantity
                        WHEN vod.product_ordered_sales_type = ''W'' THEN vod.product_ordered_quantity
                        WHEN vod.product_ordered_sales_type = ''B'' THEN vod.product_ordered_quantity
                        ELSE 0
                    END, 0
                ) AS quantity_product,
                COALESCE(
                    CASE
                        WHEN vod.product_ordered_sales_type = ''D'' THEN (dm.price - (dm.price * dm.reduction/100))
                        WHEN vod.product_ordered_sales_type = ''W'' THEN (wm.price - (wm.price * wm.reduction/100))
                        WHEN vod.product_ordered_sales_type = ''B'' THEN (bm.price - (bm.price * bm.reduction/100))
                        ELSE 0
                    END, 0
                ) AS reduction_product,
                COALESCE(
                    CASE
                        WHEN vod.product_ordered_sales_type = ''D'' THEN (dm.price - (dm.price * dm.reduction/100)) * vod.product_ordered_quantity
                        WHEN vod.product_ordered_sales_type = ''W'' THEN (wm.price - (wm.price * wm.reduction/100)) * vod.product_ordered_quantity
                        WHEN vod.product_ordered_sales_type = ''B'' THEN (bm.price - (bm.price * bm.reduction/100)) * vod.product_ordered_quantity 
                        ELSE 0
                    END, 0
                ) AS price_product_with_reduction
            FROM  
                v_order_delivery_info vod
                LEFT JOIN detail_movement dm 
                    ON vod.product_id = dm.id_product 
                    AND vod.product_ordered_sales_type = ''D''
                    AND dm.movement_date = (
                        SELECT MAX(movement_date)
                        FROM detail_movement
                        WHERE id_product = vod.product_id 
                        AND movement_date <= vod.order_date
                    )
                LEFT JOIN wholesale_movement wm 
                    ON vod.product_id = wm.id_product 
                    AND vod.product_ordered_sales_type = ''W''
                    AND wm.movement_date = (
                        SELECT MAX(movement_date)
                        FROM wholesale_movement
                        WHERE id_product = vod.product_id 
                        AND movement_date <= vod.order_date
                    )
                LEFT JOIN bulk_movement bm 
                    ON vod.product_id = bm.id_product 
                    AND vod.product_ordered_sales_type = ''B''
                    AND bm.movement_date = (
                        SELECT MAX(movement_date)
                        FROM bulk_movement
                        WHERE id_product = vod.product_id 
                        AND movement_date <= vod.order_date
                    )
            WHERE
                vod.order_id = ''' || id_order || '''
        ) vod ON vpd.id_order = vod.order_id
        LEFT JOIN (
            SELECT 
                o.id_order,
                o.reduction,
                COALESCE(SUM(
                    CASE
                        WHEN vod.product_ordered_sales_type = ''D'' THEN (dm.price - (dm.price * dm.reduction/100)) * vod.product_ordered_quantity
                        WHEN vod.product_ordered_sales_type = ''W'' THEN (wm.price - (wm.price * wm.reduction/100)) * vod.product_ordered_quantity
                        WHEN vod.product_ordered_sales_type = ''B'' THEN (bm.price - (bm.price * bm.reduction/100)) * vod.product_ordered_quantity 
                        ELSE 0
                    END
                ), 0) AS total_price_product,
                COALESCE(SUM(
                    CASE
                        WHEN vod.product_ordered_sales_type = ''D'' THEN (dm.price - (dm.price * dm.reduction/100)) * vod.product_ordered_quantity
                        WHEN vod.product_ordered_sales_type = ''W'' THEN (wm.price - (wm.price * wm.reduction/100)) * vod.product_ordered_quantity
                        WHEN vod.product_ordered_sales_type = ''B'' THEN (bm.price - (bm.price * bm.reduction/100)) * vod.product_ordered_quantity 
                        ELSE 0
                    END
                ), 0) - (COALESCE(SUM(
                    CASE
                        WHEN vod.product_ordered_sales_type = ''D'' THEN (dm.price - (dm.price * dm.reduction/100)) * vod.product_ordered_quantity
                        WHEN vod.product_ordered_sales_type = ''W'' THEN (wm.price - (wm.price * wm.reduction/100)) * vod.product_ordered_quantity
                        WHEN vod.product_ordered_sales_type = ''B'' THEN (bm.price - (bm.price * bm.reduction/100)) * vod.product_ordered_quantity 
                        ELSE 0
                    END
                ), 0) * o.reduction / 100) AS result
            FROM
                orders o
                LEFT JOIN v_order_delivery_info vod ON o.id_order = vod.order_id
                LEFT JOIN detail_movement dm 
                    ON vod.product_id = dm.id_product 
                    AND vod.product_ordered_sales_type = ''D''
                    AND dm.movement_date = (
                        SELECT MAX(movement_date)
                        FROM detail_movement
                        WHERE id_product = vod.product_id 
                        AND movement_date <= vod.order_date
                    )
                LEFT JOIN wholesale_movement wm 
                    ON vod.product_id = wm.id_product 
                    AND vod.product_ordered_sales_type = ''W''
                    AND wm.movement_date = (
                        SELECT MAX(movement_date)
                        FROM wholesale_movement
                        WHERE id_product = vod.product_id 
                        AND movement_date <= vod.order_date
                    )
                LEFT JOIN bulk_movement bm 
                    ON vod.product_id = bm.id_product 
                    AND vod.product_ordered_sales_type = ''B''
                    AND bm.movement_date = (
                        SELECT MAX(movement_date)
                        FROM bulk_movement
                        WHERE id_product = vod.product_id 
                        AND movement_date <= vod.order_date
                    )
            WHERE
                o.id_order = ''' || id_order || '''
            GROUP BY 
                o.id_order, 
                o.reduction
        ) o ON vpd.id_order = o.id_order';
END;
$$ LANGUAGE plpgsql;

--requete
--select * from get_basket_link('ORD0003');