/*animacia pri prihlaseni hraca*/

var tlacidlodiv1 = document.getElementById("first");
var tlacidlodiv2 = document.getElementById("second");
var tlacidlodiv3 = document.getElementById("third");
var tlacidlodiv4 = document.getElementById("goToRegister");
var tlacidlodiv5 = document.getElementById("goToLogin");

var div1 = document.getElementById("statistiky");
var div2 = document.getElementById("prihlasenie");
var div3 = document.getElementById("ihrisko_m");
var div4 = document.getElementById("login");
var div5 = document.getElementById("register");


tlacidlodiv1.addEventListener("click", function() {
    div1.style.display = "flex";
    div2.style.display = "none";
    div3.style.display = "none";
    div4.style.display = "none";
    div5.style.display = "none";
}
);
if(tlacidlodiv2) {
    tlacidlodiv2.addEventListener("click", function() {
        div2.style.display = "flex";
        div1.style.display = "none";
        div3.style.display = "none";
        div4.style.display = "none";
        div5.style.display = "none";
    });
}
tlacidlodiv3.addEventListener("click", function() {
    div2.style.display = "none";
    div1.style.display = "none";
    div3.style.display = "none";
    div4.style.display = "flex";
    div5.style.display = "none";
}
);

tlacidlodiv4.addEventListener("click", function() {
    div5.style.display = "flex";
    div4.style.display = "none";
    div2.style.display = "none";
    div1.style.display = "none";
    div3.style.display = "none";
}
);
tlacidlodiv5.addEventListener("click", function() {
    div5.style.display = "none";
    div4.style.display = "flex";
    div2.style.display = "none";
    div1.style.display = "none";
    div3.style.display = "none";
}
);






