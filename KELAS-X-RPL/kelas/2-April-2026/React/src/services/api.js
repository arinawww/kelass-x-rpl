import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/api', // Laravel API base URL
  headers: {
    'Content-Type': 'application/json',
    Accept: 'application/json',
  },
});

// Configure interceptor to automatically attach authorization token to requests
api.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('auth_token');
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

export default api;
