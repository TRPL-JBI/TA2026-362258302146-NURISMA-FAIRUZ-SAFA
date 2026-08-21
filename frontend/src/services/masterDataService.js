import axios from "axios";

const API = "https://ekraf.ideahub.my.id/api";

export const getSubsektor = async () => {

  const response = await axios.get(`${API}/subsektor`);

  return response.data;

};

export const getWilayah = async () => {

  const response = await axios.get(`${API}/wilayah`);

  return response.data;

};