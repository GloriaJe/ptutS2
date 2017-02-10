#!/bin/bash

parm=($QUERY_STRING)

echo "Content-type: text/html"
echo ""
echo "<!doctype html>"
echo "<HTML>"
echo "<b>working"
numLed=`echo $parm | cut -d'&' -f 1 | cut -d'=' -f 2`
intensite=`echo $parm | cut -d'&' -f 2 | cut -d'=' -f 2`
echo $numLed
echo $intensite
echo "</b>"
echo "</HTML>"

echo "$numLed=$intensite" > /dev/pi-blaster

