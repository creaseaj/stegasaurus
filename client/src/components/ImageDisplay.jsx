import React from 'react'
import { useState } from 'react'
import { useEffect } from 'react'
import { useCallback } from 'react'
import { useDropzone } from 'react-dropzone'
import { useDispatch, useSelector } from 'react-redux'
import { setPreview } from './imageSlice'
const ImageDisplay = () => {
    const image = useSelector((state) => state.image.preview)
    const dispatch = useDispatch()
    const [isError, setIsError] = useState(false)
    const onDrop = useCallback(acceptedFiles => {
        console.log(acceptedFiles)
        const file = acceptedFiles[0]
        dispatch(setPreview(URL.createObjectURL(file)));
    }, [dispatch])
    const { getRootProps, getInputProps, isDragActive } = useDropzone({
        onDrop,
        accept: { 'image/png': ['.png'] },
        maxFiles: 1
    })

    useEffect(() => {
        setIsError(fileRejections.length)
    }, [fileRejections])

    return (
        <div className='w-full h-full bg-[#1E293B] rounded-[10px] text-white relative'>
            <img src={image} alt="steg" className={`absolute inset-0 object-contain w-full h-full ${image ? 'opacity-100 pointer-events-auto' : 'opacity-0 pointer-events-none'} transition-all`} />
            <button className='absolute top-[10px] left-[10px] flex items-center justify-center bg-slate-600 p-[5px] rounded-[5px]' onClick={() => dispatch(setPreview(null))}>
                Clear
            </button>
            <div className={`${image ? 'opacity-0 pointer-events-none' : 'opacity-100 pointer-events-auto'} transition-all h-full w-full }`}>
                <div {...getRootProps({ className: `border-dashed border-2 transition-all  h-full rounded-[10px] p-[10px] flex items-center justify-center ${isError ? 'border-red-400 text-red-400' : 'border-slate-600'}` })}>
                    <input {...getInputProps({ className: 'transition-all' })} />
                    Drag 'n' drop some files here, or click to select files
                </div>
            </div>
        </div >
    )
}

export default ImageDisplay