import axios from "axios";

const images =  {
    getImages: () => {
        return axios.get('http://localhost:80/api/images');
    },
    getImage: (id) => {
        return axios.get(`http://localhost:80/api/images/${id}`);
    },
    uploadImage: (image) => {
        return axios.post('http://localhost:80/api/images', image);
    },
    deleteImage: (id) => {
        return axios.delete(`http://localhost:80/api/images/${id}`);
    },
    checkSteghide: (id) => {
        return axios.get(`http://localhost:80/api/images/${id}/steg`);
    }
}

export default images;