import React from "react";
import { Link } from "react-router-dom"; // ⬅️ tambahin
import "./Statify.css";
import statifylogo from "../assets/jumlah.png"; 
import statifykategori from "../assets/kategori.png"; 
import statifypesawat from "../assets/pesawat.png";

function Statify() {
  return (
    <div className="statify">
      {/* Judul */}
      <h2 className="title">STATIFY</h2>
      <p className="subtitle">
        Statify (statistik + simplify) adalah fitur yang menyajikan data dan informasi statistik seputar EKRAF di Kabupaten Banyuwangi.
      </p>

      {/* 3 Box */}
      <div className="statify-container">
        {/* Box 1 */}
        <Link to="/statify/jumlah" className="statify-card">
          <img src={statifylogo} alt="Jumlah Pelaku EKRAF" className="statify-icon" />
          <h3>Jumlah Pelaku EKRAF</h3>
          <p>
            Menampilkan data jumlah pelaku Ekonomi Kreatif di Kabupaten Banyuwangi sebagai gambaran perkembangan sektor kreatif.
          </p>
        </Link>

        {/* Box 2 */}
        <Link to="/statify/kategori" className="statify-card">
          <img src={statifykategori} alt="Kategori Pelaku EKRAF" className="statify-icon" />
          <h3>Kategori Pelaku EKRAF</h3>
          <p>
            Informasi berbagai kategori usaha kreatif yang dijalankan pelaku
            EKRAF.
          </p>
        </Link>

        {/* Box 3 */}
        <Link to="/statify/wilayah" className="statify-card">
          <img src={statifypesawat} alt="Wilayah Pelaku EKRAF" className="statify-icon" />
          <h3>Wilayah Pelaku EKRAF</h3>
          <p>
            Distribusi pelaku EKRAF berdasarkan wilayah di Banyuwangi untuk melihat persebaran potensi ekonomi kreatif.
          </p>
        </Link>
      </div>
    </div>
  );
}

export default Statify;
