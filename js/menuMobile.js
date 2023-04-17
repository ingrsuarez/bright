const toggleNav = document.getElementById("toggleNav");



//--------------- MENU BARS --------------------------------------

toggleNav.addEventListener("click", function(){
	const menuItems = document.getElementById('menuItems');
	console.log(menuItems.style.height);
	if(menuItems.style.height === "0px")
		{
			menuItems.style.height = "100%";
			// menuItems.style.transition = "all 1s ease";
		}else
		{
			// menuItems.style.transition = "all 1s ease";
			menuItems.style.height = "0px";
		}


	const items = document.getElementsByTagName('li');
	const totalItems = items.length;
	console.log(items);

	for (let i=0; i < totalItems; i++){

		if(items[i].style.display == "none")
		{
			items[i].style.display = "flex";
			items[i].style.height = "auto";
		}
		else
		{
			items[i].style.display = "none";
			items[i].style.height = "0px";
		}

	}
	
});



