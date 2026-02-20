<?php
$grams = "";
$price = "";
$ounces = "00.00";
$kilograms = "00.00";
$total = "00.00";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $grams = $_POST["grams"];
    $price = $_POST["price"];

    if ($grams === "" && $price === "") {
        $error = "Please enter gold weight and price per gram.";
    } else if ($grams === "") {
        $error = "Please enter gold weight in grams.";

    } elseif ($price === "") {
        $error = "Please enter price per gram.";

    } elseif (!is_numeric($grams) || !is_numeric($price)) {
        $error = "Please enter valid numeric values.";

    } else {
        $ounces = $grams / 28.3495;
        $kilograms = $grams / 1000;
        $total = $grams * $price;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Gold Converter Tool</title>

<style>
    body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #111827;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.card {
    background: #e9e6e3;
    width: 420px;
    padding: 30px;
    border-radius: 10px;
    position: relative;
}

.stripes {
    position: absolute;
    top: 0;
    right: 15px;
}

.stripe1 {
    width: 3px;
    height: 120px;
    background: #D4AF37;
    margin-left: 6px;
    display: inline-block;
    vertical-align: top;
}
.stripe2 {
    width: 3px;
    height: 160px;
    background: #D4AF37;
    margin-left: 6px;
    display: inline-block;
    vertical-align: top;
}
.stripe3 {
    width: 3px;
    height: 200px;
    background: #D4AF37;
    margin-left: 6px;
    display: inline-block;
    vertical-align: top;
}

h1 {
    font-size: 80px;
    margin: 0;
    color: #D4AF37;
    -webkit-text-stroke: 2px #1F3C88;
}

h2 {
    margin: 0;
    color: #1F3C88;
    letter-spacing: 5px;
}

.center-text {
    text-align: center;
    margin: 20px 0;
    font-weight: bold;
}

label {
    font-weight: bold;
    color: #D4AF37;
    display: block;
    margin-top: 15px;
}

input {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border-radius: 4px;
    border: 1px solid #999;
}
input:focus {
    border-color: #D4AF37;
    outline: none;
    box-shadow: 0 0 5px rgba(212,175,55,0.5);
}

.submit_btn {
    display: block;
    width: 60%;
    margin: 20px auto;
    padding: 10px;
    background: linear-gradient(135deg, #C6A232, #E6C65C, #B8860B);
    color: white;
    border: none;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
}
.submit_btn:hover {
    transform: scale(1.05);
    background: linear-gradient(135deg, #C6A232, #E6C65C, #B8860B);
}

.results-box {
    background: #2f2b3a;
    padding: 20px;
    border-radius: 12px;
    margin-top: 20px;
    color: white;
}

.results-title {
    text-align: center;
    color: #D4AF37;
    font-weight: bold;
    margin-bottom: 15px;
}

.result-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 8px;
}

.total-box {
    background: linear-gradient(135deg, #C6A232, #E6C65C, #B8860B);
    padding: 15px;
    border-radius: 8px;
    margin-top: 15px;
    font-weight: bold;
}

.clear_btn {
    background: darkred;
    padding: 8px 20px;
    border: none;
    border-radius: 6px;
    color: white;
    display: block;
    margin: 15px auto 0 auto;
    cursor: pointer;
    width: 40%;
}

.error {
    color: red;
    text-align: center;
    margin-top: 10px;
}
.total_box-title {
    font-size: 14px;
    color: #231d29;
    margin-bottom: 5px;
    
}
.total-price {
    font-size: 40px;
    font-weight: bold;
    text-align: center;
}
</style>
</head>

<body>

<div class="card">
    <div class="stripes">
        <div class="stripe1"></div>
        <div class="stripe2"></div>
        <div class="stripe3"></div>
    </div>
    <h1>GOLD</h1>
    <h2>CONVERTER TOOL</h2>
    <br>
    <div class="center-text">
        Enter the gold details below:
    </div>

    <form method="POST">
        <label>GOLD WEIGHT (GRAMS)</label>
        <input type="text" name="grams" value="<?php echo $grams; ?>">
        <label>PRICE PER GRAM (PHP)</label>
        <input type="text" name="price" value="<?php echo $price; ?>">
        <button type="submit" class="submit_btn">CALCULATE</button>
        <?php if ($error != "") { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>

        <div class="results-box">
            <div class="results-title">——— RESULTS ———</div>
            <div class="result-row">
                <span>ORIGINAL WEIGHT (GRAMS)</span>
                <span><?php echo $grams ? number_format($grams,2) : "00.00"; ?></span>
            </div>
            <div class="result-row">
                <span>EQUIVALENT (OUNCES)</span>
                <span><?php echo number_format($ounces,2); ?></span>
            </div>
            <div class="result-row">
                <span>EQUIVALENT (KILOGRAMS)</span>
                <span><?php echo number_format($kilograms,2); ?></span>
            </div>
            <br>
            <div>1 GRAM = ₱<?php echo $price ? number_format($price,2) : "00.00"; ?></div>
            <div class="total-box">
               <div class="total-box-title">TOTAL PRICE</div>
               <div class="total-price">₱ <?php echo number_format($total,2); ?></div>
            </div>
            </div>
            <button type="button" class="clear_btn"
                onclick="window.location.href='<?php echo $_SERVER['PHP_SELF']; ?>'">
                CLEAR
            </button>
        </div>
    </form>
</div>
</body>
</html>