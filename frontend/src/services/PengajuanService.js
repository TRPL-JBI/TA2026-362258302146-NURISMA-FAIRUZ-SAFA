import axios from "axios";

const API = "https://ekraf.ideahub.my.id/api";

const authHeader = () => ({
    headers: {
        Authorization: `Bearer ${localStorage.getItem("token")}`,
    },
});

// ==========================
// Kirim Pengajuan
// ==========================

export const kirimPengajuan = async (data) => {
  const formData = new FormData();

  formData.append("nama_perusahaan", data.nama_perusahaan);
  formData.append("nama_proyek", data.nama_proyek);
  formData.append("alamat", data.alamat);
  formData.append("nomor_telp", data.nomor_telp);
  formData.append("id_subsektor", data.id_subsektor);
  formData.append("id_wilayah", data.id_wilayah);
  formData.append("link_gmaps", data.link_gmaps || "");

  // Dokumen pendukung
  formData.append("dokumen_nib", data.dokumen_nib);
  formData.append("dokumen_ktp", data.dokumen_ktp);

  console.log("NIB:", data.dokumen_nib);
console.log("KTP:", data.dokumen_ktp);
console.log("NIB instanceof File:", data.dokumen_nib instanceof File);
console.log("KTP instanceof File:", data.dokumen_ktp instanceof File);

const response = await axios.post(
  `${API}/pengajuan`,
  formData,
  {
    headers: {
      Authorization: `Bearer ${localStorage.getItem("token")}`,
      "Content-Type": "multipart/form-data",
    },
  }
);

  return response.data;
};

// ==========================
// Riwayat Pengajuan
// ==========================

export const getRiwayatPengajuan = async () => {

    const response = await axios.get(
        `${API}/riwayat-pengajuan`,
        authHeader()
    );

    return response.data;
};

// ==========================
// Status Pengajuan
// ==========================

export const getStatusPengajuan = async () => {

    const response = await axios.get(
        `${API}/status-pengajuan`,
        authHeader()
    );

    return response.data;
};  