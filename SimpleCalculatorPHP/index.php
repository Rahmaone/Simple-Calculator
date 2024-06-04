<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Calculator</title>
    <style>
        body {
            margin: 0px;
            padding: 0px;
            width: 100%;
            height: 100%;
            overflow-x: hidden;
            background-image: url('background.jpg');
            background-color: #d5bab2;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .calculator {
            width: 300px;
            border: 1px solid #000;
            border-radius: 5px;
            padding: 10px;
            margin: 75px auto;
            background-color: #f5dad2;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            font-family: Arial, sans-serif;
        }

        .calculator h3 {
            text-align: center;
            color: #030303;
        }

        .input {
            display: block;
            width: 280px;
            height: 40px;
            margin: auto auto 10px auto;
            text-align: right;
            padding: 5px;
            font-size: 20px;
            border: 1px solid #000;
            border-radius: 5px;
            background-color: #fff;
        }

        .numpad {
            width: fit-content;
            display: block;
            margin: auto;
        }

        .numpad-btn {
            width: 60px;
            height: 60px;
            font-size: 18px;
            margin: 5px;
            border-radius: 5px;
            cursor: pointer;
            border: 1px solid #000;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            color: #000;
            transition: background-color 0.3s, color 0.3s;
        }

        .op {
            background-color: #bacd92;
        }

        .op:hover {
            background-color: #9aad72;
        }

        .num {
            background-color: #fcffe0;
        }

        .num:hover {
            background-color: #dcdfc0;
        }

        .numpad-btn:active {
            box-shadow: none;
            transform: translateY(2px);
        }

        .equal {
            background-color: #75a47f;
        }

        .equal:hover {
            background-color: #55845f;
        }

    </style>
</head>
<body>
    <?php
        session_start();
        $_SESSION["username"] = "ranirani";
        $username = htmlspecialchars($_SESSION["username"]);
        if(isset($_POST['calculate'])) {
            $expression = $_POST['expression'];
            if(strpos($expression, '/0') !== false) {
                echo "<script>document.getElementById('display').value = 'Error: Division by zero';</script>";
            } else {
                try {
                    $result = eval("return $expression;");
                    echo "<script>document.getElementById('display').value = '$result';</script>";
                } catch (Exception $e) {
                    echo "<script>document.getElementById('display').value = 'Error: Invalid expression';</script>";
                }
            }
        }
    ?>
    <div class="calculator">
        <form method="post" onsubmit="return checkError()">
            <input type="text" class="input" id="display" name="expression" readonly>
            <h3>Simple Calculator by <?= $username?></h3>
            <div class="numpad">
                <input class="numpad-btn op" type="button" value="C" onclick="clearDisplay()">
                <input class="numpad-btn op" type="button" value="⌫" onclick="backspace()">
                <input class="numpad-btn op" type="button" value="√" onclick="squareRoot()">
                <input class="numpad-btn op" type="button" value="+" onclick="appendToDisplay('+')">
                <br>
                <input class="numpad-btn num" type="button" value="1" onclick="appendToDisplay('1')">
                <input class="numpad-btn num" type="button" value="2" onclick="appendToDisplay('2')">
                <input class="numpad-btn num" type="button" value="3" onclick="appendToDisplay('3')">
                <input class="numpad-btn op" type="button" value="-" onclick="appendToDisplay('-')">
                <br>
                <input class="numpad-btn num" type="button" value="4" onclick="appendToDisplay('4')">
                <input class="numpad-btn num" type="button" value="5" onclick="appendToDisplay('5')">
                <input class="numpad-btn num" type="button" value="6" onclick="appendToDisplay('6')">
                <input class="numpad-btn op" type="button" value="*" onclick="appendToDisplay('*')">
                <br>
                <input class="numpad-btn num" type="button" value="7" onclick="appendToDisplay('7')">
                <input class="numpad-btn num" type="button" value="8" onclick="appendToDisplay('8')">
                <input class="numpad-btn num" type="button" value="9" onclick="appendToDisplay('9')">
                <input class="numpad-btn op" type="button" value="/" onclick="appendToDisplay('/')">
                <br>
                <input class="numpad-btn num" type="button" value="0" onclick="appendToDisplay('0')">
                <input class="numpad-btn num" type="button" value="." onclick="appendToDisplay('.')">
                <input class="numpad-btn num" type="button" value="00" onclick="appendToDisplay('00')">
                <button class="numpad-btn equal" type="submit" name="calculate">=</button>
            </div>
        </form>
    </div>

    <script>
        function appendToDisplay(value) {
            var display = document.getElementById("display");
            if (display.value === "Error: Division by zero") {
                clearDisplay();
            }
            display.value += value;
        }

        function clearDisplay() {
            document.getElementById("display").value = "";
        }

        function backspace() {
            var display = document.getElementById("display");
            display.value = display.value.slice(0, -1);
        }

        function squareRoot() {
            var display = document.getElementById("display");
            var num = parseFloat(display.value);
            if (!isNaN(num)) {
                display.value = Math.sqrt(num);
            }
        }

        function checkError() {
            var display = document.getElementById("display");
            if (display.value === "Error: Division by zero") {
                clearDisplay();
                return false;
            }
            return true;
        }

        var buttons = document.querySelectorAll(".numpad-btn");
        buttons.forEach(function(button) {
            button.addEventListener("click", function() {
                var display = document.getElementById("display");
                if (display.value === "Error: Division by zero") {
                    clearDisplay();
                }
            });
        });

    </script>
</body>
</html>
