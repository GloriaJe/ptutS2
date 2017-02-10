#!/bin/bash

parm=($QUERY_STRING)


echo "Content-type: text/html"
echo ""
echo "<!doctype html>"
echo "<HTML>"
echo "<b>working"
numLed=`echo $parm | cut -d'&' -f 1 | cut -d'=' -f 2`
echo $numLed
echo "</b>"
echo "</HTML>"

nohup sudo python /var/www/LightPi/bin/allumer_eteindre.py $numLed &

