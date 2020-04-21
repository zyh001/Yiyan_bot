#!/bin/bash

list=$(cat ./db.txt | wc -l)
num=$(($RANDOM%list+1))

echo -e $(sed -n "${num}p" ./db.txt)
