import React from "react";
import ReactDOM from "react-dom";
import { Button } from "antd";
import Home from "../pages";

function App() {
  return <Home />;
}

export default App;

if (document.getElementById("app")) {
  ReactDOM.render(<App />, document.getElementById("app"));
}
