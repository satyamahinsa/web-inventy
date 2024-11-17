<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Konfirmasi Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://app.stg.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
</head>

<body>
    <main class="py-5">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8 col-12">
                    <h2 class="fs-5 py-4 text-center">Konfirmasi Pembayaran</h2>
                    <div class="card border rounded shadow">
                        <div class="card-body">
                            <form id="donation-form" method="POST">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" id="name" name="name"
                                        value="{{ auth()->user()->name }}" class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email"
                                        value="{{ auth()->user()->email }}" class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Nomor Telepon</label>
                                    <input type="text" id="phone" name="phone" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat</label>
                                    <textarea id="address" name="address" class="form-control" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="subtotal" class="form-label">Subtotal Pembelian</label>
                                    <input type="text" id="subtotal" name="amount"
                                        value="{{ number_format($grandTotal, 0, ',', '.') }}" class="form-control"
                                        readonly>
                                </div>
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary w-100" id="pay-button">Bayar
                                        Sekarang</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            window.snap.pay(' $snapToken ', {
                onSuccess: function(result){
                    alert("Payment success!"); 
                    console.log(result);
                },
                onPending: function(result){
                    alert("Waiting for your payment!"); 
                    console.log(result);
                },
                onError: function(result){
                    alert("Payment failed!"); 
                    console.log(result);
                },
                onClose: function(){
                    alert('You closed the popup without finishing the payment');
                }
            });
        });
    </script>
</body>
</html>
