import React from 'react';
import ReactDOM from 'react-dom/client';

function MainApp() {
  return (
    <div className="container">

    </div>
  );
}

if(document.getElementById('example')) {
  const Index = ReactDOM.createRoot(document.getElementById("example"));
  Index.render(<React.StrictMode><MainApp /></React.StrictMode>)
}
