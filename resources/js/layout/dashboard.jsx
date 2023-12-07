import React from 'react';
import {Sidebar} from "../components/sidebar.jsx";

export class Dashboard extends React.Component {
  render() {
    return (
      <div id="page-top">
        <div id="wrapper">
          <Sidebar/>
        </div>
      </div>
    )
  }
}

