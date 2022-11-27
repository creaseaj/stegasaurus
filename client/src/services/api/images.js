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
    }
}

export default images;