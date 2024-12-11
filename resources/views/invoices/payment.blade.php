<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        /* Optional: Add some custom styling */
        .card-element {
            background-color: #f7f7f7;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 4px;
        }
        .loading {
            display: none;
        }
        .loading.show {
            display: block;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mt-5 mb-4 text-center">Complete Your Payment</h2>

    <!-- Payment Form -->
    <form action="{{ route('invoices.processPayment', $invoice->id) }}" method="POST" id="payment-form" class="needs-validation" novalidate>
        @csrf

        <!-- Invoice Details -->
        <div class="row mb-4">
            <div class="col">
                <label for="amount">Amount</label>
                <input type="text" id="amount" class="form-control" value="$ {{ number_format($invoice->Amount_collection, 2) }}" disabled>
            </div>
        </div>

        <!-- Card Element -->
        <div class="row mb-4">
            <div class="col">
                <label for="card-element">Credit or Debit Card</label>
                <div id="card-element" class="card-element"></div>
                <div id="card-errors" role="alert" class="text-danger"></div>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary btn-block" id="submit-btn">Pay Now</button>

        <!-- Loading Indicator -->
        <div class="loading text-center mt-4">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Processing...</span>
            </div>
        </div>
    </form>

</div>

<script>
    // Stripe Elements
    var stripe = Stripe("{{ config('services.stripe.key') }}");
    var elements = stripe.elements();

    // Create an instance of the card Element
    var card = elements.create("card", {
        hidePostalCode: true,
        style: {
            base: {
                fontSize: '16px',
                lineHeight: '1.5',
                color: '#333',
                backgroundColor: 'white',
                padding: '10px',
                borderRadius: '4px',
            }
        }
    });
    card.mount("#card-element");

    // Handle form submission
    var form = document.getElementById("payment-form");
    var submitButton = document.getElementById("submit-btn");
    var loadingIndicator = document.querySelector(".loading");

    form.addEventListener("submit", function (event) {
        event.preventDefault();

        submitButton.disabled = true;
        loadingIndicator.classList.add("show");

        stripe.createToken(card).then(function (result) {
            if (result.error) {
                var errorElement = document.getElementById("card-errors");
                errorElement.textContent = result.error.message;
                submitButton.disabled = false;
                loadingIndicator.classList.remove("show");
            } else {
                var token = result.token;
                var hiddenInput = document.createElement("input");
                hiddenInput.setAttribute("type", "hidden");
                hiddenInput.setAttribute("name", "stripeToken");
                hiddenInput.setAttribute("value", token.id);
                form.appendChild(hiddenInput);

                form.submit();
            }
        });
    });
</script>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
