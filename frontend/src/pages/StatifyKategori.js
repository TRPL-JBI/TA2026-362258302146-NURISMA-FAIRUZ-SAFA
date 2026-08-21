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

import "./StatifyKategori.css";

import { getStatify } from "../services/statifyService";
import { getSubsektor } from "../services/masterDataService";

export default function StatifyKategori() {

  const [subsektor, setSubsektor] = useState([]);

  const [selectedSubsektor, setSelectedSubsektor] = useState("");

  const [chartData, setChartData] = useState([]);

  const [totalPelaku, setTotalPelaku] = useState(0);

  const [totalSubsektor, setTotalSubsektor] = useState(0);

  const [totalWilayah, setTotalWilayah] = useState(0);

  useEffect(() => {

    loadSubsektor();

  }, []);

useEffect(() => {

    const fetchData = async () => {

        try {

            const data = await getStatify(selectedSubsektor);

            setTotalPelaku(data.total_pelaku);

            setTotalSubsektor(data.total_subsektor);

            setTotalWilayah(data.total_kecamatan);

            const hasil = data.per_wilayah.map(item => ({

                kecamatan: item.kecamatan,

                jumlah: item.jumlah

            }));

            setChartData(hasil);

        }

        catch(err){

            console.log(err);

        }

    };

    fetchData();

}, [selectedSubsektor]);

  const loadSubsektor = async () => {

    try {

      const data = await getSubsektor();

      setSubsektor(data);

    } catch (err) {

      console.log(err);

    }

  };

  return (

    <div className="statify-kategori-page">

      <h2>Kategori Pelaku EKRAF</h2>

      <div className="stat-cards">

        <div className="stat-card">

          <h3>{totalPelaku}</h3>

          <p>Total Pelaku EKRAF</p>

        </div>

        <div className="stat-card">

          <h3>{totalSubsektor}</h3>

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

          onChange={(e) =>

            setSelectedSubsektor(e.target.value)

          }

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

          height={450}

        >

          <BarChart

            data={chartData}

            margin={{

              top: 20,

              right: 20,

              left: 20,

              bottom: 80,

            }}

          >

            <CartesianGrid strokeDasharray="3 3" />

            <XAxis

              dataKey="kecamatan"

              angle={-45}

              textAnchor="end"

              interval={0}

              height={100}

            />

            <YAxis />

            <Tooltip />

            <Bar

              dataKey="jumlah"

              fill="#FF9800"

              radius={[6, 6, 0, 0]}

            />

          </BarChart>

        </ResponsiveContainer>

      </div>

    </div>

  );

}