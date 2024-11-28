<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konfirmasi Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .radio-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 10px;
        }

        .radio-buttons label {
            display: flex;
            align-items: center;
            cursor: pointer;
            border: 3px solid transparent;
            transition: border-color 0.3s;
        }

        .radio-buttons input:checked+img {
            border-color: #d88a2e;
            border-width: 4px;
        }

        .radio-buttons img {
            width: 50px;
            height: 50px;
            border: 2px solid #ddd;
            border-radius: 8px;
            transition: border-color 0.3s;
        }

        .radio-buttons input {
            display: none;
        }

        .radio-buttons label:hover img {
            border-color: #d88a2e;
        }

        /* Loading spinner */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            visibility: hidden;
            opacity: 0;
            transition: visibility 0s, opacity 0.3s;
        }

        .loading-overlay.active {
            visibility: visible;
            opacity: 1;
        }

        .spinner-border {
            color: #d88a2e;
        }
    </style>
</head>

<body>
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <main class="py-5">
        <div class="container" style="max-width: 600px; margin: auto;">
            <h2 class="fs-5 py-4 text-center" style="color: #d88a2e;">Konfirmasi Pembayaran</h2>
            <div class="card border rounded shadow" style="background-color: #fff7e6; border-color: #d88a2e;">
                <div class="card-body" style="padding: 15px;">
                    <form id="paymentForm" action="{{ route('order.processPayment') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label" style="color: #d88a2e;">Nama</label>
                            <input type="text" id="name" name="name" value="{{ auth()->user()->name }}"
                                class="form-control" readonly style="background-color: #ffffff; border-color: #d88a2e;">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label" style="color: #d88a2e;">Email</label>
                            <input type="email" id="email" name="email" value="{{ auth()->user()->email }}"
                                class="form-control" readonly style="background-color: #ffffff; border-color: #d88a2e;">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label" style="color: #d88a2e;">Nomor Telepon</label>
                            <input type="number" id="phone" name="phone" class="form-control" required
                                style="background-color: #ffffff; border-color: #d88a2e;">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label" style="color: #d88a2e;">Alamat</label>
                            <textarea id="address" name="address" class="form-control" rows="3" required
                                style="background-color: #ffffff; border-color: #d88a2e;"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="payment-method" class="form-label" style="color: #d88a2e;">Pilih Metode
                                Pembayaran</label>
                            <select id="payment-method" class="form-select" onchange="showPaymentOptions()">
                                <option value="">-- Pilih Metode Pembayaran --</option>
                                <option value="bank">Transfer Bank</option>
                                <option value="wallet">Dompet Digital</option>
                            </select>
                        </div>

                        {{-- Payment method disimpan di JavaScript untuk mempermudah tampilan dinamis dan pengolahan pilihan tanpa reload. --}}
                        <div id="paymentOptions" class="radio-buttons"></div>
                        <input type="hidden" id="payment-method-hidden" name="payment_method">

                        <div class="mb-3">
                            <label for="subtotal" class="form-label" style="color: #d88a2e;">Subtotal Pembelian</label>
                            <input type="hidden" id="amount" name="amount" value="{{ $grandTotal }}">
                            <input type="text" id="subtotal" value="{{ number_format($grandTotal, 0, ',', '.') }}"
                                class="form-control" readonly style="background-color: #ffffff; border-color: #d88a2e;">
                        </div>
                        <button type="button" id="payNowButton" class="btn"
                            style="background-color: #d88a2e; color: #fff; width: 100%; padding: 10px 0; border-radius: 5px; border: none; display: flex; align-items: center; justify-content: center; font-size: 1rem;"
                            onmouseover="this.style.backgroundColor='#b77a1e';"
                            onmouseout="this.style.backgroundColor='#d88a2e';">
                            <i class="fas fa-shopping-cart me-2"></i> Bayar Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('payNowButton').addEventListener('click', function() {
            const phone = document.getElementById('phone').value;
            const address = document.getElementById('address').value;
            const selectedMethod = document.getElementById('payment-method').value;
            const paymentOption = document.querySelector('input[name="bankOption"]:checked') || 
                                  document.querySelector('input[name="walletOption"]:checked');

            if (phone.length > 13) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Nomor telepon tidak boleh lebih dari 13 angka!',
                });
                return;
            }
            if (!phone || !address || !selectedMethod || !paymentOption) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Silakan melengkapi formulir dengan nomor telepon, alamat, dan memilih metode pembayaran!',
                });
                return;
            }

            const loadingOverlay = document.getElementById('loadingOverlay');
            const form = document.getElementById('paymentForm');

            loadingOverlay.classList.add('active');
            setTimeout(() => {
                form.submit();
            }, 5000);
        });

        function showPaymentOptions() {
            const selectedMethod = document.getElementById('payment-method').value;
            const optionsDiv = document.getElementById('paymentOptions');
            optionsDiv.innerHTML = '';

            if (selectedMethod === 'bank') {
                optionsDiv.innerHTML = `
                    <label><input type="radio" name="bankOption" value="bri" onclick="document.getElementById('payment-method-hidden').value='BRI'"> <img src="{{ asset('Payment/BRI.png') }}" alt="BRI Logo"></label>
                    <label><input type="radio" name="bankOption" value="bni" onclick="document.getElementById('payment-method-hidden').value='BNI'"> <img src="{{ asset('Payment/BNI.png') }}" alt="BNI Logo"></label>
                    <label><input type="radio" name="bankOption" value="bca" onclick="document.getElementById('payment-method-hidden').value='BCA'"> <img src="{{ asset('Payment/BCA.png') }}" alt="BCA Logo"></label>
                    <label><input type="radio" name="bankOption" value="mandiri" onclick="document.getElementById('payment-method-hidden').value='Mandiri'"> <img src="{{ asset('Payment/Mandiri.png') }}" alt="Mandiri Logo"></label>
                    <label><input type="radio" name="bankOption" value="SeaBank" onclick="document.getElementById('payment-method-hidden').value='SeaBank'"> <img src="{{ asset('Payment/SeaBank.png') }}" alt="SeaBank Logo"></label>
                `;
            } else if (selectedMethod === 'wallet') {
                optionsDiv.innerHTML = `
                    <label><input type="radio" name="walletOption" value="dana" onclick="document.getElementById('payment-method-hidden').value='Dana'"> <img src="{{ asset('Payment/Dana.png') }}" alt="Dana Logo"></label>
                    <label><input type="radio" name="walletOption" value="ovo" onclick="document.getElementById('payment-method-hidden').value='OVO'"> <img src="{{ asset('Payment/Ovo.png') }}" alt="OVO Logo"></label>
                    <label><input type="radio" name="walletOption" value="gopay" onclick="document.getElementById('payment-method-hidden').value='GoPay'"> <img src="{{ asset('Payment/Gopay.png') }}" alt="GoPay Logo"></label>
                    <label><input type="radio" name="walletOption" value="LinkAja" onclick="document.getElementById('payment-method-hidden').value='LinkAja'"> <img src="{{ asset('Payment/LinkAja.png') }}" alt="LinkAja Logo"></label>
                    <label><input type="radio" name="walletOption" value="ShopeePay" onclick="document.getElementById('payment-method-hidden').value='ShopeePay'"> <img src="{{ asset('Payment/shoopepay.png') }}" alt="ShopeePay Logo"></label>
                `;
            }
        }
    </script>
</body>
</html>
