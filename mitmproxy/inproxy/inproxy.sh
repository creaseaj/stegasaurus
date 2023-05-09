#!/bin/bash
echo 'api key:' $1

inotifywait -r -m /images -e create |
    while read dir action file; do
        image_path=$dir$file
        echo $image_path >> /home/log.txt
        stegseek $image_path /steg/rockyou.txt 2>> /home/log.txt
        output=$?
        success=0
        echo $output
        if [ $output -eq $success ] ; then
            output_path=$image_path'.out'
            echo "Found the above data hidden inside an image"
            echo "Uploading to server"
            echo "file=${image_path}"
            m=$(curl --location --request POST "http://laravel.test/api/images/${1}" --form "file=@${image_path}" 2>&1)
            if [ $? -ne 0 ] ; then
            echo "Error: ""$m"
            fi
        fi
    #   if  file starts with steg
        if [[ $file == steg* ]]; then
            # curl upload to server 
            echo "Detected image using SPAM, uploading..."
            m=$(curl --location --request POST "http://laravel.test/api/images/${1}" --form "file=@${image_path}" 2>&1)
            if [ $? -ne 0 ] ; then
            echo "Error: ""$m"
            fi
        fi
        rm $image_path
        rm $output_path
        echo 'done with ' . $image_path
        # do something with the file
    done