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

// <editor-fold desc="Application">
const EnvAppEnv = 'APP_ENV';
const AppModeProduction = 'production';
const AppModeTesting = 'testing';
const AppModeLocal = 'local';
const AppModeDevelopment = 'development';
// </editor-fold>

// <editor-fold desc="DefaultValue">
// <editor-fold desc="DefaultValue::Role::SuperAdmin">
const DefaultRoleSuperAdminId = '8626e795-4079-4e4d-9e34-98b4aa4fec4f';
const DefaultRoleSuperAdminName = 'Super Administrator';
const DefaultRoleSuperAdminLevel = 999;
// </editor-fold>
// <editor-fold desc="DefaultValue::Role::Guest">
const DefaultRoleGuestId = '304de370-bf18-4a26-8ee8-aaa6eab47955';
const DefaultRoleGuestName = 'Guest';
const DefaultRoleGuestLevel = 0;
// </editor-fold>

// <editor-fold desc="DefaultValue::User::SuperAdmin">
const DefaultUserSuperAdminId = 'fb8a8e3c-4efb-4a33-bb16-e7ca9af0d0fe';
// </editor-fold>
// <editor-fold desc="DefaultValue::User::Guest">
const DefaultUserGuestId = '93889d23-3883-46b6-949d-adb6ab337c40';
// </editor-fold>
// </editor-fold>

// <editor-fold desc="Validation">
// <editor-fold desc="Validation::Regex">
const ValidationRegexStandardName = '/^[\pL\s\-]+$/u';
const ValidationRegexStandardUsername = '/^(?=[a-zA-Z0-9._]{5,20}$)(?!.*[_.]{2})[^_.].*[^_.]$/';
const ValidationRegexInteger = '/^\d+$/';
const ValidationRegexStandardDateTimeYmdHis = '/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/';

// Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character
const ValidationRegexStandardPassword = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/';
// </editor-fold>
// </editor-fold>

const SampleLongText = "OGFytAYSdgUdOzWIsuSyljWuHphAqunJlNRYJAamYlBUEGqnNBJHBAvJXhiNQpgDIXnbUnFEZXYCFXvdOusqekWlRocndcVvUswvyiAuGLhPPtWhYQvbCRObiSJTTVNcmOVwPozPxtlQEhmyWbsUXXwsf31a";
