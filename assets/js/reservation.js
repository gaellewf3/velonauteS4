/*************** Menu Burger ***************/


var burger = document.getElementById("burger");
console.log(burger);

var menuResponsive = document.getElementById("menuResponsive");
console.log(menuResponsive);

burger.onclick = function(){
    //console.log('Test On Click');
    if(menuResponsive.style.display == 'block'){
        menuResponsive.style.display = 'none';
        burger.style.color = "#dddddb"
        burger.style.backgroundColor = "transparent"
    } else {
        menuResponsive.style.display = 'block';
        burger.style.color = "#808080"
        burger.style.backgroundColor = "#dddddb"
    }
}

/*************** PARTIE CALENDRIER *************/ 
let date1 = (new Date()).getTime();
let date2 = 0;
let nombreDeJours = 0;


// function calculIntervalDeJour(){
//     let dateDep = document.getElementById('dateDep');
//     let dateRet = document.getElementById('dateRet');
//     let valueDateDep = dateDep.getAttribute("value");
//     let valueDateRet = dateRet.getAttribute("value");
//     let objetDateDep = new Date(valueDateDep);
//     let objetDateRet = new Date(valueDateRet);
//     let tmp1 = objetDateRet.getTime();
//     let tmp2 = objetDateDep.getTime();
//     let milliSec = tmp1 - tmp2;
//     let tmp = milliSec / 1000 / 60 / 60 / 24 +1;
//     return(tmp);
// }

function UpdateFieldNbJours(nbJour){
    let fieldNbJour = document.getElementById('nbJour');
    fieldNbJour.value = nbJour;
    console.log(nbJour);
};

function calculNombreDeJours(){
    let calculJour = 0;
    if ((date1 != 0) && (date2 != 0)){
        const calculMs = date2 - date1;
        calculJour = calculMs / 1000 / 60 / 60 / 24 + 1;
        nombreDeJours = calculJour;
    }
    return(calculJour);
};

function dateDepartCallBack(event){
    if (event.target.value == ""){
        date1 = 0;
    }
    else{
        const d = new Date(event.target.value);
        date1 = d.getTime();
        console.log(date1);
    }
    UpdateFieldNbJours(calculNombreDeJours());
};

function dateRetourCallBack(event){
    const d = new Date(event.target.value);
    date2 = d.getTime();
    console.log(date2);
    UpdateFieldNbJours(calculNombreDeJours());
};


function setMinMaxDateValue(){
    let dateDep = document.getElementById('dateDep');
    let dateRet = document.getElementById('dateRet');
    let d = new Date();
    let dateSplit = d.toISOString().split('T')[0];

    dateDep.setAttribute("value", dateSplit);
    dateDep.setAttribute("min", dateSplit);
    dateRet.setAttribute("value", dateSplit);
    dateRet.setAttribute("min", dateSplit);
}


//************************** CHOIX HEBERGEMENT **************************//

var divs = ["blocHotel", "blocGite", "blocAppartement", "blocCamping"];
var visibleDivId = null;
function toggleVisibility(divId) {
  if(visibleDivId === divId) {
    //visibleDivId = null;
  } else {
    visibleDivId = divId;
  }
  hideNonVisibleDivs();
}
function hideNonVisibleDivs() {
  var i, divId, div;
  for(i = 0; i < divs.length; i++) {
    divId = divs[i];
    div = document.getElementById(divId);
    if(visibleDivId === divId) {
      div.style.display = "block";
    } else {
      div.style.display = "none";
    }
  }
}

//************************** RECAPITULATIF **************************//


if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready)
} else {
    ready()
}

function ready() {

    var removeCartItemButtons = document.getElementsByClassName('btn-danger')
    for (var i = 0; i < removeCartItemButtons.length; i++) {
        var button = removeCartItemButtons[i]
        button.addEventListener('click', removeCartItem)
    }

    var quantityInputs = document.getElementsByClassName('cart-quantity-input')
    for (var i = 0; i < quantityInputs.length; i++) {
        var input = quantityInputs[i]
        input.addEventListener('change', quantityChanged)
    }

    var addToCartButtons = document.getElementsByClassName('shop-item-button')
    for (var i = 0; i < addToCartButtons.length; i++) {
        var button = addToCartButtons[i]
        button.addEventListener('click', addToCartClicked)
    }

    document.getElementsByClassName('btn-purchase')[0].addEventListener('click', purchaseClicked)

    setMinMaxDateValue();
}


// *********** Merci pour votre achat **************** //

function purchaseClicked() {
    // alert('Merci pour votre achat')
    var cartItems = document.getElementsByClassName('cart-items')[0]
    while (cartItems.hasChildNodes()) {
        cartItems.removeChild(cartItems.firstChild)
    }
    let total = updateCartTotal()
    console.log(total);
    window.location = '/paiement.html?total=' + total
}

// *********** Enlever produit du panier **************** //

function removeCartItem(event) {
    var buttonClicked = event.target
    buttonClicked.parentElement.parentElement.remove()
    updateCartTotal()
}

// *********** Changer quantité du panier **************** //

function quantityChanged(event) {
    var input = event.target
    if (isNaN(input.value) || input.value <= 0) {
        input.value = 1
    }
    // ***** pour synchronize le value de deux cart-quantity ***** //
    // let cartQuantityList = document.getElementsByClassName('cart-quantity-input');
    // for (let i = 0; i < cartQuantityList.length; i++){
    //     cartQuantityList[i].value = input.value
    // }
    updateCartTotal()
}

// *********** Ajouter au panier  suite au clic  + Constitution du Panier **************** //

function addToCartClicked(event) {
    var button = event.target
    var shopItem = button.parentElement.parentElement
    var title = shopItem.getElementsByClassName('shop-item-title')[0].innerText
    var price = shopItem.getElementsByClassName('shop-item-price')[0].innerText
    var imageSrc = shopItem.getElementsByClassName('shop-item-image')[0].src
    addItemToCart(title, price, imageSrc)
    updateCartTotal()
}

function addItemToCart(title, price, imageSrc) {
    let cartItemsList = document.getElementsByClassName('cart-items')
    let cartItemNames = cartItemsList[0].getElementsByClassName('cart-item-title')

    // verification qu'element n'est pas dans la liste
    for (let i = 0; i < cartItemNames.length; i++) {
        if (cartItemNames[i].innerText == title) {
            alert('Cette prestation est déjà dans votre panier')
            return
        }
    }

    // ajoute l'element dans la liste
    let cartRowContents = `
        <div class="cart-item cart-column">
            <span class="cart-item-title">${title}</span>
        </div>
        <span class="cart-price cart-column">${price}</span>
        <div class="cart-quantity cart-column">
            <input class="cart-quantity-input" type="number" value="1">
            <button class="btn btn-danger" type="button">&#10005;</button>
        </div>`
    for (let i = 0; i < cartItemsList.length; i++) {
        let cartRow = document.createElement('div')
        cartRow.classList.add('cart-row')
        cartRow.innerHTML = cartRowContents;
        cartItemsList[i].append(cartRow);
        cartRow.getElementsByClassName('btn-danger')[0].addEventListener('click', removeCartItem)
        let cartQuantityList = cartRow.getElementsByClassName('cart-quantity-input');
        for (let i = 0; i < cartQuantityList.length; i++ ){
            cartQuantityList[i].addEventListener('change', quantityChanged);
        }
        // cartRow.getElementsByClassName('cart-quantity-input')[0].addEventListener('change', quantityChanged)
    }
}

// *********** Calcul du total du panier **************** //

function updateCartTotal() {
    // let total = 0
    // let cartItemsContainerList = document.getElementsByClassName('cart-items')
    // for (let i = 0; i < cartItemsContainerList.length; i++){
    //     let cartRows = cartItemsContainerList[i].getElementsByClassName('cart-row')
    //     for (let j = 0; j < cartRows.length; j++) {
    //         let cartRow = cartRows[j]
    //         let priceElement = cartRow.getElementsByClassName('cart-price')[0]
    //         let quantityElement = cartRow.getElementsByClassName('cart-quantity-input')[0]
    //         let price = parseFloat(priceElement.innerText.replace('€', ''))
    //         let quantity = quantityElement.value
    //         total = total + (price * quantity)
    //     }
        var cartItemContainer = document.getElementsByClassName('cart-items')[0]
        var cartRows = cartItemContainer.getElementsByClassName('cart-row')
        var total = 0
        for (var i = 0; i < cartRows.length; i++) {
            var cartRow = cartRows[i]
            var priceElement = cartRow.getElementsByClassName('cart-price')[0]
            var quantityElement = cartRow.getElementsByClassName('cart-quantity-input')[0]
            var price = parseFloat(priceElement.innerText.replace('€', ''))
            var quantity = quantityElement.value
            total = total + (price * quantity)
    }
   
    total = Math.round(total * 100) / 100 * nombreDeJours;
    
    /******** Affichage du Total du Panier Responsive *****/
    
    let cartTotalPriceArray = document.getElementsByClassName('cart-total-price');
    for (var i = 0; i < cartTotalPriceArray.length; i++) {
        cartTotalPriceArray[i].innerText = total + ' €';
    }

    return total;
}


// ******************** Sélection en couleur du produit ************************** // 

var shopItem = document.getElementsByClassName('shop-item');
console.log(shopItem);

var shopItemButton = document.getElementsByClassName('shop-item-button');
console.log(shopItemButton);

var shopItemPrice = document.getElementsByClassName('shop-item-price');
console.log(shopItemButton);


for(var y=0; y<shopItem.length; y++){
    shopItem[y].addEventListener('click', function(e){
    console.log(shopItem, 'addEvent')

    shopItem = document.querySelectorAll('.selected');
    console.log(shopItem, 'shopItem');
    
    shopItem.forEach(function(index){
        index.classList.remove('selected');
        })
        this.classList.add('selected');

  })
}


// ******************** Toast ************************** // 

function toast() {
    var x = document.getElementById("snackbar");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
  }

/****** PARTIE FOOTER CONTACT ******/

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


/****************** PanierCache  ***********/

let arrow = document.getElementById('arrow');
let panier = document.getElementById('panierCache');

arrow.addEventListener('click', function(){
    arrow.classList.toggle('fa-chevron-up');
    if(panier.style.display == 'block'){
        panier.style.display = 'none'
    }
    else{
        panier.style.display = 'block'
    }
});


