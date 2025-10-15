import axios from 'axios';

const api = axios.create({
  baseURL: 'http://127.0.0.1:8000/api',
});

api.interceptors.request.use((config) => {
  const token = useRecoilValue(userState).token;
  if (token) config.headers.Authorization = `Bearer ${token}`;
  return config;
});

export default api;