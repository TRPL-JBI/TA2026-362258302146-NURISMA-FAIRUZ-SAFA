import axios from "axios";

const API = "https://ekraf.ideahub.my.id/api";

// Helper untuk mengambil header otentikasi agar kode tidak berulang (DRY)
const getAuthHeaders = () => {
    const token = localStorage.getItem("token");
    return {
        Authorization: token ? `Bearer ${token}` : "",
        Accept: "application/json",
    };
};

export const login = async (data) => {
    const response = await axios.post(`${API}/login`, data);
    return response.data;
};

export const register = async (data) => {
    const response = await axios.post(`${API}/register`, data);
    return response.data;
};

export const profile = async () => {
    const response = await axios.get(`${API}/profile`, {
        headers: getAuthHeaders(),
    });
    return response.data;
};

export const logout = async () => {
    const response = await axios.post(
        `${API}/logout`,
        {},
        { headers: getAuthHeaders() }
    );
    return response.data;
};

export const getDataSaya = async () => {
    const response = await axios.get(`${API}/data-saya`, {
        headers: getAuthHeaders(),
    });
    return response.data;
};

export const updateDataSaya = async (data) => {
    const response = await axios.put(`${API}/pengajuan/update`, data, {
        headers: getAuthHeaders(),
    });
    return response.data;
};

export const getOpsiForm = async () => {

    const response = await axios.get(
        `${API}/pengajuan/opsi-form`,
        {
            headers: {
                Authorization: `Bearer ${localStorage.getItem("token")}`,
                Accept: "application/json",
            },
        }
    );

    return response.data;

};