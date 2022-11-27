import React from 'react'
import { Link } from 'react-router-dom'
import { Stego } from '../images/StegoLogo'
const Navbar = ({ view }) => {

    return (
        <div className='text-white items-end flex gap-[20px] p-[10px] xl:p-[15px] bg-[#1E293B] text-2xl'>
            <Link className='flex items-center gap-[10px]' to='/'>
                <div className='max-h-[50px] w-[50px] lg:w-[55px] xl:w-[60px]'>
                    <Stego />
                </div>
                <p className='text-[30px] lg:text-[40px] xl:text-[50px]'>
                    Stegasaurus
                </p>
            </Link>
            <Link to='/editor'>
                Editor
            </Link>
            <Link to='/images'>
                Images
            </Link>
        </div>
    )
}

export default Navbar