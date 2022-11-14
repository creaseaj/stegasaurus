import { createSlice } from "@reduxjs/toolkit";

export const imageSlice = createSlice({
    name: 'image',
    initialState: {
        preview: null,
        view: 'hex',
    },
    reducers: {
        setPreview: (state, action) => {
            state.preview = action.payload;
        },
        setView: (state, action) => {
            state.view = action.payload;
        },
    }
});
export const { setPreview, setView } = imageSlice.actions;
export default imageSlice.reducer