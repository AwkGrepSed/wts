#!/bin/sh
# makethedb.sh
# Copyright (C) 2018 Gerald B. Hammack <wizard171@gmail.com>
# ----------------------------------------------------------------------------
# Pgmr:  Gerald B. Hammack
# Desc:  Build the PostgreSQL Database
# ----------------------------------------------------------------------------
# I am building/using the .sql file simply because I like having one file
# as a reference to describe everything needed to create the database.
# ----------------------------------------------------------------------------

# ----------------------------------------------------------------------------
# obtain the current .env
# ----------------------------------------------------------------------------
.  ../.env

# ----------------------------------------------------------------------------
# config/init
# ----------------------------------------------------------------------------
SQLFLN=${DB_DATABASE}.sql
NOWDTM=`date +%Y%m%d-%H%M%S`
LOGFLN=${DB_DATABASE}-$NOWDTM.log
cat /dev/null > $LOGFLN
#
# the "testing" database will get created as well
DB_TESTDBNM="${DB_DATABASE}test"

# ----------------------------------------------------------------------------
echo "`date` - Building Database SQL is starting ..."

cat > $SQLFLN <<PART1
-- ${DB_DATABASE}.sql
-- Copyright (C) 2018 Gerald B. Hammack <wizard171@gmail.com>
-- ---------------------------------------------------------------------------
-- Pgmr:  Gerald B. Hammack
-- Desc:  Build the Database
-- ---------------------------------------------------------------------------
--
\echo Drop and Create databases
-- (test)
DROP   DATABASE IF EXISTS ${DB_TESTDBNM};
CREATE DATABASE           ${DB_TESTDBNM};
-- (prod)
DROP   DATABASE IF EXISTS ${DB_DATABASE};
CREATE DATABASE           ${DB_DATABASE};
\connect ${DB_DATABASE}
PART1

# ----------------------------------------------------------------------------
echo "`date` - Building Database from the SQL just built ..."
sudo -u postgres -- psql -f $SQLFLN  >> $LOGFLN 2>&1
# ----------------------------------------------------------------------------
echo "`date` - Building Database SQL is finished ... Logfile :$LOGFLN:"
