--
-- PostgreSQL database dump
--

-- Dumped from database version 12.2 (Debian 12.2-2.pgdg100+1)
-- Dumped by pg_dump version 12.2 (Ubuntu 12.2-2.pgdg18.04+1)

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
-- Name: article; Type: TABLE; Schema: public; Owner: newsportal
--

CREATE TABLE public.article (
    id bigint NOT NULL,
    author_id integer NOT NULL,
    title character varying(128) NOT NULL,
    writing_time timestamp(0) without time zone NOT NULL,
    description character varying(512) DEFAULT NULL::character varying,
    views_count integer NOT NULL,
    content text NOT NULL
);


ALTER TABLE public.article OWNER TO newsportal;

--
-- Name: article_id_seq; Type: SEQUENCE; Schema: public; Owner: newsportal
--

CREATE SEQUENCE public.article_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.article_id_seq OWNER TO newsportal;

--
-- Name: articles_has_tags; Type: TABLE; Schema: public; Owner: newsportal
--

CREATE TABLE public.articles_has_tags (
    article_id bigint NOT NULL,
    tag_id integer NOT NULL
);


ALTER TABLE public.articles_has_tags OWNER TO newsportal;

--
-- Name: author_requests; Type: TABLE; Schema: public; Owner: newsportal
--

CREATE TABLE public.author_requests (
    id integer NOT NULL,
    name character varying(30) NOT NULL,
    surname character varying(30) NOT NULL,
    country character varying(30) NOT NULL,
    birthday date,
    language character varying(80) DEFAULT NULL::character varying,
    email character varying(255) NOT NULL,
    phone character varying(30) NOT NULL,
    edu character varying(128) DEFAULT NULL::character varying,
    categories character varying(80) DEFAULT NULL::character varying,
    bio character varying(512) DEFAULT NULL::character varying,
    previous_works character varying(512) DEFAULT NULL::character varying,
    other character varying(512) DEFAULT NULL::character varying
);


ALTER TABLE public.author_requests OWNER TO newsportal;

--
-- Name: author_requests_id_seq; Type: SEQUENCE; Schema: public; Owner: newsportal
--

CREATE SEQUENCE public.author_requests_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.author_requests_id_seq OWNER TO newsportal;

--
-- Name: comment; Type: TABLE; Schema: public; Owner: newsportal
--

CREATE TABLE public.comment (
    id bigint NOT NULL,
    written_by integer NOT NULL,
    to_article bigint NOT NULL,
    added_time timestamp(0) without time zone NOT NULL,
    content character varying(1024) NOT NULL
);


ALTER TABLE public.comment OWNER TO newsportal;

--
-- Name: comment_id_seq; Type: SEQUENCE; Schema: public; Owner: newsportal
--

CREATE SEQUENCE public.comment_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.comment_id_seq OWNER TO newsportal;

--
-- Name: confirmation; Type: TABLE; Schema: public; Owner: newsportal
--

CREATE TABLE public.confirmation (
    id integer NOT NULL,
    for_user integer NOT NULL,
    key character varying(255) NOT NULL,
    expired timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.confirmation OWNER TO newsportal;

--
-- Name: confirmation_id_seq; Type: SEQUENCE; Schema: public; Owner: newsportal
--

CREATE SEQUENCE public.confirmation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.confirmation_id_seq OWNER TO newsportal;

--
-- Name: migration_versions; Type: TABLE; Schema: public; Owner: newsportal
--

CREATE TABLE public.migration_versions (
    version character varying(14) NOT NULL,
    executed_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.migration_versions OWNER TO newsportal;

--
-- Name: COLUMN migration_versions.executed_at; Type: COMMENT; Schema: public; Owner: newsportal
--

COMMENT ON COLUMN public.migration_versions.executed_at IS '(DC2Type:datetime_immutable)';


--
-- Name: tag; Type: TABLE; Schema: public; Owner: newsportal
--

CREATE TABLE public.tag (
    id integer NOT NULL,
    tag_title character varying(30) NOT NULL
);


ALTER TABLE public.tag OWNER TO newsportal;

--
-- Name: tag_id_seq; Type: SEQUENCE; Schema: public; Owner: newsportal
--

CREATE SEQUENCE public.tag_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tag_id_seq OWNER TO newsportal;

--
-- Name: usr; Type: TABLE; Schema: public; Owner: newsportal
--

CREATE TABLE public.usr (
    id integer NOT NULL,
    username character varying(180) NOT NULL,
    roles json NOT NULL,
    password character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    description character varying(512) DEFAULT NULL::character varying,
    user_pic character varying(255) DEFAULT NULL::character varying,
    is_activated boolean NOT NULL
);


ALTER TABLE public.usr OWNER TO newsportal;

--
-- Name: usr_id_seq; Type: SEQUENCE; Schema: public; Owner: newsportal
--

CREATE SEQUENCE public.usr_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usr_id_seq OWNER TO newsportal;

--
-- Data for Name: article; Type: TABLE DATA; Schema: public; Owner: newsportal
--

COPY public.article (id, author_id, title, writing_time, description, views_count, content) FROM stdin;
\.


--
-- Data for Name: articles_has_tags; Type: TABLE DATA; Schema: public; Owner: newsportal
--

COPY public.articles_has_tags (article_id, tag_id) FROM stdin;
\.


--
-- Data for Name: author_requests; Type: TABLE DATA; Schema: public; Owner: newsportal
--

COPY public.author_requests (id, name, surname, country, birthday, language, email, phone, edu, categories, bio, previous_works, other) FROM stdin;
\.


--
-- Data for Name: comment; Type: TABLE DATA; Schema: public; Owner: newsportal
--

COPY public.comment (id, written_by, to_article, added_time, content) FROM stdin;
\.


--
-- Data for Name: confirmation; Type: TABLE DATA; Schema: public; Owner: newsportal
--

COPY public.confirmation (id, for_user, key, expired) FROM stdin;
\.


--
-- Data for Name: migration_versions; Type: TABLE DATA; Schema: public; Owner: newsportal
--

COPY public.migration_versions (version, executed_at) FROM stdin;
20200428005733	2020-04-28 00:58:23
20200430234229	2020-04-30 23:45:16
20200502231009	2020-05-02 23:11:10
\.


--
-- Data for Name: tag; Type: TABLE DATA; Schema: public; Owner: newsportal
--

COPY public.tag (id, tag_title) FROM stdin;
\.


--
-- Data for Name: usr; Type: TABLE DATA; Schema: public; Owner: newsportal
--

COPY public.usr (id, username, roles, password, email, description, user_pic, is_activated) FROM stdin;
\.


--
-- Name: article_id_seq; Type: SEQUENCE SET; Schema: public; Owner: newsportal
--

SELECT pg_catalog.setval('public.article_id_seq', 1, false);


--
-- Name: author_requests_id_seq; Type: SEQUENCE SET; Schema: public; Owner: newsportal
--

SELECT pg_catalog.setval('public.author_requests_id_seq', 4, true);


--
-- Name: comment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: newsportal
--

SELECT pg_catalog.setval('public.comment_id_seq', 1, false);


--
-- Name: confirmation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: newsportal
--

SELECT pg_catalog.setval('public.confirmation_id_seq', 16, true);


--
-- Name: tag_id_seq; Type: SEQUENCE SET; Schema: public; Owner: newsportal
--

SELECT pg_catalog.setval('public.tag_id_seq', 1, false);


--
-- Name: usr_id_seq; Type: SEQUENCE SET; Schema: public; Owner: newsportal
--

SELECT pg_catalog.setval('public.usr_id_seq', 52, true);


--
-- Name: article article_pkey; Type: CONSTRAINT; Schema: public; Owner: newsportal
--

ALTER TABLE ONLY public.article
    ADD CONSTRAINT article_pkey PRIMARY KEY (id);


--
-- Name: articles_has_tags articles_has_tags_pkey; Type: CONSTRAINT; Schema: public; Owner: newsportal
--

ALTER TABLE ONLY public.articles_has_tags
    ADD CONSTRAINT articles_has_tags_pkey PRIMARY KEY (article_id, tag_id);


--
-- Name: author_requests author_requests_pkey; Type: CONSTRAINT; Schema: public; Owner: newsportal
--

ALTER TABLE ONLY public.author_requests
    ADD CONSTRAINT author_requests_pkey PRIMARY KEY (id);


--
-- Name: comment comment_pkey; Type: CONSTRAINT; Schema: public; Owner: newsportal
--

ALTER TABLE ONLY public.comment
    ADD CONSTRAINT comment_pkey PRIMARY KEY (id);


--
-- Name: confirmation confirmation_pkey; Type: CONSTRAINT; Schema: public; Owner: newsportal
--

ALTER TABLE ONLY public.confirmation
    ADD CONSTRAINT confirmation_pkey PRIMARY KEY (id);


--
-- Name: migration_versions migration_versions_pkey; Type: CONSTRAINT; Schema: public; Owner: newsportal
--

ALTER TABLE ONLY public.migration_versions
    ADD CONSTRAINT migration_versions_pkey PRIMARY KEY (version);


--
-- Name: tag tag_pkey; Type: CONSTRAINT; Schema: public; Owner: newsportal
--

ALTER TABLE ONLY public.tag
    ADD CONSTRAINT tag_pkey PRIMARY KEY (id);


--
-- Name: usr usr_pkey; Type: CONSTRAINT; Schema: public; Owner: newsportal
--

ALTER TABLE ONLY public.usr
    ADD CONSTRAINT usr_pkey PRIMARY KEY (id);


--
-- Name: idx_23a0e66f675f31b; Type: INDEX; Schema: public; Owner: newsportal
--

CREATE INDEX idx_23a0e66f675f31b ON public.article USING btree (author_id);


--
-- Name: idx_9374b9637294869c; Type: INDEX; Schema: public; Owner: newsportal
--

CREATE INDEX idx_9374b9637294869c ON public.articles_has_tags USING btree (article_id);


--
-- Name: idx_9374b963bad26311; Type: INDEX; Schema: public; Owner: newsportal
--

CREATE INDEX idx_9374b963bad26311 ON public.articles_has_tags USING btree (tag_id);


--
-- Name: idx_9474526c8ca23393; Type: INDEX; Schema: public; Owner: newsportal
--

CREATE INDEX idx_9474526c8ca23393 ON public.comment USING btree (to_article);


--
-- Name: idx_9474526cfda3cc86; Type: INDEX; Schema: public; Owner: newsportal
--

CREATE INDEX idx_9474526cfda3cc86 ON public.comment USING btree (written_by);


--
-- Name: uniq_1762498ce7927c74; Type: INDEX; Schema: public; Owner: newsportal
--

CREATE UNIQUE INDEX uniq_1762498ce7927c74 ON public.usr USING btree (email);


--
-- Name: uniq_1762498cf85e0677; Type: INDEX; Schema: public; Owner: newsportal
--

CREATE UNIQUE INDEX uniq_1762498cf85e0677 ON public.usr USING btree (username);


--
-- Name: uniq_483d123c5e26b7dc; Type: INDEX; Schema: public; Owner: newsportal
--

CREATE UNIQUE INDEX uniq_483d123c5e26b7dc ON public.confirmation USING btree (for_user);


--
-- Name: uniq_9415fce4e7927c74; Type: INDEX; Schema: public; Owner: newsportal
--

CREATE UNIQUE INDEX uniq_9415fce4e7927c74 ON public.author_requests USING btree (email);


--
-- Name: article fk_23a0e66f675f31b; Type: FK CONSTRAINT; Schema: public; Owner: newsportal
--

ALTER TABLE ONLY public.article
    ADD CONSTRAINT fk_23a0e66f675f31b FOREIGN KEY (author_id) REFERENCES public.usr(id);


--
-- Name: confirmation fk_483d123c5e26b7dc; Type: FK CONSTRAINT; Schema: public; Owner: newsportal
--

ALTER TABLE ONLY public.confirmation
    ADD CONSTRAINT fk_483d123c5e26b7dc FOREIGN KEY (for_user) REFERENCES public.usr(id);


--
-- Name: articles_has_tags fk_9374b9637294869c; Type: FK CONSTRAINT; Schema: public; Owner: newsportal
--

ALTER TABLE ONLY public.articles_has_tags
    ADD CONSTRAINT fk_9374b9637294869c FOREIGN KEY (article_id) REFERENCES public.article(id) ON DELETE CASCADE;


--
-- Name: articles_has_tags fk_9374b963bad26311; Type: FK CONSTRAINT; Schema: public; Owner: newsportal
--

ALTER TABLE ONLY public.articles_has_tags
    ADD CONSTRAINT fk_9374b963bad26311 FOREIGN KEY (tag_id) REFERENCES public.tag(id) ON DELETE CASCADE;


--
-- Name: comment fk_9474526c8ca23393; Type: FK CONSTRAINT; Schema: public; Owner: newsportal
--

ALTER TABLE ONLY public.comment
    ADD CONSTRAINT fk_9474526c8ca23393 FOREIGN KEY (to_article) REFERENCES public.article(id);


--
-- Name: comment fk_9474526cfda3cc86; Type: FK CONSTRAINT; Schema: public; Owner: newsportal
--

ALTER TABLE ONLY public.comment
    ADD CONSTRAINT fk_9474526cfda3cc86 FOREIGN KEY (written_by) REFERENCES public.usr(id);


--
-- PostgreSQL database dump complete
--

