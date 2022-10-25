import React from 'react'
import { useState } from 'react'
import { useCallback } from 'react'
import { useDropzone } from 'react-dropzone'
import { useDispatch, useSelector } from 'react-redux'
import { setPreview } from './imageSlice'
const ImageDisplay = () => {
    const image = useSelector((state) => state.image.preview)
    const [file, setFile] = useState(null)
    const dispatch = useDispatch()
    const onDrop = useCallback(acceptedFiles => {
        // Do something with the files
        console.log(acceptedFiles)
        const file = acceptedFiles[0]
        dispatch(setPreview(URL.createObjectURL(file)));
    }, [])
    const { getRootProps, getInputProps, isDragActive } = useDropzone({
        onDrop,
        accept: 'image/png',
        maxFiles: 1
    })
    return (
        <div className='w-full h-full bg-[#1E293B] rounded-[10px] text-white relative'>

            {/* <div className='text-white flex items-center gap-[10px] p-[10px] xl:p-[15px]  w-full h-full text-lg border-dashed border-2 border-slate-600 justify-center text-slate-500 '>
                + Add an Image

            </div> */}
            <img src={image} alt="steg" className={`absolute inset-0 object-contain w-full h-full ${image ? 'opacity-100 pointer-events-auto' : 'opacity-0 pointer-events-none'} transition-all`} />
            <div className={`${image ? 'opacity-0 pointer-events-none' : 'opacity-100 pointer-events-auto'} transition-all h-full w-full }`}>
                <div {...getRootProps({ className: 'border-dashed border-2 border-slate-600 h-full rounded-[10px] p-[10px] flex items-center justify-center' })}>
                    <input {...getInputProps()} />
                    {
                        isDragActive ?
                            <p>Drop the files here ...</p> :
                            <p>Drag 'n' drop some files here, or click to select files</p>
                    }
                </div>
            </div>
        </div>
    )
}

export default ImageDisplay