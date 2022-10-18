import React from 'react'
import { Stego } from '../images/StegoLogo'
const Header = () => {
    return (
        <div className='text-white flex items-center gap-[10px] p-[10px] xl:p-[15px] bg-[#1E293B]'>
            <div className='max-h-[50px] max-w-[50px] w-full h-full xl:max-h-[65px] xl:max-w-[65px]'>
                <Stego />
            </div>
            <p className='text-[30px] lg:text-[40px] xl:text-[50px]'>
                Stegasaurus
            </p>
        </div>
    )
}

export default Header