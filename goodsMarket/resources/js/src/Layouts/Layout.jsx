// Layout.js

import React from 'react';
import Header from './Header';
import Footer from './Footer';

const Layout = ({ children }) => {
    return (
    <div className='body'>
        <Header />
            <div className="container">
                <main className="content">
                    {children}
                </main>
            </div>
        <Footer />
    </div>
    );
};

export default Layout;
