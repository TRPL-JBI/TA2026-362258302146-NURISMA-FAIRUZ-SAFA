import React from "react";
import "./SidebarInfo.css";
import logo from "../assets/logonya.png";

function SidebarInfo({ data, onClose, isOpen }) {
  if (!data) return null;

  return (
    <div className={`sidebar ${isOpen ? "open" : "closed"}`}>
      {/* Header Utama Sidebar */}
      <div className="sidebar-header-top">
        <div className="brand">
          <img src={logo} alt="Wani Wangi" className="brand-logo" />
          <h2>Wani Wangi Info</h2>
        </div>
        <button className="close-btn" onClick={onClose} aria-label="Close">
          ×
        </button>
      </div>

      {/* Konten Utama */}
      <div className="sidebar-content">
        {/* Banner Nama Usaha */}
        <div className="business-card">
          <h3 className="business-name">{data.nama_perusahaan}</h3>
          {data.subsektor && (
            <span className="badge-subsektor">{data.subsektor}</span>
          )}
        </div>

        {/* Detail Informasi */}
        <div className="info-list">
          <div className="info-item">
            <span className="info-label">Nama Proyek</span>
            <span className="info-value">{data.nama_proyek || "-"}</span>
          </div>

          <div className="info-item">
            <span className="info-label">Alamat</span>
            <span className="info-value">{data.alamat || "-"}</span>
          </div>

          <div className="info-item">
            <span className="info-label">Wilayah</span>
            <span className="info-value">{data.wilayah || "-"}</span>
          </div>

          <div className="info-item">
            <span className="info-label">Nomor Telepon</span>
            <span className="info-value">{data.nomor_telp || "-"}</span>
          </div>
        </div>
      </div>
    </div>
  );
}

export default SidebarInfo;