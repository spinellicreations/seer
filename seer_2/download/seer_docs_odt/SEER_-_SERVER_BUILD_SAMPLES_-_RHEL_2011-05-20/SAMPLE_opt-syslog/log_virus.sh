#!/bin/bash
# virus ID

SERVER=wheeljack

DATESTAMP=`/bin/date +%Y_%m%d_%H:%M:%S`
NAME=virus_detected
OUTPUTDIR=/mnt/backup/server_logs/${SERVER}
FILENAME=${OUTPUTDIR}/${DATESTAMP}_${NAME}.log

echo ""
echo "VIRUS DTECTED!"
echo ""
echo "... clamav or the milter has found an infected"
echo "... file or message."
echo ""

echo "${SERVER} -- clamav or the milter has found an infected file or message at ${DATESTAMP}" >> ${FILENAME}

#
