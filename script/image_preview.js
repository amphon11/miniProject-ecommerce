if(productData){
  console.log(productData);
}
const img_main = document.getElementById("main_img");
// console.log(img_main.getAttribute("src"));

const img_preview = document.querySelectorAll(".preview_img img");
img_preview.forEach((content) => {
  content.addEventListener("click", () => {
    img_main.setAttribute("src", content.getAttribute("src"));
  });
});

function addToCartID(product_id) {
  const item = productData.find((element) => element.product_id === product_id);
  if (item) {
    const existingItem = cart.find(
      (cartItem) => cartItem.product_id === product_id
    );

    if (existingItem) {
      // If item is already in the cart
    } else {
      if(item.store == 0){
        console.log("สินค้าหมด");
       alert_out_stock();
      }else{
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

function alert_addSuccess() {
  Swal.fire({
    position: "center",
    icon: "success",
    title: "เพิ่มสินค้าลงในตะกร้าสำเร็จ",
    showConfirmButton: false,
    timer: 1500,
  });
}
function alert_out_stock(){
  Swal.fire({
    position: "center",
    icon: "error",
    title: "ขออภัยสินค้าหมด !!",
    text: "กรุณาเลือกสินค้าชิ้นอื่น",
    showConfirmButton: true,
  });
}
