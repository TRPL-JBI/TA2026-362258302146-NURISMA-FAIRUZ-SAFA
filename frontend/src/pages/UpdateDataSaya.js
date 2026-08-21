import React, { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import {
    getDataSaya,
    updateDataSaya,
    getOpsiForm
} from "../services/authService";
import "./UpdateDataSaya.css";

export default function UpdateDataSaya() {

    const [subsektor, setSubsektor] = useState([]);
const [wilayah, setWilayah] = useState([]);

    const navigate = useNavigate();

    const [formData, setFormData] = useState({
        nama_perusahaan: "",
        nama_proyek: "",
        alamat: "",
        id_subsektor: "",
        id_wilayah: "",
        link_gmaps: "",
        nomor_telp: "",
    });

    const [loading, setLoading] = useState(true);

   useEffect(() => {

    const fetchData = async () => {

        try {

            const data = await getDataSaya();

            const opsi = await getOpsiForm();

            setSubsektor(opsi.subsektor);
            setWilayah(opsi.wilayah);

            setFormData({
                nama_perusahaan: data.nama_perusahaan || "",
                nama_proyek: data.nama_proyek || "",
                alamat: data.alamat || "",
                id_subsektor: data.id_subsektor || "",
                id_wilayah: data.id_wilayah || "",
                link_gmaps: data.link_gmaps || "",
                nomor_telp: data.nomor_telp || "",
            });

        } catch (error) {

            console.error(
                "Gagal mengambil data:",
                error
            );

        } finally {

            setLoading(false);

        }

    };

    fetchData();

}, []);

    const handleChange = (e) => {

        setFormData({
            ...formData,
            [e.target.name]: e.target.value,
        });

    };

    const handleSubmit = async (e) => {

        e.preventDefault();

        try {

            const response =
                await updateDataSaya(formData);

            alert(response.message);

            navigate("/pengajuan-saya");

        } catch (error) {

            console.error(error);

            alert(
                error.response?.data?.message ||
                "Gagal mengajukan perubahan data."
            );

        }

    };

    if (loading) {

        return (
            <div className="update-page">
                <h1>Memuat data...</h1>
            </div>
        );

    }

    return (

        <div className="update-page">

            <div className="update-header">

                <h1>
                    Ajukan Perubahan Data
                </h1>

                <p>
                    Perbarui informasi usaha Anda melalui pengajuan
                    perubahan data.
                </p>

            </div>

            <div className="update-card">

                <form onSubmit={handleSubmit}>

                    <div className="form-group">

                        <label>
                            Nama Perusahaan
                        </label>

                        <input
                            type="text"
                            name="nama_perusahaan"
                            value={formData.nama_perusahaan}
                            onChange={handleChange}
                            required
                        />

                    </div>

                    <div className="form-group">

                        <label>
                            Nama Proyek
                        </label>

                        <input
                            type="text"
                            name="nama_proyek"
                            value={formData.nama_proyek}
                            onChange={handleChange}
                            required
                        />

                    </div>

                    <div className="form-group">

                        <label>
                            Alamat
                        </label>

                        <textarea
                            name="alamat"
                            value={formData.alamat}
                            onChange={handleChange}
                            required
                        />

                    </div>

                    <div className="form-row">

                        <div className="form-group">

                            <label>
                                ID Subsektor
                            </label>

                           <select
    name="id_subsektor"
    value={formData.id_subsektor}
    onChange={handleChange}
    required
>
    <option value="">
        Pilih Subsektor
    </option>

    {subsektor.map((item) => (

        <option
            key={item.id_subsektor}
            value={item.id_subsektor}
        >
            {item.nama_subsektor}
        </option>

    ))}

</select>

                        </div>

                        <div className="form-group">

                            <label>
                                ID Wilayah
                            </label>

                           <select
    name="id_wilayah"
    value={formData.id_wilayah}
    onChange={handleChange}
    required
>
    <option value="">
        Pilih Kecamatan
    </option>

    {wilayah.map((item) => (

        <option
            key={item.id_wilayah}
            value={item.id_wilayah}
        >
            {item.kecamatan}
        </option>

    ))}

</select>

                        </div>

                    </div>

                    <div className="form-group">

                        <label>
                            Link Google Maps
                        </label>

                        <input
                            type="url"
                            name="link_gmaps"
                            value={formData.link_gmaps}
                            onChange={handleChange}
                        />

                    </div>

                    <div className="form-group">

                        <label>
                            Nomor Telepon
                        </label>

                        <input
                            type="text"
                            name="nomor_telp"
                            value={formData.nomor_telp}
                            onChange={handleChange}
                            required
                        />

                    </div>

                    <div className="form-actions">

                        <button
                            type="button"
                            className="cancel-button"
                            onClick={() =>
                                navigate("/data-saya")
                            }
                        >
                            Batal
                        </button>

                        <button
                            type="submit"
                            className="submit-button"
                        >
                            Ajukan Perubahan
                        </button>

                    </div>

                </form>

            </div>

        </div>

    );

}