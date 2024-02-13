import React from 'react';
import ReactDOM from 'react-dom';

function Example() {
    return (
        <div className="container">
            <h1>예시 컴포넌트
                <br />
                추후수정
            </h1>
        </div>
    );
}

export default Example;

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}