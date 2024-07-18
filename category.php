<?php

include 'connection.php';
include 'nav.php';

$search_text = '';
$c_id = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['search_text'])) {
        $search_text = $_POST['search_text'];
    }

    if (isset($_POST['c_id'])) {
        $c_id = $_POST['c_id'];
        $_SESSION['c_id'] = $c_id; // Set c_id in session
    }
} else {
    // Handle other cases (like navigating back or initial load)
    if (isset($_SESSION['c_id'])) {
        $c_id = $_SESSION['c_id'];
        unset($_SESSION['c_id']); // Clear session variable after use
    }

    // Handle session storage for search_text (if necessary)
    echo "<script>
        if (sessionStorage.getItem('search_text')) {
            var searchText = sessionStorage.getItem('search_text');
            sessionStorage.removeItem('search_text');
            document.write('<form id=\"hidden_form\" method=\"post\" action=\"category.php\"><input type=\"hidden\" name=\"search_text\" value=\"' + searchText + '\"></form>');
            document.getElementById('hidden_form').submit();
        }
    </script>";
}

// Fetch max price for slider
$sqlcost = "SELECT MAX(price) as max_price FROM product";
$resultcost = $con->query($sqlcost);
$rowcost = $resultcost->fetch_assoc();
$maxPrice = $rowcost['max_price'];

if (!empty($search_text)) {
        $sqlproduct = "SELECT p.*
                        FROM product p
                        LEFT JOIN category c ON p.c_id = c.category_id
                        LEFT JOIN alternate_category ac ON c.category_id = ac.c_id
                        WHERE p.title LIKE ? OR p.label LIKE ? OR c.category_name LIKE ? OR ac.alternate_names LIKE ?
                        ";
                        $like_search_text = '%' . $search_text . '%';
    
                        $stmt = $con->prepare($sqlproduct);
                        $stmt->bind_param("ssss", $like_search_text, $like_search_text, $like_search_text, $like_search_text);
                        $stmt->execute();
                        $resultproduct = $stmt->get_result();
    
} else if (!empty($c_id)) {
    $sqlproduct = "SELECT * FROM product WHERE c_id=?";
    $stmt = $con->prepare($sqlproduct);
    $stmt->bind_param("i", $c_id);
    $stmt->execute();
    $resultproduct = $stmt->get_result();
} else {
    $sqlproduct = "SELECT * FROM product";
    $resultproduct = $con->query($sqlproduct);
}



?>

<script>
    var maxPrice = <?php echo $maxPrice; ?>;
</script>

<?php
include 'mainFilter.php';
?>
<?php
    include 'footer.php';
?>
<script>

    $(document).ready(function() {
        $(".form-check-input, #inputmin, #inputmax").change(function() {
            filterProducts();
        });

        $("#priceRange").slider({
            range: true,
            min: 0,
            max: maxPrice,
            values: [0, maxPrice],
            slide: function(event, ui) {
                $("#minValueDisplay").text("₹" + ui.values[0]);
                $("#maxValueDisplay").text("₹" + ui.values[1]);
                $("#minPrice").val(ui.values[0]);
                $("#maxPrice").val(ui.values[1]);
            },
            change: function(event, ui) {
                filterProducts(); 
            }
        });

        $("#minValueDisplay").text("₹" + $("#priceRange").slider("values", 0));
        $("#maxValueDisplay").text("₹" + $("#priceRange").slider("values", 1));


        function resetForm() {
            $("#filter-form")[0].reset();
            $("#priceRange").slider("values", [0, maxPrice]);
            filterProducts();
            $("#minValueDisplay").text("₹0");
            $("#maxValueDisplay").text("₹<?php echo $maxPrice?>");
        }
        window.resetForm=resetForm;
    });

    function description(p_id) {
        console.log(p_id);
    $.ajax({
    url: "set_session.php",
    type: "POST",
    data: {p_id: p_id},
    success: function(response){
      window.location.href = "description.php";
    },
    error: function(xhr, status, error){
      console.error(error);
    }
  });
  console.log(c_id);
}
</script>
<style>
    .hidden {
        display: none;
    }
</style>
</body>
</html>
