import React, { useContext, useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import { FaChevronDown } from "react-icons/fa";
import { AuthContext } from "../context/AuthContext";

import "./Navbar.css";
import logo from "../assets/logonyaa.png";

export default function Navbar() {
  const { user, logout } = useContext(AuthContext);
  const navigate = useNavigate();
  const [showMenu, setShowMenu] = useState(false);
  const [isLoggingOut, setIsLoggingOut] = useState(false); // 👈 State untuk loading logout

  const handleLogout = async () => {
    setShowMenu(false); // Tutup dropdown terlebih dahulu
    setIsLoggingOut(true); // 👈 Aktifkan loading animasi

    try {
      await logout();
      // Memberikan sedikit jeda (delay) 1-1.5 detik agar efek loading terasa halus
      setTimeout(() => {
        setIsLoggingOut(false);
        navigate("/");
      }, 1200);
    } catch (error) {
      console.error("Gagal logout:", error);
      setIsLoggingOut(false); // Matikan loading jika error
    }
  };

  return (
    <>
      {/* 👈 ELEMEN LOADING OVERLAY */}
      {isLoggingOut && (
        <div className="logout-loading-overlay">
          <div className="logout-spinner-box">
            <div className="logout-spinner"></div>
            <p>Mengeluarkan akun...</p>
          </div>
        </div>
      )}

      <nav className="navbar">
        {/* Logo */}
        <h1 className="logo">
          <Link to="/">
            <img
              src={logo}
              alt="Logo"
              style={{
                height: "90px",
                marginRight: "100px",
                verticalAlign: "middle",
              }}
            />
          </Link>
        </h1>

        {/* MENU UTAMA */}
        <ul className="nav-links">
          <li>
            <Link to="/">Beranda</Link>
          </li>
          <li>
            <Link to="/tentang">Tentang</Link>
          </li>

          {/* STATIFY */}
          <li className="dropdown">
            <span>
              Statify <FaChevronDown className="icon-down"/>
            </span>
            <ul className="dropdown-menu">
              <li><Link to="/statify/jumlah">Jumlah Pelaku EKRAF</Link></li>
              <li><Link to="/statify/kategori">Kategori Pelaku EKRAF</Link></li>
              <li><Link to="/statify/wilayah">Wilayah Pelaku EKRAF</Link></li>
            </ul>
          </li>

          {/* SIPINTAR */}
          <li className="dropdown">
            <span>
              Si Pintar <FaChevronDown className="icon-down"/>
            </span>
            <ul className="dropdown-menu">
              <li><Link to="/sipintar/cara-daftar">Cara Daftar</Link></li>
              <li><Link to="/sipintar/daftar">Daftar</Link></li>
            </ul>
          </li>

          {/* KONDISI AUTH */}
          {user ? (
            <li className="dropdown-user">
              <span onClick={() => setShowMenu(!showMenu)} style={{ cursor: "pointer" }}>
                👤 {user.nama} <FaChevronDown className="icon-down"/>
              </span>
              {showMenu && (
                <ul className="dropdown-user-menu">
<li>
  <Link
    to="/pengajuan-saya"
    onClick={() => setShowMenu(false)}
  >
    Pengajuan Saya
  </Link>

<Link to="/data-saya">
    Data Saya
</Link>

</li>
                  <li>
                    <button className="logout-btn" onClick={handleLogout}>
                      Logout
                    </button>
                  </li>
                </ul>
              )}
            </li>
          ) : null}
        </ul>
      </nav>
    </>
  );
}