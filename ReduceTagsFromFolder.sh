#!/bin/bash
#Run ReduceTags.php for each file in folder in parameter.

SrcFolder=$1
if [ ! -d "${SrcFolder}" ];then
	echo "Usage: $0 <Folder that contains HTML files>"
	exit 1;
fi

DstFolder=$1.reduced
[ ! -d ${DstFolder} ] && mkdir ${DstFolder}
for File in `ls -1 "${SrcFolder}"`;do
	/bin/php ReduceTags.php ${SrcFolder}/${File} |\
		tail -n +3  > ${DstFolder}/${File}
	#Remove the first 2 lines because they contain program title and article title
done
