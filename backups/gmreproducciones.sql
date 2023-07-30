--
-- PostgreSQL database dump
--

-- Dumped from database version 14.8 (Homebrew)
-- Dumped by pg_dump version 14.8 (Homebrew)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: categories; Type: TABLE; Schema: public; Owner: juliofranco
--

CREATE TABLE public.categories (
    id bigint NOT NULL,
    module integer NOT NULL,
    parent integer DEFAULT 0 NOT NULL,
    name character varying(255) NOT NULL,
    slug character varying(255) NOT NULL,
    file_path character varying(255),
    icono character varying(255) NOT NULL,
    "order" integer DEFAULT 0 NOT NULL,
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.categories OWNER TO juliofranco;

--
-- Name: categories_id_seq; Type: SEQUENCE; Schema: public; Owner: juliofranco
--

CREATE SEQUENCE public.categories_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.categories_id_seq OWNER TO juliofranco;

--
-- Name: categories_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: juliofranco
--

ALTER SEQUENCE public.categories_id_seq OWNED BY public.categories.id;


--
-- Name: coverage; Type: TABLE; Schema: public; Owner: juliofranco
--

CREATE TABLE public.coverage (
    id bigint NOT NULL,
    status integer DEFAULT 1 NOT NULL,
    coverage_type integer NOT NULL,
    state_id integer NOT NULL,
    name character varying(255) NOT NULL,
    price numeric(11,2) NOT NULL,
    days integer NOT NULL,
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.coverage OWNER TO juliofranco;

--
-- Name: coverage_id_seq; Type: SEQUENCE; Schema: public; Owner: juliofranco
--

CREATE SEQUENCE public.coverage_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.coverage_id_seq OWNER TO juliofranco;

--
-- Name: coverage_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: juliofranco
--

ALTER SEQUENCE public.coverage_id_seq OWNED BY public.coverage.id;


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: juliofranco
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO juliofranco;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: juliofranco
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.failed_jobs_id_seq OWNER TO juliofranco;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: juliofranco
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: galleries; Type: TABLE; Schema: public; Owner: juliofranco
--

CREATE TABLE public.galleries (
    id bigint NOT NULL,
    timeline_id integer NOT NULL,
    file_path character varying(255) NOT NULL,
    file_name character varying(255) NOT NULL,
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.galleries OWNER TO juliofranco;

--
-- Name: galleries_id_seq; Type: SEQUENCE; Schema: public; Owner: juliofranco
--

CREATE SEQUENCE public.galleries_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.galleries_id_seq OWNER TO juliofranco;

--
-- Name: galleries_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: juliofranco
--

ALTER SEQUENCE public.galleries_id_seq OWNED BY public.galleries.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: juliofranco
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO juliofranco;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: juliofranco
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO juliofranco;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: juliofranco
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: orders; Type: TABLE; Schema: public; Owner: juliofranco
--

CREATE TABLE public.orders (
    id bigint NOT NULL,
    o_number character varying(255),
    status integer DEFAULT 0 NOT NULL,
    o_type integer DEFAULT 0 NOT NULL,
    user_id integer NOT NULL,
    user_address_id integer,
    user_comment text,
    subtotal numeric(11,2) DEFAULT '0'::numeric NOT NULL,
    delivery numeric(11,2) DEFAULT '0'::numeric NOT NULL,
    total numeric(11,2) DEFAULT '0'::numeric NOT NULL,
    payment_method integer,
    payment_info text,
    paid_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.orders OWNER TO juliofranco;

--
-- Name: orders_id_seq; Type: SEQUENCE; Schema: public; Owner: juliofranco
--

CREATE SEQUENCE public.orders_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.orders_id_seq OWNER TO juliofranco;

--
-- Name: orders_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: juliofranco
--

ALTER SEQUENCE public.orders_id_seq OWNED BY public.orders.id;


--
-- Name: orders_items; Type: TABLE; Schema: public; Owner: juliofranco
--

CREATE TABLE public.orders_items (
    id bigint NOT NULL,
    user_id integer NOT NULL,
    order_id integer NOT NULL,
    product_id integer NOT NULL,
    inventory_id integer NOT NULL,
    variant_id integer,
    label_item text,
    quantity text DEFAULT '1'::text NOT NULL,
    discount_status integer DEFAULT 0 NOT NULL,
    discount_until_date date,
    discount integer DEFAULT 0 NOT NULL,
    price_initial numeric(11,2) NOT NULL,
    price_unit numeric(11,2) NOT NULL,
    total numeric(11,2) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.orders_items OWNER TO juliofranco;

--
-- Name: orders_items_id_seq; Type: SEQUENCE; Schema: public; Owner: juliofranco
--

CREATE SEQUENCE public.orders_items_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.orders_items_id_seq OWNER TO juliofranco;

--
-- Name: orders_items_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: juliofranco
--

ALTER SEQUENCE public.orders_items_id_seq OWNED BY public.orders_items.id;


--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: juliofranco
--

CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_resets OWNER TO juliofranco;

--
-- Name: product_gallery; Type: TABLE; Schema: public; Owner: juliofranco
--

CREATE TABLE public.product_gallery (
    id bigint NOT NULL,
    product_id integer NOT NULL,
    file_path character varying(255) NOT NULL,
    file_name character varying(255) NOT NULL,
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.product_gallery OWNER TO juliofranco;

--
-- Name: product_gallery_id_seq; Type: SEQUENCE; Schema: public; Owner: juliofranco
--

CREATE SEQUENCE public.product_gallery_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.product_gallery_id_seq OWNER TO juliofranco;

--
-- Name: product_gallery_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: juliofranco
--

ALTER SEQUENCE public.product_gallery_id_seq OWNED BY public.product_gallery.id;


--
-- Name: product_inventory; Type: TABLE; Schema: public; Owner: juliofranco
--

CREATE TABLE public.product_inventory (
    id bigint NOT NULL,
    product_id integer NOT NULL,
    name character varying(255) NOT NULL,
    quantity integer NOT NULL,
    price numeric(11,2) NOT NULL,
    limited integer NOT NULL,
    minimum integer NOT NULL,
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.product_inventory OWNER TO juliofranco;

--
-- Name: product_inventory_id_seq; Type: SEQUENCE; Schema: public; Owner: juliofranco
--

CREATE SEQUENCE public.product_inventory_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.product_inventory_id_seq OWNER TO juliofranco;

--
-- Name: product_inventory_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: juliofranco
--

ALTER SEQUENCE public.product_inventory_id_seq OWNED BY public.product_inventory.id;


--
-- Name: product_inventory_variants; Type: TABLE; Schema: public; Owner: juliofranco
--

CREATE TABLE public.product_inventory_variants (
    id bigint NOT NULL,
    product_id integer NOT NULL,
    inventory_id integer NOT NULL,
    name character varying(255) NOT NULL,
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.product_inventory_variants OWNER TO juliofranco;

--
-- Name: product_inventory_variants_id_seq; Type: SEQUENCE; Schema: public; Owner: juliofranco
--

CREATE SEQUENCE public.product_inventory_variants_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.product_inventory_variants_id_seq OWNER TO juliofranco;

--
-- Name: product_inventory_variants_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: juliofranco
--

ALTER SEQUENCE public.product_inventory_variants_id_seq OWNED BY public.product_inventory_variants.id;


--
-- Name: products; Type: TABLE; Schema: public; Owner: juliofranco
--

CREATE TABLE public.products (
    id bigint NOT NULL,
    status integer NOT NULL,
    code character varying(255) DEFAULT '0'::character varying NOT NULL,
    name character varying(255) NOT NULL,
    slug character varying(255) NOT NULL,
    category_id integer NOT NULL,
    "subCategory_id" integer DEFAULT 0 NOT NULL,
    file_path character varying(255) NOT NULL,
    image character varying(255) NOT NULL,
    price numeric(11,3) DEFAULT '0'::numeric,
    inventory integer DEFAULT 0 NOT NULL,
    in_discount integer NOT NULL,
    discount_until_date date,
    discount integer NOT NULL,
    content text NOT NULL,
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.products OWNER TO juliofranco;

--
-- Name: products_id_seq; Type: SEQUENCE; Schema: public; Owner: juliofranco
--

CREATE SEQUENCE public.products_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.products_id_seq OWNER TO juliofranco;

--
-- Name: products_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: juliofranco
--

ALTER SEQUENCE public.products_id_seq OWNED BY public.products.id;


--
-- Name: sliders; Type: TABLE; Schema: public; Owner: juliofranco
--

CREATE TABLE public.sliders (
    id bigint NOT NULL,
    user_id integer NOT NULL,
    status integer NOT NULL,
    name character varying(255) NOT NULL,
    file_path character varying(255) NOT NULL,
    file_name character varying(255) NOT NULL,
    content text NOT NULL,
    s_order integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.sliders OWNER TO juliofranco;

--
-- Name: sliders_id_seq; Type: SEQUENCE; Schema: public; Owner: juliofranco
--

CREATE SEQUENCE public.sliders_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sliders_id_seq OWNER TO juliofranco;

--
-- Name: sliders_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: juliofranco
--

ALTER SEQUENCE public.sliders_id_seq OWNED BY public.sliders.id;


--
-- Name: timeline-profils; Type: TABLE; Schema: public; Owner: juliofranco
--

CREATE TABLE public."timeline-profils" (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    description text NOT NULL,
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public."timeline-profils" OWNER TO juliofranco;

--
-- Name: timeline-profils_id_seq; Type: SEQUENCE; Schema: public; Owner: juliofranco
--

CREATE SEQUENCE public."timeline-profils_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."timeline-profils_id_seq" OWNER TO juliofranco;

--
-- Name: timeline-profils_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: juliofranco
--

ALTER SEQUENCE public."timeline-profils_id_seq" OWNED BY public."timeline-profils".id;


--
-- Name: timelines; Type: TABLE; Schema: public; Owner: juliofranco
--

CREATE TABLE public.timelines (
    id bigint NOT NULL,
    profile_id integer NOT NULL,
    title character varying(255) NOT NULL,
    slug character varying(255) NOT NULL,
    date date NOT NULL,
    file_path character varying(255) NOT NULL,
    image character varying(255) NOT NULL,
    description text NOT NULL,
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.timelines OWNER TO juliofranco;

--
-- Name: timelines_id_seq; Type: SEQUENCE; Schema: public; Owner: juliofranco
--

CREATE SEQUENCE public.timelines_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.timelines_id_seq OWNER TO juliofranco;

--
-- Name: timelines_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: juliofranco
--

ALTER SEQUENCE public.timelines_id_seq OWNED BY public.timelines.id;


--
-- Name: user_address; Type: TABLE; Schema: public; Owner: juliofranco
--

CREATE TABLE public.user_address (
    id bigint NOT NULL,
    user_id integer NOT NULL,
    state_id integer NOT NULL,
    city_id integer NOT NULL,
    name character varying(255) NOT NULL,
    addr_info text NOT NULL,
    "default" integer DEFAULT 0 NOT NULL,
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.user_address OWNER TO juliofranco;

--
-- Name: user_address_id_seq; Type: SEQUENCE; Schema: public; Owner: juliofranco
--

CREATE SEQUENCE public.user_address_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_address_id_seq OWNER TO juliofranco;

--
-- Name: user_address_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: juliofranco
--

ALTER SEQUENCE public.user_address_id_seq OWNED BY public.user_address.id;


--
-- Name: user_favorites; Type: TABLE; Schema: public; Owner: juliofranco
--

CREATE TABLE public.user_favorites (
    id bigint NOT NULL,
    user_id integer NOT NULL,
    module integer NOT NULL,
    object_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.user_favorites OWNER TO juliofranco;

--
-- Name: user_favorites_id_seq; Type: SEQUENCE; Schema: public; Owner: juliofranco
--

CREATE SEQUENCE public.user_favorites_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_favorites_id_seq OWNER TO juliofranco;

--
-- Name: user_favorites_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: juliofranco
--

ALTER SEQUENCE public.user_favorites_id_seq OWNED BY public.user_favorites.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: juliofranco
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    role integer DEFAULT 0 NOT NULL,
    name character varying(255) NOT NULL,
    lastname character varying(255) NOT NULL,
    phone integer,
    birthday date,
    gender integer,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    password_code character varying(255),
    status integer DEFAULT 1 NOT NULL,
    avatar character varying(255),
    permissions text,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO juliofranco;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: juliofranco
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO juliofranco;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: juliofranco
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: categories id; Type: DEFAULT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.categories ALTER COLUMN id SET DEFAULT nextval('public.categories_id_seq'::regclass);


--
-- Name: coverage id; Type: DEFAULT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.coverage ALTER COLUMN id SET DEFAULT nextval('public.coverage_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: galleries id; Type: DEFAULT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.galleries ALTER COLUMN id SET DEFAULT nextval('public.galleries_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: orders id; Type: DEFAULT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.orders ALTER COLUMN id SET DEFAULT nextval('public.orders_id_seq'::regclass);


--
-- Name: orders_items id; Type: DEFAULT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.orders_items ALTER COLUMN id SET DEFAULT nextval('public.orders_items_id_seq'::regclass);


--
-- Name: product_gallery id; Type: DEFAULT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.product_gallery ALTER COLUMN id SET DEFAULT nextval('public.product_gallery_id_seq'::regclass);


--
-- Name: product_inventory id; Type: DEFAULT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.product_inventory ALTER COLUMN id SET DEFAULT nextval('public.product_inventory_id_seq'::regclass);


--
-- Name: product_inventory_variants id; Type: DEFAULT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.product_inventory_variants ALTER COLUMN id SET DEFAULT nextval('public.product_inventory_variants_id_seq'::regclass);


--
-- Name: products id; Type: DEFAULT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.products ALTER COLUMN id SET DEFAULT nextval('public.products_id_seq'::regclass);


--
-- Name: sliders id; Type: DEFAULT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.sliders ALTER COLUMN id SET DEFAULT nextval('public.sliders_id_seq'::regclass);


--
-- Name: timeline-profils id; Type: DEFAULT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public."timeline-profils" ALTER COLUMN id SET DEFAULT nextval('public."timeline-profils_id_seq"'::regclass);


--
-- Name: timelines id; Type: DEFAULT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.timelines ALTER COLUMN id SET DEFAULT nextval('public.timelines_id_seq'::regclass);


--
-- Name: user_address id; Type: DEFAULT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.user_address ALTER COLUMN id SET DEFAULT nextval('public.user_address_id_seq'::regclass);


--
-- Name: user_favorites id; Type: DEFAULT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.user_favorites ALTER COLUMN id SET DEFAULT nextval('public.user_favorites_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: categories; Type: TABLE DATA; Schema: public; Owner: juliofranco
--

COPY public.categories (id, module, parent, name, slug, file_path, icono, "order", deleted_at, created_at, updated_at) FROM stdin;
1	0	0	Conciertos	conciertos	2023-05-07	918-instrumento-musical.png	0	\N	2023-05-07 19:46:00	2023-05-07 19:46:00
2	0	1	Música de Cámara	musica-de-camara	2023-05-07	952-guitarra.png	0	\N	2023-05-07 19:46:40	2023-05-07 19:46:40
3	0	1	Zarzuelas	zarzuelas	2023-06-04	664-zarzuela.png	0	2023-06-04 22:27:00	2023-06-04 22:26:29	2023-06-04 22:27:00
4	0	0	Zarzuelas	zarzuelas	2023-06-04	702-zarzuela.png	0	\N	2023-06-04 22:27:34	2023-06-04 22:27:34
5	0	4	Zarzuelas Paraguayas	zarzuelas-paraguayas	2023-06-04	137-zarzuela.png	0	\N	2023-06-04 22:28:09	2023-06-04 22:28:09
\.


--
-- Data for Name: coverage; Type: TABLE DATA; Schema: public; Owner: juliofranco
--

COPY public.coverage (id, status, coverage_type, state_id, name, price, days, deleted_at, created_at, updated_at) FROM stdin;
1	1	0	0	Central	0.00	1	\N	2023-05-11 18:33:46	2023-05-11 18:33:46
2	1	1	1	Asunción	10000.00	1	\N	2023-05-11 18:34:02	2023-05-11 18:34:02
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: juliofranco
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: galleries; Type: TABLE DATA; Schema: public; Owner: juliofranco
--

COPY public.galleries (id, timeline_id, file_path, file_name, deleted_at, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: juliofranco
--

COPY public.migrations (id, migration, batch) FROM stdin;
225	2014_10_12_000000_create_users_table	1
226	2014_10_12_100000_create_password_resets_table	1
227	2019_08_19_000000_create_failed_jobs_table	1
228	2020_09_17_044354_create_categories_table	1
229	2020_09_18_042524_create_products_table	1
230	2020_09_21_033756_create_product_gallery_table	1
231	2020_10_09_031208_create_time_line_perfils_table	1
232	2020_10_10_144318_create_timelines_table	1
233	2020_10_10_144713_create_galleries_table	1
234	2022_03_04_130511_create_sliders_table	1
235	2023_01_22_191724_create_table_user_favorites	1
236	2023_01_28_185220_create_product_inventory	1
237	2023_01_29_005730_create_product_inventory_variants	1
250	2023_03_26_211608_create_orders_table	2
251	2023_03_27_155312_create_orders_items_table	2
252	2023_04_11_135427_create_coverage_table	2
253	2023_04_16_232018_create_user_address_table	2
\.


--
-- Data for Name: orders; Type: TABLE DATA; Schema: public; Owner: juliofranco
--

COPY public.orders (id, o_number, status, o_type, user_id, user_address_id, user_comment, subtotal, delivery, total, payment_method, payment_info, paid_at, created_at, updated_at) FROM stdin;
3	1	1	1	1	0	A	90000.00	0.00	90000.00	0	\N	\N	2023-07-05 19:10:10	2023-07-05 19:19:47
4	2	1	0	1	1	A	90000.00	10000.00	100000.00	0	\N	\N	2023-07-05 19:24:09	2023-07-05 19:24:21
\.


--
-- Data for Name: orders_items; Type: TABLE DATA; Schema: public; Owner: juliofranco
--

COPY public.orders_items (id, user_id, order_id, product_id, inventory_id, variant_id, label_item, quantity, discount_status, discount_until_date, discount, price_initial, price_unit, total, created_at, updated_at) FROM stdin;
1	1	1	2	2	4	Música de Película/Platea/Oeste	1	1	\N	10	1000.00	900.00	900.00	2023-05-11 18:53:11	2023-05-11 18:53:11
2	1	1	1	1	2	Concierto de Música de Cámara Italiana/Palcos/5 personas	1	0	\N	0	50000.00	50000.00	50000.00	2023-05-11 18:53:19	2023-05-11 18:53:19
4	1	2	3	3	5	María Pacurí/PLATEA/2 PERSONAS	1	1	2023-06-05	10	100000.00	90000.00	90000.00	2023-07-05 19:07:32	2023-07-05 19:07:32
5	1	3	3	3	6	María Pacurí/PLATEA/FAMILIAR (5 PERSONAS)	1	1	2023-07-31	10	100000.00	90000.00	90000.00	2023-07-05 19:10:17	2023-07-05 19:10:17
\.


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: juliofranco
--

COPY public.password_resets (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: product_gallery; Type: TABLE DATA; Schema: public; Owner: juliofranco
--

COPY public.product_gallery (id, product_id, file_path, file_name, deleted_at, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: product_inventory; Type: TABLE DATA; Schema: public; Owner: juliofranco
--

COPY public.product_inventory (id, product_id, name, quantity, price, limited, minimum, deleted_at, created_at, updated_at) FROM stdin;
2	2	Platea	10	1000.00	0	1	\N	2023-05-11 17:28:01	2023-05-11 17:30:52
1	1	Palcos	2	50000.00	0	1	\N	2023-05-07 19:48:10	2023-05-11 17:31:19
3	3	PLATEA	1	100000.00	0	1	\N	2023-06-04 22:35:07	2023-06-04 22:35:07
\.


--
-- Data for Name: product_inventory_variants; Type: TABLE DATA; Schema: public; Owner: juliofranco
--

COPY public.product_inventory_variants (id, product_id, inventory_id, name, deleted_at, created_at, updated_at) FROM stdin;
1	1	1	2 personas	\N	2023-05-07 19:48:22	2023-05-07 19:48:22
2	1	1	5 personas	\N	2023-05-07 19:48:28	2023-05-07 19:48:28
3	2	2	Este	\N	2023-05-11 17:28:16	2023-05-11 17:28:16
4	2	2	Oeste	\N	2023-05-11 17:28:20	2023-05-11 17:28:20
5	3	3	2 PERSONAS	\N	2023-06-04 22:35:31	2023-06-04 22:35:31
6	3	3	FAMILIAR (5 PERSONAS)	\N	2023-06-04 22:35:41	2023-06-04 22:35:41
\.


--
-- Data for Name: products; Type: TABLE DATA; Schema: public; Owner: juliofranco
--

COPY public.products (id, status, code, name, slug, category_id, "subCategory_id", file_path, image, price, inventory, in_discount, discount_until_date, discount, content, deleted_at, created_at, updated_at) FROM stdin;
3	1	001	María Pacurí	maria-pacuri	4	5	2023-06-04	900-musica-pelicula.jpg	100000.000	0	1	2023-07-31	10	&lt;p&gt;Zarzuela Mar&amp;iacute;a Pacur&amp;iacute; en dos actos.&amp;nbsp;&lt;/p&gt;	\N	2023-06-04 22:33:14	2023-07-05 19:10:00
2	1	11	Música de Película	musica-de-pelicula	1	2	2023-05-11	331-musica-pelicula.jpg	1000.000	0	1	\N	10	&lt;p&gt;Concierto de M&amp;uacute;sica de Pel&amp;iacute;cula&lt;/p&gt;	2023-06-04 22:34:21	2023-05-11 17:27:29	2023-06-04 22:34:21
1	1	0	Concierto de Música de Cámara Italiana	concierto-de-musica-de-camara-italiana	1	2	2023-05-07	921-images.jpeg	50000.000	0	0	\N	0	&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt;&amp;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;	2023-06-04 22:34:25	2023-05-07 19:47:47	2023-06-04 22:34:25
4	0	1	Casa	casa	1	2	2023-07-24	213-12495112-1065211803539021-7201984143772650012-n.jpg	0.000	0	0	\N	10	&lt;p&gt;A&lt;/p&gt;	\N	2023-07-24 03:00:35	2023-07-24 03:00:35
5	0	0	beleza	beleza	1	2	2023-07-24	653-12495112-1065211803539021-7201984143772650012-n.jpg	0.000	0	0	\N	10	&lt;p&gt;asdf&lt;/p&gt;	\N	2023-07-24 04:29:29	2023-07-24 04:29:29
6	0	11	Concierto musica clasica	concierto-musica-clasica	4	5	2023-07-26	897-12973158-1065211810205687-1511173717539298820-o.jpg	0.000	0	0	\N	10	&lt;p&gt;A&lt;/p&gt;	\N	2023-07-26 16:09:10	2023-07-26 16:09:10
\.


--
-- Data for Name: sliders; Type: TABLE DATA; Schema: public; Owner: juliofranco
--

COPY public.sliders (id, user_id, status, name, file_path, file_name, content, s_order, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: timeline-profils; Type: TABLE DATA; Schema: public; Owner: juliofranco
--

COPY public."timeline-profils" (id, name, description, deleted_at, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: timelines; Type: TABLE DATA; Schema: public; Owner: juliofranco
--

COPY public.timelines (id, profile_id, title, slug, date, file_path, image, description, deleted_at, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: user_address; Type: TABLE DATA; Schema: public; Owner: juliofranco
--

COPY public.user_address (id, user_id, state_id, city_id, name, addr_info, "default", deleted_at, created_at, updated_at) FROM stdin;
1	1	1	2	Mi Casa	{"add1":"Campo Grande","add2":"Eloy P\\u00e1ez","add3":"446","add4":"Biggie"}	1	\N	2023-05-11 18:35:00	2023-05-11 18:35:00
\.


--
-- Data for Name: user_favorites; Type: TABLE DATA; Schema: public; Owner: juliofranco
--

COPY public.user_favorites (id, user_id, module, object_id, created_at, updated_at) FROM stdin;
1	1	1	3	2023-06-04 23:05:06	2023-06-04 23:05:06
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: juliofranco
--

COPY public.users (id, role, name, lastname, phone, birthday, gender, email, email_verified_at, password, password_code, status, avatar, permissions, remember_token, created_at, updated_at) FROM stdin;
1	1	Julio	Franco	981574711	1981-11-11	1	jucfra23@gmail.com	\N	$2y$10$15y.eiphQmqZsIANs8/81e7vr7YnT7kWoXohhNQKgBWdpiZKtUKIy	\N	1	349_tito.jpg	{"dashboard":"true","dashboard_small_stats":"true","dashboard_sell_today":"true","products":"true","product_add":"true","product_edit":"true","product_search":"true","product_delete":"true","product_gallery_add":"true","product_gallery_delete":"true","product_inventory":"true","categories":"true","category_add":"true","category_edit":"true","category_delete":"true","user_list":"true","user_edit":"true","user_banned":"true","user_permissions":"true","settings":"true","sliders_list":"true","slider_add":"true","slider_edit":"true","slider_delete":"true","orders_list":"true","coverage_list":"true","coverage_add":"true","coverage_edit":"true","coverage_delete":"true"}	7uTiXgVjQC4xgpGwGK2aLJA7soULlxXMc1tpXLCIKd4E36WQex5X0X82pMub	2023-05-07 19:44:35	2023-07-06 20:00:37
\.


--
-- Name: categories_id_seq; Type: SEQUENCE SET; Schema: public; Owner: juliofranco
--

SELECT pg_catalog.setval('public.categories_id_seq', 5, true);


--
-- Name: coverage_id_seq; Type: SEQUENCE SET; Schema: public; Owner: juliofranco
--

SELECT pg_catalog.setval('public.coverage_id_seq', 2, true);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: juliofranco
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: galleries_id_seq; Type: SEQUENCE SET; Schema: public; Owner: juliofranco
--

SELECT pg_catalog.setval('public.galleries_id_seq', 1, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: juliofranco
--

SELECT pg_catalog.setval('public.migrations_id_seq', 253, true);


--
-- Name: orders_id_seq; Type: SEQUENCE SET; Schema: public; Owner: juliofranco
--

SELECT pg_catalog.setval('public.orders_id_seq', 4, true);


--
-- Name: orders_items_id_seq; Type: SEQUENCE SET; Schema: public; Owner: juliofranco
--

SELECT pg_catalog.setval('public.orders_items_id_seq', 5, true);


--
-- Name: product_gallery_id_seq; Type: SEQUENCE SET; Schema: public; Owner: juliofranco
--

SELECT pg_catalog.setval('public.product_gallery_id_seq', 1, false);


--
-- Name: product_inventory_id_seq; Type: SEQUENCE SET; Schema: public; Owner: juliofranco
--

SELECT pg_catalog.setval('public.product_inventory_id_seq', 3, true);


--
-- Name: product_inventory_variants_id_seq; Type: SEQUENCE SET; Schema: public; Owner: juliofranco
--

SELECT pg_catalog.setval('public.product_inventory_variants_id_seq', 6, true);


--
-- Name: products_id_seq; Type: SEQUENCE SET; Schema: public; Owner: juliofranco
--

SELECT pg_catalog.setval('public.products_id_seq', 6, true);


--
-- Name: sliders_id_seq; Type: SEQUENCE SET; Schema: public; Owner: juliofranco
--

SELECT pg_catalog.setval('public.sliders_id_seq', 1, false);


--
-- Name: timeline-profils_id_seq; Type: SEQUENCE SET; Schema: public; Owner: juliofranco
--

SELECT pg_catalog.setval('public."timeline-profils_id_seq"', 1, false);


--
-- Name: timelines_id_seq; Type: SEQUENCE SET; Schema: public; Owner: juliofranco
--

SELECT pg_catalog.setval('public.timelines_id_seq', 1, false);


--
-- Name: user_address_id_seq; Type: SEQUENCE SET; Schema: public; Owner: juliofranco
--

SELECT pg_catalog.setval('public.user_address_id_seq', 1, true);


--
-- Name: user_favorites_id_seq; Type: SEQUENCE SET; Schema: public; Owner: juliofranco
--

SELECT pg_catalog.setval('public.user_favorites_id_seq', 1, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: juliofranco
--

SELECT pg_catalog.setval('public.users_id_seq', 1, true);


--
-- Name: categories categories_pkey; Type: CONSTRAINT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (id);


--
-- Name: coverage coverage_pkey; Type: CONSTRAINT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.coverage
    ADD CONSTRAINT coverage_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: galleries galleries_pkey; Type: CONSTRAINT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.galleries
    ADD CONSTRAINT galleries_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: orders_items orders_items_pkey; Type: CONSTRAINT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.orders_items
    ADD CONSTRAINT orders_items_pkey PRIMARY KEY (id);


--
-- Name: orders orders_pkey; Type: CONSTRAINT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_pkey PRIMARY KEY (id);


--
-- Name: product_gallery product_gallery_pkey; Type: CONSTRAINT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.product_gallery
    ADD CONSTRAINT product_gallery_pkey PRIMARY KEY (id);


--
-- Name: product_inventory product_inventory_pkey; Type: CONSTRAINT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.product_inventory
    ADD CONSTRAINT product_inventory_pkey PRIMARY KEY (id);


--
-- Name: product_inventory_variants product_inventory_variants_pkey; Type: CONSTRAINT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.product_inventory_variants
    ADD CONSTRAINT product_inventory_variants_pkey PRIMARY KEY (id);


--
-- Name: products products_pkey; Type: CONSTRAINT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_pkey PRIMARY KEY (id);


--
-- Name: sliders sliders_pkey; Type: CONSTRAINT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.sliders
    ADD CONSTRAINT sliders_pkey PRIMARY KEY (id);


--
-- Name: timeline-profils timeline-profils_pkey; Type: CONSTRAINT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public."timeline-profils"
    ADD CONSTRAINT "timeline-profils_pkey" PRIMARY KEY (id);


--
-- Name: timelines timelines_pkey; Type: CONSTRAINT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.timelines
    ADD CONSTRAINT timelines_pkey PRIMARY KEY (id);


--
-- Name: user_address user_address_pkey; Type: CONSTRAINT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.user_address
    ADD CONSTRAINT user_address_pkey PRIMARY KEY (id);


--
-- Name: user_favorites user_favorites_pkey; Type: CONSTRAINT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.user_favorites
    ADD CONSTRAINT user_favorites_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: password_resets_email_index; Type: INDEX; Schema: public; Owner: juliofranco
--

CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);


--
-- Name: products products_category_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_category_id_foreign FOREIGN KEY (category_id) REFERENCES public.categories(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: timelines timelines_profile_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: juliofranco
--

ALTER TABLE ONLY public.timelines
    ADD CONSTRAINT timelines_profile_id_foreign FOREIGN KEY (profile_id) REFERENCES public."timeline-profils"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

