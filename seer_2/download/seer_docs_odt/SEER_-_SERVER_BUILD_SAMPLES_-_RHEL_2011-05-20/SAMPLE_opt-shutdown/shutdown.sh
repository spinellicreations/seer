#!/bin/bash
# shutdown identification

SERVER=wheeljack

DATESTAMP=`/bin/date +%Y_%m%d_%H:%M:%S`
NAME=shutdown
OUTPUTDIR=/mnt/backup/server_logs/${SERVER}
FILENAME=${OUTPUTDIR}/${DATESTAMP}_${NAME}.log
PKILL=/usr/bin/pkill
SHUTDOWN=/sbin/shutdown
SLEEP=/bin/sleep
TAR=/bin/tar
MT=/bin/mt

echo ""
echo "SYSTEM SHUTDOWN REQUESTED"
echo ""
echo "... killing all threads,"
echo "... and shutting down the system."
echo ""

echo "${SERVER}  SHUTDOWN was requested at ${DATESTAMP}" >> ${FILENAME}

# TAKE DOWN PROCESSES BEFORE SHUTDOWN THAT DO NOT STOP ON THEIR OWN
#
# STaRBUC
# -------
echo ""
echo "KILL STARBUC OPS"
echo ""
$PKILL $MT
$PKILL $TAR
$PKILL $MT
#
# syphon
# ------
echo ""
echo "KILL SYPHON OPS"
echo ""
$PKILL syphon
#
# mod_openopc
# -----------
echo ""
echo "KILL MOD_OPENOPC OPS"
echo ""
$PKILL mod_openopc
#
# Sun Virtual Box
# ---------------
echo ""
echo "GRACEFULLY BRING DOWN VIRTUAL MACHINES"
echo ""
/usr/bin/VBoxManage controlvm "ironhide" acpipowerbutton
echo ""
echo "WAITING 4 MINUTES TO ALLOW VIRTUAL MACHINES TO EXIT"
$SLEEP 30
echo "------- WAITING 3 1/2 MINUTES"
$SLEEP 30
echo "------- WAITING 3 MINUTES"
$SLEEP 30
echo "------- WAITING 2 1/2 MINUTES"
$SLEEP 30
echo "------- WAITING 2 MINUTES"
$SLEEP 30
echo "------- WAITING 1 1/2 MINUTES"
$SLEEP 30
echo "------- WAITING 1 MINUTE"
$SLEEP 30
echo "------- WAITING 1/2 MINUTE"
$SLEEP 30
echo "------- PROCEEDING"
echo ""
#
# MYSQL SERVER
# ------------
echo ""
echo "KILL MYSQL_INNODB_BACKUP OPS"
echo ""
$PKILL mysql_innodb_backup
echo ""
echo "GRACEFULLY STOP MYSQL DB SERVER"
echo ""
/etc/init.d/mysqld stop
#

# HAND OFF TO SYS SHUTDOWN
#
echo ""
echo "PROCEED WITH STANDARD SYSTEM SHUTDOWN FROM HERE..."
echo ""
$SHUTDOWN -h now
#
