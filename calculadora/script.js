var num1;
var num2;
var total;
function converter(){
    //converter de texto para numero
    num1 = parseInt(num1);
    num2 = parseInt(num2);
}
function entrada(){
    //Pegando valores do frontend e armazenando em variáveis
    num1 = document.getElementById("n1").value;
    num2 = document.getElementById("n2").value;
    total = document.getElementById("resultado");
    converter();
}
function somar(){
    entrada();
    total.innerHTML = num1 + num2;
}
function subtrair(){
    entrada();
    total.innerHTML = num1 - num2;
}
function multiplicar(){
    entrada();
    total.innerHTML = num1 * num2;
}
function dividir(){
    entrada();
    total.innerHTML = num1 / num2;
}


