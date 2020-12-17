
var boutonPaiement = document.getElementById('boutonPaiement');
console.log(boutonPaiement);
var numeroCarte = document.getElementById('numeroCarte');
var modal = document.getElementById("myModal");
var close = document.getElementById('close');
console.log('close')

var numeroCarte = document.getElementById('numeroCarte')
var securite = document.getElementById('securite')

boutonPaiement.addEventListener('click', function (event) {
    event.preventDefault()
    var numeroCarteLength = numeroCarte.value.toString().length
    if (numeroCarteLength == 16) {
        // console.log(numeroCarte.value)
        modal.style.display = 'block';
        erreur.style.display = 'none';
        close.onclick = function () {
            modal.style.display = 'none'
        }
    } else {
        console.log("erreur ! ")
        erreur.style.display = 'block'
    }
})


numeroCarte.addEventListener('input', checkCardValidity)

function checkCardValidity(e) {
    var numeroCarteLength = numeroCarte.value.length;
    console.log(numeroCarteLength);
    if (numeroCarteLength > 16) {
        // console.log(numeroCarteLength);
        console.log('laire')
        // variable = la valeur de l'input cad ce que tape l'utilisateur
        var numeroCarteValue = numeroCarte.value;
        console.log(numeroCarteValue);
        // numeroCarteValue.substring(0,16); 
        // creer une var qui limite la taille de l'input
        var numeroCarteLimite = numeroCarteValue.substring(0, 16);
        console.log(numeroCarteLimite);
        numeroCarte.value = numeroCarteLimite;
    } else {
        console.log('OK')
    }
}

function restrainLength(element, maxLength) {
    var elementLength = element.value.length;
    if (elementLength > maxLength) {
        var elementValue = element.value;
        var elementLimite = elementValue.substring(0, maxLength);
        element.value = elementLimite
    }
}

// securite.addEventListener('input', function (e) { restrainLength(securite, 3) })
// EQUIVAUT A :
securite.addEventListener('input', checkSecurityCode)
function checkSecurityCode(e) {
    restrainLength(securite, 3)
}

// numeroCarte.addEventListener('input', function(e) {restrainLength(numeroCarte,16)})


// Recuperation des données page réservation
// 1. recuperer url
// split l'url qui crée un tableau de param
// créer objet
// boucle for qui itere sur les parametres de l'url. split sur = pour récup le nom et la valeur du param
var totalVelonaute = document.getElementById('totalVelonaute');

 var parameters = location.search.substring(1).split("&");
 console.log(parameters)
 var l = parameters[0].split("=")
 console.log(l)
 var total = l[0]
 console.log(l[0])
//  var parametersObj = {}
//  for (parameter of parameters) {
//    var l= parameters.split("=")
//    console.log(l[0])
//  }
document.getElementById('totalVelonaute').innerHTML = "Montant total: " + l[1] +" euros"
