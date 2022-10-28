import React from 'react'
import { useState } from 'react';
import { useSelector } from 'react-redux'
import { Buffer } from 'buffer'
import { useEffect } from 'react';
import Jimp from 'jimp';

const File = () => {
    let fileReader;
    const [output, setOutput] = useState(null)
    const [imageOut, setImageOut] = useState(null)
    const [metaData, setMetaData] = useState(null)
    const image = useSelector((state) => state.image.preview)
    const handleFileRead = (e) => {
        const content = fileReader.result;
        setOutput(content)
    };
    const handleFileChosen = async () => {
        if (image) {
            const newJimp = Jimp.read(image);
            (await newJimp).rotate(90);
            setOutput(await newJimp.getBase64Async(Jimp.MIME_PNG))
            fetch(image).then(res => res.blob()).then(blob => {
                // const newFileReader = new FileReader();
                // newFileReader.onloadend = function (event) {
                //     console.log({ event })
                //     const test = new PNG({ filterType: 4 }).parse(event.target.result, function (error, image) {
                //         if (error) { return; }
                //         for (var y = 0; y < image.height; y++) {
                //             for (var x = 0; x < image.width; x++) {
                //                 var idx = (image.width * y + x) << 2;

                //                 // invert color
                //                 image.data[idx] = 255 - image.data[idx];
                //                 image.data[idx + 1] = 255 - image.data[idx + 1];
                //                 image.data[idx + 2] = 255 - image.data[idx + 2];

                //                 // and reduce opacity
                //                 image.data[idx + 3] = image.data[idx + 3] >> 1;
                //             }
                //         }
                //         //image is the PNG image
                //         let { width, height, data } = image;
                //         setMetaData({
                //             width, height
                //         });
                //         // console.log('image be here', image)
                //         console.log({ 'image': image.pack() })
                //     });
                //     console.log({ 'test': test })
                // };
                // console.log({ 'newFileReader': newFileReader.readAsArrayBuffer(blob) });
                fileReader = new FileReader();
                fileReader.onloadend = handleFileRead;
                fileReader.readAsBinaryString(blob);
            });
        }
    };
    // console.log({ 'out': imageOut })
    // console.log(metaData)
    useEffect(() => {
        handleFileChosen()
    }, [image])
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
        <div className={`bg-[#1E293B] h-full mt-[10px] mx-[10px] rounded-[10px] p-[10px] text-slate-200 transition-all ${image ? 'opacity-100 pointer-events-auto h-full' : 'opacity-0 pointer-events-none h-0'}`}>
            File Reader
            <image src={output} />
            {metaData && Object.keys(metaData).map((meta) => <div>{meta}: {metaData[meta]}</div>)}
            <div>
                <div className={`font-mono break-all `}>
                    <Patches />
                </div>
            </div>
        </div>
    )
}

export default File