// Initialize the first carousel
const carousel1 = new Swiper("#carousel1 .carouselbox", {
  spaceBetween: 30,
  slidesPerView: "auto",
  centeredSlides: true,
  navigation: {
    nextEl: "#carousel1 .swiper-button-next",
    prevEl: "#carousel1 .swiper-button-prev",
  },
  breakpoints: {
    481: {
      slidesPerView: 2,
      slidesPerGroup: 1,
      centeredSlides: false,
    },
    640: {
      slidesPerView: 2,
      slidesPerGroup: 2,
      centeredSlides: false,
    },
    992: {
      slidesPerView: 4,
      slidesPerGroup: 4,
      centeredSlides: false,
    },
  },
});

if (productData) {
  // ทำงานก็ต่อเมื่อ productData ถูกกำหนดค่า
  var product = productData;
  console.log(product);
  // ... โค้ดที่ใช้ product
} else {
  console.error("productData is not defined.");
}
function valid_form() {
  const search_form = document.getElementById("search_form");
  const search_formInput = search_form.search.value;
  if (search_formInput == "") {
    alert_error("กรุณาป้อนข้อความ");
    return false;
  } else {
    return true;
  }
}
//-------------------------------------
//-----<< items slide section >>-------
//-------------------------------------
const swip_item = document.getElementById("swip-item");
if (swip_item) {
  let product_filter = product.filter(p => p.price < 1000 && p.price > 300);
  product_filter.forEach((element, i) => {
    let number = Number(element.price);
    let formattedNumber = number.toLocaleString("en-US", {
      style: "decimal",
      maximumFractionDigits: 2,
    });

    let item_list = `<div class="item swiper-slide">
        <div class="dot-image">
          <a href="product_detail.php?productID=${element.product_id}" class="product-permalink"></a>
          <div class="thumbnail">
            <img src="./img/main_img/${element.image}" alt="">
          </div>
          <div class="thumbnail hover">
            <img src="./img/main_img/${element.image}" alt="">
          </div>
          <div class="actions">
            <ul>
              <li><a href="#" id="addToCart${element.product_id}"><i class="ri-shopping-cart-2-line"></i></a></li>
            </ul>
          </div>
          <div class="label"><span>10%</span></div>
        </div>
        <div class="dot-info">
          <h4 class="dot-title"><a href="#">${element.name_brand} ${element.model}</a></h4>
          <div class="product-price">
            <span class="current"><button id="addToCartButton${element.product_id}"><i class="ri-shopping-cart-line"></i>฿${formattedNumber} -</button></span>
          </div>
        </div>
      </div>`;
    swip_item.insertAdjacentHTML("beforeend", item_list);
    let item = {
      product_id: `${element.product_id}`,
      model: `${element.model}`,
      name_brand: `${element.name_brand}`,
      type: `${element.type}`,
      image: `${element.image}`,
      price: `${element.price}`,
      store: `${element.store}`,
      amount: `${element.amount}`,
    };

    const addToCart = document.getElementById(`addToCart${element.product_id}`);
    addToCart.addEventListener("click", () => addToCartFunction(item));

    const addToCartButton = document.getElementById(
      `addToCartButton${element.product_id}`
    );
    addToCartButton.addEventListener("click", () => addToCartFunction(item));
  });
}
//-------------------------------------
//-----<< /items slide section >>-------
//-------------------------------------
//-------------------------------------
//-----<< /items cart >>-------
//-------------------------------------

function addToCartID(product_id) {
  console.log("ffff");
  const item = product.find((element) => element.product_id === product_id);

  if (item) {
    const existingItem = cart.find(
      (cartItem) => cartItem.product_id === product_id
    );

    if (existingItem) {
    } else {
      console.log(item.store);
      if (item.store == 0) {
        console.log("สินค้าหมด");
        alert_out_stock();
      } else {
        console.log("มีสินค้า");
        item.amount = 1;
        cart.push(item);
        alert_addSuccess();
      }
    }
    updateCartDisplay();
  } else {
    console.error("Item not found:", product_id);
  }
}
function addToCartFunction(item) {
  console.log("dddd");
  const existingItem = cart.find(
    (cartItem) => cartItem.product_id === item.product_id
  );

  if (existingItem) {
  } else {
    console.log(item.store);
    if (item.store == 0) {
      console.log("สินค้าหมด");
      alert_out_stock();
    } else {
      console.log("มีสินค้า");
      item.amount = 1;
      cart.push(item);
      alert_addSuccess();
    }
  }
  updateCartDisplay();
}
function alert_addSuccess() {
  Swal.fire({
    position: "center",
    icon: "success",
    title: "เพิ่มสินค้าลงในตะกร้าสำเร็จ",
    showConfirmButton: false,
    timer: 1500,
  });
}
function alert_error(title) {
  Swal.fire({
    position: "center",
    icon: "error",
    title: title,
    showConfirmButton: false,
    timer: 1500,
  });
}
function alert_out_stock() {
  Swal.fire({
    position: "center",
    icon: "error",
    title: "ขออภัยสินค้าหมด !!",
    text: "กรุณาเลือกสินค้าชิ้นอื่น",
    showConfirmButton: true,
  });
}

//-------------------------------------
//-----<< /items cart >>-------
//-------------------------------------

//-------------------------------------
//-----<< /pagination >>-------
//-------------------------------------
const cardItems = document.querySelectorAll(".card_items");
let num_item = cardItems.length;
const NUMITEMS = 8;
let pageSize = Math.ceil(num_item / NUMITEMS);
let page_link = document.querySelector(".page-link");
let page_number = 1;
const prev_btn = document.querySelector(".prev");
const next_btn = document.querySelector(".next");

if (pageSize > 0) {
  for (let i = 1; i <= pageSize; i++) {
    let new_link = document.createElement("button");
    new_link.setAttribute("class", "page-number");
    new_link.setAttribute("page", i);
    new_link.innerHTML = i;
    page_link.appendChild(new_link);
  }
  let all_page_number = document.querySelectorAll(".page-number");
  all_page_number.forEach((element) => {
    element.addEventListener("click", () => {
      let page = element.getAttribute("page");
      getPageShow(page);
    });
  });
  defaltPage(page_number);
  next_btn.addEventListener("click", () => {
    page_number++;
    console.log(pageSize);

    if (page_number > pageSize) {
      page_number = pageSize;
    }
    console.log(page_number);
    getPageShow(page_number);
  });
  prev_btn.addEventListener("click", () => {
    page_number--;
    console.log(page_number);
    if (page_number < 1) {
      page_number = 1;
    }
    getPageShow(page_number);
  });
}
function defaltPage(page) {
  for (let i = 0; i < NUMITEMS; i++) {
    cardItems[i].style.display = "flex";
  }
  let all_page_number = document.querySelectorAll(".page-number");
  all_page_number.forEach((page_btn) => {
    if(page_btn.classList.contains("active")){
      page_btn.classList.remove("active");
    }
    if (page_btn.getAttribute("page") == page) {
     page_btn.classList.add("active");
    }
  });
}
function setAllDisplayNone() {
  cardItems.forEach((items) => {
    items.style.display = "none";
  });
}
function getPageShow(page) {
  page_number = page;
  setAllDisplayNone();
  let EndItems = NUMITEMS * page;
  let StartItems = EndItems - NUMITEMS;
  if (EndItems > num_item) {
    EndItems = num_item;
  }
  for (let i = StartItems; i < EndItems; i++) {
    cardItems[i].style.display = "flex";
  }
  let all_page_number = document.querySelectorAll(".page-number");
  all_page_number.forEach((page_btn) => {
    if(page_btn.classList.contains("active")){
      page_btn.classList.remove("active");
    }
    if (page_btn.getAttribute("page") == page) {
     page_btn.classList.add("active");
    }
  });

  // console.log(page);
}


//-------------------------------------
//-----<< /pagination >>-------
//-------------------------------------

