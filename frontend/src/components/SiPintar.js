import React from "react";
import { Link } from "react-router-dom";
import "./SiPintar.css";
import ilustrasi from "../assets/sipintar.png";

function SiPintar() {
  return (
    <div className="SiPintar">
      <div className="SiPintar-container">
        
        {/* Gambar di kiri */}
        <div className="SiPintar-image">
          <img src={ilustrasi} alt="Ilustrasi SI PINTAR" />
        </div>

        {/* Konten teks di kanan */}
        <div className="SiPintar-content">
          <h2>SI PINTAR</h2>
          <p>
            Punya produk lokal yang ingin dikenal lebih luas? <br />
            Yuk, daftarkan daganganmu di platform ini! <br />
            Lewat layanan PINTAR, kami bantu pelaku EKRAF seperti kamu untuk
            masuk ke dunia digital. <br />
            Prosesnya mudah, cepat, dan gratis. <br />
            Saatnya kamu yang tampil dan harumkan nama daerah! <br />
            Klik tombol daftar sekarang, dan mulai langkah pertamamu.
          </p>

          {/* ✅ Tombol diarahkan ke sub-route daftar */}
          <Link to="/sipintar/daftar">
            <button>Daftar</button>
          </Link>
        </div>
      </div>
    </div>
  );
}

export default SiPintar;
