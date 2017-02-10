#!/bin/bash

parm=($QUERY_STRING)

echo "Content-type: text/html"
echo ""
echo "<!doctype html>"
echo "<HTML>"
echo "<b>Working"
Intensite1=`echo $parm | cut -d'&' -f 1 | cut -d'=' -f 2`
Intensite2=`echo $parm | cut -d'&' -f 2 | cut -d'=' -f 2 | cut -d'&' -f 1`
Intensite3=`echo $parm | cut -d'&' -f 3 | cut -d'=' -f 2 | cut -d'&' -f 1`
Intensite4=`echo $parm | cut -d'&' -f 4 | cut -d'=' -f 2 | cut -d'&' -f 1`
echo "{" > /var/www/html/javascript/data.json
echo "\"Intensite1\": $Intensite1," >> /var/www/html/javascript/data.json
echo "\"Intensite2\": $Intensite2," >> /var/www/html/javascript/data.json
echo "\"Intensite3\": $Intensite3," >> /var/www/html/javascript/data.json
echo "\"Intensite4\": $Intensite4" >> /var/www/html/javascript/data.json
echo "}" >> /var/www/html/javascript/data.json
echo "</b>"
echo "</HTML>"