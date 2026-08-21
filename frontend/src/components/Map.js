import React, { useEffect } from "react";
import { MapContainer, TileLayer, useMap } from "react-leaflet";
import { Link } from "react-router-dom";
import "leaflet/dist/leaflet.css";
import "./Map.css";

// Koordinat & Zoom yang kamu tentukan
const PUSAT_KOTA_BANYUWANGI = [-8.2192, 114.2800];
const ZOOM_DEKAT = 13;

// Helper untuk memastikan peta re-center & ukurannya pas
function ChangeView({ center, zoom }) {
  const map = useMap();
  useEffect(() => {
    map.setView(center, zoom);
    map.invalidateSize();
  }, [center, zoom, map]);
  return null;
}

const Map = () => {
  return (
    <div className="map-section">
      <div className="map-header">
        <h2 className="map-title">MAP BANYUWANGI</h2>
        <p className="map-subtitle">
          Peta interaktif sebaran wilayah dan potensi ekonomi kreatif Kabupaten Banyuwangi.
        </p>
      </div>

      <div className="map-wrapper">
        {/* Box Ringkasan Melayang (Glassmorphism Effect) */}
        <div className="map-overlay-card">
          <div className="overlay-item">
            <span className="overlay-number">25</span>
            <span className="overlay-label">Kecamatan</span>
          </div>
          
          <div className="overlay-divider"></div>
          
          <div className="overlay-item">
            <span className="overlay-number">17</span>
            <span className="overlay-label">Subsektor</span>
          </div>

          <Link to="/statify/wilayah" className="overlay-btn">
            Lihat Detail Peta →
          </Link>
        </div>

        {/* Peta Standar OpenStreetMap */}
        <MapContainer
          center={PUSAT_KOTA_BANYUWANGI}
          zoom={ZOOM_DEKAT}
          maxZoom={19}
          minZoom={9}
          scrollWheelZoom={true}
          style={{ height: "500px", width: "100%" }}
        >
          <ChangeView center={PUSAT_KOTA_BANYUWANGI} zoom={ZOOM_DEKAT} />

          {/* Tile Layer OpenStreetMap Asli */}
          <TileLayer
            attribution='&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
          />
        </MapContainer> {/**/}
      </div>
    </div>
  );
};

export default Map;