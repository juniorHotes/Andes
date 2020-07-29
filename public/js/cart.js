// Multiplicar produtos do carrinho

const inputAmount = document.querySelectorAll('input[name=amount]')
const totalElement   = document.querySelectorAll('#total')
const productElement = document.querySelectorAll('input[type=hidden]')
const totalValue     = document.querySelector('#total-value')

var formatter = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',
});

inputAmount.forEach((input) => {
    input.addEventListener('change', () => {
    
        let inputId       = Number(input.id)
        let units         = parseInt(input.value)
        let estoque       = parseInt(input.max)
        let precounitario = parseFloat(productElement[inputId].value)

        totalElement[inputId].innerHTML = "Total: "

        if(units > estoque) {
            precounitario *= estoque;
            totalElement[inputId].innerHTML += formatter.format(precounitario)
            input.value = estoque

        } else {
            precounitario *= units
            totalElement[inputId].innerHTML += formatter.format(precounitario)
        }

        totalCart()

    });
});

function totalCart() {
    let array1 = []
    for (let i = 0; i < inputAmount.length; i++) {
        array1.push(parseFloat(productElement[i].value * inputAmount[i].value ))
    }
    let total = array1.reduce((total, num) => { return total + num })

    totalValue.innerHTML = "Total value of your cart: " + formatter.format(total)
}

totalCart()