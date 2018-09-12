-- wtsdb.sql
-- Copyright (C) 2018 Gerald B. Hammack <wizard171@gmail.com>
-- ---------------------------------------------------------------------------
-- Pgmr:  Gerald B. Hammack
-- Desc:  Build the Database
-- ---------------------------------------------------------------------------
--
\echo Drop and Create databases
-- (test)
DROP   DATABASE IF EXISTS wtsdbtest;
CREATE DATABASE           wtsdbtest;
-- (prod)
DROP   DATABASE IF EXISTS wtsdb;
CREATE DATABASE           wtsdb;
\connect wtsdb
