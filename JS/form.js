'use strict' /*Usado usado um modo mais seguro e rigoroso para executar o código.*/

const FormId = document.getElementById('FormID'); /*Declarei uma variavel para pegar o elemento FormID do HTML pelo ID*/

const togglerContainer = () => FormID.classList.toggle('togglerContainer'); /*Declarei uma variavel que usa o metodo arrow(Função) que vai pegar a variavel FormID, e adicionar uma classe com o classList, o metodo toggle, verifica se a classe já está lá, se sim, remove, se não, adiciona*/

document.getElementById('btnOverlayRegister').addEventListener('click', togglerContainer);
/*Pega o elemento ID de um botão de registro, e adiciona um evento ao Click, e chama a variavel togglerContainer*/
document.getElementById('btnOverlayLogin').addEventListener('click', togglerContainer);
/*Pega o elemento ID de um botão de Login, e adiciona um evento ao Click, e chama a variavel togglerContainer*/

/*Pra celular*/
document.getElementById('btnOverlayRegisterMobile').addEventListener('click', togglerContainer);
/*Pega o elemento ID de um botão de mobile de Login, e adiciona um evento ao Click, e chama a variavel togglerContainer*/
document.getElementById('btnOverlayLoginMobile').addEventListener('click', togglerContainer);
/*Pega o elemento ID de um botão de mobile de Cadastrar, e adiciona um evento ao Click, e chama a variavel togglerContainer*/