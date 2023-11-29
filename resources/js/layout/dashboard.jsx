import React from 'react';

export class Dashboard extends React.Component {
  render() {
    return (
      <div id="page-top">
        <div id="wrapper">
          <ul className="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a className="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
              <div className="sidebar-brand-icon rotate-n-15">
                <i className="fas fa-laugh-wink"></i>
              </div>
              <div className="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <hr className="sidebar-divider my-0"/>
              <li className="nav-item active">
                <a className="nav-link" href="index.html">
                  <i className="fas fa-fw fa-tachometer-alt"></i>
                  <span>Dashboard</span></a>
              </li>
          </ul>
        </div>
      </div>
    )
  }
}

