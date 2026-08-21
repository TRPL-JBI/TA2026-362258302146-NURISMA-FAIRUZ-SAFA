import React, { useEffect, useState } from "react";
import { getDataSaya } from "../services/authService";
import { Link } from "react-router-dom";
import "./DataSaya.css";

function DataSaya() {
    const [data, setData] = useState(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState("");

    useEffect(() => {
        const fetchData = async () => {
            try {
                const result = await getDataSaya();

                console.log("DATA API:", result);

                setData(result);

            } catch (error) {
                console.error("ERROR DATA SAYA:", error);

                setError(
                    error.response?.data?.message ||
                    "Gagal mengambil data."
                );

            } finally {
                setLoading(false);
            }
        };

        fetchData();
    }, []);

    if (loading) {
        return (
            <div className="data-saya-page">
                <h1>Memuat data...</h1>
            </div>
        );
    }

    if (error) {
        return (
            <div className="data-saya-page">
                <div className="data-error">
                    {error}
                </div>
            </div>
        );
    }

    if (!data) {
        return (
            <div className="data-saya-page">
                <h1>Data tidak ditemukan</h1>
            </div>
        );
    }

    return (
        <div className="data-saya-page">

            <div className="data-saya-header">
                <h1>Data Saya</h1>

                <p>
                    Informasi data usaha Ekonomi Kreatif yang telah
                    terverifikasi.
                </p>
            </div>

            <div className="data-card">

                <div className="data-card-header">
                    <div>
                        <h2>{data.nama_perusahaan}</h2>

                        <span className="status-badge">
                            ✓ Terverifikasi
                        </span>
                    </div>
                </div>

                <div className="data-grid">

                    <div className="data-item">
                        <span>Nama Proyek</span>
                        <strong>{data.nama_proyek}</strong>
                    </div>

                    <div className="data-item">
                        <span>Nomor Telepon</span>
                        <strong>{data.nomor_telp}</strong>
                    </div>

                    <div className="data-item">
                        <span>Subsektor</span>
                        <strong>{data.subsektor}</strong>
                    </div>

                    <div className="data-item">
                        <span>Wilayah</span>
                        <strong>{data.wilayah}</strong>
                    </div>

                    <div className="data-item full-width">
                        <span>Alamat</span>
                        <strong>{data.alamat}</strong>
                    </div>

                    <div className="data-item full-width">
                        <span>Lokasi Google Maps</span>

                        {data.link_gmaps ? (
                            <a
                                href={data.link_gmaps}
                                target="_blank"
                                rel="noreferrer"
                                className="maps-link"
                            >
                                📍 Lihat Lokasi di Google Maps
                            </a>
                        ) : (
                            <strong>
                                Link lokasi belum tersedia
                            </strong>
                        )}
                    </div>

                </div>

                <div className="data-card-footer">

                    <p>
                        Ingin memperbarui informasi usaha?
                    </p>

                    <Link to="/data-saya/update">
                        <button className="update-button">
                            Ajukan Perubahan Data
                        </button>
                    </Link>

                </div>

            </div>

        </div>
    );
}

export default DataSaya;