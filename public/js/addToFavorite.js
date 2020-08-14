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
        localStorage.setItem("favorites", favoriteds)
        favorites.parentElement.setAttribute("href", "index.php?favorites=" + favoriteds)     
    })
})

function getFavorites() {
    if (localStorage.getItem("favorites") == null) return
    
    favoriteds = localStorage.getItem("favorites").split(',')

    favorites.parentElement.setAttribute("href", "index.php?favorites=" + favoriteds)

    productElement.forEach((element) => {
    
        let prId = element.value
        let isFav = favoriteds.indexOf(prId)
    
        if (favoriteds[isFav] == prId) {
            element.classList.add("favorited")
            favorites.innerHTML = favoriteds.length
        }
    })
}
//localStorage.removeItem('favorites')