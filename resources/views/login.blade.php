<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}
    <style>
        /* Gaya dasar untuk body */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #4b6cb7, #182848);
            font-family: Arial, sans-serif;
            cursor: none; /* Hilangkan kursor default */
        }

        /* Gaya untuk kursor kustom */
        .custom-cursor {
            width: 20px;
            height: 20px;
            position: absolute;
            background-color: rgba(75, 108, 183, 0.8);
            border-radius: 50%;
            pointer-events: none; /* Agar tidak mengganggu interaksi */
            transition: transform 0.1s ease, opacity 0.3s ease;
            transform: translate(-50%, -50%);
            z-index: 1000;
        }

        /* Kontainer utama untuk form login */
        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
            position: relative;
            width: 100%;
            max-width: 400px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        /* Animasi Fade In */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            50% { transform: translateX(5px); }
            75% { transform: translateX(-5px); }
        }

        .shake {
            animation: shake 0.5s;
        }

        /* Judul */
        .login-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #4b6cb7;
        }

        /* Gaya input */
        .form-input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        /* Tombol login */
        .login-button {
            width: 100%;
            padding: 12px;
            background-color: #4b6cb7;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-button:hover {
            background-color: #3a539b;
        }

        /* Efek Hover pada Input */
        .form-input:focus {
            border-color: #4b6cb7;
            outline: none;
        }
        /* Gaya untuk background gelombang */
.wave-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: -1; /* Letakkan di belakang konten */
}

/* Gelombang Pertama */
.wave-background::before,
.wave-background::after {
    content: "";
    position: absolute;
    width: 200%;
    height: 200px;
    background: rgba(75, 108, 183, 0.5);
    top: 80%;
    left: -50%;
    border-radius: 45%;
    animation: wave-animation 10s infinite linear;
}

/* Gelombang Kedua */
.wave-background::after {
    background: rgba(75, 108, 183, 0.3);
    animation: wave-animation 8s infinite linear reverse;
}

/* Animasi untuk gelombang bergerak */
@keyframes wave-animation {
    0% { transform: translateX(0); }
    50% { transform: translateX(10%); } /* Bergerak sedikit ke kanan untuk efek gelombang */
    100% { transform: translateX(0); }
}

/* Gaya untuk elemen kapal */
.boat {
    position: absolute;
    bottom: 12%; /* Tinggi kapal di atas gelombang */
    left: 80%;
    width: 180px;
    height: 180px;
    background-image: url('https://img2.pngdownload.id/20180219/fbw/kisspng-caravel-ship-clip-art-ship-vector-5a8aab4c6901f2.8635440015190372604301.jpg'); /* Ganti dengan URL gambar kapal */
    background-size: contain;
    background-repeat: no-repeat;
    animation: boat-movement 5s infinite ease-in-out;
}

/* Animasi gerakan kapal */
@keyframes boat-movement {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); } /* Gerakan naik-turun untuk efek gelombang */
}


    </style>
</head>
<body>
    <!-- Background Gelombang -->
    <div class="wave-background">
        <!-- Elemen Kapal -->
        <div class="boat"></div>
    </div>

    <div class="login-container">
        <h2 class="login-title">Login</h2>
        {{-- <form action="{{ route('login') }}" method="POST"> --}}
            @csrf
            <input type="email" name="email" placeholder="Email" class="form-input" required autofocus>
            <input type="password" name="password" placeholder="Password" class="form-input" required>
            {{-- <a href="{{ route('dashboard') }}"> --}}
                <button type="button" class="login-button" onclick="window.location.href='{{ route('dashboard') }}'">Log In</button>
            {{-- </a> --}}
            {{-- </form> --}}
    </div>
    <div class="custom-cursor"></div>
<script>
    document.querySelector('.login-button').addEventListener('click', function(event) {
        event.preventDefault(); // Mencegah pengiriman form untuk demo
        const loginContainer = document.querySelector('.login-container');
        loginContainer.classList.add('shake');

        setTimeout(() => {
            loginContainer.classList.remove('shake');
        }, 500);

        // Kirim form setelah animasi
        setTimeout(() => {
            document.querySelector('form').submit();
        }, 500);
    });
    
    const customCursor = document.querySelector('.custom-cursor');

    // Tambahkan event listener untuk mengupdate posisi kursor kustom saat mouse bergerak
    document.addEventListener('mousemove', (e) => {
        customCursor.style.left = `${e.pageX}px`;
        customCursor.style.top = `${e.pageY}px`;
        customCursor.style.opacity = 1;
    });

    // Tambahkan animasi tambahan saat mouse berada di area klik atau input
    const interactiveElements = document.querySelectorAll('button, input');

    interactiveElements.forEach((element) => {
        element.addEventListener('mouseover', () => {
            customCursor.style.transform = 'scale(1.5)'; // Perbesar lingkaran
            customCursor.style.backgroundColor = 'rgba(58, 83, 155, 0.8)'; // Ubah warna
        });

        element.addEventListener('mouseout', () => {
            customCursor.style.transform = 'scale(1)'; // Kembali ke ukuran normal
            customCursor.style.backgroundColor = 'rgba(75, 108, 183, 0.8)'; // Kembali ke warna awal
        });
});
</script>
</body>
</html>
