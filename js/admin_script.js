
/* PARA EL NAVEGADOR */
let navbar = document.querySelector('.header .container nav');
document.querySelector('#btn-menu').onclick = () =>{
   navbar.classList.toggle('active');
}

/* PARA EL PERFIL DEL LOGIN */
let profile = document.querySelector('.header .container .profile');
document.querySelector('#btn-usuario').onclick = () =>{
   profile.classList.toggle('active');
}
window.onscroll = () =>{
   navbar.classList.remove('active');
   profile.classList.remove('active');
}