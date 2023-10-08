<?php
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

const ENV_APP_ENV = 'APP_ENV';
const APP_MODE_PRODUCTION = 'production';
const APP_MODE_TESTING = 'testing';
const APP_MODE_LOCAL = 'local';
const APP_MODE_DEVELOPMENT = 'development';

// <editor-fold desc="validation">
const VALIDATION_DATE_YMD_HIS = 'date_format:Y-m-d H:i:s';

// <editor-fold desc="validation::regex">
const VALIDATION_REGEX_STD_NAME = '/^[\pL\s\-]+$/u';
const VALIDATION_REGEX_USERNAME = '/^(?=[a-zA-Z0-9._]{6,20}$)(?!.*[_.]{2})[^_.].*[^_.]$/';
const VALIDATION_REGEX_INTEGER = '/^\d+$/';

// Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character
const VALIDATION_REGEX_PASSWORD = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/';
// </editor-fold>
// </editor-fold>
