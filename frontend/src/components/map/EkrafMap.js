import React, { useState, useEffect } from "react";
import { MapContainer, TileLayer, Marker, useMap } from "react-leaflet";
import "leaflet/dist/leaflet.css";
import L from "leaflet";
import SidebarInfo from "../SidebarInfo";
import "./EkrafMap.css";

/*
|--------------------------------------------------------------------------
| Konstan & Fungsi Utama (Di Luar Komponen)
|--------------------------------------------------------------------------
*/
// Longitude diturunkan ke 114.3400 agar tampilan peta bergeser ke KIRI
const PUSAT_KOTA_BANYUWANGI = [-8.2192, 114.2800];
const ZOOM_DEKAT = 13;

const createIcon = (color) => {
  return L.divIcon({
    className: "custom-marker",
    html: `
      <div
        style="
          background: ${color};
          width: 12px;
          height: 12px;
          border-radius: 50%;
          border: 2px solid white;
          box-shadow: 0 1px 4px rgba(0,0,0,0.35);
        "
      ></div>
    `,
    iconSize: [12, 12],
    iconAnchor: [6, 6],
    popupAnchor: [0, -8],
  });
};

/*
|--------------------------------------------------------------------------
| Icon berdasarkan subsektor
|--------------------------------------------------------------------------
*/
const getMarkerColor = (subsektor) => {
  const warna = {
    Aplikasi: "#607D8B",
    Arsitektur: "#FF9800",
    "Desain Interior": "#9C27B0",
    "Desain Komunikasi Visual": "#2196F3",
    "Desain Produk": "#009688",
    Fashion: "#4CAF50",
    "Film, Animasi dan Video": "#795548",
    Fotografi: "#673AB7",
    Kriya: "#E91E63",
    Kuliner: "#FF5722",
    Musik: "#03A9F4",
    Penerbitan: "#3F51B5",
    "Pengembangan Permainan": "#8BC34A",
    Periklanan: "#F44336",
    "Seni Pertunjukan": "#673AB7",
    "Seni Rupa": "#E91E63",
    "TV dan Radio": "#795548",
  };

  return warna[subsektor] || "#607D8B";
};

/*
|--------------------------------------------------------------------------
| Komponen Pembantu: Logika Auto Zoom Terbalik
|--------------------------------------------------------------------------
*/
function AutoFitBounds({ dataPoints }) {
  const map = useMap();

  useEffect(() => {
    // Saring titik yang memiliki koordinat valid
    const validPoints = dataPoints
      .filter(
        (item) =>
          item.latitude &&
          item.longitude &&
          !isNaN(parseFloat(item.latitude)) &&
          !isNaN(parseFloat(item.longitude))
      )
      .map((item) => [parseFloat(item.latitude), parseFloat(item.longitude)]);

    // Jika mode "Semua" (jumlah titik > 100)
    if (validPoints.length > 100) {
      map.setView(PUSAT_KOTA_BANYUWANGI, ZOOM_DEKAT, {
        animate: true,
      });
    } 
    // Jika user memilih SUBSEKTOR tertentu
    else if (validPoints.length > 0) {
      const bounds = L.latLngBounds(validPoints);
      map.fitBounds(bounds, {
        padding: [60, 60],
        animate: true,
      });
    }
  }, [dataPoints, map]);

  return null;
}

/*
|--------------------------------------------------------------------------
| Komponen Utama Peta
|--------------------------------------------------------------------------
*/

const MapLegend = () => {
  const subsektorList = [
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

  return (
    <div className="map-legend">
      <div className="map-legend-title">
        Legenda Subsektor
      </div>

      <div className="map-legend-list">
        {subsektorList.map((subsektor) => (
          <div className="legend-item" key={subsektor}>
            <span
              className="legend-marker"
              style={{
                backgroundColor: getMarkerColor(subsektor),
              }}
            ></span>

            <span className="legend-label">
              {subsektor}
            </span>
          </div>
        ))}
      </div>
    </div>
  );
};

const EkrafMap = ({ data }) => {
  const [selected, setSelected] = useState(null);
  const [isOpen, setIsOpen] = useState(false);

  const handleSelect = (item) => {
    setSelected(item);
    setIsOpen(true);
  };

  const handleClose = () => {
    setIsOpen(false);
    setSelected(null);
  };

  return (
    <div
      style={{
        position: "relative",
        height: "100vh",
        width: "100%",
      }}
    >
      <MapContainer
        center={PUSAT_KOTA_BANYUWANGI}
        zoom={ZOOM_DEKAT}
        style={{
          height: "100%",
          width: "100%",
        }}
      >
        <AutoFitBounds dataPoints={data} />

        <TileLayer
          attribution='&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>'
          url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
        />

        <MapLegend />

        {data
          .filter(
            (item) =>
              item.latitude &&
              item.longitude &&
              !isNaN(parseFloat(item.latitude)) &&
              !isNaN(parseFloat(item.longitude))
          )
          .map((item) => (
            <Marker
              key={item.id_ekraf}
              position={[
                parseFloat(item.latitude),
                parseFloat(item.longitude),
              ]}
              icon={createIcon(getMarkerColor(item.subsektor))}
              eventHandlers={{
                click: () => handleSelect(item),
              }}
            />
          ))}
      </MapContainer>

      <SidebarInfo
        data={selected}
        isOpen={isOpen}
        onClose={handleClose}
      />
    </div>
  );
};

export default EkrafMap;