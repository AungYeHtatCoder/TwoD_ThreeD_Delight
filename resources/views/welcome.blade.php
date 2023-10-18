@extends('layouts.user_app')

@section('user_styles')
  <meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
    <style>
        /* .digit.selected {
            background-color: #007bff;
            color: white;
            border-radius: 50%;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            
            width: 2.5rem;
            height: 2.5rem;
            line-height: 2.5rem;

        } */
        .digit.selected {
            background-color: #007bff;
            color: white;
            border-radius: 50%;
            width: 2.2rem;
            /* Reduced size */
            height: 2.2rem;
            /* Reduced size */
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #007bff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            margin: 0 4px;
            /* Spacing between digits */
        }

        .digit {
            border: 3px solid gold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
            border-radius: 8px;
            font-size: 20px;
            font-weight: bold;
            transition: all 0.3s ease;
            cursor: pointer;
            margin: 0 1px;
            /* Spacing between digits */
        }

        /* .digit.selected {
        background-color: #007bff;
        color: white;
        border-radius: 50%;
        width: 2.5rem;
        height: 2.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #007bff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    } */

        /* .digit {
        border: 3px solid gold;
        transition: background-color 0.3s;
        animation: goldAnimate 2s infinite alternate;
    }

    @keyframes goldAnimate {
        0% {
            border-color: #ffd700;
        }
        50% {
            border-color: #ffcc00;
        }
        100% {
            border-color: #ffdb58;
        }
    } */
        /* General styles */
        .beauty {
            font-family: 'Arial', sans-serif;
            /* Change as per your preference */
            background: linear-gradient(45deg, #f3f4f6, #ddd);
            /* Light gradient background */
            padding: 2em;
        }

        /* .digit {
        border: 3px solid gold;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 10px 0;
        border-radius: 8px;
        font-size: 20px;
        font-weight: bold;
        transition: all 0.3s ease;
        cursor: pointer;
    } */

        .digit:hover {
            transform: translateY(-5px);
            /* Slight lift effect */
            box-shadow: 0 6px 2px rgba(0, 0, 0, 0.15);
            /* Increased shadow on hover */
        }

        .disabled {
            cursor: not-allowed;
            /* Indicates non-clickable */
        }

        .disabled:hover {
            transform: none;
            /* No lift effect for disabled */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* No change in shadow for disabled */
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
                            @if (Auth::check())
                                <span id="userBalance"
                                    data-balance="{{ Auth::user()->balance }}">{{ Auth::user()->balance }}</span>
                            @else
                                <span id="userBalance" data-balance="0">0</span>
                                <!-- or some other default value or message -->
                            @endif
                        </h5>
                        @foreach ($twoDigits->chunk(5) as $chunk)
                            <div class="row my-2 beauty">
                                @foreach ($chunk as $digit)
                                    @php
                                        $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_pivot')
                                            ->where('two_digit_id', $digit->id)
                                            ->sum('sub_amount');
                                    @endphp

                                    @if ($totalBetAmountForTwoDigit < 5000)
                                        <div class="col-2 text-center digit"
                                            style="background-color: {{ 'javascript:getRandomColor();' }}"
                                            onclick="selectDigit('{{ $digit->two_digit }}', this)">
                                            {{ $digit->two_digit }}
                                        </div>
                                    @else
                                        <div class="col-2 text-center digit disabled"
                                            style="background-color: {{ 'javascript:getRandomColor();' }}"
                                            onclick="showLimitFullAlert()">
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
                            <div class="form-group mb-3">
                                <label for="totalAmount">Total Amount</label>
                                <input type="text" id="totalAmount" name="totalAmount" class="form-control" readonly>
                            </div>
                            <input type="hidden" name="user_id" value="{{ Auth::check() ? Auth::user()->id : 'default_value' }}">

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">playNow</button>
                                {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

    <script>
        function showLimitFullAlert() {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'This two digit\'s amount limit is full. - သတ်မှတ်ကြေးပြည့်သွား၍ ဤဂဏန်းကို သင်ထိုး၍ မရတော့ပါ။ '
    });
}

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
                amountInput.onchange = updateTotalAmount; // Add this line to call the total update function
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
    //alert('Your balance is not enough to play two digit.');
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Your balance is not enough to play two digit. - သင်၏လက်ကျန်ငွေ မလုံလောက်ပါ - ကျေးဇူးပြု၍ ငွေဖြည့်ပါ။',
        footer: '<a href="{{ route('admin.profiles.index') }}" style="background-color: #007BFF; color: #FFFFFF; padding: 5px 10px; border-radius: 5px; text-decoration: none;">Fill Balance - ငွေဖြည့်သွင်းရန် နိုပ်ပါ </a>'
    });
    return; // Exit the function to prevent further changes 
}



            // Decrease the user balance by the total
            userBalance -= total;

            // Update the displayed balance and the data attribute
            userBalanceSpan.textContent = userBalance;
            userBalanceSpan.setAttribute('data-balance', userBalance);

            document.getElementById('totalAmount').value = total;
        }

        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
        // sweet alert
        document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault(); // prevent the form from submitting immediately

    Swal.fire({
        title: 'Are you sure- ထိုးမှာလား ?',
        text: 'You are about to submit your lottery choices.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, submit it! - ထိုးမယ်!',
        cancelButtonText: 'No, cancel! - မထိုးပါ!'
    }).then((result) => {
        if (result.isConfirmed) {
            // If the user clicked "Yes", submit the form
            event.target.submit();
        }
    });
});

// store two digit lottery
// document.querySelector('form').addEventListener('submit', function(event) {
//     event.preventDefault(); // prevent the form from submitting immediately

//     Swal.fire({
//         title: 'Are you sure?',
//         text: 'You are about to submit your lottery choices.',
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonText: 'Yes, submit it!',
//         cancelButtonText: 'No, cancel!'
//     }).then((result) => {
//         if (result.isConfirmed) {
//             // If the user clicked "Yes", send an AJAX request
//             const formData = new FormData(event.target);
//             fetch(event.target.action, {
//                 method: 'POST',
//                 body: formData,
//                 headers: {
//                     'X-Requested-With': 'XMLHttpRequest', // Indicates this is an AJAX request
//                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Add CSRF token for Laravel
//                 }
//             })
//             .then(response => response.json()) // Parse the JSON response
//             .then(data => {
//                 if (data.success) {
//                     Swal.fire('Success!', data.message, 'success');
//                 } else {
//                     Swal.fire('Error!', data.error, 'error');
//                 }
//             })
//             .catch(error => {
//                 Swal.fire('Oops!', 'Something went wrong. Please try again.', 'error');
//             });
//         }
//     });
// });

    </script>


    <script>
    $(document).ready(function() {
        function fetchData() {
            $.ajax({
                url: "/",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    // Update live data
                    updateLiveData(data.live);

                    // Update results
                    updateResultsData(data.result);
                }
            });
        }

        function updateLiveData(liveData) {
            // Helper function to update text and possibly animate the update
            function updateAndAnimate(elementId, newValue) {
                const element = $(elementId);
                if (element.text() !== newValue) {
                    element.text(newValue).addClass('activeUpdate');
                    setTimeout(function() {
                        element.removeClass('activeUpdate');
                    }, 300);
                }
            }

            updateAndAnimate("#liveSet", liveData.set);
            updateAndAnimate("#liveValue", liveData.value);
            $("#liveTime").text(liveData.time);  // Always update time
        }

        function updateResultsData(results) {
            let resultsHtml = '';
            results.forEach(function(result) {
                resultsHtml += `
                    <p>Set: ${result.set}</p>
                    <p>Value: ${result.value}</p>
                    <p>Open Time: ${result.open_time}</p>
                    <hr>
                `;
            });

            $("#resultsData").html(resultsHtml);
        }

        fetchData();  // Initial data fetch
        setInterval(fetchData, 1000);  // Fetch data every 3 seconds
    });
</script>
@endsection
