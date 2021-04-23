let reserver        = document.getElementById("reserver");
let close           = document.querySelector(".reserver span");
let reserverContent = document.querySelector(".reserver");
let container       = document.querySelector(".reserver .container");
let reserveForm     = document.querySelector(".reserver form");
let galleryItem     = document.querySelectorAll(".gallery-container .gallery-item");
let navbar          = document.querySelector(".navbar");
let scrollTop       = document.getElementById("scroll-top");
let xhr = new XMLHttpRequest();

reserver.onclick = function()
{
	reserverContent.style.visibility = "visible";
	reserverContent.style.opacity = "1";
	onkeydown = function(e)
	{
		if(e.key === "Escape")
		{
			reserverContent.style.visibility = "hidden";
			reserverContent.style.opacity = "0";			
		}
	}
}

close.onclick = function()
{
	reserverContent.style.visibility = "hidden";
	reserverContent.style.opacity = "0";
}


reserveForm.onsubmit = function(e)
{
	e.preventDefault();
	let nom = this.nom.value,
		prenom = this.prenom.value,
		tel = this.tel.value,
		nbrpersonne = this.nbrpersonne.value,
		date = this.date.value;
	
	xhr.onreadystatechange = function() {
	  if (this.readyState == 4 && this.status == 200) {
	    container.innerHTML = this.responseText;
	  }
	};
	xhr.open("GET","reservertable.php?nom="+nom+"&prenom="+prenom+"&tel="+tel+"&nbr="+nbrpersonne+"&date=+"+date,true);
	let x = setInterval(function(){

		console.log("loaded");
	},100);
	xhr.send(nom,prenom,tel,nbrpersonne,date);
	clearInterval(x);
}

onscroll = function()
{
	if(window.pageYOffset > 200)
	{
		navbar.classList.add("fixed");
		scrollTop.style.opacity = 1;
		scrollTop.style.visibility = "visible";
	}
	else
	{
		scrollTop.style.opacity = 0;
		scrollTop.style.visibility = "hidden";
		navbar.classList.remove("fixed");
	}
}

scrollTop.onclick = function(e){
	e.preventDefault();
	scrollTo({top: 0, behavior:"smooth"});
}