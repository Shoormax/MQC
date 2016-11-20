var iDureeMouve = 50;
var iQuantiteMouve = 1;
var iLargeurImage = 3083;
var iPosition = parseInt(Math.random()*iLargeurImage);

var bDirectionLeft;

var oPanorama = document.getElementById("panorama");
var oBoucle;

function startMove() {
  oBoucle = setInterval(function() {
    bDirectionLeft ? iPosition += iQuantiteMouve : iPosition -= iQuantiteMouve;
    iPosition = iPosition%(iLargeurImage);
	oPanorama.style.backgroundPosition = (iPosition)+"px";
  }, iDureeMouve);
}

function stopMove() {
  clearInterval(oBoucle);
} 

startMove();
