#!/bin/bash
# api-tests.sh
# Copyright (C) 2018 Gerald B. Hammack <wizard171@gmail.com>
# ----------------------------------------------------------------------------
# Pgmr:  Gerald B. Hammack
# Desc:  Using curl to test api calls
# ----------------------------------------------------------------------------
# Notes:
#
# - make sure you have the correct ".env" information for your database
# - that you have created the necessary databases
# - and whichever database you are referencing in ".env" has data (or not?)
#   - php artisan migrate:fresh --seed
#
# - I have installed json via "npm install -g json" locally in my dev
# ----------------------------------------------------------------------------

# ----------------------------------------------------------------------------
# run all test on an api
# ----------------------------------------------------------------------------
runall()
{
  echo "running api test against: ${1}"  | ${TEE} -a ${LOGFLN}
  URL="${APP_URL}/api/${1}"
  echo ${URL}                            | ${TEE} -a ${LOGFLN}
  ${CURL}  "${URL}"                      | ${JSON} -j    >>  ${LOGFLN}  2>&1
}

# ----------------------------------------------------------------------------
# run all test on an api
# ----------------------------------------------------------------------------
runallauth()
{
  echo "running api test against: ${1}"  | ${TEE} -a ${LOGFLN}
  URL="${APP_URL}/api/${1}?api_token=$(echo ${ATOKEN})"
  echo ${URL}                            | ${TEE} -a ${LOGFLN}
  ${CURL}  "${URL}"                      | ${JSON} -j    >>  ${LOGFLN}  2>&1
}

# ----------------------------------------------------------------------------
# run one test on an api
# ----------------------------------------------------------------------------
runone()
{
  echo "running api test against: ${1}"  | ${TEE} -a ${LOGFLN}
  URL="${APP_URL}/api/${1}/${2}"
  echo ${URL}                            | ${TEE} -a ${LOGFLN}
  ${CURL}  "${URL}"                      | ${JSON} -j    >>  ${LOGFLN}  2>&1
}

# ----------------------------------------------------------------------------
# run one test on an api
# ----------------------------------------------------------------------------
runoneauth()
{
  echo "running api test against: ${1}"  | ${TEE} -a ${LOGFLN}
  URL="${APP_URL}/api/${1}/${2}?api_token=$(echo ${ATOKEN})"
  echo ${URL}                            | ${TEE} -a ${LOGFLN}
  ${CURL}  "${URL}"                      | ${JSON} -j    >>  ${LOGFLN}  2>&1
}

#
# source current configuration and define variables
# ----------------------------------------------------------------------------
. .env

# ----------------------------------------------------------------------------
# commands we need for these tests, often not available in docker images
# ----------------------------------------------------------------------------
# do we have curl?
CURL=$(which curl)
if [ "${CURL}" =  "" ]; then 
  echo "Oops!  No \"curl\" available to get results."
  exit 1
fi

# do we have json?
JSON=$(which json)
if [ "${JSON}" =  "" ]; then 
  echo "Oops!  No \"json\" available to pipe results into."
  exit 1
fi

# do we have tee?
TEE=$(which tee)
if [ "${TEE}" =  "" ]; then 
  echo "Oops!  No \"tee\" available to append output to log file."
  exit 1
fi

# 
# default seeder value for admin user apitoken
# or, comment this out and copy/paste the value from the table
DBNAME=${DB_DATABASE}
SQLSTR="select api_token from users where id = 1"
ATOKEN=$(echo "${SQLSTR}" | sudo -u postgres -- psql -qt -d ${DBNAME})
#
#ATOKEN='your-value-goes-here'
#echo ${ATOKEN}
#exit 1

# default values
NOWDTM=`date +%Y%m%d-%H%M%S`
LOGFLN="$(basename $0 .sh)-$NOWDTM.log"

TESTID=${1:-allauth}
ITEMID=${2:-3}

#
# what are we doing?
# ----------------------------------------------------------------------------
case "${TESTID}" in

#
# all records from existing api  (list of articles does not require auth)
all)
  echo "api test for all records ..."  | ${TEE} -a ${LOGFLN}
  runall      article
  runallauth  contact
  runallauth  user
  ;;

#
# all records from existing api
allauth)
  echo "api test for all records ..."  | ${TEE} -a ${LOGFLN}
  runallauth  article
  runallauth  contact
  runallauth  user
  ;;

#
# one record from each existing api  (get one article does not require auth)
one)
  echo "api test for one record  ... ITEMID: ${ITEMID} ..."  | ${TEE} -a ${LOGFLN}
  runone      article  ${ITEMID}
  runoneauth  contact  ${ITEMID}
  runoneauth  user     ${ITEMID}
  ;;

#
# one record from each existing api  (send auth with every request)
oneauth)
  echo "api test for one record  ... ITEMID: ${ITEMID} ..."  | ${TEE} -a ${LOGFLN}
  runoneauth  article  ${ITEMID}
  runoneauth  contact  ${ITEMID}
  runoneauth  user     ${ITEMID}
  ;;

#
# one of the tests copied from above, without having to do them all, eh?
test)
  echo "api test of just one ..."  | ${TEE} -a ${LOGFLN}
  URL="http://192.168.254.12/wts/api/user?api_token=$(echo ${ATOKEN})"
  echo ${URL}
  #${CURL}  "${URL}"                | ${JSON} -j    >>  ${LOGFLN}  2>&1
  runallauth user
  ;;

-h|--help|*)
  echo "Usage: $0  {all|allauth|one|oneauth} {id}"
  echo "  if {all|allauth|one|oneauth} is not specified, you get {allauth} tests by default "
  echo "  if {id} is not specified, you get id 3 by default "
  echo "  if you wanted something more specific, use this to write your own! "

esac

#
# tidy up
# ----------------------------------------------------------------------------
if [ -f "${LOGFLN}" ]; then
  echo "logged results are in: ${LOGFLN}"
fi
