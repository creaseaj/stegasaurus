import { BrowserRouter, Route, Routes } from 'react-router-dom';
import './App.css';
import Editor from './pages/Editor';
import Error404 from './pages/Error404';
import Home from './pages/Home';
import ImageList from './pages/ImageList';
import Layout from './pages/Layout';
import cors from 'cors';
function App() {
  return (
    <>
    <BrowserRouter>
    <Routes>
      <Route path="/" element={<Layout />} >
        <Route index element={<Home />} />
        <Route path='editor' element={<Editor />} />
        <Route path='editor/:imageId' element={<Editor  />} />
        <Route path='images' element={<ImageList />} />
        <Route path='*' element={<Error404 />} />
      </Route>
    </Routes>
    </BrowserRouter>
    
    </>
  );
}

export default App;
