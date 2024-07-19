let galleryItem     = document.querySelectorAll(".gallery-container .gallery-item");
let controlBox      = document.querySelector('.control-box');
let colorBox        = document.querySelector('.color-box');
let colorItems      = document.querySelectorAll('.color-box ul li');
let closeBox        = document.querySelector('.color-box span');
let xhr       = new XMLHttpRequest();
let commandes = document.querySelectorAll(".commande-btn");

document.body.onload = function()
{
	if(commandes[0].hasAttribute("data-login"))
	{
		xhr.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
			    document.querySelector("#shop span").innerHTML = this.responseText;
			}
		};
		xhr.open("GET","nbrcommande.php",true);
		xhr.send();		
	}

}



commandes.forEach(function(commande) {

commande.onclick = function(e)
{
	e.preventDefault();
	let foodid = this.parentNode.childNodes[9].value;
	if(this.hasAttribute("data-login"))
	{
		xhr.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
			    document.querySelector("#shop span").innerHTML = this.responseText;
			}
		};
		xhr.open("GET","commande.php?foodid="+foodid,true);
		xhr.send(foodid);

	}
	else
	{
		nologin();
		document.querySelector(".alert-container span").onclick = function()
		{
			this.parentNode.remove();
		}
	}
}

});


galleryItem.forEach(function(item, index){
	item.onclick = function()
	{
		let container       = document.createElement("div");
		let box             = document.createElement("div");
		container.className = "gallery-box-container";
		box.className        = "gallery-box";
		let img = document.querySelectorAll(".gallery-container .gallery-item img")[index].cloneNode();
		let close = document.createElement("span");
		close.className = "close";
		close.innerHTML = "✖"; 
		img.style.width  = "600px";
		box.appendChild(img);
		container.appendChild(box);
		container.appendChild(close);
		document.body.appendChild(container);
		onkeydown = function(e)
		{
			if(e.key = "Escape")
			{
				container.remove();
			}
		}
		close.onclick = function()
		{
			container.remove();
		}
	}
});

let navbar = document.querySelector(".navbar");

onscroll = function(){
	console.log(this.scrollY)
	if(this.scrollY > 150){
		navbar.classList.add("fixed");
	}
	else{
		navbar.classList.remove("fixed");
	}
}

let year = new Date().getFullYear()

document.getElementById("year").innerText = year;

// let div = document.querySelector(".reservation").getBoundingClientRect();
let div = document.querySelector(".reservation");
let btn = document.getElementById("reserver");

btn.addEventListener("click", function(){
	window.scrollTo({
		top:div.offsetTop - 100,
		behavior:"smooth"
	});
});