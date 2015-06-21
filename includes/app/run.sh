#!/bin/bash
script=$1
file=$2

# handle line breaks properly; needed when a line has spaces or tabs
IFS=$'\n'

for i in `cat $file`
do
	/usr/bin/python $1 "$i"
done
