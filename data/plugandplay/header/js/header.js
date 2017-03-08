
var apaceHeader = {

	init: function() {

		var burger = document.getElementById('burger'); 
		var menuItems = document.getElementById('menu-items');

		burger.onclick = function() {

		    if (menuItems.style.display == 'block') {
		    	menuItems.style.display = 'none';
		    } else {
		    	menuItems.style.display = 'block';
		    }
		};

		window.addEventListener("resize", checkWidth);

		function checkWidth() {
			var mq = window.matchMedia( "(min-width: 622px)" );
			if (mq.matches) {
				if (menuItems.style.display == 'none') {
					menuItems.style.display = 'block';
				}
			}
		}

	}



}

apaceHeader.init();