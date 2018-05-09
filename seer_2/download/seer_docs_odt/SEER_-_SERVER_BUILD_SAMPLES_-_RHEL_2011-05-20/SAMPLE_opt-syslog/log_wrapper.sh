#!/bin/bash
# logfile scan - wrapper

DATESTAMP=`/bin/date +%Y_%m%d_%H:%M:%S`
SCRIPT=$1
NAME=`/bin/basename "$1"`
NAME=${NAME%.*}
OUTPUTDIR=$2
FILENAME=${OUTPUTDIR}/${DATESTAMP}_${NAME}.log

${SCRIPT} >> ${FILENAME}
