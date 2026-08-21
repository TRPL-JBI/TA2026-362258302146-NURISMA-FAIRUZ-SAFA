import axios from "axios";

const API = "https://ekraf.ideahub.my.id/api";

export const getPelakuEkrafMap = async () => {
    const response = await axios.get(
        `${API}/pelaku-ekraf/map`
    );

    return response.data;
};