var activeScreen = '';
var name='Guest';
document.addEventListener("DOMContentLoaded", function() {
	window.scrollTo(0,1);
	showLoader('Starting Up',1000);
	changeScreen('#start');
	document.getElementById("game-bg").volume = 0.2;
	// document.getElementById("game-bg").play();
	if(location.hash=='#dashboard' && activeScreen!='dashboard'){
		changeScreen('#dashboard');
		dashTabs('#dash-home'); 
		showLoader('Loading dashboard', 2000);
	}
});
function changeScreen(w){
	var divs = document.querySelectorAll('body>div'), i;
	for (i = 0; i < divs.length; ++i) {
	  divs[i].style.display = "none";
	}
	document.querySelector(w).style.display='block';
	document.getElementById("game-bg").play();
	activeScreen=w;
	var fnsn = document.getElementById('registerfn').value;
	if(fnsn!='') {
		// name = fnsn.split(', ');
		// name = name[0];
		name=fnsn;
	}
	document.getElementById('mini-name-name').innerHTML=name;
	window.scrollTo(0,1);
}
function startReset(){
	var divs = document.querySelectorAll('#content>div'), i;
	for (i = 0; i < divs.length; ++i) {
	  divs[i].style.bottom = "-300vh";
	}
}
function startProcess(w){
	startReset();
	if(w!='#content-start' && window.innerWidth<=1024){
		document.querySelector('#hero img').style.opacity=0;
		// document.querySelector('#hero').style.background='url(images/bg001.png)';
	} else {
		document.querySelector('#hero img').style.opacity=1;
		// document.querySelector('#hero').style.background='none';
	}
	setTimeout(() => {document.querySelector(w).style.bottom='0';}, 300);
	
}


function dashTabs(w){
		document.querySelector('#dash-menu').classList.remove("visible");
		document.querySelector('.mobile-menu-container').classList.remove("change");

	if(document.querySelector(w).style.display!='block'){
		var divs = document.querySelectorAll('#dash-content>div'), i;
		for (i = 0; i < divs.length; ++i) {
			divs[i].style.display = "none";
			// // console.log(divs[i].getAttribute('id'));
			// animateCSS('#'+divs[i].getAttribute('id'), 'bounceOutLeft').then((message) => {
			//   document.querySelector('#'+message).style.display = "none";
			//   // console.log(message);
			// });
		}
		document.querySelector(w).style.display='block';
		animateCSS(w, 'bounceInLeft');
		window.scrollTo(0,0);
	}
}
 


function showLoader(msg,t){
	document.getElementById('loading-msg').innerHTML=msg;
	setTimeout(() => {document.querySelector('#loader').style.display='block'},10);
	setTimeout(() => {document.querySelector('#loader').style.opacity='1'}, 100);
	setTimeout(() => {document.querySelector('#loader').style.opacity='0'}, t);
	setTimeout(() => {document.querySelector('#loader').style.display='none'},t+500);
	window.scrollTo(0,1);
	// document.getElementById('loading-msg').innerHTML='Loading...';
}

/*** HELPERS ***/
function menuToggle(x) {
  x.classList.toggle("change");
  document.querySelector('#dash-menu').classList.toggle("visible");
}

const animateCSS = (element, animation, prefix = 'animate__') =>
  // We create a Promise and return it
  new Promise((resolve, reject) => {
    const animationName = `${prefix}${animation}`;
    const node = document.querySelector(element);

    node.classList.add(`${prefix}animated`, animationName);

    // When the animation ends, we clean the classes and resolve the Promise
    function handleAnimationEnd() {
      node.classList.remove(`${prefix}animated`, animationName);
      node.removeEventListener('animationend', handleAnimationEnd);

      resolve(node.getAttribute('id'));
    }

    node.addEventListener('animationend', handleAnimationEnd);
  });

function convertToRGB(hex){
    if(hex.length != 6){
        throw "Only six-digit hex colors are allowed.";
    }

    var aRgbHex = hex.match(/.{1,2}/g);
    var aRgb = [
        parseInt(aRgbHex[0], 16),
        parseInt(aRgbHex[1], 16),
        parseInt(aRgbHex[2], 16)
    ];
    return aRgb;
}

var current = 'Very Weak';
function assess(){
	pw = document.querySelector('#registerpassword').value;
	var r = zxcvbn(pw);
	if(r.score<=1) current='Very Weak';
	if(r.score==2) current='Weak';
	if(r.score==3) current='Strong';
	if(r.score>=4) current='Very Strong';

	document.querySelector('#pw-score').innerHTML = 'Password Strength: '+current;
	document.querySelector('#pw-strength').value = current;
	if(r.score<=2) {
		document.querySelector('#finishCreateAccount').style.opacity='0.8';
		document.querySelector('#finishCreateAccount').setAttribute('disabled','true');
	}
	if(r.score>=3) {
		document.querySelector('#finishCreateAccount').style.opacity='1';
		document.querySelector('#finishCreateAccount').removeAttribute('disabled');
	}
}