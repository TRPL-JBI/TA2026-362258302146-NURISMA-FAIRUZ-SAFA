import { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import { getRiwayatPengajuan } from "../services/PengajuanService";
import "./PengajuanSaya.css";

export default function PengajuanSaya() {

  const [pengajuan, setPengajuan] = useState([]);

  useEffect(() => {
    loadData();
  }, []);

  const loadData = async () => {

    try {

      const res = await getRiwayatPengajuan();

      console.log(res);

      setPengajuan(res.data);

    } catch (err) {

      console.log(err);

    }

  };

  return (

    <div className="pengajuan-container">

      <h1>
        Pengajuan Saya
      </h1>

      <p className="subtitle">
        Pantau proses verifikasi usaha kreatif Anda.
      </p>

      {pengajuan.length === 0 ? (

        <div className="empty-card">

          <div className="empty-icon">
            📭
          </div>

          <h2>
            Belum ada pengajuan
          </h2>

          <p>
            Silakan mendaftarkan usaha Anda terlebih dahulu.
          </p>

          <Link to="/sipintar/daftar">

            <button>
              Daftar Sekarang
            </button>

          </Link>

        </div>

      ) : (

        pengajuan.map((item) => (

          <div
            key={item.id_verifikasi}
            className="pengajuan-card"
          >

            <div className="pengajuan-header">

              <div>

                <h2>
                  {item.nama_perusahaan}
                </h2>

                <p>
                  {item.subsektor}
                </p>

                <p>
                  {item.wilayah}
                </p>

              </div>

              <div
                className={`jenis-pengajuan ${
                  item.jenis_pengajuan === "perubahan"
                    ? "perubahan"
                    : "baru"
                }`}
              >

                {item.jenis_pengajuan === "perubahan"
                  ? "✏️ Perubahan Data"
                  : "📝 Pendaftaran Baru"}

              </div>

            </div>

            <div
              className={`status ${
                item.status === "disetujui"
                  ? "approved"
                  : item.status === "ditolak"
                  ? "rejected"
                  : "waiting"
              }`}
            >

              {item.status === "disetujui" &&
                "🟢 Disetujui"}

              {item.status === "ditolak" &&
                "🔴 Ditolak"}

              {item.status === "menunggu" &&
                "🟡 Menunggu Verifikasi"}

            </div>

            <hr />

            <p>
              <b>Alamat</b>
            </p>

            <p>
              {item.alamat}
            </p>

            <p>
              <b>Nomor HP</b>
            </p>

            <p>
              {item.nomor_telp}
            </p>

            {item.catatan && (

              <div className="catatan">

                <b>
                  Catatan Admin
                </b>

                <p>
                  {item.catatan}
                </p>

              </div>

            )}

            <div className="tanggal">

              <p>
                <b>
                  Tanggal Pengajuan:
                </b>{" "}
                {new Date(
                  item.tanggal_pengajuan
                ).toLocaleDateString("id-ID")}
              </p>

              {item.tanggal_verifikasi && (

                <p>
                  <b>
                    Tanggal Verifikasi:
                  </b>{" "}
                  {new Date(
                    item.tanggal_verifikasi
                  ).toLocaleDateString("id-ID")}
                </p>

              )}

            </div>

          </div>

        ))

      )}

    </div>

  );

}