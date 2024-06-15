CREATE DATABASE dry_fruits_project;

ALTER DATABASE dry_fruits_project OWNER TO postgres;

\c dry_fruits_project;

CREATE SEQUENCE stock_sequence
    START 1
    INCREMENT 1
    MINVALUE 1
    MAXVALUE 999999
    CACHE 1;

CREATE SEQUENCE client_account_sequence
    START 1
    INCREMENT 1
    MINVALUE 1
    MAXVALUE 999999
    CACHE 1;

CREATE SEQUENCE movement_detail_sequence
    START 1
    INCREMENT 1
    MINVALUE 1
    MAXVALUE 999999
    CACHE 1;

CREATE SEQUENCE movement_bulk_sequence
    START 1
    INCREMENT 1
    MINVALUE 1
    MAXVALUE 999999
    CACHE 1;

CREATE SEQUENCE movement_wholesale_sequence
    START 1
    INCREMENT 1
    MINVALUE 1
    MAXVALUE 999999
    CACHE 1;

CREATE SEQUENCE movement_charges_sequence
    START 1
    INCREMENT 1
    MINVALUE 1
    MAXVALUE 999999
    CACHE 1;

CREATE SEQUENCE ordered_product_sequence
    START 1
    INCREMENT 1
    MINVALUE 1
    MAXVALUE 999999
    CACHE 1;

CREATE SEQUENCE client_favorite_products_sequence
    START 1
    INCREMENT 1
    MINVALUE 1
    MAXVALUE 999999
    CACHE 1;

CREATE SEQUENCE delivery_sequence
    START 1
    INCREMENT 1
    MINVALUE 1
    MAXVALUE 999999
    CACHE 1;

CREATE SEQUENCE products_ordered_sequence
    START 1
    INCREMENT 1
    MINVALUE 1
    MAXVALUE 999999
    CACHE 1;