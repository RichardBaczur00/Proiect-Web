function change_img() {
    var e = document.getElementById("product_select");

    var str = e.value;

    window.location.href = "add_item.php?selected=" + str;
}