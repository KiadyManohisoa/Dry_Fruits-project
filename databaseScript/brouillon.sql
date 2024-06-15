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
                        cp.id_cat_product = 1 
                        AND DATE(s.renewal_date) = date(now())
                    GROUP BY 
                        cp.id_cat_product, 
                        p.id_product) s 
                left join (
                    SELECT * from v_produit_detail
                ) vpd on s.id_product = vpd.id_product
            left join
            (SELECT
                        cp.id_cat_product,
                        p.id_product, 
                        COALESCE(SUM(
                            CASE 
                                WHEN po.sales_type IN ('D','W') THEN po.quantity * 0.1
                                WHEN po.sales_type ='B' THEN po.quantity
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
                        DATE(o.ordering_date) = date(now())
                        AND cp.id_cat_product = 1
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
                            WHEN po.sales_type = 'D' THEN po.quantity
                            WHEN po.sales_type = 'W' THEN po.quantity
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
                    cp.id_cat_product=1
                    AND DATE(o.ordering_date) = date(now())
                    AND (po.sales_type = 'W' OR po.sales_type = 'D')
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
                    LEFT JOIN
                        Product p ON ckm.id_product = p.id_product
                    LEFT JOIN
                        cat_product cp ON p.id_cat_product = cp.id_cat_product
                    WHERE
                        cp.id_cat_product = 1
                    AND date(ckm.movement_date) = (select date(max(movement_date)) from charges_kg_movement where DATE(movement_date) <= '2024-06-15')
            ) charges 
            on s.id_cat_product = charges.id_cat_product and s.id_product=charges.id_product
            LEFT join 
            (SELECT
                        p.id_cat_product,
                        p.id_product,
                        SUM(
                            CASE 
                                WHEN po.sales_type = 'D' THEN dm.price * po.quantity
                                WHEN po.sales_type = 'W' THEN wm.price * po.quantity
                                WHEN po.sales_type = 'B' THEN bm.price * po.quantity
                                ELSE 0
                            END
                        ) AS total_price
                    FROM
                        orders o
                    JOIN
                        products_ordered po ON o.id_order = po.id_order
                    LEFT JOIN
                        detail_movement dm ON po.id_product = dm.id_product AND po.sales_type = 'D' AND dm.movement_date = (select max(movement_date) from detail_movement where DATE(movement_date) <=DATE(o.ordering_date))
                    LEFT JOIN
                        wholesale_movement wm ON po.id_product = wm.id_product AND po.sales_type = 'W' AND wm.movement_date = (select max(movement_date) from wholesale_movement where DATE(movement_date) <=DATE(o.ordering_date))
                    LEFT JOIN
                        bulk_movement bm ON po.id_product = bm.id_product AND po.sales_type = 'B' AND bm.movement_date = (select max(movement_date) from bulk_movement where DATE(movement_date) <=DATE(o.ordering_date))
                    JOIN
                        Product p ON po.id_product = p.id_product
                    WHERE
                        p.id_cat_product=1
                        AND DATE(o.ordering_date) = date(now())
                    GROUP BY
                        p.id_cat_product,p.id_product) as sales_amount
            on s.id_cat_product = sales_amount.id_cat_product and s.id_product=sales_amount.id_product