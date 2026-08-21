import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import { useEffect } from "react";
import AOS from "aos";
import "aos/dist/aos.css";

// components
import Navbar from "./components/Navbar";
import Dashboard from "./components/Dashboard";
import Statify from "./components/Statify";
import SiPintar from "./components/SiPintar";
import Booknow from "./components/Booknow";
import Map from "./components/Map";
import Footer from "./components/Footer";

// pages
import Tentang from "./pages/Tentang";
import StatifyJumlah from "./pages/StatifyJumlah";
import StatifyKategori from "./pages/StatifyKategori";
import StatifyWilayah from "./pages/StatifyWilayah";
import CaraDaftar from "./pages/CaraDaftar";
import SiPintarPage from "./pages/SiPintarPage";
import PengajuanSaya from "./pages/PengajuanSaya";
import DataSaya from "./pages/DataSaya";
import UpdateDataSaya from "./pages/UpdateDataSaya";
import ResetPassword from "./pages/ResetPassword";

// auth pages
import Signin from "./pages/Signin";
import Signup from "./pages/Signup";
import ForgotPassword from "./pages/ForgotPassword";
import EmailSuccess from "./pages/EmailSuccess";

function App() {
  useEffect(() => {
    AOS.init({
      duration: 1000, // lama animasi
      once: true,     // animasi hanya sekali
      easing: "ease-in-out",
    });
  }, []);

  return (
    <Router>
      <Navbar />

      <Routes>
        {/* Landing Page */}
        <Route
          path="/"
          element={
            <>
              <div data-aos="fade-up"><Dashboard /></div>
              <div data-aos="fade-right"><Statify /></div>
              <div data-aos="fade-left"><SiPintar /></div>
              <div data-aos="zoom-in"><Booknow /></div>
              <div data-aos="fade-up"><Map /></div>
            </>
          }
        />

        {/* Other pages */}
        <Route path="/tentang" element={<Tentang />} />
        <Route path="/statify/jumlah" element={<StatifyJumlah />} />
        <Route path="/statify/kategori" element={<StatifyKategori />} />
        <Route path="/statify/wilayah" element={<StatifyWilayah />} />
        <Route path="/sipintar/cara-daftar" element={<CaraDaftar />} />
        <Route path="/sipintar/daftar" element={<SiPintarPage />} />
        <Route path="/pengajuan-saya" element={<PengajuanSaya />} />
        <Route path="/data-saya" element={<DataSaya />} />
        <Route path="/data-saya/update" element={<UpdateDataSaya />} />


        {/* Auth pages */}
        <Route path="/signin" element={<Signin />} />
        <Route path="/signup" element={<Signup />} />
<Route path="/email-success" element={<EmailSuccess />} />
        <Route path="/forgotpassword" element={<ForgotPassword />} />
        <Route
    path="/reset-password"
    element={<ResetPassword />}
/>
      </Routes>

      <Footer />
    </Router>
  );
}

export default App;
