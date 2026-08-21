import axios from "axios";

const API = "https://ekraf.ideahub.my.id/api";

export const getStatify = async (id_subsektor = "") => {

    const response = await axios.get(`${API}/statify`, {
        params: {
            id_subsektor,
        },
    });

    return response.data;
};