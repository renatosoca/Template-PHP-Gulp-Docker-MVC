/* Para el header */
let ubicPrincipal = window.pageYOffset
let header = document.querySelector('.header')

window.addEventListener('scroll', function(){
    let UbicActual= this.window.pageYOffset
    if (ubicPrincipal>=UbicActual) {
        header.style.top="0px"
    }else{
        header.style.top="-80px"
    }
    ubicPrincipal=UbicActual;
});

/* Para el menu */
let navbar = document.querySelector('.header .container nav');

document.querySelector('#btn-menu').onclick = () =>{
   navbar.classList.toggle('active');
};


/* Para el Carrito de Compras */
let cart = document.querySelector('.carrito');

   document.querySelector('#btn-carrito').onclick = () =>{
      cart.classList.add('active');
   }

   document.querySelector('#cerrar_carrito').onclick = () =>{
      cart.classList.remove('active');
   }


/* Para el Loader */
function loader(){
   document.querySelector('.loader').style.display ='none';
}

function fadeOut(){
   setInterval(loader, 2000);
}

window.onload = fadeOut;

let profile = document.querySelector('.header .container .profile');
   document.querySelector('#btn-usuario').onclick = () =>{
   profile.classList.toggle('active');
}


