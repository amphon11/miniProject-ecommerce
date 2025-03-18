//--------------------------------------------------
//------*******[ <dropdown cart>] *****************
//--------------------------------------------------
let cart = [];
if (localStorage.getItem("cart")) {
  cart = JSON.parse(localStorage.getItem("cart"));
}
const cart_list = document.getElementById("cart-list");

const quantity = document.getElementById("quantity");

const item_floating = document.querySelector(".item-floating");

function updateCartDisplay() {
  let sum = 0;
  cart_list.innerHTML = "";
  quantity.innerHTML = "ยอดรวม ";

  if (cart && Array.isArray(cart) && cart.length > 0) {
    item_floating.innerHTML = cart.length;

    cart.forEach((element,i) => {
      sum += element.amount * element.price;
      let items_list = `<div class="list">
          <p>${i+1}</p>
          <img src="../img/main_img/${element.image}" alt="">
          <div class="row">
            <span>
              <h4>${element.name_brand +" "+ element.model}</h4>
            </span>
            <span> ราคา ${element.price} บาท</span>
            <div class="col">
              <a href="#"><i class="ri-add-fill" id="addCartId${element.product_id}"></i></a>
              <p>${element.amount}</p>
              <a href="#"><i class="ri-subtract-line" id="deleteCartId${element.product_id}"></i></a>
            </div>
          </div>
          <span class="del-icon"><i class="ri-delete-bin-2-fill" id="remove_item${element.product_id}"></i></span>
        </div>`;

      cart_list.insertAdjacentHTML("beforeend", items_list);

      const delete_items = document.getElementById(
        `deleteCartId${element.product_id}`
      );
      if (delete_items) {
        delete_items.addEventListener("click", () =>
          delete_items_cart(`${element.product_id}`)
        );
      }

      const add_items = document.getElementById(
        `addCartId${element.product_id}`
      );
      add_items.addEventListener("click", () =>
        add_items_Cart(`${element.product_id}`)
      );

      const remove_item = document.getElementById(
        `remove_item${element.product_id}`
      );
      remove_item.addEventListener("click", () =>
        remove_item_cart(`${element.product_id}`)
      );
    });
    sum = sum+" บาท";
    quantity.insertAdjacentHTML("beforeend", sum);
    
    // Save the cart to localStorage
    localStorage.setItem("cart", JSON.stringify(cart));
  } else {
    item_floating.innerHTML = "0";
    cart_list.insertAdjacentHTML("beforeend", "กรุณาเลือกสินค้า");
    quantity.insertAdjacentHTML("beforeend", "0");
    // Clear the cart from localStorage
    localStorage.removeItem("cart");
  }
}

function delete_items_cart(id) {
  const existingItemIndex = cart.findIndex(
    (cartItem) => cartItem.product_id === id
  );

  if (existingItemIndex !== -1) {
    const existingItem = cart[existingItemIndex];
    existingItem.amount -= 1;

    if (existingItem.amount === 0) {
      cart.splice(existingItemIndex, 1);
    }
  }

  updateCartDisplay();
}

function add_items_Cart(id) {
  const existingItemIndex = cart.findIndex(
    (cartItem) => cartItem.product_id === id
  );

  if (cart[existingItemIndex].amount < cart[existingItemIndex].store) {
    cart[existingItemIndex].amount += 1;
  } else {
    alert("ไม่สามารถเพิ่มเกินจำนวนในคลัง");
  }

  updateCartDisplay();
}

function remove_item_cart(id) {
  const existingItemIndex = cart.findIndex(
    (cartItem) => cartItem.product_id === id
  );

  cart.splice(existingItemIndex, 1);

  updateCartDisplay();
}

// window.onload = updateCartDisplay;
document.addEventListener("DOMContentLoaded", function () {
  updateCartDisplay();
});

//--------------------------------------------------
//------*******[ </dropdown cart>] *****************
//--------------------------------------------------