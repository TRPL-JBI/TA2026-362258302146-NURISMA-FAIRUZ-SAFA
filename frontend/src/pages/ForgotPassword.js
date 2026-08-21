import React, { useState } from "react";
import axios from "axios";
import "./ForgotPassword.css";
import kiri from "../assets/kiri.png";
import kanan from "../assets/kanan.png";

export default function ForgotPassword() {
  const [email, setEmail] = useState("");
  const [loading, setLoading] = useState(false);

  const handleSubmit = async (e) => {
    e.preventDefault();

    setLoading(true);

    try {
      const response = await axios.post(
        "https://ekraf.ideahub.my.id/api/forgot-password",
        {
          email: email,
        }
      );

      alert(response.data.message);

    } catch (error) {
      console.error(error);

      alert(
        error.response?.data?.message ||
        "Gagal mengirim link reset password."
      );

    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="forgot-wrapper">

      <img
        src={kiri}
        alt="kiri"
        className="side-img left"
      />

      <div className="forgot-card">

        <div className="forgot-header">
          <h4>Kembali ke</h4>

          <a href="/signin">
            Masuk
          </a>
        </div>

        <h2>Lupa Password</h2>

        <p className="subtitle">
          Masukkan email akun Anda dan kami akan mengirim link untuk mereset
          password.
        </p>

        <form onSubmit={handleSubmit}>

          <label>Email</label>

          <input
            type="email"
            placeholder="Masukkan email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            required
          />

          <button
            type="submit"
            className="forgot-btn"
            disabled={loading}
          >
            {loading
              ? "Mengirim..."
              : "Kirim Link Reset"}
          </button>

        </form>

      </div>

      <img
        src={kanan}
        alt="kanan"
        className="side-img right"
      />

    </div>
  );
}