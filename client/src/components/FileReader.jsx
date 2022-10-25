import React from 'react'
import { useState } from 'react';
import { useSelector } from 'react-redux'
import { Stego } from '../images/StegoLogo'
import { Buffer } from 'buffer'
const File = () => {
    let fileReader;
    const [output, setOutput] = useState(null)
    const handleFileRead = (e) => {
        const content = fileReader.result;
        setOutput(content)
    };
    const handleFileChosen = () => {
        console.log('clicked!')
        if (image) {
            console.log({ 'image': image })
            fetch(image).then(res => res.blob()).then(blob => {
                fileReader = new FileReader();
                fileReader.onloadend = handleFileRead;
                fileReader.readAsText(blob);
            });
        }
    };
    console.log(output && Buffer.from(output, 'utf-8').toString('hex').match(/.{1,4}/g))
    console.log(output)
    const Patches = <div>
        {output && Buffer.from(output, 'utf-8').toString('hex').split("(?=(.{4})+$)").map((patch, index) => {
            <div>
                {patch}
            </div>
        })}
    </div>
    const image = useSelector((state) => state.image.preview)
    fetch(image).then(res => console.log(res))
    return (
        <div>
            <button onClick={handleFileChosen}>Click</button>
            <div className='font-mono break-all '>
                <Patches />
            </div>
        </div>
    )
}

export default File