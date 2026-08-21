import React from "react";
import "./CaraDaftar.css";
import {
  FaUserPlus,
  FaStore,
  FaMapMarkerAlt,
  FaPaperPlane,
  FaCheckCircle,
} from "react-icons/fa";

export default function CaraDaftar() {
  return (
    <div className="caradaftar-container">
      <h2 className="caradaftar-title">
        Cara Daftar Pelaku Ekonomi Kreatif
      </h2>

      <p className="caradaftar-subtitle">
        Ikuti langkah-langkah berikut untuk mendaftarkan data usaha Ekonomi
        Kreatif di Wani Wangi.
      </p>

      <div className="steps">

        <div className="step-card">
          <span className="step-number">
            <FaUserPlus />
          </span>

          <p>
            Buat akun terlebih dahulu dengan mengisi data diri dan informasi
            akun.
          </p>
        </div>

        <div className="step-card">
          <span className="step-number">
            <FaStore />
          </span>

          <p>
            Isi data usaha seperti nama perusahaan, nama proyek (usaha), subsektor,
            wilayah, alamat, dan nomor telepon.
          </p>
        </div>

        <div className="step-card">
          <span className="step-number">
            <FaMapMarkerAlt />
          </span>

          <p>
            Tambahkan link lokasi usaha dari Google Maps agar lokasi usaha
            dapat ditampilkan pada peta digital.
          </p>
        </div>

        <div className="step-card">
          <span className="step-number">
            <FaCheckCircle />
          </span>

          <p>
            Periksa kembali seluruh data yang telah diisi sebelum mengirim
            pengajuan.
          </p>
        </div>

        <div className="step-card">
          <span className="step-number">
            <FaPaperPlane />
          </span>

          <p>
            Klik tombol <strong>Daftar Sekarang</strong> untuk mengirim data
            dan menunggu proses verifikasi dari admin.
          </p>
        </div>

      </div>

      <a
        href="/sipintar/daftar"
        className="caradaftar-btn"
      >
        👉 Daftar Sekarang
      </a>
    </div>
  );
}