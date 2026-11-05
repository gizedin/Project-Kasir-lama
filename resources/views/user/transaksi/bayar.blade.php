<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

@php
    $harga = $barang->harga;
    $tipeDiskon = $barang->diskon?->tipe;
    $nilaiDiskon = $barang->diskon?->nilai ?? 0;
@endphp

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-success text-white">
                    Konfirmasi Pembayaran
                </div>
                <div class="card-body">
                    <p><strong>Barang :</strong> {{ $barang->namabarang }}</p>
                    <p>
                        <strong>Stok Tersedia :</strong>
                        <span id="stokView">{{ $barang->stok }}</span>
                    </p>

                    <form method="POST" action="{{ route('user.transaksi.store') }}" id="paymentForm">
                        @csrf
                        <input type="hidden" name="barang_id" value="{{ $barang->id }}">
                        <input type="hidden" name="harga_asli" id="harga_asli">
                        <input type="hidden" name="diskon" id="diskon_input">
                        <input type="hidden" name="harga_final" id="total_input">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Jumlah</label>
                            <input type="number"
                                   id="qty"
                                   name="qty"
                                   class="form-control"
                                   min="1"
                                   max="{{ $barang->stok }}"
                                   value="1"
                                   required>
                            <div class="form-text text-danger" id="qtyError"></div>
                        </div>

                        <hr>

                        <p>Harga Satuan : Rp <span id="hargaView">0</span></p>
                        <p>Subtotal : Rp <span id="subtotalView">0</span></p>
                        <p>Diskon : Rp <span id="diskonView">0</span></p>

                        <h5 class="fw-bold">
                            Total Bayar : Rp <span id="totalView">0</span>
                        </h5>

                        <div class="mb-3 mt-3">
                            <label class="form-label">Metode Pembayaran</label>
                            <select name="payment" class="form-select" required>
                                <option value="">-- pilih --</option>
                                <option value="cash">Cash</option>
                                <option value="transfer">Transfer</option>
                                <option value="ewallet">E-Wallet</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            Bayar Sekarang
                        </button>

                        <a href="{{ route('home') }}" class="btn btn-light w-100 mt-2">
                            Batal
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const harga = {{ $harga }};
const tipeDiskon = "{{ $tipeDiskon }}";
const nilaiDiskon = {{ $nilaiDiskon }};
const stokAwal = {{ $barang->stok }};

const qtyInput = document.getElementById('qty');
const stokView = document.getElementById('stokView');
const hargaView = document.getElementById('hargaView');
const subtotalView = document.getElementById('subtotalView');
const diskonView = document.getElementById('diskonView');
const totalView = document.getElementById('totalView');
const hargaAsliInput = document.getElementById('harga_asli');
const diskonInput = document.getElementById('diskon_input');
const totalInput = document.getElementById('total_input');
const qtyError = document.getElementById('qtyError');
const paymentForm = document.getElementById('paymentForm');

function formatRupiah(n) {
    return new Intl.NumberFormat('id-ID').format(n);
}

function hitung() {
    let qty = parseInt(qtyInput.value);
    
    // Validasi input
    if (isNaN(qty) || qty < 1) {
        qty = 1;
        qtyInput.value = 1;
    }
    
    if (qty > stokAwal) {
        qty = stokAwal;
        qtyInput.value = stokAwal;
        qtyError.textContent = `Jumlah melebihi stok. Maksimal: ${stokAwal}`;
    } else {
        qtyError.textContent = '';
    }

    // Update stok view
    const stokSisa = stokAwal - qty;
    stokView.textContent = stokSisa;

    // Hitung harga
    const subtotal = harga * qty;
    let diskon = 0;
    
    if (tipeDiskon === 'persen') {
        diskon = subtotal * nilaiDiskon / 100;
    } else if (tipeDiskon === 'nominal') {
        diskon = nilaiDiskon;
    }
    
    // Pastikan diskon tidak lebih dari subtotal
    if (diskon > subtotal) {
        diskon = subtotal;
    }
    
    const total = subtotal - diskon;

    // Update tampilan
    hargaView.textContent = formatRupiah(harga);
    subtotalView.textContent = formatRupiah(subtotal);
    diskonView.textContent = formatRupiah(diskon);
    totalView.textContent = formatRupiah(total);

    // Update hidden inputs
    hargaAsliInput.value = subtotal;
    diskonInput.value = diskon;
    totalInput.value = total;
}

// Variabel untuk melacak nilai sebelumnya
let previousValue = qtyInput.value;

// Event listeners
qtyInput.addEventListener('input', function(e) {
    // Izinkan input kosong sementara
    const newValue = this.value;
    
    // Hanya izinkan angka
    if (newValue !== '' && !/^\d+$/.test(newValue)) {
        this.value = previousValue;
        return;
    }
    
    // Simpan nilai baru
    previousValue = newValue;
    
    // Jika tidak kosong, hitung
    if (newValue !== '') {
        hitung();
    } else {
        // Kosongkan tampilan sementara
        subtotalView.textContent = '0';
        diskonView.textContent = '0';
        totalView.textContent = '0';
        hargaAsliInput.value = 0;
        diskonInput.value = 0;
        totalInput.value = 0;
        stokView.textContent = stokAwal;
    }
});

qtyInput.addEventListener('blur', function() {
    if (this.value === '' || parseInt(this.value) < 1) {
        this.value = 1;
        hitung();
    } else if (this.value > stokAwal) {
        this.value = stokAwal;
        hitung();
    }
});

qtyInput.addEventListener('keydown', function(e) {
    // Izinkan tombol backspace, delete, arrow keys, dll.
    const allowedKeys = [
        'Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 
        'ArrowUp', 'ArrowDown', 'Tab', 'Home', 'End'
    ];
    
    // Izinkan Ctrl/Command + A, C, V, X
    if (e.ctrlKey || e.metaKey) {
        return;
    }
    
    // Blokir karakter non-digit, tapi izinkan backspace
    if (!/^\d$/.test(e.key) && !allowedKeys.includes(e.key)) {
        e.preventDefault();
    }
});

// Handle form submission
paymentForm.addEventListener('submit', function(e) {
    const qty = parseInt(qtyInput.value);
    
    if (isNaN(qty) || qty < 1 || qty > stokAwal) {
        e.preventDefault();
        qtyError.textContent = 'Jumlah tidak valid. Harap periksa kembali.';
        qtyInput.focus();
        return false;
    }
    
    // Validasi metode pembayaran
    const paymentSelect = document.querySelector('select[name="payment"]');
    if (!paymentSelect.value) {
        e.preventDefault();
        alert('Pilih metode pembayaran terlebih dahulu!');
        paymentSelect.focus();
        return false;
    }
});

// Initialize calculation
hitung();
</script>

</body>
</html>