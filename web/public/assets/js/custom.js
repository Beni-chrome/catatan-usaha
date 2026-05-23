function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR'
    }).format(angka);
}

function previewTema(primer, sekunder) {
    document.documentElement.style.setProperty(
        '--bs-primary',
        primer
    );

    document.documentElement.style.setProperty(
        '--bs-secondary',
        sekunder
    );
}

function hitungTotal(jumlahId, hargaId, totalId) {
    const jumlah = parseFloat(
        document.getElementById(jumlahId).value || 0
    );

    const harga = parseFloat(
        document.getElementById(hargaId).value || 0
    );

    const total = jumlah * harga;

    document.getElementById(totalId).value = total;
}

function showToast(message) {
    const toastEl = document.getElementById('liveToast');

    if (!toastEl) return;

    document.getElementById('toastMessage').innerText = message;

    const toast = new bootstrap.Toast(toastEl);

    toast.show();
}
