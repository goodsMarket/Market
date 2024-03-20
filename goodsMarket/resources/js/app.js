import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import { CookiesProvider } from 'react-cookie';
import Login from './src/Pages/Login';
import Regist from './src/Pages/Regist';
import Mypage from './src/Pages/Mypage';
import Main from './src/Pages/Main';
import Chat from './src/Pages/Chat';
import UsedProductionDetail from './src/Pages/UsedProductionDetail';
import ProductionDetail from './src/Pages/ProductionDetail';
import UsedProductionInsert from './src/Pages/UsedProductionInsert';
import ProductionInsert from './src/Pages/ProductionInsert';
import Error from './src/Pages/Error';
import Layout from './src/Layouts/Layout';

const App = () => {
	console.log('App');
	return (
		<CookiesProvider>
			<Router>
				{/* 레이아웃 */}
				<Layout>
					{/* 라우터 처리 */}
					<Routes>
						{console.log('Routes')}
						<Route path="/login" element={<Login />}></Route>
						<Route path="/regist" element={<Regist />}></Route>
						<Route path="/mypage" element={<Mypage />}></Route>
						<Route path="/chat" element={<Chat />}></Route>
						<Route path="/new/used" element={<UsedProductionInsert />}></Route>
						<Route path="/used" element={<UsedProductionDetail />}></Route>
						<Route path="/new/production" element={<ProductionInsert />}></Route>
						<Route path="/production" element={<ProductionDetail />}></Route>
						<Route path="/" element={<Main />}></Route>
						<Route path="/board / [d]" element={<Main />}></Route>
						<Route path="*" element={<Error />}></Route>
					</Routes>
				</Layout>
			</Router>
		</CookiesProvider>
	);
};

if (document.getElementById('root')) {
	ReactDOM.render(<App />, document.getElementById('root'))
}