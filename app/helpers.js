
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

	document.querySelector('#pw-score').innerHTML = 'Password Strenght: '+current;
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


function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  var expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function checkCookie() {
  var user = getCookie("username");
  if (user != "") {
    alert("Welcome again " + user);
  } else {
    user = prompt("Please enter your name:", "");
    if (user != "" && user != null) {
      setCookie("username", user, 365);
    }
  }
}

var stringToHTML = function (str) {
    var dom = document.createElement('a-scene');
    dom.innerHTML = str;
    // dom.setAttribute('id','main3d');
    dom.setAttribute('embedded','');
    return dom;

};
