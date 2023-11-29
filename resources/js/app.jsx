/*
//
//  ______    _   _           _  __      _   _     ____   ___
// |  ____|  | | | |         | |/ _|    | | | |   |___ \ / _ \
// | |__ __ _| |_| |__   __ _| | |_ __ _| |_| |__   __) | | | |
// |  __/ _` | __| '_ \ / _` | |  _/ _` | __| '_ \ |__ <| | | |
// | | | (_| | |_| | | | (_| | | || (_| | |_| | | |___) | |_| |
// |_|  \__,_|\__|_| |_|\__,_|_|_| \__,_|\__|_| |_|____/ \___/
//
// Written by Fathalfath30.
// Email : fathalfath30@gmail.com
// Follow me on:
//  Github : https://github.com/fathalfath30
//  Gitlab : https://gitlab.com/Fathalfath30
//
*/
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */
import './bootstrap';

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import React from 'react';
import ReactDOM from "react-dom/client";
import {RouterProvider} from "react-router-dom";
import {routes} from './config/routes.jsx';

import '../vendor/fontawesome-free/css/all.min.css';
import '../css/sb-admin-2.min.css';

import '../vendor/jquery/jquery.min.js'
import '../vendor/bootstrap/js/bootstrap.bundle.min.js'
import '../vendor/jquery-easing/jquery.easing.min.js'
import '../js/sb-admin-2.min.js'

let element = document.getElementById('root');
if(element) {
  const root = ReactDOM.createRoot(element);
  root.render(<React.StrictMode>
    <RouterProvider
      router={routes} />
  </React.StrictMode>)
}

