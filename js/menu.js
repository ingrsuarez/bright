const layout = document.getElementsByClassName('layout');
const toggle = document.getElementById('toggleNav');
const menuItems = document.getElementById('menuItems');
const dropdownItems = document.getElementsByClassName("dropdown__item");

toggle.addEventListener('click',()=>{

	for (let i = 0; i < dropdownItems.length; i++) {
		dropdownItems[i].classList.toggle("invisible");

	}
})

