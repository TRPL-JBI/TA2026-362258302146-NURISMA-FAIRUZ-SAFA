import { createContext, useEffect, useState } from "react";
import * as authService from "../services/authService";

export const AuthContext = createContext();

export default function AuthProvider({ children }) {

    const [user, setUser] = useState(null);

    useEffect(() => {

        checkLogin();

    }, []);

    const checkLogin = async () => {

        const token = localStorage.getItem("token");

        if (!token) return;

        try {

            const data = await authService.profile();

            setUser(data);

        } catch (err) {

            localStorage.removeItem("token");

            setUser(null);

        }

    };

   const login = async (email, password) => {

    const response = await authService.login({
        email,
        password
    });

    localStorage.setItem("token", response.token);

    setUser(response.user);

    return response;
};

    const register = async (payload) => {

        const data = await authService.register(payload);

        localStorage.setItem("token", data.token);

        setUser(data.user);

    };

    const logout = async () => {

        try {

            await authService.logout();

        } catch (err) {}

        localStorage.removeItem("token");

        setUser(null);

    };

    return (

        <AuthContext.Provider
            value={{
                user,
                login,
                logout,
                register,
            }}
        >

            {children}

        </AuthContext.Provider>

    );

}