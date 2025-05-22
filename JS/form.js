'use strict'

const FormId = document.getElementById('FormID');

const togglerContainer = () => FormID.classList.toggle('togglerContainer');

document.getElementById('btnOverlayRegister').addEventListener('click', togglerContainer);

document.getElementById('btnOverlayLogin').addEventListener('click', togglerContainer);

document.getElementById('btnOverlayRegisterMobile').addEventListener('click', togglerContainer);

document.getElementById('btnOverlayLoginMobile').addEventListener('click', togglerContainer);