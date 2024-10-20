document.querySelector(".notif").addEventListener("click", function () {
	let target = document.querySelector(".notifications");
	target.classList.toggle("show");
});

document.querySelector(".avatar").addEventListener("click", function () {
	console.log("clicked")
	let target = document.querySelector(".profile");
	target.classList.toggle("show");
});

// addEventListener("click", function(e){
// 	let target1 = document.querySelector(".notifications");
// 	let target2 = document.querySelector(".notif");
//     if(e.target !== target2 && target1.classList.contains("show")){
//             target1.classList.remove("show");
//     }
// });