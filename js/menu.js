const layout = document.getElementsByClassName('layout');
const toggle = document.getElementById('toggleNav');
const menuItems = document.getElementById('menuItems');
const dropdownItems = document.getElementsByClassName("dropdown__item");

toggle.addEventListener('click',()=>{
	layout[0].classList.toggle('hideMenu');
	console.log(layout);
	for (let i = 0; i < dropdownItems.length; i++) {
		dropdownItems[i].classList.toggle("invisible");

	}
})