import React from 'react';
import { createRoot } from 'react-dom/client';
import { BrowserRouter, Routes, Route, NavLink } from 'react-router-dom';
import Login from './Pages/login';
import Regist from './Pages/Regist';
import Mypage from './Pages/Mypage';

const App = () => {
    return (
        <BrowserRouter>
            <div>
                <NavLink to="/">Login</NavLink>
                <NavLink to="/regist">Regist</NavLink>
                <NavLink to="/mypage">Mypage</NavLink>
            </div>

            <Routes>
                <Route path="/" element={<Login />} />
                <Route path="/regist" element={<Regist />} />
                <Route path="/mypage" element={<Mypage />} />
            </Routes>
        </BrowserRouter>
    );
};

if (document.getElementById('app')) {
    createRoot(document.getElementById('app')).render(<App />);
}