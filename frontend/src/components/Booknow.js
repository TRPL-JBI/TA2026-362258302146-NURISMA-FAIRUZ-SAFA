import React from "react";
import "./Booknow.css";
import museumLogo from "../assets/museum.png";

function Booknow() {
  return (
    <div className="Booknow">
      <div className="Booknow-container">
        
        {/* Logo / Gambar */}
        <div className="Booknow-image">
          <img src={museumLogo} alt="Museum Banyuwangi" />
        </div>

        {/* Konten teks */}
        <div className="Booknow-content">
          <h2>BOOK NOW!</h2>
          <p>
            Pesan kunjunganmu secara online, isi data dan pilih tanggal kunjungan. 
            Dapatkan pengalaman budaya Banyuwangi lebih dekat!
          </p>
          <a
            href="https://museum.banyuwangikab.go.id/"
            target="_blank"
            rel="noopener noreferrer"
          >
            <button>Pesan Sekarang</button>
          </a>
        </div>
      </div>
    </div>
  );
}

export default Booknow;
