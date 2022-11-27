import React, { useEffect } from 'react';
import { useDispatch } from 'react-redux';
import { useParams } from 'react-router-dom';
import FileView from '../components/FileView';
import ImageDisplay from '../components/ImageDisplay';
import { setPreview } from '../components/imageSlice';
import ToolPicker from '../components/ToolPicker';
import images from '../services/api/images';

function Editor() {
    const dispatch = useDispatch()

    const { imageId } = useParams();
    useEffect(() => {
        dispatch(setPreview(null))
        images.getImage(imageId).then((res) => {
            dispatch(setPreview('http://localhost/images/' + res.data.data.filename));
        });
    }, [])
    return (
        <>
            <div className='gap-[30px] mt-[35px] h-[550px] flex'>
                <div className='bg-[#1E293B] w-full max-w-[220px] h-full rounded-r-[10px] px-[20px] py-[15px] text-slate-200 hidden lg:flex'>
                    Bookmarks
                </div>
                <div className='w-full h-full'>
                    <ImageDisplay />
                </div>
                <div className='bg-[#1E293B] w-full max-w-[220px] h-full rounded-l-[10px] hidden lg:flex flex-col text-slate-200 p-[10px] pr-[0px]'>
                    <div className='text-lg'>
                        Tools
                    </div>
                    <ToolPicker />
                </div>
            </div>

            <FileView />
        </>
    );
}

export default Editor;