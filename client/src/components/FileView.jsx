import React, { useMemo, useState } from 'react'
import { useSelector } from 'react-redux'
import { Buffer } from 'buffer'
import ClipLoader from "react-spinners/ClipLoader";

const fileToHex = (file) => {
    return new Promise((resolve) => {
        const reader = new FileReader()
        reader.onload = function (e) {
            const hex = e.target.result
            resolve(hex)
        }
        reader.readAsBinaryString(file);

    })
}
const FileView = () => {
    const image = useSelector((state) => state.image.preview)
    const view = useSelector((state) => state.image.view)
    const [hex, setHex] = useState('')

    const patches = useMemo(() => {
        console.log('running patches');
        const formatImage = async () => {
            if (image) {
                return fetch(image).then(res => res.blob()).then(async blob => {
                    const hex = await fileToHex(blob)
                    return (Buffer.from(hex, 'binary').toString('hex'));
                });
            }
            else {
                return '';
            }
        }
        const hex = formatImage()
        return hex
    }, [image])
    patches.then((data) => {
        if (data === '') return;
        setHex(data)
    })
    return (
        <div className='flex items-center justify-center p-4 m-4 rounded-md text-slate-200 bg-primary-light'>
            {image ? hex === ''
                ? <div className='flex items-center justify-center'> <ClipLoader color='#ddd'
                    loading={true} />
                </div>
                :
                <div className='flex justify-center mx-auto overflow-auto font-mono break-words'>
                    {hex.toString().replace(/(.{2})/g, " $1 ") ?? ''}
                </div>
                : view
            }
        </div >
    )
}

export default FileView