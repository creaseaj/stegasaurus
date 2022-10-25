import './App.css';
import File from './components/FileReader';
import Header from './components/Header';
import ImageDisplay from './components/ImageDisplay';

function App() {
  return (
    <>
      <Header />
      <div className='gap-[30px] mt-[35px] h-[550px] flex'>
        <div className='bg-[#1E293B] w-full max-w-[220px] h-full rounded-r-[10px] px-[20px] py-[15px] text-slate-200 hidden lg:flex'>
          Bookmarks
        </div>
        <div className='w-full h-full'>
          <ImageDisplay />
        </div>
        <div className='bg-[#1E293B] w-full max-w-[220px] h-full rounded-l-[10px] hidden lg:flex text-slate-200 p-[10px]'>
          Tools
        </div>
      </div>
      <div className='bg-[#1E293B] w-full h-full mt-[10px] mx-[10px] rounded-[10px] p-[10px] text-slate-200'>
        File Reader
        <File />
      </div>
    </>
  );
}

export default App;
