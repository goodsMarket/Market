import React from 'react';
import ReactDOM from 'react-dom';

function Error(props) {
    return (
		<div>
			<h1>에러페이지입니다</h1>
		</div>
    );
}

ReactDOM.createRoot(document.getElementById('app')).render(<Error />);