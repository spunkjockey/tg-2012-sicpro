--
-- PostgreSQL database dump
--

-- Dumped from database version 9.1.4
-- Dumped by pg_dump version 9.1.4
-- Started on 2012-09-22 16:51:49

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = sicpro2012, pg_catalog;

--
-- TOC entry 2053 (class 0 OID 0)
-- Dependencies: 171
-- Name: contrato_idcontrato_seq; Type: SEQUENCE SET; Schema: sicpro2012; Owner: postgres
--

SELECT pg_catalog.setval('contrato_idcontrato_seq', 7, true);


--
-- TOC entry 2054 (class 0 OID 0)
-- Dependencies: 214
-- Name: persona_idpersona_seq; Type: SEQUENCE SET; Schema: sicpro2012; Owner: postgres
--

SELECT pg_catalog.setval('persona_idpersona_seq', 3, true);


--
-- TOC entry 2050 (class 0 OID 17652)
-- Dependencies: 213
-- Data for Name: persona; Type: TABLE DATA; Schema: sicpro2012; Owner: postgres
--

INSERT INTO persona (idpersona, idcargofuncional, idplaza, nombrespersona, apellidospersona, telefonocontacto, correoelectronico) VALUES (1, 5, 1, 'Eliseo ', 'Quintanilla', '23451234', 'cheyo@gmail.com');
INSERT INTO persona (idpersona, idcargofuncional, idplaza, nombrespersona, apellidospersona, telefonocontacto, correoelectronico) VALUES (2, 4, 1, 'Ramon', 'Morales', '12212121', '12121');
INSERT INTO persona (idpersona, idcargofuncional, idplaza, nombrespersona, apellidospersona, telefonocontacto, correoelectronico) VALUES (3, 5, 4, 'Cesar', 'Campos', '78907890', 'asasas');


--
-- TOC entry 2049 (class 0 OID 17477)
-- Dependencies: 170 2050
-- Data for Name: contrato; Type: TABLE DATA; Schema: sicpro2012; Owner: postgres
--

INSERT INTO contrato (idcontrato, idproyecto, idpersona, idempresa, con_idcontrato, codigocontrato, nombrecontrato, montooriginal, tipocontrato, variacion, plazoejecucion, ordeninicio, fechainiciocontrato, fechafincontrato, detalleobras, estadocontrato, userc, creacion, userm, modificacion) VALUES (6, 5, 1, 1, NULL, '002-2012', 'Construcción de canales de riego', 100000.00, 'Construcción de obras', 0.00, 60, NULL, '2012-10-01', '2012-12-29', 'lorem ipsum', NULL, 'douglas', '2012-09-22 15:26:06.422', NULL, NULL);
INSERT INTO contrato (idcontrato, idproyecto, idpersona, idempresa, con_idcontrato, codigocontrato, nombrecontrato, montooriginal, tipocontrato, variacion, plazoejecucion, ordeninicio, fechainiciocontrato, fechafincontrato, detalleobras, estadocontrato, userc, creacion, userm, modificacion) VALUES (7, 5, 1, 1, NULL, '003-2012', 'Colocación de tuberías ', 50000.00, 'Construcción de obras', 0.00, 60, NULL, '2012-10-01', '2012-12-29', 'lorem ipsum', NULL, 'douglas', '2012-09-22 16:48:42.035', NULL, NULL);


-- Completed on 2012-09-22 16:51:49

--
-- PostgreSQL database dump complete
--

