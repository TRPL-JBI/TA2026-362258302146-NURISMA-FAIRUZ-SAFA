import React from 'react';
import './EmailSuccess.css';

export default function EmailSuccess() {
  return (
    <div className="clean-success-container">
      {/* Kartu putih melayang */}
      <div className="success-card">
        
        {/* Kontainer Ikon dengan Latar Belakang Lingkaran */}
        <div className="check-icon-container">
          <svg
            className="check-icon-svg"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            strokeWidth="2.5"
            strokeLinecap="round"
            strokeLinejoin="round"
          >
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
          </svg>
        </div>

        {/* Teks Judul Modern - Spasi Rapi */}
        <h1 className="success-title">Email Berhasil Diverifikasi!</h1>
        
        {/* Teks Subtitle yang Elegan */}
        <p className="success-subtitle">
          Selamat, akun Anda sekarang telah aktif dan siap digunakan.
        </p>

        {/* Panel Informasi - Terpisah dengan Jelas */}
        <div className="info-panel">
          <h2 className="info-panel-title">Apa yang bisa Anda lakukan sekarang?</h2>
          <ul className="info-panel-list">
            <li>
              <span className="check-bullet">✓</span>
              <span>Akses penuh ke seluruh fitur platform</span>
            </li>
            <li>
              <span className="check-bullet">✓</span>
              <span>Melengkapi profil dan pengaturan keamanan</span>
            </li>
            <li>
              <span className="check-bullet">✓</span>
              <span>Mulai menjelajahi dashboard Anda</span>
            </li>
          </ul>
        </div>  
      </div>
    </div>
  );
}