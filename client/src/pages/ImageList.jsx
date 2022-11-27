import React from 'react';
import { useEffect } from 'react';
import { Link } from 'react-router-dom';
import images from '../services/api/images';

function ImageList() {
    const [imageList, setImageList] = React.useState([]);
    useEffect(() => {
        images.getImages().then((res) => {
            setImageList(res.data.data);
        });
    }, [])

    console.log(imageList);
    return (
        <>
            <h1 className='text-white'>List of all images</h1>
            <div className='flex'>
                {imageList.map((image) => (
                    <Link to={`/editor/${image.id}`} key={image.id}>
                        <img className='object-contain' alt={image.filename} src={`http://localhost/images/${image.filename}`} />
                    </Link>
                ))
                }
            </div>
        </>
    );
}

export default ImageList;