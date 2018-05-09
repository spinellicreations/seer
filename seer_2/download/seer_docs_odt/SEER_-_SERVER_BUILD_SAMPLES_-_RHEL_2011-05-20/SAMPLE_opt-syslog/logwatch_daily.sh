#!/bin/bash
# logwatch daily report

echo "LOGWATCH REPORT FOR SYSTEM"
echo "---------------------------------"
echo "---------------------------------"
echo "---------------------------------"
echo ""

/usr/sbin/logwatch --detail 5 --print --range Yesterday

echo ""
echo "ALL DONE"
echo "--------"
echo ""
