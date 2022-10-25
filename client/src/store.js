import { configureStore } from "@reduxjs/toolkit";
import imageReducer from "./components/imageSlice";

export default configureStore({
    reducer: {
        image: imageReducer,
    },
});