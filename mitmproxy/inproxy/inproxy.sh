#!/bin/bash

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
        fi
        # do something with the file
    done