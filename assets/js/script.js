let text = document.querySelector('h1');
let poulet = document.getElementById('poulet');
let saumon = document.getElementById('saumon');
let boeuf = document.getElementById('boeuf');
let thon = document.getElementById('thon');
window.addEventListener("scroll", () =>{
    let value = window.scrollY;
    thon.style.left = value * 1.5 +"px";
    thon.style.top = value *1 + "px";
    thon.style.rotate = value *1.5+"deg";
    
    poulet.style.top = value * 1.5 +"px";
    poulet.style.left = value *-1.5 +"px";
    poulet.style.rotate = value *1.5+"deg";

    boeuf.style.left = value * 2 +"px";
    boeuf.style.bottom = value * 1.5 +"px";
    boeuf.style.rotate = value *1.5+"deg";

    saumon.style.top = value * -1.5 +"px";
    saumon.style.left = value * -1.5 +"px";
    saumon.style.rotate = value *1.5+"deg";

    text.style.color = "#359381";

});
