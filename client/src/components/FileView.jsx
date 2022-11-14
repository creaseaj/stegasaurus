import React, { useEffect, useMemo, useState } from 'react'
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
const formatImage = async (image) => {
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

const renderHex = (hex) => {
    return hex.toString().replace(/(.{2})/g, "$1 ")
}
const renderStrings = (hex) => {
    const text = Buffer.from(hex, 'hex').toString('ASCII')
    console.log(text);
    return text.match(/\w+/g).join(', ')
}

const FileView = () => {
    const image = useSelector((state) => state.image.preview)
    const view = useSelector((state) => state.image.view)
    const [hex, setHex] = useState('')

    useEffect(() => {
        formatImage(image).then(setHex)
    }, [image])

    // Show different UI Elements based on view
    const RenderView = () => {
        switch (view) {
            case 'strings':
                return renderStrings(hex);
            case 'metadata':
                return (<p>Metadata</p>)
            case 'xor':
                return (<p>xor</p>)
            default: // Also 'hex'
                return renderHex(hex);

        }
    }

    if (!image) return null;
    return (
        <div className='flex items-center justify-center p-4 m-4 rounded-md text-slate-200 bg-primary-light'>
            {hex ?
                <RenderView />
                :
                <div className='flex items-center justify-center'>
                    <ClipLoader
                        color='#ddd'
                        loading={true}
                    />
                </div>
            }
        </div >
    )
}

export default FileView