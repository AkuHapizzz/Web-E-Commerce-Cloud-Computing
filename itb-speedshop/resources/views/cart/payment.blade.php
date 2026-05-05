<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - ITB.SpeedShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-900 overflow-x-hidden min-h-screen flex flex-col">

    <x-navbar-guest />

    <!-- Progress Bar -->
    <div class="bg-black text-white py-6">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="font-black text-xl md:text-2xl tracking-tighter italic">
                <span class="text-white hover:text-gray-300 transition">Shopping Cart</span> 
                <span class="text-gray-600 mx-3">&rarr;</span> 
                <span class="text-white hover:text-gray-300 transition">Checkout</span> 
                <span class="text-gray-600 mx-3">&rarr;</span> 
                <span class="text-white border-b-2 border-red-600 pb-1">Payment</span>
            </h2>
        </div>
    </div>

    <div class="py-24 bg-gray-50 flex-grow flex items-center justify-center">
        <div class="max-w-md w-full bg-white shadow-xl sm:rounded-xl border border-gray-100 p-8 text-center mx-6">
            <h3 class="text-2xl font-extrabold text-gray-900 mb-2 uppercase italic">Menunggu Pembayaran</h3>
            <p class="text-gray-500 text-sm mb-8 font-bold">Harap selesaikan pembayaranmu melalui Midtrans.</p>
            
            <div class="bg-gray-50 border border-gray-100 rounded-xl p-6 mb-8">
                <div class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">TOTAL BAYAR</div>
                <div class="text-3xl font-black text-red-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                <div class="text-xs text-gray-400 font-bold mt-2">Order ID: #ORD-{{ $order->id }}</div>
            </div>

            <button id="pay-button" class="w-full bg-red-600 outline-none hover:bg-black text-white py-4 rounded-xl font-bold uppercase tracking-widest transition shadow-lg shadow-red-100 flex items-center justify-center space-x-2">
                <span>BAYAR SEKARANG</span>
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </button>
            <a href="{{ route('dashboard') }}" class="block mt-4 text-xs font-bold text-gray-400 hover:text-gray-600 uppercase tracking-widest">Batalkan</a>
        </div>
    </div>

    <x-footer-guest />

    <!-- Gunakan Sandbox JS Midtrans sesuai standard integrasi. Saat diganti production rubah URL nya -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY', 'SB-Mid-client-YOUR_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
      var payButton = document.getElementById('pay-button');
      
      payButton.onclick = function(){
        @if($snapToken)
            // SnapToken Acquired from Controller
            snap.pay('{{ $snapToken }}', {
              // Optional
              onSuccess: function(result){
                window.location.href = "{{ route('checkout.success', $order->id) }}";
              },
              onPending: function(result){
                window.location.href = "{{ route('dashboard') }}";
              },
              onError: function(result){
                alert("Pembayaran gagal!");
                window.location.href = "{{ route('dashboard') }}";
              },
              onClose: function(){
                // user closed the popup without finishing payment
                alert("Anda menutup jendela pembayaran sebelum menyelesaikannya.");
              }
            });
        @else
            alert("Terjadi kesalahan, Snap Token gagal dibuat. Pastikan Key Midtrans dimasukkan di konfigurasi sistem.");
        @endif
      };

      // Auto-open Snap on page load
      window.onload = function() {
          payButton.click();
      };
    </script>
</body>
</html>
