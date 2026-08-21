import React, { useEffect, useState } from "react";
import EkrafMap from "../components/map/EkrafMap";
import { getPelakuEkrafMap } from "../services/PelakuEkrafService";
import "./StatifyWilayah.css";

// Daftar Lengkap 17 Subsektor Ekonomi Kreatif Indonesia
const DAFTAR_17_SUBSEKTOR = [
  "Semua",
  "Aplikasi",
  "Arsitektur",
  "Desain Interior",
  "Desain Komunikasi Visual",
  "Desain Produk",
  "Fashion",
  "Film, Animasi dan Video",
  "Fotografi",
  "Kriya",
  "Kuliner",
  "Musik",
  "Penerbitan",
  "Pengembangan Permainan",
  "Periklanan",
  "Seni Pertunjukan",
  "Seni Rupa",
  "TV dan Radio",
];

const StatifyWilayah = () => {
  const [ekrafData, setEkrafData] = useState([]);
  const [filterSubsektor, setFilterSubsektor] = useState("Semua");
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const data = await getPelakuEkrafMap();
        console.log("DATA MAP:", data);
        setEkrafData(data);
      } catch (error) {
        console.error("Gagal mengambil data map:", error);
      } finally {
        setLoading(false);
      }
    };

    fetchData();
  }, []);

  // Filter data berdasarkan subsektor
  const dataFiltered =
    filterSubsektor === "Semua"
      ? ekrafData
      : ekrafData.filter(
          (item) =>
            item.subsektor?.toLowerCase() === filterSubsektor.toLowerCase()
        );

  if (loading) {
    return <div className="loading-map">Memuat data peta Banyuwangi...</div>;
  }

  return (
    <div className="statify-wilayah-container">
      {/* Filter Horizontal Scrollable */}
      <div className="subsektor-filter-wrapper">

  <div className="subsektor-scroll-container">
    {DAFTAR_17_SUBSEKTOR.map((subsektor) => (
      <button
        key={subsektor}
        className={`chip-button ${
          filterSubsektor === subsektor ? "active" : ""
        }`}
        onClick={() => setFilterSubsektor(subsektor)}
      >
        {subsektor}
      </button>
    ))}
  </div>

  <div className="swipe-hint">
    ← Geser untuk melihat subsektor lainnya →
  </div>

</div>

      {/* Komponen Peta */}
      <div className="map-container">
        <EkrafMap data={dataFiltered} />
      </div>
    </div>
  );
};

export default StatifyWilayah;