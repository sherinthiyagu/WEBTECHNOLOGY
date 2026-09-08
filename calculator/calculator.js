let firstNumber = "";
let operator = "";
let newNumber = true;

const display = document.getElementById("display");

function addNumber(number) {

    if (newNumber) {
        display.value = "";
        newNumber = false;
    }

    if (number === "." && display.value.includes(".")) {
        return;
    }

    display.value += number;
}

function chooseOperator(selectedOperator) {

    firstNumber = Number(display.value);

    operator = selectedOperator;

    if (selectedOperator === "+") {
        display.value = firstNumber + " +";
    }

    else if (selectedOperator === "-") {
        display.value = firstNumber + " −";
    }

    else if (selectedOperator === "*") {
        display.value = firstNumber + " ×";
    }

    else if (selectedOperator === "/") {
        display.value = firstNumber + " ÷";
    }

    newNumber = true;
}

function calculateResult() {

    let secondNumber = Number(display.value);
    let result;

    if (operator === "+") {
        result = firstNumber + secondNumber;
    }

    else if (operator === "-") {
        result = firstNumber - secondNumber;
    }

    else if (operator === "*") {
        result = firstNumber * secondNumber;
    }

    else if (operator === "/") {

        if (secondNumber === 0) {
            display.value = "Error";
            newNumber = true;
            return;
        }

        result = firstNumber / secondNumber;
    }

    display.value = result;

    newNumber = true;
    operator = "";
}

function clearAll() {

    display.value = "0";

    firstNumber = "";
    operator = "";

    newNumber = true;
}

function clearEntry() {

    display.value = "0";

    newNumber = true;
}

function backspace() {

    if (display.value.length > 1) {
        display.value = display.value.slice(0, -1);
    }

    else {
        display.value = "0";
    }
}

function changeSign() {

    display.value = Number(display.value) * -1;
}

function calculate(type) {

    let number = Number(display.value);
    let result;

    if (type === "percent") {
        result = number / 100;
    }

    else if (type === "sin") {
        result = Math.sin(number * Math.PI / 180);
    }

    else if (type === "cos") {
        result = Math.cos(number * Math.PI / 180);
    }

    else if (type === "tan") {
        result = Math.tan(number * Math.PI / 180);
    }

    else if (type === "sqrt") {
        result = Math.sqrt(number);
    }

    else if (type === "square") {
        result = number * number;
    }

    else if (type === "log") {
        result = Math.log10(number);
    }

    else if (type === "ln") {
        result = Math.log(number);
    }

    else if (type === "reciprocal") {
        result = 1 / number;
    }

    display.value = result;

    newNumber = true;
}