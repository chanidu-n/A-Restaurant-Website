document.addEventListener('DOMContentLoaded', function () {
    var filterButtons = document.querySelectorAll('.filter_button button');
    var menuItems = document.querySelectorAll('.menu .itemBox');
    var basketItems = JSON.parse(localStorage.getItem('basketItems')) || [];
    var totalPrice = basketItems.reduce((total, item) => total + item.price, 0);
    const searchBar = document.getElementById('search-bar');
    searchBar.addEventListener('input', searchMenu);
    


    
    function searchMenu() {
        const filter = searchBar.value.toLowerCase();
        const menuItems = document.querySelectorAll('.menu .itemBox');

        menuItems.forEach(item => {
            const title = item.querySelector('.item-title').textContent.toLowerCase();
            if (title.includes(filter)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }
  
    // Filter functionality
    filterButtons.forEach(button => {
      button.addEventListener('click', function () {
        filterButtons.forEach(btn => btn.classList.remove('filter-active'));
        this.classList.add('filter-active');
  
        var filterName = this.getAttribute('data-name');
        menuItems.forEach(item => {
          item.style.display = filterName === 'All_Categories' || item.getAttribute('data-name') === filterName ? 'block' : 'none';
        });
      });
    });
  
    // Add to basket functionality
    function addToBasket(itemName, itemPrice) {
    var basketItem = {
        name: itemName,
        price: itemPrice,
    };
    basketItems.push(basketItem);
    localStorage.setItem('basketItems', JSON.stringify(basketItems));
    updateBasket();
    alert(itemName + " added to the basket!");
    }
  
    // Update basket display
    function updateBasket() {
      var basketList = document.querySelector(".basket-items");
      basketList.innerHTML = "";
  
      var totalPrice = 0;
      basketItems.forEach((item, index) => {
        var listItem = document.createElement("li");
        listItem.innerHTML = `${item.name} - LKR ${item.price.toFixed(2)} <button class="remove-item" data-index="${index}">Remove</button>`;
        basketList.appendChild(listItem);
        totalPrice += item.price;
      });
  
      var totalPriceElement = document.querySelector(".total-price");
      totalPriceElement.innerText = "Total: LKR " + totalPrice.toFixed(2);
    }
  
    // Event listener for "Add to Cart" buttons
    var addToBasketButtons = document.querySelectorAll(".add-to-basket");
    addToBasketButtons.forEach(button => {
      button.addEventListener("click", function (e) {
        var itemName = e.target.dataset.item;
        var itemPrice = parseFloat(e.target.dataset.price);
        addToBasket(itemName, itemPrice);
      });
    });
  
    // Event listener for "Remove" buttons in the basket
    document.querySelector(".basket").addEventListener('click', function (e) {
      if (e.target.classList.contains('remove-item')) {
        var index = e.target.getAttribute('data-index');
        basketItems.splice(index, 1);
        localStorage.setItem('basketItems', JSON.stringify(basketItems));
        updateBasket();
      }
    });
  
    // Display basket items and total price
    updateBasket();
  
    // Handle form submission
    document.getElementById("checkout-form").addEventListener("submit", function (e) {
      e.preventDefault();
  
      var name = document.getElementById("name").value;
      var email = document.getElementById("email").value;
      var address = document.getElementById("address").value;
  
  
      // Clear the basket
      localStorage.removeItem('basketItems');
      window.location.href = 'confirmation.html'; // Redirect to a confirmation page
    });
  });
  