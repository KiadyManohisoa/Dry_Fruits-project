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
        RETURN QUERY EXECUTE ' 
        select s.id_product, vpd.product_name, s.total_quantity - COALESCE(o.total_quantity,0) as stock, COALESCE(o.total_quantity,0) as out, COALESCE(sales.number_package,0) as sales, charges.price * (COALESCE(o.total_quantity,0)) as charges, COALESCE(sales_amount.total_price,0) as sales_amount ,COALESCE(sales_amount.total_price,0) - charges.price * (COALESCE(o.total_quantity,0)) as results from
            (SELECT 
                        cp.id_cat_product, 
                        p.id_product,   
                        SUM(s.quantity_kg) AS total_quantity
                    FROM 
                        cat_product cp
                    JOIN 
                        Product p ON cp.id_cat_product = p.id_cat_product
                    JOIN 
                        stock s ON p.id_product = s.id_product
                    WHERE
                        cp.id_cat_product = ''' || id_cat_produit || ''' 
                        AND DATE(s.renewal_date) = ''' || date_Search || '''
                    GROUP BY 
                        cp.id_cat_product, 
                        p.id_product) s 
                left join (
                    SELECT * from v_product_detail
                ) vpd on s.id_product = vpd.id_product
            left join
            (SELECT
                        cp.id_cat_product,
                        p.id_product, 
                        COALESCE(SUM(
                            CASE 
                                WHEN po.sales_type IN (''D'',''W'') THEN po.quantity * 0.1
                                WHEN po.sales_type =''B'' THEN po.quantity
                                ELSE 0 
                            END
                        ),0) AS total_quantity
                    FROM
                        orders o
                    JOIN
                        products_ordered po ON o.id_order = po.id_order
                    JOIN
                        Product p ON po.id_product = p.id_product
                    JOIN
                        cat_product cp ON p.id_cat_product = cp.id_cat_product
                    WHERE
                        DATE(o.ordering_date) = ''' || date_Search || '''
                        AND cp.id_cat_product = ''' || id_cat_produit || '''
                    GROUP BY
                        cp.id_cat_product,p.id_product) o
            on s.id_cat_product=o.id_cat_product and s.id_product=o.id_product
            left join 
            (
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
                FROM
                    orders o
                JOIN
                    products_ordered po ON o.id_order = po.id_order
                JOIN
                    Product p ON po.id_product = p.id_product
                JOIN
                    cat_product cp ON p.id_cat_product = cp.id_cat_product
                WHERE
                    cp.id_cat_product=''' || id_cat_produit || '''
                    AND DATE(o.ordering_date) = ''' || date_Search || '''
                    AND (po.sales_type = ''W'' OR po.sales_type = ''D'')
                GROUP BY
                    cp.id_cat_product,p.id_product
            ) sales
            on s.id_cat_product = sales.id_cat_product and s.id_product=sales.id_product
            left join (
                    SELECT 
                        cp.id_cat_product,
                        p.id_product,
                        ckm.price
                    FROM
                        charges_kg_movement ckm
                    JOIN
                        Product p ON ckm.id_product = p.id_product
                    JOIN
                        cat_product cp ON p.id_cat_product = cp.id_cat_product
                    WHERE
                        cp.id_cat_product = ''' || id_cat_produit || '''
                        AND ckm.movement_date = (select max(movement_date) from charges_kg_movement where DATE(movement_date) <= ''' || date_Search || ''')
            ) charges 
            on s.id_cat_product = charges.id_cat_product and s.id_product=charges.id_product
            LEFT join 
            (SELECT
                        p.id_cat_product,
                        p.id_product,
                        SUM(
                            CASE 
                                WHEN po.sales_type = ''D'' THEN dm.price * po.quantity
                                WHEN po.sales_type = ''W'' THEN wm.price * po.quantity
                                WHEN po.sales_type = ''B'' THEN bm.price * po.quantity
                                ELSE 0
                            END
                        ) AS total_price
                    FROM
                        orders o
                    JOIN
                        products_ordered po ON o.id_order = po.id_order
                    LEFT JOIN
                        detail_movement dm ON po.id_product = dm.id_product AND po.sales_type = ''D'' AND dm.movement_date = (select max(movement_date) from detail_movement where movement_date <=o.ordering_date)
                    LEFT JOIN
                        wholesale_movement wm ON po.id_product = wm.id_product AND po.sales_type = ''W'' AND wm.movement_date = (select max(movement_date) from wholesale_movement where movement_date <=o.ordering_date)
                    LEFT JOIN
                        bulk_movement bm ON po.id_product = bm.id_product AND po.sales_type = ''B'' AND bm.movement_date = (select max(movement_date) from bulk_movement where movement_date <=o.ordering_date)
                    JOIN
                        Product p ON po.id_product = p.id_product
                    WHERE
                        p.id_cat_product=''' || id_cat_produit || '''
                        AND DATE(o.ordering_date) = ''' || date_Search || '''
                    GROUP BY
                        p.id_cat_product,p.id_product) as sales_amount
            on s.id_cat_product = sales_amount.id_cat_product and s.id_product=sales_amount.id_product
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
        type_sales TEXT,
        unit_product_price NUMERIC(14,2),
        quantity_product NUMERIC(14,2),
        reduction_product NUMERIC(14,2),
        price_product_with_reduction NUMERIC(14,2),
        total_price_product NUMERIC(14,2),
        reduction SMALLINT,
        result NUMERIC(14,2)
    ) AS $$
    begin
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
                vod.type_sales,
                vod.unit_product_price,
                vod.quantity_product,
                vod.reduction_product,
                vod.price_product_with_reduction,
                o.total_price_product,
                o.reduction,
                o.result
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
            vod.product_ordered_sales_type,
            CASE
                    WHEN vod.product_ordered_sales_type = ''D'' THEN ''Detail''
                    WHEN vod.product_ordered_sales_type = ''W'' THEN ''Wholesale''
                    WHEN vod.product_ordered_sales_type = ''B'' THEN ''Bulk''
                    ELSE ''''
                END AS type_sales,
            CASE
                WHEN vod.product_ordered_sales_type = ''D'' THEN dm.price
                WHEN vod.product_ordered_sales_type = ''W'' THEN wm.price
                WHEN vod.product_ordered_sales_type = ''B'' THEN bm.price
                ELSE 0
            END AS unit_product_price,
            CASE
                WHEN vod.product_ordered_sales_type = ''D'' THEN vod.product_ordered_quantity
                WHEN vod.product_ordered_sales_type = ''W'' THEN vod.product_ordered_quantity
                WHEN vod.product_ordered_sales_type = ''B'' THEN vod.product_ordered_quantity
                ELSE 0
            END AS quantity_product,
            CASE
                WHEN vod.product_ordered_sales_type = ''D'' THEN (dm.price - (dm.price * dm.reduction/100))
                WHEN vod.product_ordered_sales_type = ''W'' THEN (wm.price - (wm.price * wm.reduction/100))
                WHEN vod.product_ordered_sales_type = ''B'' THEN (bm.price - (bm.price * bm.reduction/100))
                ELSE 0
            END AS reduction_product,
            CASE
                WHEN vod.product_ordered_sales_type = ''D'' THEN (dm.price - (dm.price * dm.reduction/100)) * vod.product_ordered_quantity * 0.1
                WHEN vod.product_ordered_sales_type = ''W'' THEN (wm.price - (wm.price * wm.reduction/100)) * vod.product_ordered_quantity * 0.1
                WHEN vod.product_ordered_sales_type = ''B'' THEN (bm.price - (bm.price * bm.reduction/100)) * vod.product_ordered_quantity 
                ELSE 0
            END AS price_product_with_reduction
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
                    SUM(
                        CASE
                            WHEN vod.product_ordered_sales_type = ''D'' THEN (dm.price - (dm.price * dm.reduction/100)) * vod.product_ordered_quantity * 0.1
                            WHEN vod.product_ordered_sales_type = ''W'' THEN (wm.price - (wm.price * wm.reduction/100)) * vod.product_ordered_quantity * 0.1
                            WHEN vod.product_ordered_sales_type = ''B'' THEN (bm.price - (bm.price * bm.reduction/100)) * vod.product_ordered_quantity 
                            ELSE 0
                        END
                    ) AS total_price_product,
                    SUM(
                        CASE
                            WHEN vod.product_ordered_sales_type = ''D'' THEN (dm.price - (dm.price * dm.reduction/100)) * vod.product_ordered_quantity * 0.1
                            WHEN vod.product_ordered_sales_type = ''W'' THEN (wm.price - (wm.price * wm.reduction/100)) * vod.product_ordered_quantity * 0.1
                            WHEN vod.product_ordered_sales_type = ''B'' THEN (bm.price - (bm.price * bm.reduction/100)) * vod.product_ordered_quantity 
                            ELSE 0
                        END
                    ) - (SUM(
                        CASE
                            WHEN vod.product_ordered_sales_type = ''D'' THEN (dm.price - (dm.price * dm.reduction/100)) * vod.product_ordered_quantity * 0.1
                            WHEN vod.product_ordered_sales_type = ''W'' THEN (wm.price - (wm.price * wm.reduction/100)) * vod.product_ordered_quantity * 0.1
                            WHEN vod.product_ordered_sales_type = ''B'' THEN (bm.price - (bm.price * bm.reduction/100)) * vod.product_ordered_quantity 
                            ELSE 0
                        END
                    ) * o.reduction / 100) AS result
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
            ) o ON vpd.id_order = o.id_order
        ';
        END;
    $$ LANGUAGE plpgsql;
--requete
--select * from get_basket_link('ORD0003');