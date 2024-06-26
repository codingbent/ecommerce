// function addToCart(productId) {
//     // Send AJAX request to addToCart.php with productId
//     let xhr = new XMLHttpRequest();
//     xhr.open("POST", "addToCart.php", true);
//     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
//     xhr.onreadystatechange = function () {
//         if (xhr.readyState === 4 && xhr.status === 200) {
//             // Handle the response from addToCart.php if needed
//             alert(xhr.responseText); // For example, show an alert message
//         }
//     };
//     xhr.send("productId=" + productId);
// }
function remove(){
confrim("DO you want to detele tis product");
}
