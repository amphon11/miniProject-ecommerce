// window.onload = updateCartDisplay;
document.addEventListener("DOMContentLoaded", function () {
  updateCartDisplay();
});

const box_items = document.getElementById("box_items");
const total = document.getElementById("total");
const total_price = document.querySelectorAll(".total_price");
const form_order = document.getElementById("Form_order");
const btn_confirm = document.getElementById("btn_confirm");
console.log(btn_confirm);
var tot = 0;
if (cart) {
  cart.forEach((product) => {
    tot += product.amount * product.price;
    let item = `
        <div class="item">
            <div class="image">
                <img src="../img/main_img/${product.image}" alt="">
            </div>
            <div class="name">
                <p>${product.name_brand} ${product.model}</p>
            </div>
            <div class="amout">
                <p>x ${product.amount}</p>
            </div>
            <div class="price">
                <h4>฿ ${Number(product.price).toLocaleString()}</h4>
            </div>
        </div>
        <input type="hidden" value="${product.product_id}" name="product_id[]">
        <input type="hidden" value="${product.model}" name="model[]">
        <input type="hidden" value="${product.price}" name="price[]">
        <input type="hidden" value="${product.amount}" name="amount[]">
        `;
    box_items.insertAdjacentHTML("beforeend", item);
  });
  total.innerHTML = cart.length + " ชิ้น";
  let Number_tot = Number(tot);
  let formated_tot = Number_tot.toLocaleString('en-US');
  total_price[0].innerHTML = formated_tot +" บาท";
  total_price[1].innerHTML = formated_tot +" บาท";

  btn_confirm.addEventListener("click", async () => {
    const result = await Swal.fire({
      title: "ต้องการยืนยันคำสั่งซื้อ?",
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "ตกลง",
      cancelButtonText: "ยกเลิก",
    });

    if (result.isConfirmed) {
      form_order.submit();
    }
  });
}
