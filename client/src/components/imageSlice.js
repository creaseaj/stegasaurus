import { createSlice } from "@reduxjs/toolkit";

export const imageSlice = createSlice({
    name: 'image',
    initialState: {
        preview: null,
    },
    reducers: {
        setPreview: (state, action) => {
            state.preview = action.payload;
        }
    },
});
export const { setPreview } = imageSlice.actions;
export default imageSlice.reducer