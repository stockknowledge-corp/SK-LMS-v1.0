function menuToggle(x) {
x.classList.toggle("change");
document.querySelector('#sidebar').classList.toggle("visible");
}

var current = 'norm';
function assess(){
	pw = document.querySelector('#pw').value;
	var r = zxcvbn(pw);
	if(r.score<=1) current='Very Weak';
	if(r.score==2) current='Weak';
	if(r.score==3) current='Strong';
	if(r.score>=4) current='Very Strong';

	document.querySelector('#pw-score').innerHTML = 'Password Strenght: '+current;
	document.querySelector('#pw-strength').value = current;
}