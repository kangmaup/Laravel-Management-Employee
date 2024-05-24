import axios from 'axios';

const apiClient = axios.create({
  baseURL: 'http://localhost:8000/api', // Sesuaikan dengan URL API Anda
  headers: {
    'Content-Type': 'application/json',
  },
});

apiClient.interceptors.request.use((config) => {
  const token = localStorage.getItem('token');
  console.log(token)
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }else{
    console.log('oi')
  }
  return config;
});

export default apiClient;
