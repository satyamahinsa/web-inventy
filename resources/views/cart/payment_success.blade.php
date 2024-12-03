<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pembayaran Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <main class="py-5">
        <div class="container" style="max-width: 500px; margin: auto;">
            <div class="card border rounded shadow"
                style="background-color: #fff7e6; border: 1px solid #e5b378; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="card-body" style="padding: 15px;">
                    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; background-color: #fbd38d; padding: 15px; border-radius: 10px; margin-bottom: 15px;">
                        <img src="{{ asset('imageAuth/succes.gif') }}" alt="Gift Animation" style="display: block; margin: 10px auto; width: 200px; height: auto;">
                        <h4 style="margin-bottom: 10px; font-size: 1.25rem;">Terima kasih, pembayaran Anda telah berhasil!</h4> 
                        <p style="margin-bottom: 10px; font-size: 0.875rem;">Kami sedang memproses pesanan Anda. Berikut rincian pesanan Anda:</p>
                    </div>

                    <div
                        style="background-color: #f8f9fa; padding: 15px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: 1px solid #e0e0e0;">
                        <h5 style="margin-bottom: 10px; color: #e94e77; font-size: 1rem; text-align: center;">Detail Pembayaran</h5>
                        <ul
                            style="list-style-type: none; padding: 0; margin: 0; text-align: left; display: inline-block;">
                            <li style="margin-bottom: 8px; color: #333; font-size: 0.875rem;"><strong>Nama:</strong> {{ $order->name }}</li>
                            <li style="margin-bottom: 8px; color: #333; font-size: 0.875rem;"><strong>Email:</strong> {{ $order->email }}</li>
                            <li style="margin-bottom: 8px; color: #333; font-size: 0.875rem;"><strong>Telepon:</strong> {{ $order->phone }}</li>
                            <li style="margin-bottom: 8px; color: #333; font-size: 0.875rem;"><strong>Alamat:</strong> {{ $order->address }}</li>
                            <li style="margin-bottom: 8px; color: #333; font-size: 0.875rem;"><strong>Produk yang Dibeli:</strong>
                                <ul>
                                    @foreach ($products as $product)
                                        <li>{{ $product->name }} ({{ $product->pivot->quantity }})</li>
                                    @endforeach
                                </ul>
                            </li>
                            <li style="margin-bottom: 8px; color: #333; font-size: 0.875rem;"><strong>Total Pembayaran:</strong> Rp {{ number_format($order->total_amount, 0, ',', '.') }}</li>
                            <li style="margin-bottom: 8px; color: #333; font-size: 0.875rem;"><strong>Metode Pembayaran:</strong> {{ strtoupper($order->payment_method) }}</li>
                        </ul>
                    </div>


                    <div style="text-align: center; margin-top: 10px;">
                        <a href="{{ route('cart.index') }}" class="btn btn-primary"
                            style="background-color: #fba94c; border-color: #d27812; color: #fff; padding: 8px 16px; border-radius: 5px; text-decoration: none; display: inline-block; font-size: 0.875rem;"
                            onmouseover="this.style.backgroundColor='#d88a2e'; this.style.borderColor='#d88a2e';"
                            onmouseout="this.style.backgroundColor='#fba94c'; this.style.borderColor='#fba94c';">
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
