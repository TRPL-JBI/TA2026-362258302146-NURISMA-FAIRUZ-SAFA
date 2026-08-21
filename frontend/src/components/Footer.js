import React from "react";
import "./Footer.css";
import { FaFacebookF, FaInstagram, FaTwitter, FaYoutube } from "react-icons/fa";

const Footer = () => {
  return (
    <footer className="footer">
      <div className="footer-container">

        {/* Kolom 1: Menu */}
        <div className="footer-column">
          <h3>MENU</h3>
          <p>
            Ikuti akun resmi kami di media sosial untuk memperoleh informasi,
            program, dan layanan terbaru dari Dinas Kebudayaan dan Pariwisata
            Kabupaten Banyuwangi.
          </p>
          <div className="social-icons">
            <a href="https://www.facebook.com/disbudparbwi/about/?_rdr" target="_blank" rel="noreferrer"><FaFacebookF /></a>
            <a href="https://www.instagram.com/disbudparbanyuwangi?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" rel="noreferrer"><FaInstagram /></a>
            <a href="https://x.com/disbudparbwi" target="_blank" rel="noreferrer"><FaTwitter /></a>
            <a href="https://www.youtube.com/@banyuwangitourism1" target="_blank" rel="noreferrer"><FaYoutube /></a>
          </div>
        </div>

        {/* Kolom 2: Kontak */}
        <div className="footer-column">
          <h3>ABOUT US</h3>
          <p>📞 (0333) 424172</p>
          <p>📧 bwitourism1@gmail.com </p>
          <p>📍 Jl. Jenderal Ahmad Yani No.78, Taman Baru, Kec. Banyuwangi, Jawa Timur 68416</p>
        </div>

        {/* Kolom 3: Link Directory */}
        <div className="footer-column">
          <h3>LINK DIRECTORY</h3>
          <ul>
            <li><a href="https://banyuwangitourism.com/" target="_blank" rel="noreferrer">Banyuwangi Tourism</a></li>
            <li><a href="https://disbudpar.banyuwangikab.go.id/" target="_blank" rel="noreferrer">Disbudpar Banyuwangi</a></li>
            <li><a href="https://dkb.or.id/" target="_blank" rel="noreferrer">Dewan Kesenian Blambangan</a></li>
            <li><a href="https://sijamuwangi.banyuwangikab.go.id/" target="_blank" rel="noreferrer">SIJAMUWANGI</a></li>
          </ul>
        </div>
      </div>

      <div className="footer-bottom">
        <p>Copyright © 2025 Dinas Kebudayaan Dan Pariwisata Banyuwangi. All Rights Reserved</p>
      </div>
    </footer>
  );
};

export default Footer;
