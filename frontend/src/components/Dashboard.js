import React, { useContext, useEffect, useState } from "react";
import { Link } from "react-router-dom";
import "./Dashboard.css";
import sidelogo from "../assets/dashboardnya.png";
import { AuthContext } from "../context/AuthContext";
import { getStatusPengajuan } from "../services/PengajuanService";

export default function Dashboard() {
  const { user } = useContext(AuthContext);

  const [status, setStatus] = useState(null);

useEffect(() => {
  if (user) {
    loadStatus();
  }
}, [user]);

const loadStatus = async () => {
  try {
    const res = await getStatusPengajuan();
    setStatus(res);
  } catch (err) {
    console.log(err);
  }
};

  return (
    <section className="Dashboard">
      <div className="Dashboard-container">
        
        {/* Konten sebelah kiri */}
        <div className="Dashboard-content">
          <h2>Wani</h2>
          <h3>Wangi</h3>
          <p>
            Bukan sekedar semboyan — tapi semangat Banyuwangi yang berani tampil
            dan membawa harum nama daerah lewat karya. Website ini hadir untuk
            mendukung pelaku EKRAF lokal agar berani digital, berani bersaing,
            dan bangga memperkenalkan produknya ke dunia.
          </p>

          {/* Tombol ke halaman Sign In dan Sign Up */}
          <div className="auth-buttons">

  {!user ? (

    <Link to="/signin">

      <button>

        Masuk / Register

      </button>

    </Link>

  ) : (

    <div className="user-dashboard-card">

      <h5>

        Halo, {user.nama} 👋

      </h5>

      <h6>

        Selamat datang kembali di WANI WANGI.

      </h6>

      <div
  className={`status-box ${
    status?.status === "disetujui"
      ? "approved"
      : status?.status === "ditolak"
      ? "rejected"
      : "waiting"
  }`}
>
  <span className="status-icon">
    {status?.status === "disetujui"
      ? "🟢"
      : status?.status === "ditolak"
      ? "🔴"
      : "🟡"}
  </span>

  <div>
    <strong>Status Pengajuan</strong>
    <br />

    {status
      ? status.status.charAt(0).toUpperCase() +
        status.status.slice(1)
      : "Belum ada pengajuan"}
  </div>
</div>

    </div>

  )}

</div>
        </div>

        {/* Logo sebelah kanan */}
        <div className="Dashboard-image">
          <img src={sidelogo} alt="Ilustrasi Wani Wangi" />
        </div>

      </div>
    </section>
  );
}