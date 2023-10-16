@extends('layouts.user_app')

@section('user_styles')
<style>
    .digit.selected {
        background-color: #007bff;  /* Bootstrap primary color */
        color: white;  /* Text color for better contrast */
        /* rounded */
        border-radius: 50%;
        -moz-border-radius: 50%;
        -webkit-border-radius: 50%;
        /* circle */
        width: 2.5rem;
        height: 2.5rem;
        line-height: 2.5rem;

    }
</style>
@endsection
@section('content')
<div class="row align-items-center">
        <div class="col-lg-10 ms-auto">
          <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="info">
                <div class="icon icon-sm">
                  {{-- 1 --}}
                </div>
                <h5 class="font-weight-bolder mt-3">Delight 2D
                <span>{{ Auth::user()->balance }}</span>    
                </h5>
                
                @foreach($twoDigits->chunk(5) as $chunk)
        <div class="row my-5">
            @foreach($chunk as $digit)
                @php
                $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_pivot')
                    ->where('two_digit_id', $digit->id)
                    ->sum('sub_amount');
                @endphp

                @if($totalBetAmountForTwoDigit < 5000)
                    <div class="col-2 text-center digit" onclick="selectDigit('{{ $digit->two_digit }}', this)">
                        {{ $digit->two_digit }}
                    </div>
                @else
                    <div class="col-2 text-center digit disabled" onclick="alert('This two digit\'s amount limit is full.')">
                        {{ $digit->two_digit }}
                    </div>
                @endif
            @endforeach
        </div>
    @endforeach

    <form action="{{ route('admin.two-d-lotteries.store') }}" method="post">
        @csrf

        <input type="text" name="selected_digits" id="selected_digits" class="form-control">
        
        <div id="amountInputs"></div>
        <!-- Add this right above your PlayNow & Close buttons in the modal-body -->
    <div class="form-group mb-3">
        <label for="totalAmount">Total Amount</label>
        <input type="text" id="totalAmount" name="totalAmount" class="form-control" readonly> <span id="userBalanceSpan" data-balance="1000">1000</span>

    </div>
     <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        {{-- PlayNow & Close buttons --}}
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">playNow</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </form>


              </div>
            </div>
            
          </div>
          
        </div>
        {{-- add more col --}}
      </div>
@endsection
@section('user_scripts')
<script>

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
    console.log("updateTotalAmount called");

    if (document.getElementById('userBalanceSpan')) {
        const userBalanceSpan = document.getElementById('userBalanceSpan');
        let userBalance = Number(userBalanceSpan.getAttribute('data-balance'));
        console.log("Current User Balance:", userBalance);
        
        let total = 0;
        const inputs = document.querySelectorAll('input[name^="amounts["]');
        inputs.forEach(input => {
            console.log("Input Value:", input.value);
            total += Number(input.value);
        });
        console.log("Total Calculated:", total);
        
        if (userBalance < total) {
            alert('Your balance is not enough to play two digit.');
            return;
        }
        
        userBalance -= total;
        userBalanceSpan.textContent = userBalance;
        userBalanceSpan.setAttribute('data-balance', userBalance);

        document.getElementById('totalAmount').value = total;
    } else {
        console.log("userBalanceSpan not found");
    }
}


</script>
@endsection