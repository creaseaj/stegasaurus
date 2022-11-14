import { useState } from 'react';
import { useSelector } from 'react-redux';
import './App.css';
import FileView from './components/FileView';
import Header from './components/Header';
import ImageDisplay from './components/ImageDisplay';
import ToolPicker from './components/ToolPicker';

function App() {
 
  return (
    <>
      <Header />
      <div className='gap-[30px] mt-[35px] h-[550px] flex'>
        <div className='bg-[#1E293B] w-full max-w-[220px] h-full rounded-r-[10px] px-[20px] py-[15px] text-slate-200 hidden lg:flex opacity-0'>
          Bookmarks
        </div>
        <div className='w-full h-full'>
          <ImageDisplay />
        </div>
        <div className='bg-[#1E293B] w-full max-w-[220px] h-full rounded-l-[10px] hidden lg:flex flex-col text-slate-200 p-[10px] pr-[0px]'>
          <div className='text-lg'>
            Tools
          </div>
          <ToolPicker/>
        </div>
      </div>
      
      <FileView />
    </>
  );
}

export default App;
