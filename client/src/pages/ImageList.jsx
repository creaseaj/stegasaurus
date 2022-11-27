import React from 'react';
import { useEffect } from 'react';
import { Link } from 'react-router-dom';
import { BinIcon } from '../images/BinIcon';
import ApiClient from '../services/api/ApiClient';

function ImageList() {
    const [imageList, setImageList] = React.useState([]);
    useEffect(() => {
        ApiClient.images.getImages().then((res) => {
            setImageList(res.data.data);
        });
    }, [])

    return (
        <>
            <h1 className='text-white'>List of all images</h1>
            <div className='grid md:grid-cols-2 lg:grid-cols-4 gap-[10px]'>
                {imageList.map((image) => (
                    <Link to={`/editor/${image.id}`} key={image.id} className='relative w-full overflow-hidden rounded-md'>
                        <img className='object-cover w-full h-full' alt={image.filename} src={`http://localhost/images/${image.filename}`} />
                        <button className='absolute bottom-2 right-2 flex w-[50px] hover:bg-red-300 transition-all p-2 rounded-md'
                            onClick={(e) => {
                                e.preventDefault();
                                ApiClient.images.deleteImage(image.id).then((res => {
                                    setImageList(imageList.filter((img) => img.id !== image.id));
                                }))
                            }}>
                            <BinIcon />
                        </button>
                    </Link>
                ))
                }

            </div>
        </>
    );
}

export default ImageList;