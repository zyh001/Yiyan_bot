#!/bin/bash
set -e
list=$(cat ./db.txt | wc -l)
num=$(($RANDOM%list+1))
update_db(){
	set -e
	python3 ./getmsg.py >/dev/null 2>&1
	awk '!x[$0]++' db.txt | sed '/^[[:space:]]*$/d' > db1.txt
	mv ./db1.txt db.txt
	echo 0 > /tmp/getyiyan.temp
}
if [[ -f /tmp/getyiyan.temp ]];then
	i=$(cat /tmp/getyiyan.temp)
	if [[ ${i} == "10" ]];then
		(update_db &)
	else
		i=$((i+1))
		echo ${i} > /tmp/getyiyan.temp
	fi
else
	echo 0 > /tmp/getyiyan.temp
fi
echo -e $(sed -n "${num}p" ./db.txt)
exit 0
