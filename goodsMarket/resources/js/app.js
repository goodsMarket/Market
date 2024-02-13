import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom'
import Login from './src/Pages/Login';
import Regist from './src/Pages/Regist';
import Mypage from './src/Pages/Mypage';
import Error from './src/Pages/Error';
import Header from './src/Layouts/Header';

const App = () => {
    return (
		<div>
			<Header />
			<Routes>
				<Route path="/" element={Login}></Route>
				<Route path="/login" element={Login}></Route>
				<Route path="/regist" element={Regist}></Route>
				<Route path="/mypage" element={Mypage}></Route>
				<Route path="*" element={Error}></Route>
			</Routes>
		</div>
    );
};

export default App;