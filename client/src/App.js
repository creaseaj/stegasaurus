import './App.css';
import Header from './components/Header';

function App() {
  return (
    <>
      <Header />
      <div className='gap-[30px] mt-[35px] h-[550px] flex'>
        <div className='bg-[#1E293B] w-full max-w-[220px] h-full rounded-r-[10px]'>
          Bookmarks
        </div>
        <div className='bg-slate-200 w-full h-full rounded-[10px]'>
          Image!
        </div>
        <div className='bg-[#1E293B] w-full max-w-[220px] h-full rounded-l-[10px]'>
          Bookmarks
        </div>
      </div>
    </>
  );
}

export default App;
