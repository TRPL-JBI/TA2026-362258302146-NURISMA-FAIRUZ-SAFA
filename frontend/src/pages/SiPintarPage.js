import React, { useEffect, useState } from "react";
import "./SiPintarPage.css";
import { getSubsektor, getWilayah } from "../services/masterDataService";
import { useNavigate } from "react-router-dom";
import { kirimPengajuan } from "../services/PengajuanService";

function SiPintarPage() {
  const navigate = useNavigate();

  const [formData, setFormData] = useState({
    nama_perusahaan: "",
    nama_proyek: "",
    alamat: "",
    nomor_telp: "",
    id_subsektor: "",
    id_wilayah: "",
    link_gmaps: "",
    dokumen_nib: null,
    dokumen_ktp: null,
  });

  const [subsektor, setSubsektor] = useState([]);
  const [wilayah, setWilayah] = useState([]);
  const [loading, setLoading] = useState(false);

  useEffect(() => {
    loadMaster();
  }, []);

  const loadMaster = async () => {
    try {
      const sub = await getSubsektor();
      const wil = await getWilayah();

      console.log("SUB:", sub);
      console.log("WIL:", wil);

      setSubsektor(sub);
      setWilayah(wil);
    } catch (err) {
      console.log(err);
    }
  };

  const handleChange = (e) => {
    const { name, value, files } = e.target;

    setFormData({
      ...formData,
      [name]: files ? files[0] : value,
    });
  };

  const handleSubmit = async (e) => {
    console.log("HANDLE SUBMIT DIPANGGIL");
    e.preventDefault();

    const token = localStorage.getItem("token");

    if (!token) {
      alert("Silakan login terlebih dahulu untuk mengajukan data.");
      navigate("/login");
      return;
    }

    setLoading(true);

    try {
      await kirimPengajuan(formData);

      alert("🎉 Pengajuan berhasil dikirim!");

      navigate("/pengajuan-saya");
    } catch (err) {
      console.log(err);

      if (err.response?.status === 401) {
        alert("Silakan login terlebih dahulu untuk mengajukan data.");
        navigate("/login");
        return;
      }

      alert(
        err.response?.data?.message ||
          "Pengajuan gagal. Silakan coba kembali."
      );
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="sipintar-container">
      <h2 className="sipintar-title">
        Sistem Pusat Informasi dan Tata Registrasi
      </h2>

      <p className="sipintar-subtitle">
        Lengkapi formulir berikut untuk mengajukan verifikasi sebagai Pelaku
        Ekonomi Kreatif Kabupaten Banyuwangi.
      </p>

      <form className="sipintar-form" onSubmit={handleSubmit}>
        <div className="form-grid">
          {/* BARIS 1: Nama Perusahaan & Nama Proyek */}
          <div className="form-group">
            <label>Nama Perusahaan</label>
            <input
              type="text"
              name="nama_perusahaan"
              value={formData.nama_perusahaan}
              onChange={handleChange}
              placeholder="Masukkan nama perusahaan"
            />
          </div>

          <div className="form-group">
            <label>Nama Proyek (usaha)</label>
            <input
              type="text"
              name="nama_proyek"
              value={formData.nama_proyek}
              onChange={handleChange}
              placeholder="Masukkan nama proyek (usaha)"
            />
          </div>

          {/* BARIS 2: Subsektor & Kecamatan */}
          <div className="form-group">
            <label>Subsektor</label>
            <select
              name="id_subsektor"
              value={formData.id_subsektor}
              onChange={handleChange}
            >
              <option value="">-- Pilih Subsektor --</option>
              {subsektor.map((item) => (
                <option key={item.id_subsektor} value={item.id_subsektor}>
                  {item.nama_subsektor}
                </option>
              ))}
            </select>
          </div>

          <div className="form-group">
            <label>Kecamatan</label>
            <select
              name="id_wilayah"
              value={formData.id_wilayah}
              onChange={handleChange}
            >
              <option value="">-- Pilih Kecamatan --</option>
              {wilayah.map((item) => (
                <option key={item.id_wilayah} value={item.id_wilayah}>
                  {item.kecamatan}
                </option>
              ))}
            </select>
          </div>

          {/* BARIS 3: NIB & KTP Pemilik (SEJAJAR KIRI-KANAN) */}
          <div className="form-group">
            <label>
              NIB <span className="required">*</span>
            </label>
            <input
              type="file"
              name="dokumen_nib"
              accept=".pdf,.jpg,.jpeg,.png"
              onChange={handleChange}
              required
            />
            <small className="maps-info">
            Upload NIB sebagai dokumen pendukung verifikasi. Format: PDF,
              JPG, JPEG, atau PNG.
            </small>
          </div>

          <div className="form-group">
            <label>
              KTP Pemilik <span className="required">*</span>
            </label>
            <input
              type="file"
              name="dokumen_ktp"
              accept=".pdf,.jpg,.jpeg,.png"
              onChange={handleChange}
              required
            />
            <small className="maps-info">
            Upload KTP pemilik sebagai dokumen identitas. Format: PDF, JPG,
              JPEG, atau PNG.
            </small>
          </div>

          {/* BARIS 4: Nomor Telepon & Link Google Maps */}
          <div className="form-group">
            <label>Nomor Telepon</label>
            <input
              type="text"
              name="nomor_telp"
              value={formData.nomor_telp}
              onChange={handleChange}
              placeholder="08xxxxxxxxxx"
            />
          </div>

          <div className="form-group">
            <label>Link Google Maps</label>
            <input
              type="text"
              name="link_gmaps"
              value={formData.link_gmaps}
              onChange={handleChange}
              placeholder="https://maps.app.goo.gl/..."
            />
            <small className="maps-info">
              📍 Buka Google Maps → Bagikan → Salin Link → Tempel di sini.
            </small>
          </div>
        </div>

        {/* Alamat Lengkap (Full Width) */}
        <div className="form-group alamat-group">
          <label>Alamat Lengkap</label>
          <textarea
            rows="4"
            name="alamat"
            value={formData.alamat}
            onChange={handleChange}
            placeholder="Masukkan alamat lengkap usaha"
          />
        </div>

        <button className="sipintar-btn" type="submit" disabled={loading}>
          {loading ? "Mengirim..." : "Kirim Pengajuan"}
        </button>
      </form>
    </div>
  );
}

export default SiPintarPage;