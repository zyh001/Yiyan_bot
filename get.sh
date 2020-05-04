#!/bin/bash
set -e
cd "$(dirname "${BASH_SOURCE[0]}")"
list=$(cat ./db.txt | wc -l)
num=$(($RANDOM%list+1))
update_db(){
	set -e
	python3 ./getmsg.py >/dev/null 2>&1
	awk '!x[$0]++' db.txt | sed '/^[[:space:]]*$/d' > db1.txt
	mv ./db1.txt db.txt
	echo 0 > /tmp/getyiyan.temp
}
if [[ ! -z ${1} ]];then
	text=${1}
	checkt="$(python3 ./test.py ${text} 2>/dev/null)"
	if [[ -z ${checkt} ]];then
		echo "未能匹配到一致成分！"
	else
		str1="$(echo ${checkt} | head -1)"
		str2="$(echo ${str1} | awk -F' -> ' '{ print $1}')"
		str3="$(echo ${str1} | awk -F' -> ' '{ print $2}')"
		echo -e "发现相似句：\n\n\`${str3}\`\n\n相似度：*${str2}*\n请人工确认！"
	fi
	exit 0
fi
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
