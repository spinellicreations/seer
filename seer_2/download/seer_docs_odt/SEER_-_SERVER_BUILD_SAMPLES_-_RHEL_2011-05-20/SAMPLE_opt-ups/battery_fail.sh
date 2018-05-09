#!/bin/bash
# battery failure identification

SERVER=wheeljack

DATESTAMP=`/bin/date +%Y_%m%d_%H:%M:%S`
NAME=battery_low-fail
OUTPUTDIR=/mnt/backup/server_logs/${SERVER}
FILENAME=${OUTPUTDIR}/${DATESTAMP}_${NAME}.log
MANAGEDSHUTDOWN=/opt/shutdown/shutdown.sh

echo ""
echo "BATTERY IS LOW / FAILURE!"
echo ""
echo "... you've been on batteries for too long."
echo "... you've reached the low threshold of"
echo "... capacity and the system is shutting down."
echo "... the system will stay down until manually"
echo "... restarted."
echo ""

echo "${SERVER} backup UPS suffered low battery or battery failure at ${DATESTAMP}" >> ${FILENAME}

# FORK AND EXECUTE MANAGED SHUTDOWN
# 
$MANAGEDSHUTDOWN &
#
