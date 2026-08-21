import React, { useEffect, useState } from "react";
import {
  ResponsiveContainer,
  BarChart,
  Bar,
  XAxis,
  YAxis,
  CartesianGrid,
  Tooltip,
} from "recharts";

import "./StatifyJumlah.css";
import { getStatify } from "../services/statifyService";
import { getSubsektor } from "../services/masterDataService";

export default function StatifyJumlah() {

  const [chartData, setChartData] = useState([]);
  const [totalPelaku, setTotalPelaku] = useState(0);
  const [totalProduk, setTotalProduk] = useState(0);
  const [totalWilayah, setTotalWilayah] = useState(0);

  const [subsektor, setSubsektor] = useState([]);
  const [selectedSubsektor, setSelectedSubsektor] = useState("");

  // Ambil list subsektor
  useEffect(() => {

    const fetchSubsektor = async () => {

      try {

        const data = await getSubsektor();

        setSubsektor(data);

      } catch (err) {

        console.log(err);

      }

    };

    fetchSubsektor();

  }, []);

  // Ambil data grafik
  useEffect(() => {

    const fetchData = async () => {

      try {

        const data = await getStatify(selectedSubsektor);

        setTotalPelaku(data.total_pelaku);
        setTotalProduk(data.total_subsektor);
        setTotalWilayah(data.total_kecamatan);

        const hasil = data.per_subsektor.map((item) => ({

          kategori: item.nama_subsektor,
          jumlah: item.jumlah,

        }));

        setChartData(hasil);

      } catch (err) {

        console.log(err);

      }

    };

    fetchData();

  }, [selectedSubsektor]);

  return (

    <div className="statify-jumlah-page">

      <h2>Jumlah Pelaku EKRAF</h2>

      <div className="stat-cards">

        <div className="stat-card">
          <h3>{totalPelaku}</h3>
          <p>Total Pelaku</p>
        </div>

        <div className="stat-card">
          <h3>{totalProduk}</h3>
          <p>Total Subsektor</p>
        </div>

        <div className="stat-card">
          <h3>{totalWilayah}</h3>
          <p>Total Kecamatan</p>
        </div>

      </div>

      <div className="filter-row">

        <label>Pilih Subsektor :</label>

        <select
          value={selectedSubsektor}
          onChange={(e) => setSelectedSubsektor(e.target.value)}
        >

          <option value="">
            Semua Subsektor
          </option>

          {subsektor.map((item) => (

            <option
              key={item.id_subsektor}
              value={item.id_subsektor}
            >

              {item.nama_subsektor}

            </option>

          ))}

        </select>

      </div>

      <div className="chart-card">

        <ResponsiveContainer
          width="100%"
          height={420}
        >

          <BarChart data={chartData}>

            <CartesianGrid strokeDasharray="3 3" />

            <XAxis
              dataKey="kategori"
              angle={-45}
              textAnchor="end"
              interval={0}
              height={100}
            />

            <YAxis />

            <Tooltip />

            <Bar
              dataKey="jumlah"
              fill="#00BFFF"
              radius={[6, 6, 0, 0]}
            />

          </BarChart>

        </ResponsiveContainer>

      </div>

    </div>

  );

}