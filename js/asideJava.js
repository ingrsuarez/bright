 
const horiz = document.getElementById("horiz1");
const horiz2 = document.getElementById("horiz2");
const horiz3 = document.getElementById("horiz3");


horiz.addEventListener("click",function(){
	const submenu = document.getElementById("horiz1__inside");
	const flecha = document.getElementById("flecha1");
	if (submenu.style.opacity == "0"){
		flecha.className = 'fas fa-angle-down';
		submenu.style.opacity = "1";
		submenu.style.display = "block";
		submenu.style.transition = "1s";
		submenu.style.transitionTimingFunction = "cubic-bezier(0,0,0,1)";
	}else {
		flecha.className = 'fas fa-angle-right';
		submenu.style.opacity = "0";
		submenu.style.display = "none";
		// submenu.style.left = "-100px";
		submenu.style.transition = "1s";
		submenu.style.transitionTimingFunction = "cubic-bezier(0,0,0,1)"; }
});


horiz2.addEventListener("click",function(){
	const submenu = document.getElementById("horiz2__inside");
	const flecha = document.getElementById("flecha2");
	if (submenu.style.opacity == "0"){
		flecha.className = 'fas fa-angle-down';
		submenu.style.opacity = "1";
		// submenu.style.left = "70";
		submenu.style.display = "block";
		submenu.style.transition = "1s";
		submenu.style.transitionTimingFunction = "cubic-bezier(0,0,0,1)";
	}else {
		flecha.className = 'fas fa-angle-right';
		submenu.style.opacity = "0";
		submenu.style.display = "none";
		// submenu.style.left = "-100px";
		submenu.style.transition = "0.5s";
		submenu.style.transitionTimingFunction = "cubic-bezier(0,0,0,1)"; }
});

horiz3.addEventListener("click",function(){
	const submenu = document.getElementById("horiz3__inside");
	const flecha = document.getElementById("flecha3");
	if (submenu.style.opacity == "0"){
		flecha.className = 'fas fa-angle-down';
		submenu.style.opacity = "1";
		// submenu.style.left = "70";
		submenu.style.display = "block";
		submenu.style.transition = "1s";
		submenu.style.transitionTimingFunction = "cubic-bezier(0,0,0,1)";
	}else {
		flecha.className = 'fas fa-angle-right';
		submenu.style.opacity = "0";
		submenu.style.display = "none";
		// submenu.style.left = "-100px";
		submenu.style.transition = "0.5s";
		submenu.style.transitionTimingFunction = "cubic-bezier(0,0,0,1)"; }
});

// RESPONSIVE EFECTS


