console.log('Test de la Page');

/************************ PAGE ACCUEIL ************************/

/*COOKIES*/

var accept = document.getElementById('accept'); 
var banner = document.getElementById('cookies');

accept.onclick = function() {
    banner.style.display = 'none';
}

/*BURGER*/
var burger = document.getElementById("burger");
console.log(burger);

var burgerMenu = document.getElementById("burgerMenu");
console.log(burgerMenu);

burger.addEventListener('click', function(){
	if(burgerMenu.style.display == 'block'){
    burgerMenu.style.display = 'none';
    burger.style.color = "#dddddb"
    burger.style.backgroundColor = "transparent"
  } else {
    burgerMenu.style.display = 'block';
    burger.style.color = "#808080"
    burger.style.backgroundColor = "#dddddb"
  }
})

/************************ CONTACT ************************/

let buttonContact = document.getElementById('buttoncontact');
let close = document.getElementById('close');

buttonContact.addEventListener("click", function(){
    let contact = document.getElementById('contact');
    contact.style.display = "block"
});
close.addEventListener("click", function(){
    let contact = document.getElementById('contact');
    contact.style.display = "none"
});


