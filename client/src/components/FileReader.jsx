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
const File = () => {
    const image = useSelector((state) => state.image.preview)
    const [hex, setHex] = useState(null)


    const patches = useMemo(() => {
        const formatImage = async () => {
            if (image) {
                return fetch(image).then(res => res.blob()).then(async blob => {
                    const hex = await fileToHex(blob)
                    return (Buffer.from(hex, 'binary').toString('hex'));
                });
            }
            else {
                return null;
            }
        }
        const hex = formatImage()
        return hex
    }, [image])
    patches.then((data) => {
        setHex(data)
    })
    return (
        <div>

            {image ? !hex
                ? <div className='w-full flex justify-center items-center'> <ClipLoader color='#ddd'
                    loading={true} />
                </div>
                :
                <div className='font-mono flex break-normal w-full max-w-screen'>
                    {hex.toString().replace(/(.{2})/g, "$1 ")}
                </div>
                // : hex.toString().match(/.{1,2}/g).map((patch, index) =>
                //     <div key={index} className='flex hover:bg-slate-700 transition-all bg-transparent cursor-default p-[1px] rounded-[4px]'>
                //         {patch}
                //     </div>
                // )
                : null
            }
        </div >
    )
}

export default File