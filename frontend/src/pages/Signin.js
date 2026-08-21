import React, { useState, useContext, useEffect } from "react";
import { Link, useNavigate } from "react-router-dom";
import { AuthContext } from "../context/AuthContext";
import "./Signin.css";
import { FaEye, FaEyeSlash } from "react-icons/fa";
import kiri from "../assets/kiri.png";
import kanan from "../assets/kanan.png";
import { useLocation } from "react-router-dom";

export default function Signin() {

  const navigate = useNavigate();

  const { login } = useContext(AuthContext);

  const [showPassword, setShowPassword] = useState(false);

  const [formData, setFormData] = useState({
    email: "",
    password: "",
});

  const handleChange = (e) => {

    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });

  };

  const handleSubmit = async (e) => {

    e.preventDefault();

    try {

      await login(
        formData.email,
        formData.password
      );

      alert("Login berhasil!");

      navigate("/");

    } catch (err) {

      alert(
        err.response?.data?.message ||
        "Login gagal"
      );

    }

  };

  

  const location = useLocation();

useEffect(() => {

    const params = new URLSearchParams(location.search);

    if(params.get("verified")){

        alert("🎉 Email berhasil diverifikasi.\nSilakan login.");

    }

}, [location]);

  return (
    <div className="signin-wrapper">

      <img src={kiri} alt="kiri" className="side-img left" />

      <div className="signin-card">

        <div className="signin-header">
          <h4>Welcome Back</h4>

          <Link to="/signup">
            Sign up
          </Link>
        </div>

        <h2>Sign in</h2>

        <p className="subtitle">
          Enter your credentials to access your account.
        </p>

        <form onSubmit={handleSubmit}>

          <label>Email</label>

          <input
            type="email"
            name="email"
            placeholder="Enter your email"
            value={formData.email}
            onChange={handleChange}
          />

          <label>Password</label>

          <div className="input-wrapper">

            <input
              type={showPassword ? "text" : "password"}
              name="password"
              placeholder="Enter your password"
              value={formData.password}
              onChange={handleChange}
            />

            <span
              className="toggle-password"
              onClick={() => setShowPassword(!showPassword)}
            >
              {showPassword ? <FaEyeSlash /> : <FaEye />}
            </span>

          </div>

          <div className="forgot-link">

            <Link to="/forgotpassword">
              Forgot Password?
            </Link>

          </div>

          <button
            type="submit"
            className="signin-btn"
          >
            Sign in
          </button>

        </form>

      </div>

      <img src={kanan} alt="kanan" className="side-img right" />

    </div>
  );

}