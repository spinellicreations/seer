#!/bin/bash
# power failure identification

SERVER=wheeljack

DATESTAMP=`/bin/date +%Y_%m%d_%H:%M:%S`
NAME=power_failure
OUTPUTDIR=/mnt/backup/server_logs/${SERVER}
FILENAME=${OUTPUTDIR}/${DATESTAMP}_${NAME}.log

echo ""
echo "POWER FAILURE!"
echo ""
echo "... you're running on batteries for now."
echo "... if you don't shut down manually, the"
echo "... system will auto-shutdown when battery"
echo "... capacity has reached low setpoint."
echo ""

echo "${SERVER} backup UPS suffered power failure at ${DATESTAMP}" >> ${FILENAME}
