import React from 'react'
const Button = ({ children, onClick, className }) => {
    return (
        <button {...{ onClick }} className={`${className} flex justify-start transition-all hover:bg-white/50 p-[4px] w-full rounded-md`}>
            {children}
        </button>
    )
}

export default Button