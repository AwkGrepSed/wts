#!/bin/bash
# sqlexec.sh
# Copyright (C) 2018 Gerald B. Hammack <wizard171@gmail.com>
# ----------------------------------------------------------------------------
# Pgmr:  Gerald B. Hammack
# Desc:  Execute a local ".sql" file
# ----------------------------------------------------------------------------

# obtain the current .env
.  ../.env
# ----------------------------------------------------------------------------
DBNAME=${DB_DATABASE}
#DBNAME=${DB_DATABASE}test
SQLFLN=${1:-nope}
NOWDTM=`date +%Y%m%d-%H%M%S`
LOGFLN=${SQLFLN}-$NOWDTM.log
# ----------------------------------------------------------------------------
if [ "${SQLFLN}" = "nope" ]; then
  echo "Usage: ${0}  {filename}"
  exit 1
fi
# ----------------------------------------------------------------------------
echo "`date` - SQL: ${SQLFLN} starting ..."
cat /dev/null > $LOGFLN

sudo -u postgres -- \
  psql \
    -d ${DBNAME}  \
    -f ${SQLFLN}  \
>> $LOGFLN 2>&1
# ----------------------------------------------------------------------------
echo "`date` - SQL: ${SQLFLN} finished ... Logfile :${LOGFLN}:"
cat ${LOGFLN}
