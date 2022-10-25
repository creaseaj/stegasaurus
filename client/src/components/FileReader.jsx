import React from 'react'
import { useState } from 'react';
import { useSelector } from 'react-redux'
import { Stego } from '../images/StegoLogo'
import { Buffer } from 'buffer'
import { useEffect } from 'react';

const File = () => {
    let fileReader;
    const [output, setOutput] = useState(null)
    const image = useSelector((state) => state.image.preview)
    const handleFileRead = (e) => {
        const content = fileReader.result;
        setOutput(content)
    };
    const handleFileChosen = () => {
        if (image) {
            fetch(image).then(res => res.blob()).then(blob => {
                fileReader = new FileReader();
                fileReader.onloadend = handleFileRead;
                fileReader.readAsBinaryString(blob);
            });
        }
    };
    useEffect(() => {
        console.log({ 'output': output })
        handleFileChosen()
    }, [image])
    // console.log(output && Buffer.from(output, 'utf-8').toString('hex').match(/.{1,4}/g))
    console.log(output)
    const Patches = () => {
        return (<div className='flex gap-[1px] flex-wrap'>
            {output && Buffer.from(output, 'binary').toString('hex').match(/.{1,2}/g).map((patch, index) =>
                <div key={index} className='flex hover:bg-slate-700 transition-all bg-transparent cursor-default p-[1px] rounded-[4px]'>
                    {patch}
                </div>
            )}
        </div>)
    }
    return (
        <div>
            <div className='font-mono break-all '>
                <Patches />
            </div>
        </div>
    )
}

export default File