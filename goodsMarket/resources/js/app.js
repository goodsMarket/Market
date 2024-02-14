import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Login from './src/Pages/Login';
import Regist from './src/Pages/Regist';
import Mypage from './src/Pages/Mypage';
import Error from './src/Pages/Error';
import Header from './src/Layouts/Header';
import Footer from './src/Layouts/Footer';

const App = () => {
    return (
		<div>
			<Header />
			<Router>
				<Routes>
					<Route path="/login" element={<Login />}></Route>
					<Route path="/regist" element={<Regist />}></Route>
					<Route path="/mypage" element={<Mypage />}></Route>
					<Route path="*" element={<Error />}></Route>
				</Routes>
			</Router>
			<Footer />
		</div>
    );
};

if(document.getElementById('root')){
	ReactDOM.render(<App />, document.getElementById('root'))
}