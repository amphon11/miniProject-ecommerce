const inputFile = document.querySelector("#file-img-artist");
const custum_file_upload = document.querySelector(".custum-file-upload");
if (inputFile) {
  inputFile.addEventListener("change", function () {
    const image = this.files[0];

    const reader = new FileReader();

    reader.onload = () => {
      const imgUrl = reader.result;
      const img = document.createElement("img");
      img.src = imgUrl;
      // Remove existing image (if any) before appending a new one
      const existingImage = custum_file_upload.querySelector("img");
      if (existingImage) {
        existingImage.remove();
      }

      custum_file_upload.appendChild(img);
    };

    reader.readAsDataURL(image);
  });
}

// const btn_edit_brandALL = document.querySelectorAll(".btn_edit_brand");
// const box_edit_brand =
// btn_edit_brandALL.forEach((element)=>{
//   element.addEventListener('click',()=>{
//     console.log(element.getAttribute("id"));
//   });
// });
function showFormType(id) {
  let allbox = document.querySelectorAll(".box-edit-type");
  let btn_close = document.getElementById(`closeID${id}`);
  allbox.forEach((Element) => {
    if (Element.classList.contains("active")) {
      Element.classList.remove("active");
    }
  });
  document.getElementById(`box_edit_typeID${id}`).classList.add("active");

  btn_close.addEventListener("click", () => {
    document.getElementById(`box_edit_typeID${id}`).classList.remove("active");
  });
}
function showForm(id) {
  let allbox = document.querySelectorAll(".box-edit-brand");
  let btn_close = document.getElementById(`closeID${id}`);
  allbox.forEach((Element) => {
    if (Element.classList.contains("active")) {
      Element.classList.remove("active");
    }
  });
  document.getElementById(`box_edit${id}`).classList.add("active");

  btn_close.addEventListener("click", () => {
    document.getElementById(`box_edit${id}`).classList.remove("active");
  });
}

function validform1(id) {
  let box = document.getElementById(`box_edit${id}`);
  let brand_new = box.querySelector("input[name='brand_new']").value;
  let brand_old = box.querySelector("input[name='brand_old']").value;
  let isvalid = true;
  // ดึงค่า value ของ input และพิมพ์ออกมาที่คอนโซล
  if (brand_new == brand_old) {
    Swal.fire({
      title: "ไม่มีการแก้ไข!!",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "top",
    });
    isvalid = false;
  } else if (brand_new == "") {
    Swal.fire({
      title: "กรุณากรอกข้อมูล!!",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "top",
    });
    isvalid = false;
  }
  if (!/^[A-Za-z]+$/.test(brand_new)) {
    Swal.fire({
      title: "ชื่อแบรนด์ รูปแบบไม่ถูกต้อง",
      text: "อนุญาตให้กรอกเฉพาะ ตัวอักษร และไม่มีช่องว่าง",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "center",
    });
    isvalid = false;
  }
  return isvalid;
}
function validform2(id) {
  let box = document.getElementById(`box_edit_typeID${id}`);
  let type_new = box.querySelector("input[name='type_new']").value;
  let type_old = box.querySelector("input[name='type_old']").value;
  let isvalid = true;
  // ดึงค่า value ของ input และพิมพ์ออกมาที่คอนโซล
  if (type_new == type_old) {
    Swal.fire({
      title: "ไม่มีการแก้ไข!!",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "top",
    });
    isvalid = false;
  }
  else if (!/^[A-Za-z]+$/.test(type_new)) {
    Swal.fire({
      title: "ชื่อประเภท รูปแบบไม่ถูกต้อง",
      text: "อนุญาตให้กรอกเฉพาะ ตัวอักษร และไม่มีช่องว่าง",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "center",
    });
    isvalid = false;
  }
   else if (type_new == "") {
    Swal.fire({
      title: "กรุณากรอกข้อมูล!!",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "top",
    });
    isvalid = false;
  }
  return isvalid;
}
async function confirm_delete(text, page, target, id) {
  const result = await Swal.fire({
    title: "ยืนยันการลบใช่หรือไม่",
    text: text,
    icon: "question",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "ยืนยัน",
    cancelButtonText: "ยกเลิก",
  });

  if (result.isConfirmed) {
    // เมื่อยืนยันการลบ กลับไปทำงานเหตุการณ์ลิงก์
    window.location.href = `?page=${page}&${target}=${id}`;
  }
}
async function confirm_delete_product(text, id) {
  const result = await Swal.fire({
    title: "ยืนยันการลบสินค้าใช่หรือไม่",
    text: text,
    icon: "question",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "ยืนยัน",
    cancelButtonText: "ยกเลิก",
  });

  if (result.isConfirmed) {
    // เมื่อยืนยันการลบ กลับไปทำงานเหตุการณ์ลิงก์
    window.location.href = `?product_id=${id}`;
  }
}

// เรียกใช้งานฟังก์ชันเมื่อต้องการส่งข้อมูล
const view_order_product = document.querySelectorAll(".view_order_product");
const box_product = document.querySelectorAll(".box-order-product");
const close_amount_order = document.querySelectorAll(".close_amount_order");
console.log(box_product);
if (view_order_product) {
  view_order_product.forEach((element, i) => {
    element.addEventListener("click", () => {
      box_product.forEach((element) => {
        if (element.classList.contains("active")) {
          element.classList.remove("active");
        }
      });
      box_product[i].classList.add("active");
    });
  });
  close_amount_order.forEach((element, i) => {
    element.addEventListener("click", () => {
      box_product[i].classList.remove("active");
    });
  });
}

function validform_add() {
  console.log("validddddddddd");
  const form_add = document.getElementById("form_add");
  let medel = form_add.querySelector("input[name='model']").value;
  let freq = form_add.querySelector("input[name='frequency']").value;
  let imped = form_add.querySelector("input[name='impedance']").value;
  let senti = form_add.querySelector("input[name='sentivity']").value;
  let resolu = form_add.querySelector("input[name='resolution']").value;
  let feture = form_add.querySelector("textarea[name='feature']").value;
  let cable = form_add.querySelector("input[name='cableL']").value;
  let batter = form_add.querySelector("input[name='battery']").value;
  let weight = form_add.querySelector("input[name='grossweight']").value;
  let volume = form_add.querySelector("input[name='volume']").value;
  let color = form_add.querySelector("input[name='color']").value;

  if (!/^[a-zA-Z][a-zA-Z0-9-\s]*$/.test(medel)) {
    Swal.fire({
      title: "ชื่อ model รูปแบบไม่ถูกต้อง",
      text: "กรุณากรอกใหม่ เฉพาะตัวอักษร a-z และตัวเลข เช่น m303",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "center",
    });
    return false;
  } else if (!/^[a-zA-Z0-9-–+~,\s]*$/.test(freq) && freq != "") {
    Swal.fire({
      title: "Frequency รูปแบบไม่ถูกต้อง",
      text: "กรุณากรอกใหม่ เฉพาะตัวอักษร a-z และตัวเลข เช่น 30Hz-40Hz",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "center",
    });
    return false;
  } else if (!/^[a-zA-Z0-9Ω±%.\s]*$/.test(imped) && imped != "") {
    Swal.fire({
      title: "Impedance รูปแบบไม่ถูกต้อง",
      text: "กรุณากรอกใหม่ เฉพาะตัวอักษร a-z และตัวเลข เช่น 30ohm",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "center",
    });
    return false;
  } else if (!/^[a-zA-Z0-9.()+\s-±/]*$/.test(senti) && senti != "") {
    Swal.fire({
      title: "Sentivity รูปแบบไม่ถูกต้อง",
      text: "กรุณากรอกใหม่ เฉพาะตัวอักษร a-z และตัวเลข",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "center",
    });
    return false;
  } else if (!/^[a-zA-Z0-9-/,\s]*$/.test(resolu) && resolu != "") {
    Swal.fire({
      title: "Resolution รูปแบบไม่ถูกต้อง",
      text: "กรุณากรอกใหม่ เฉพาะตัวอักษร a-z และตัวเลข",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "center",
    });
    return false;
  // } else if (!/^[a-zA-Z0-9/\s]*$/.test(feture) && feture != "") {
  //   Swal.fire({
  //     title: "Feture รูปแบบไม่ถูกต้อง",
  //     text: "กรุณากรอกใหม่ เฉพาะตัวอักษร a-z และตัวเลข",
  //     icon: "error",
  //     confirmButtonColor: "#3085d6",
  //     confirmButtonText: "ยืนยัน",
  //     position: "center",
  //   });
  //   return false;
  } else if (!/^[a-zA-Z0-9./\s]*$/.test(cable) && cable != "") {
    Swal.fire({
      title: "Cable Lenght รูปแบบไม่ถูกต้อง",
      text: "กรุณากรอกใหม่ เฉพาะตัวอักษร a-z และตัวเลข",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "center",
    });
    return false;
  } else if (!/^[a-zA-Z][a-zA-Z0-9./\s]*$/.test(batter) && batter != "") {
    Swal.fire({
      title: "Battery รูปแบบไม่ถูกต้อง",
      text: "กรุณากรอกใหม่ เฉพาะตัวอักษร a-z และตัวเลข",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "center",
    });
    return false;
  } else if (!/^[a-zA-Z0-9./\s]*$/.test(weight) && weight != "") {
    Swal.fire({
      title: "grossweight รูปแบบไม่ถูกต้อง",
      text: "กรุณากรอกใหม่ เฉพาะตัวอักษร a-z และตัวเลข",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "center",
    });
    return false;
  } else if (!/^[a-zA-Z0-9/\s,.()]*$/.test(volume) && volume != "") {
    Swal.fire({
      title: "Volume รูปแบบไม่ถูกต้อง",
      text: "กรุณากรอกใหม่ เฉพาะตัวอักษร a-z และตัวเลข",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "center",
    });
    return false;
  } else if (!/^[a-zA-Z0-9#/\s]*$/.test(color) && color != "") {
    Swal.fire({
      title: "Color รูปแบบไม่ถูกต้อง",
      text: "กรุณากรอกใหม่ เฉพาะตัวอักษร a-z และตัวเลข",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "center",
    });
    return false;
  } else {
    return true;
  }
}
function validform_edit() {
  console.log("validddddddddd");
  const form_add = document.getElementById("form_edit");
  let medel = form_add.querySelector("input[name='model']").value;
  let freq = form_add.querySelector("input[name='frequency']").value;
  let imped = form_add.querySelector("input[name='impedance']").value;
  let senti = form_add.querySelector("input[name='sentivity']").value;
  let resolu = form_add.querySelector("input[name='resolution']").value;
  let feture = form_add.querySelector("textarea[name='feature']").value;
  let cable = form_add.querySelector("input[name='cableL']").value;
  let batter = form_add.querySelector("input[name='battery']").value;
  let weight = form_add.querySelector("input[name='grossweight']").value;
  let volume = form_add.querySelector("input[name='volume']").value;
  let color = form_add.querySelector("input[name='color']").value;

  if (!/^[a-zA-Z][a-zA-Z0-9-\s]*$/.test(medel)) {
    Swal.fire({
      title: "ชื่อ model รูปแบบไม่ถูกต้อง",
      text: "กรุณากรอกใหม่ เฉพาะตัวอักษร a-z และตัวเลข เช่น m303",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "center",
    });
    return false;
  } else if (!/^[a-zA-Z0-9-–+~,\s]*$/.test(freq) && freq != "") {
    Swal.fire({
      title: "Frequency รูปแบบไม่ถูกต้อง",
      text: "กรุณากรอกใหม่ เฉพาะตัวอักษร a-z และตัวเลข เช่น 30Hz-40Hz",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "center",
    });
    return false;
  } else if (!/^[a-zA-Z0-9Ω%±.\s]*$/.test(imped) && imped != "") {
    Swal.fire({
      title: "Impedance รูปแบบไม่ถูกต้อง",
      text: "กรุณากรอกใหม่ เฉพาะตัวอักษร a-z และตัวเลข เช่น 30ohm",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "center",
    });
    return false;
  } else if (!/^[a-zA-Z0-9.()+\s-±/]*$/.test(senti) && senti != "") {
    Swal.fire({
      title: "Sentivity รูปแบบไม่ถูกต้อง",
      text: "กรุณากรอกใหม่ เฉพาะตัวอักษร a-z และตัวเลข",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "center",
    });
    return false;
  } else if (!/^[a-zA-Z0-9-/,\s]*$/.test(resolu) && resolu != "") {
    Swal.fire({
      title: "Resolution รูปแบบไม่ถูกต้อง",
      text: "กรุณากรอกใหม่ เฉพาะตัวอักษร a-z และตัวเลข",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "center",
    });
    return false;
  // } else if (!/^[a-zA-Z0-9/\s]*$/.test(feture) && feture != "") {
  //   Swal.fire({
  //     title: "Feture รูปแบบไม่ถูกต้อง",
  //     text: "กรุณากรอกใหม่ เฉพาะตัวอักษร a-z และตัวเลข",
  //     icon: "error",
  //     confirmButtonColor: "#3085d6",
  //     confirmButtonText: "ยืนยัน",
  //     position: "center",
  //   });
  //   return false;
  } else if (!/^[a-zA-Z0-9./\s]*$/.test(cable) && cable != "") {
    Swal.fire({
      title: "Cable Lenght รูปแบบไม่ถูกต้อง",
      text: "กรุณากรอกใหม่ เฉพาะตัวอักษร a-z และตัวเลข",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "center",
    });
    return false;
  } else if (!/^[a-zA-Z][a-zA-Z0-9./\s]*$/.test(batter) && batter != "") {
    Swal.fire({
      title: "Battery รูปแบบไม่ถูกต้อง",
      text: "กรุณากรอกใหม่ เฉพาะตัวอักษร a-z และตัวเลข",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "center",
    });
    return false;
  } else if (!/^[a-zA-Z0-9./\s]*$/.test(weight) && weight != "") {
    Swal.fire({
      title: "grossweight รูปแบบไม่ถูกต้อง",
      text: "กรุณากรอกใหม่ เฉพาะตัวอักษร a-z และตัวเลข",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "center",
    });
    return false;
  } else if (!/^[a-zA-Z0-9/\s,.()]*$/.test(volume) && volume != "") {
    Swal.fire({
      title: "Volume รูปแบบไม่ถูกต้อง",
      text: "กรุณากรอกใหม่ เฉพาะตัวอักษร a-z และตัวเลข",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "center",
    });
    return false;
  } else if (!/^[a-zA-Z0-9#/\s]*$/.test(color) && color != "") {
    Swal.fire({
      title: "Color รูปแบบไม่ถูกต้อง",
      text: "กรุณากรอกใหม่ เฉพาะตัวอักษร a-z และตัวเลข",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "center",
    });
    return false;
  } else {
    return true;
  }
}
function valid_form_add_brand() {
  const form_add_brand = document.getElementById("form_add_brand");
  let input_brand = form_add_brand.querySelector("input[name='brand']");
  console.log(input_brand.value);
  if (!/^[A-Za-z]+$/.test(input_brand.value)) {
    Swal.fire({
      title: "ชื่อแบรนด์ รูปแบบไม่ถูกต้อง",
      text: "อนุญาตให้กรอกเฉพาะ ตัวอักษร และไม่มีช่องว่าง",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "center",
    });
    return false;
  } else {
    return true;
  }
}
function valid_form_add_type(){
  const form_add_type = document.getElementById("form_add_type");
  let input_type = form_add_type.querySelector("input[name='type']");
  if (!/^[A-Za-z]+$/.test(input_type.value)) {
    Swal.fire({
      title: "ชื่อประเภท รูปแบบไม่ถูกต้อง",
      text: "อนุญาตให้กรอกเฉพาะ ตัวอักษร และไม่มีช่องว่าง",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "center",
    });
    return false;
  } else {
    return true;
  }
}
