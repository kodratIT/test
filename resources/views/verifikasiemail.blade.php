<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Verifikasi Email</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">

  <div class="bg-white shadow-xl rounded-xl p-8 max-w-md w-full text-center space-y-6">
    
    <!-- Icon Email -->
    <div class="flex justify-center">
      <div class="bg-gray-100 p-4 rounded-full shadow">
        <svg class="w-10 h-10 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
          <path d="M2.01 6.4L12 13.2l9.99-6.8A2 2 0 0 0 20 4H4a2 2 0 0 0-1.99 2.4z"/>
          <path d="M22 8.8l-10 6.8-10-6.8V18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8.8z"/>
        </svg>
      </div>
    </div>

    <!-- Judul -->
    <h2 class="text-2xl font-bold text-gray-800">
      Verifikasi Email Anda
    </h2>

    <!-- Deskripsi -->
    <p class="text-gray-600 text-sm leading-relaxed">
      Akun Anda sudah selesai dibuat.<br />
      Silakan masukkan <span class="font-medium text-gray-800">kode verifikasi</span> yang telah dikirimkan melalui email Anda.
      Kode ini berlaku selama <span class="font-semibold text-gray-800">5 menit</span>.
    </p>

    <!-- Form -->
    <form method="POST" action="#" class="flex w-full mt-4">
      <p>Halo {{ $user->name }},</p>
<p>Kamu meminta untuk mengganti kata sandi. Klik link di bawah ini untuk mengatur ulang kata sandi. Link hanya bisa dipakai sekali dan berlaku 10 menit:</p>
<p><a href="{{ $url }}">{{ $url }}</a></p>
<p>Kalau kamu tidak meminta ini, abaikan saja.</p>
      <button
        type="submit"
        class="px-5 py-3 bg-yellow-500 text-white text-sm font-medium rounded-r-md hover:bg-teal-600 transition"
      >
        Verifikasi
      </button>
    </form>

    <!-- Footer -->
    <p class="text-xs text-gray-500 pt-1">
      Belum menerima kode? <a href="#" class="text-teal-500 hover:underline">Kirim ulang</a>
    </p>

  </div>

</body>
</html>
