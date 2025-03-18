//--------------------------------------------------
//------*******[ <cart index>] *****************
//--------------------------------------------------

if (localStorage.getItem("cart")) {
  cart = JSON.parse(localStorage.getItem("cart"));
}
const items_list = document.getElementById("items-list");
const none_item = document.querySelector(".none-item");

const orderPrice = document.getElementById("orderPrice");
const orderPrice2 = document.getElementById("orderPrice2");

function updateCartIndex() {
  orderPrice.innerHTML = "0 .-";
  orderPrice2.innerHTML = "0 .-";
  if (cart && Array.isArray(cart) && cart.length > 0) {
    let sumPrice = 0;
    cart.forEach((element, i) => {
      sumPrice += element.amount * element.price;
      let item = `<div class="items" index="${i}">
                    <div class="col-checkBox">
                      <input type="checkbox" class="check_del" index="${i}" product_id="${element.product_id}">
                    </div>
                    <div class="col-image">
                        <img src="./img/main_img/${element.image}" alt="">
                    </div>
                    <div class="col-main">
                        <div class="title">
                            <h4>${element.type + " " + element.model}</h4>
                            <br>
                            <p>แบรนด์&nbsp ${element.name_brand}</p>
                            <span>ราคา&nbsp ${element.price.toLocaleString()} บาท</span>
                        </div>
                        <div class="edit-amount">
                              <span>จำนวน</span>
                              <button type="button">
                                <i class="ri-add-fill" id="addCartIndexId${
                                  element.product_id
                                }">
                                </i>
                              </button>
                              <p class="p-amount" id="amount_id${element.product_id}">${element.amount}</p>

                              <button type="button"><i class="ri-subtract-line" id="deleteCartIndexId${
                                element.product_id
                              }"></i></button>
                              <p class="state_item" id="state_itemID${
                                element.product_id
                              }">สินค้าหมด</p>
                        </div>
                    </div>
                    <div class="col-sumPrice" id="sumPriceID${element.product_id}">
                        ${(element.price*element.amount).toLocaleString()} บาท
                    </div>
                    <div class="col-delete" >
                    <a class="bin" index="${i}" id="remove_indexID${
        element.product_id
      }">
                    <i class="ri-delete-bin-2-fill"></i>
                    </a>
                    </div>
                  </div>`;
      items_list.insertAdjacentHTML("beforeend", item);

      const state_item = document.getElementById(
        `state_itemID${element.product_id}`
      );

      // Update ค่า store
      for (const item of cart_store) {
        if (item.product_id === element.product_id) {
          element.store = item.store;
          break; // หากพบสินค้าให้หยุดการวนลูป
        }
      }

      if (state_item) {
        let store = element.store;
        if (store > 0) {
          state_item.style.color = "#2ECC71";
          state_item.innerHTML = "มีสินค้า";
        } else {
          state_item.style.color = "#E74C3C";
          state_item.innerHTML = "สินค้าหมด";
        }
      }

      const deleteCartIndexId = document.getElementById(
        `deleteCartIndexId${element.product_id}`
      );
      if (deleteCartIndexId) {
        deleteCartIndexId.addEventListener("click", () =>
          delete_items_index(`${element.product_id}`)
        );
      }

      const addCartIndexId = document.getElementById(
        `addCartIndexId${element.product_id}`
      );
      addCartIndexId.addEventListener("click", () =>
        add_items_index(`${element.product_id}`)
      );

      const remove_indexID = document.getElementById(
        `remove_indexID${element.product_id}`
      );
      remove_indexID.addEventListener("click", () =>{
        Swal.fire({
          title: "ต้องการสินค้าออกจากตระกร้า?",
          text: `ยืนยันลบสินค้า ${element.model} จากตระกร้าหรือไม่`,
          icon: "question",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "ตกลง",
          cancelButtonText: "ยกเลิก",
        }).then((result)=>{
          if(result.isConfirmed){
            remove_item_index(`${element.product_id}`,i);
          }
        });
      });
    });
    update_OrderPrice();
    localStorage.setItem("cart", JSON.stringify(cart));
  } else {
    none_item.innerHTML = "ยังไม่มีสินค้าในตะกร้า";
    localStorage.removeItem("cart");
  }
}

function update_OrderPrice(){
  if(cart){
    let price =0;
    cart.forEach((p)=>{
      price+= p.amount*p.price;
    });
    let number = Number(price);
    let formattedNumber = number.toLocaleString('en-US');
    document.getElementById("orderPrice2").innerHTML = formattedNumber+" บาท";
    document.getElementById("orderPrice").innerHTML = formattedNumber+" บาท";
  }
}

//--------------------------------------------------
//------*******[ <form valid>] *****************
function validateForm() {
  console.log("valid");
  let productsAvailable = true;
  if (cart.length > 0) {
    for (const element of cart) {
      if (element.store == 0) {
        productsAvailable = false;
        break;
      }
    }
    if (!productsAvailable) {
      alert_out_stock();
      return false;
    } else {
      return true;
    }
  } else {
    Swal.fire({
      position: "bottom-center",
      icon: "error",
      title: "ยังไม่มีสินค้าในตะกร้า",
      showConfirmButton: false,
      timer: 1500,
    });
    return false;
  }
}
//------*******[ </form valid>] *****************
//--------------------------------------------------

function delete_items_index(id) {
  const existingItemIndex = cart.findIndex(
    (cartItem) => cartItem.product_id === id
  );

  if (existingItemIndex !== -1) {
    const existingItem = cart[existingItemIndex];
    if (existingItem.amount > 1) {
      existingItem.amount -= 1;
      let sum = Number(cart[existingItemIndex].amount*cart[existingItemIndex].price);
      let formattedSum = sum.toLocaleString('en-US');
      document.getElementById(`amount_id${id}`).innerHTML = cart[existingItemIndex].amount;
      document.getElementById(`sumPriceID${id}`).innerHTML = formattedSum +" บาท";
      update_OrderPrice();
    }

  }

  // ถ้ามีการลบสินค้าทำให้ cart ว่าง
  if (cart.length === 0) {
    none_item.innerHTML = "ยังไม่มีสินค้าในตะกร้า";
  }

  updateCartDisplay();
}

function add_items_index(id) {
  const existingItemIndex = cart.findIndex(
    (cartItem) => cartItem.product_id === id
  );

  if (cart[existingItemIndex].amount < cart[existingItemIndex].store) {
    cart[existingItemIndex].amount += 1;
    let sum = Number(cart[existingItemIndex].amount*cart[existingItemIndex].price);
      let formattedSum = sum.toLocaleString('en-US');
    document.getElementById(`amount_id${id}`).innerHTML = cart[existingItemIndex].amount;
    document.getElementById(`sumPriceID${id}`).innerHTML = formattedSum + " บาท";
    update_OrderPrice();
  } else {
    alert_over_stock();
  }
  updateCartDisplay();
}

function remove_item_index(id,index) {
  const existingItemIndex = cart.findIndex(
    (cartItem) => cartItem.product_id === id
  );
  cart.splice(existingItemIndex, 1);
  const items = document.querySelectorAll(".items");
  console.log(id,index);
  for(let i=0;i<items.length;i++){
    if(items[i].getAttribute("index") == index){
      items[i].remove();
    }
  }//endfor
  if (cart.length === 0) {
    none_item.innerHTML = "ยังไม่มีสินค้าในตะกร้า";
  }
  update_OrderPrice();
  updateCartDisplay();
}


function addToCartFunction(item) {
  const existingItem = cart.find(
    (cartItem) => cartItem.product_id === item.product_id
  );

  if (existingItem) {
    //if have item in list
  } else {
    item.amount = 1;
    cart.push(item);
  }
  updateCartDisplay();
  updateCartIndex();
}
function delete_selectAll(){
  const items = document.querySelectorAll(".items");
  for (let i = items.length - 1; i >= 0; i--) {
    if (check_boxes[i].checked == true) {
      console.log(check_boxes[i].checked);
      const index = check_boxes[i].getAttribute("index");
      items[index].remove();
      const product_id = check_boxes[i].getAttribute("product_id");
      console.log(product_id);
      const existingItemIndex = cart.findIndex(
        (cartItem) => cartItem.product_id === product_id
      );
      cart.splice(existingItemIndex, 1);
      if(cart.length==0){
        none_item.innerHTML = "ยังไม่มีสินค้าในตระกร้า";
      }
      update_OrderPrice();
      updateCartDisplay();
    }
  }
}

if (cart_list) {
  updateCartDisplay();
  updateCartIndex();
}

//--------------------------------------------------
//------*******[ <cart index>] *****************
//--------------------------------------------------

//--------------------------------------------------
//------*******[ <check box >] *****************
//--------------------------------------------------
const check_all = document.getElementById("check_all");
const check_boxes = document.querySelectorAll(".check_del");
const delect_select = document.getElementById("delect_select");
// console.log(delect_select);
check_all.addEventListener("click", () => {
  check_boxes.forEach((checkbox) => {
    checkbox.checked = check_all.checked;
    console.log(
      `Checkbox ${checkbox.getAttribute("index")}: ${checkbox.checked}`
    );
  });
});

check_boxes.forEach((checkbox) => {
  checkbox.addEventListener("click", () => {
    if (checkbox.checked == true) {
      console.log(
        `Checkbox ${checkbox.getAttribute("index")}: ${checkbox.checked}`
      );
    }
  });
});

delect_select.addEventListener("click", () => {
  Swal.fire({
    title: "ต้องการลบรายการที่เลือกทั้งหมด?",
    text: "ลบรายการที่เลือกออกจากตระกร้าหรือไม่?",
    icon: "question",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "ตกลง",
    cancelButtonText: "ยกเลิก",
  }).then((result)=>{
    if(result.isConfirmed){
      delete_selectAll();
    }
  });
});

function alert_over_stock(){
  Swal.fire({
    position: "center",
    icon: "error",
    title: "ไม่สามารถเพิ่มเกินจำนวนสินค้าในคลัง !!",
    showConfirmButton: true,
  });
}

function alert_out_stock(){
  Swal.fire({
    position: "center",
    icon: "error",
    title: "สินค้าบางประเภทหมด !!",
    text: "กรุณาตรวจสอบสินค้าในตระกร้าอีกครั้ง",
    showConfirmButton: true,
  });
}

//--------------------------------------------------
//------*******[ </check box>] *****************
//--------------------------------------------------
