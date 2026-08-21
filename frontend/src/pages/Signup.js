import React, { useState, useContext } from "react";
import { Link, useNavigate } from "react-router-dom";
import { AuthContext } from "../context/AuthContext";
import "./Signup.css";
import { FaEye, FaEyeSlash } from "react-icons/fa";
import kiri from "../assets/kiri.png";
import kanan from "../assets/kanan.png";

export default function Signup() {

const navigate = useNavigate();

const { register } = useContext(AuthContext);

const [formData, setFormData] = useState({
  nama: "",
  email: "",
  password: "",
});

  const [showPassword, setShowPassword] = useState(false);

  const togglePassword = () => {
    setShowPassword(!showPassword);
  };

  const handleChange = (e) => {

  setFormData({

    ...formData,

    [e.target.name]: e.target.value,

  });

};

const handleSubmit = async (e) => {

  e.preventDefault();

  try {

    await register(formData);

    alert(
"Registrasi berhasil.\nSilakan cek email Anda untuk melakukan verifikasi akun."
);

navigate("/signin");

  } catch (err) {
  console.log(err);
  console.log(err.response);
  console.log(err.response?.data);

  alert(JSON.stringify(err.response?.data));
}

};

  return (
    <div className="signup-wrapper">
      {/* Gambar kiri */}
      <img src={kiri} alt="Kiri" className="side-img left" />

      {/* Gambar kanan */}
      <img src={kanan} alt="Kanan" className="side-img right" />

      <div className="signup-card">
        <div className="signup-header">
          <p>
            Have an Account? <Link to="/signin">Sign in</Link>
          </p>
        </div>

        <h2>Sign up</h2>
        <p className="subtitle">Create your account to get started.</p>

        <form onSubmit={handleSubmit}>
          <label>Enter your username or email address</label>
          <input
  type="email"
  name="email"
  placeholder="Email"
  value={formData.email}
  onChange={handleChange}
/>

          <div className="row-input">
            <div>
              <label>User name</label>
              <input
  type="text"
  name="nama"
  placeholder="Nama Lengkap"
  value={formData.nama}
  onChange={handleChange}
/>
            </div>
          </div>

          <label>Enter your Password</label>
          <div className="input-wrapper">
           <input
  type={showPassword ? "text" : "password"}
  name="password"
  placeholder="Password"
  value={formData.password}
  onChange={handleChange}
/>
            <span className="toggle-password" onClick={togglePassword}>
              {showPassword ? <FaEyeSlash /> : <FaEye />}
            </span>
          </div>

          <button type="submit" className="signup-btn">
            Sign up
          </button>
        </form>
      </div>
    </div>
  );
}
