#!/bin/bash
echo 'api key:' $1

inotifywait -r -m /images -e create |
    while read dir action file; do
        image_path=$dir$file
        echo $image_path >> /home/log.txt
        stegseek $image_path /steg/rockyou/rockyou.txt 2>> /home/log.txt
        output=$?
        success=0
        if [ $output -eq $success ]
        then
            output_path=$file'.out'
            cat $output_path
            echo "Found the above data hidden inside an image"
            echo "Uploading to server"
            echo "file=${image_path}"
            m=$(curl --location --request POST "http://laravel.test/api/images/${1}" --form "file=@${image_path}" 2>&1)
            if [ $? -ne 0 ] ; then
            echo "Error: ""$m"
            fi
            rm $image_path
        fi
        # do something with the file
    done