<script>
 document.addEventListener("DOMContentLoaded", function() {
  function selectDigit(num, element) {
    const selectedInput = document.getElementById('selected_digits');
    const amountInputsDiv = document.getElementById('amountInputs');
    let selectedDigits = selectedInput.value ? selectedInput.value.split(",") : [];

    // Check if the digit is already selected
    if (selectedDigits.includes(num)) {
        // If it is, remove the digit, its style, and its input field
        selectedInput.value = selectedInput.value.replace(num, '').replace(',,', ',').replace(/^,|,$/g, '');
        element.classList.remove('selected');
        const inputToRemove = document.getElementById('amount_' + num);
        amountInputsDiv.removeChild(inputToRemove);
    } else {
        // Otherwise, add the digit, its style, and its input field
        selectedInput.value = selectedInput.value ? selectedInput.value + "," + num : num;
        element.classList.add('selected');
        
        const amountInput = document.createElement('input');
        amountInput.setAttribute('type', 'number');
        amountInput.setAttribute('name', 'amounts[' + num + ']');
        amountInput.setAttribute('id', 'amount_' + num);
        amountInput.setAttribute('placeholder', 'Amount for ' + num);
        amountInput.setAttribute('min', '100');
        amountInput.setAttribute('max', '5000');
        amountInput.setAttribute('class', 'form-control mt-2');
        amountInput.onchange = updateTotalAmount;  // Add this line to call the total update function
        amountInputsDiv.appendChild(amountInput);
    }

    updateTotalAmount();
}

// New function to calculate and display the total amount
function updateTotalAmount() {
    let total = 0;
    const inputs = document.querySelectorAll('input[name^="amounts["]');
    inputs.forEach(input => {
        total += Number(input.value);
    });
    
    // Get the user's current balance from the data attribute
    const userBalanceSpan = document.getElementById('userBalance');
    let userBalance = Number(userBalanceSpan.getAttribute('data-balance'));

    // Check if user balance is less than total amount
    if (userBalance < total) {
        alert('Your balance is not enough to play two digit.');
        return;  // Exit the function to prevent further changes
    }

    // Decrease the user balance by the total
    userBalance -= total;

    // Update the displayed balance and the data attribute
    userBalanceSpan.textContent = userBalance;
    userBalanceSpan.setAttribute('data-balance', userBalance);

    document.getElementById('totalAmount').value = total;
}



});

</script>