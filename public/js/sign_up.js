/* Validação de formulário */

const pwd1 = document.querySelector('input[name=senha1]');
const pwd2 = document.querySelector('input[name=senha2]');
 
pwd2.addEventListener('blur', () => {
    if(pwd1.value != pwd2.value ) {
        alert("Password is not the same");
    }
    if(pwd1.value.length < 8 && pwd1.value.length > 0) {
        alert("The password must contain at least 8 digits");
    }
})        



