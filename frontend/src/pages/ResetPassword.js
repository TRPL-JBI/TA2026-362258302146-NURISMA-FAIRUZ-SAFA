import React, { useState } from "react";
import { useSearchParams, useNavigate } from "react-router-dom";
import axios from "axios";
import "./ResetPassword.css";

const API  = "https://ekraf.ideahub.my.id/api";;

export default function ResetPassword() {

    const [searchParams] = useSearchParams();
    const navigate = useNavigate();

    const [password, setPassword] = useState("");
    const [passwordConfirmation, setPasswordConfirmation] =
        useState("");

    const [loading, setLoading] = useState(false);

    const token = searchParams.get("token");
    const email = searchParams.get("email");

    const handleSubmit = async (e) => {

        e.preventDefault();

        if (password !== passwordConfirmation) {

            alert("Konfirmasi password tidak sama.");

            return;

        }

        try {

            setLoading(true);

            const response = await axios.post(
                `${API}/reset-password`,
                {
                    token: token,
                    email: email,
                    password: password,
                    password_confirmation:
                        passwordConfirmation,
                },
                {
                    headers: {
                        Accept: "application/json",
                        "Content-Type": "application/json",
                    },
                }
            );

            alert(response.data.message);

            navigate("/signin");

        } catch (error) {

            console.error(error);

            alert(
                error.response?.data?.message ||
                "Gagal mereset password."
            );

        } finally {

            setLoading(false);

        }

    };

    return (

        <div className="reset-page">

            <div className="reset-card">

                <h1>Reset Password</h1>

                <p>
                    Buat password baru untuk akun Anda.
                </p>

                <form onSubmit={handleSubmit}>

                    <label>
                        Password Baru
                    </label>

                    <input
                        type="password"
                        value={password}
                        onChange={(e) =>
                            setPassword(e.target.value)
                        }
                        placeholder="Minimal 8 karakter"
                        minLength={8}
                        required
                    />

                    <label>
                        Konfirmasi Password
                    </label>

                    <input
                        type="password"
                        value={passwordConfirmation}
                        onChange={(e) =>
                            setPasswordConfirmation(
                                e.target.value
                            )
                        }
                        placeholder="Ulangi password baru"
                        minLength={8}
                        required
                    />

                    <button
                        type="submit"
                        disabled={loading}
                    >
                        {loading
                            ? "Memproses..."
                            : "Reset Password"}
                    </button>

                </form>

            </div>

        </div>

    );

}