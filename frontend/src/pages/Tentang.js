import React from "react";
import "./Tentang.css";

// Import gambar
import logobwi from "../assets/banyuwangi.png";
import logobwi2 from "../assets/sunrise.png"; 
import waniwangi from "../assets/logonya.png";
import statify from "../assets/statilogo.png";
import sipintar from "../assets/sipintar.png";

function Tentang() {
  return (
    <div className="tentang">

      {/* 1. Banyuwangi */}
      <div className="tentang-container" data-aos="fade-right">
        <div className="tentang-image">
          <img src={logobwi} alt="Lambang Banyuwangi" />
        </div>
        <div className="tentang-content">
          <h2>BANYUWANGI</h2>
          <p>
            Kabupaten paling timur di Pulau Jawa yang dikenal sebagai "Sunrise of Java". 
            Wilayah ini kaya akan keindahan alam, mulai dari gunung, pantai, hutan, hingga taman nasional yang memukau. 
            Selain itu, Banyuwangi juga memiliki keberagaman budaya yang kuat, seperti tradisi Gandrung, Seblang, dan Kebo-keboan. 
            Dalam beberapa tahun terakhir, Banyuwangi tumbuh pesat sebagai daerah inovatif yang memadukan potensi lokal, 
            kemajuan teknologi, dan pelayanan publik berbasis digital.
          </p>
        </div>
      </div>

      {/* 2. Disbudpar */}
      <div className="tentang-container reverse" data-aos="fade-left">
        <div className="tentang-image">
          <img src={logobwi2} alt="Logo Banyuwangi" />
        </div>
        <div className="tentang-content">
          <h2 className="judul-merah">DISBUDPAR BANYUWANGI</h2>
          <p>
            Dinas Pariwisata dan Kebudayaan Kabupaten Banyuwangi menjadi mitra utama dalam pengembangan inovasi digital daerah, 
            termasuk lewat platform Wani Wangi. Dengan menggabungkan kekuatan budaya, kearifan lokal, dan teknologi, dinas ini 
            mendorong pelaku EKRAF, seniman, serta komunitas lokal untuk berdaya saing dan berkiprah lebih luas.
          </p>
        </div>
      </div>

      {/* 3. Wani Wangi */}
      <div className="tentang-container" data-aos="fade-right">
        <div className="tentang-image">
          <img src={waniwangi} alt="Ilustrasi Wani Wangi" />
        </div>
        <div className="tentang-content">
          <h2 className="judul-merah">WANI WANGI</h2>
          <p>
            Wani Wangi merupakan website digital yang dirancang untuk mendukung pelaku EKRAF di Banyuwangi dalam memperkenalkan produk, 
            memperluas jangkauan pasar, serta mengakses informasi dan data secara mudah. Mengusung semangat 
            “Wani Tampil, Harumkan Produk Lokal”, platform ini hadir sebagai jembatan antara potensi daerah dan peluang digital, 
            agar para pelaku usaha lokal mampu bersaing di ranah nasional hingga global.
          </p>
        </div>
      </div>

      {/* 4. Statify */}
      <div className="tentang-container reverse" data-aos="fade-left">
        <div className="tentang-image">
          <img src={statify} alt="Ilustrasi Statify" />
        </div>
        <div className="tentang-content">
          <h2 className="judul-merah">STATIFY</h2>
          <p>
            Fitur yang menyajikan data dan statistik seputar perkembangan EKRAF di Banyuwangi secara visual dan informatif. 
            Melalui Statify, pengguna dapat melihat jumlah EKRAF aktif, persebaran lokasi, kategori usaha, hingga tren perkembangan dari tahun ke tahun. 
            Disajikan dalam bentuk grafik dan peta interaktif, fitur ini memudahkan publik dan pemangku kebijakan untuk memahami kondisi riil 
            di lapangan dan mendukung pengambilan keputusan berbasis data.
          </p>
        </div>
      </div>

      {/* 5. Si Pintar */}
      <div className="tentang-container" data-aos="fade-right">
        <div className="tentang-image">
          <img src={sipintar} alt="Ilustrasi Si Pintar" />
        </div>
        <div className="tentang-content">
          <h2 className="judul-merah">SI PINTAR</h2>
          <p>
            Fitur edukatif yang memandu pelaku EKRAF untuk mendaftarkan produk mereka ke dalam sistem digital Banyuwangi. 
            Dengan bahasa sederhana dan tampilan yang ramah pengguna, Si Pintar membantu pelaku EKRAF — dari pemula hingga yang sudah berjalan — 
            agar semakin siap bertransformasi ke dunia digital.
          </p>
        </div>
      </div>

      {/* 6. Video Banyuwangi */}
      <div className="tentang-container reverse" data-aos="fade-up">
        <div className="tentang-image youtube-wrapper">
          <a 
            href="https://youtu.be/4BWqCkpT3jw?si=lRiFf3d3QPZfOP-i" 
            target="_blank" 
            rel="noopener noreferrer"
          >
            <img 
              src="https://img.youtube.com/vi/4BWqCkpT3jw/hqdefault.jpg" 
              alt="Video Banyuwangi Terbaru" 
              className="youtube-thumbnail"
            />
            <div className="youtube-overlay">▶</div>
          </a>
        </div>
        <div className="tentang-content">
          <h2 className="judul-merah">Banyuwangi Tourism</h2>
          <p>
            Kanal Resmi Milik Pemerintah Kabupaten Banyuwangi digunakan untuk menyebarluaskan informasi kegiatan pemerintahan dan kegiatan masyarakat.
          </p>
        </div>
      </div>

    </div>
  );
}

export default Tentang;
