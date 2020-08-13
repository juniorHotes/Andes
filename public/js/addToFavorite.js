const productElement = document.querySelectorAll('.button-heart')
const favorites = document.querySelector('#favorite-items')

let favoriteds = []

getFavorites()

productElement.forEach((element) => {
    element.addEventListener('click', (event) => {

        let prId = event.target.value
        let isFav = favoriteds.indexOf(prId)
        
        if (favoriteds[isFav] != prId) {
            element.classList.add("favorited")
            favoriteds.push(prId)
        } else {
            favoriteds.splice(isFav, 1)
            element.classList.remove("favorited")
        }

        favorites.innerHTML = favoriteds.length
        let jsonStr = JSON.stringify(favoriteds)
        localStorage.setItem("favorites", jsonStr)

        favorites.parentElement.setAttribute("href", "index.php?favorites=" + jsonStr)
        console.log(favorites.parentElement)
})
})

function getFavorites() {
    if (localStorage.getItem("favorites") == null) return
    
    favoriteds = JSON.parse(localStorage.getItem("favorites"))

    productElement.forEach((element) => {
    
        let prId = element.value
        let isFav = favoriteds.indexOf(prId)
    
        if (favoriteds[isFav] == prId) {
            element.classList.add("favorited")
            favorites.innerHTML = favoriteds.length
        }
    })
}