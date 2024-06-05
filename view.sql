CREATE OR REPLACE VIEW Product_Categories AS
SELECT 
    p.id AS product_id,
    p.lienImage AS product_image_link,
    p.description AS product_description,
    p.dateCreation AS product_creation_date,
    cp.libelle AS product_category,
    cf.libelle AS fruit_category
FROM Produit p
INNER JOIN Cat_Produit cp ON p.id_1 = cp.id
INNER JOIN Cat_Fruit cf ON p.id_2 = cf.id;

CREATE OR REPLACE VIEW Product_Configuration AS
SELECT 
    pc.product_id,
    pc.product_image_link,
    pc.product_description,
    pc.product_creation_date,
    pc.product_category,
    pc.fruit_category,
    s.dateRenouvellement AS stock_renewal_date,
    s.qttKg AS stock_quantity,
    d.dateMvt AS detail_date,
    d.prix AS detail_price,
    d.reduction AS detail_reduction,
    m.dateMvt AS charges_date,
    m.prix AS charges_price
FROM Product_Categories pc
LEFT JOIN Stock s ON pc.product_id = s.id_1
LEFT JOIN Mvt_Detail d ON pc.product_id = d.id_1
LEFT JOIN Mvt_DepensesKg m ON pc.product_id = m.id_1;

