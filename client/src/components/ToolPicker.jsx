import React from 'react'
import { useDispatch, useSelector } from 'react-redux'
import Button from './Button'
import { setView } from './imageSlice'

const ToolButton = ({ children, onClick, active = false }) => {
    return (
        <div className='overflow-hidden transition-all hover:rounded-l-md'>
            <Button onClick={onClick} className='rounded-r-none rounded-l-md'>{children} </Button>
            <div className={`w-full bg-slate-200 h-[0.2rem] mt-[-0.2rem] transition-all ${active ? 'translate-x-0' : 'translate-x-full'} overflow-hidden ease-in-out duration-300`} />
        </div>
    )
}

const ToolPicker = () => {
    const view = useSelector((state) => state.image.view)
    const dispatch = useDispatch()

    return (
        <div className='flex flex-col gap-[5px]'>
            <ToolButton
                active={view === 'hex'}
                onClick={() => dispatch(setView('hex'))}>
                View Hex
            </ToolButton>
            <ToolButton
                active={view === 'strings'}
                onClick={() => dispatch(setView('strings'))}>
                Extract Strings
            </ToolButton>
            <ToolButton
                active={view === 'metadata'}
                onClick={() => dispatch(setView('metadata'))}>
                Metadata
            </ToolButton>
            <ToolButton
                active={view === 'xor'}
                onClick={() => dispatch(setView('xor'))}>
                XOR
            </ToolButton>
        </div>
    )
}

export default ToolPicker