
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_shop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فروشگاه اینترنتی من</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        header {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
        }
        nav a {
            margin: 0 15px;
            text-decoration: none;
            color: #000;
        }
        .products, .product-details {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 20px;
        }
        .product, .product-details {
            border: 1px solid #ddd;
            margin: 10px;
            padding: 10px;
            text-align: center;
            width: 300px;
        }
        .product img, .product-details img {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <header>
        <h1>خوش آمدید به فروشگاه اینترنتی من</h1>
        <nav>
            <a href="index.php">صفحه اصلی</a>
        </nav>
    </header>
    <main>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM products WHERE id=$id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo '<div class="product-details">';
                echo '<img src="images/' . $row["image"] . '" alt="' . $row["name"] . '">';
                echo '<h2>' . $row["name"] . '</h2>';
                echo '<p>' . $row["description"] . '</p>';
                echo '<p>قیمت: ' . $row["price"] . ' تومان</p>';
                echo '<a href="index.php">بازگشت به صفحه اصلی</a>';
                echo '</div>';
            } else {
                echo "محصول مورد نظر یافت نشد.";
            }
        } else {
            echo '<h2>محصولات</h2>';
            echo '<div class="products">';
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="product">';
                    echo '<img src="images/' . $row["image"] . '" alt="' . $row["name"] . '">';
                    echo '<h3>' . $row["name"] . '</h3>';
                    echo '<p>' . $row["description"] . '</p>';
                    echo '<p>قیمت: ' . $row["price"] . ' تومان</p>';
                    echo '<a href="index.php?id=' . $row["id"] . '">مشاهده جزئیات</a>';
                    echo '</div>';
                }
            } else {
                echo "هیچ محصولی موجود نیست.";
            }
            echo '</div>';
        }
        $conn->close();
        ?>
    </main>
    <footer>
        <p>&copy; 2024 فروشگاه اینترنتی من</p>
    </footer>
</body>
</html>
