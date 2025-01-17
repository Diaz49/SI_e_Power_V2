<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoInvoice - Login</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <!-- Fonts and icons -->
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #004AAD , #007BFF 90%);
        }
        .container-fluid {
            display: flex;
            height: 100%;
            overflow: hidden;
        }
        .left-section {
            flex: 2;
            color: #fff;
            padding: 4rem 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            position: relative;
        }
        .left-section h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            z-index: 2;
            font-weight: 700;
        }
        .left-section p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            line-height: 1.8;
            z-index: 2;
        }
        .left-section a {
            background: #fff;
            color: #004AAD;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: bold;
            text-decoration: none;
            font-size: 0.9rem;
            transition: transform 0.3s ease;
            z-index: 2;
        }
        .left-section a:hover {
            transform: scale(1.1);
        }
        .circle {
            position: absolute;
            border-radius: 50%;
            z-index: 1;
        }
        .circle-outline {
            border: 4px solid rgba(255, 255, 255, 0.3);
            background: transparent;
        }
        .circle-filled {
            background: rgba(255, 255, 255, 0.2);
        }
        /* Lingkaran Outline */
        .circle-1 {
            width: 300px;
            height: 300px;
            bottom: -50px;
            left: -50px;
            transform: rotate(45deg);
        }
        .circle-2 {
            width: 450px;
            height: 450px;
            bottom: -150px;
            left: -250px;
            transform: rotate(-30deg);
        }
        /* Lingkaran Penuh */
        .circle-3 {
            width: 300px;
            height: 300px;
            top: -120px;
            right: -170px;
        }
        .circle-4 {
            width: 400px;
            height: 400px;
            top: -210px;
            right: -40px;
        }
        .right-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: linear-gradient(145deg, #f5f7fa, #ffffff);
            box-shadow: -10px 0 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            text-align: center;
        }
        .right-section h2 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 0.5rem;
        }
        .right-section p {
            font-size: 1rem;
            color: #555;
            margin-bottom: 2rem;
        }
        .right-section form {
            width: 100%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .input-group {
            position: relative;
            width: 100%;
            display: flex;
            align-items: center;
            border-radius: 8px;
            overflow: hidden;
        }

        .input-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #737f8b;
            font-size: 1.2rem;
            z-index: 2; /* Menjaga ikon di atas input */
        }

        .form-control {
            border-radius: 8px;
            font-size: 1rem;
            height: 45px;
            padding-left: 40px; /* Memberi ruang untuk ikon */
            width: 100%;
            z-index: 1; /* Input di bawah ikon */
            border: 1px solid #ced4da;
        }

        .form-control:focus {
            border-color: #007BFF;
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
        }

        .btn-primary {
            background: #007BFF;
            border: none;
            padding: 0.8rem;
            width: 100%;
            font-size: 1rem;
            border-radius: 8px;
            font-weight: bold;
            transition: background 0.3s;
        }
        .btn-primary:hover {
            background: #0056b3;
        }
        .additional-info {
            font-size: 0.9rem;
            color: #888;
            margin-top: 1.5rem;
            text-align: center;
        }
        .additional-info a {
            color: #3d4045;
            text-decoration: none;
            font-weight: italic;
            transition: color 0.3s ease;
        }
        .additional-info a:hover {
            color: #3d4045;
        }
        @media (max-width: 768px) {
            .left-section {
                display: none; /* Menyembunyikan bagian kiri di layar kecil */
            }

            .right-section {
                flex: 1;
                padding: 2rem;
                background: #ffffff;
                box-shadow: none;
                height: 100vh; /* Memastikan tinggi penuh untuk tampilan mobile */
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            .right-section h2 {
                font-size: 2.2rem;
                margin-bottom: 1rem;
            }

            .right-section p {
                font-size: 1rem;
                margin-bottom: 2rem;
            }

            .input-group {
                width: 100%;
                margin-bottom: 1rem;
            }

            .form-control {
                font-size: 1.2rem;
                height: 50px;
                padding-left: 45px; /* Memberi lebih banyak ruang untuk ikon */
            }

            .btn-primary {
                width: 100%;
                padding: 1rem;
                font-size: 1.2rem;
                border-radius: 8px;
            }

            .additional-info {
                font-size: 1rem;
                color: #888;
                margin-top: 1.5rem;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Left Section -->
        <div class="left-section">
            <!-- Lingkaran Outline -->
            <div class="circle circle-outline circle-1"></div>
            <div class="circle circle-outline circle-2"></div>

            <!-- Lingkaran Penuh -->
            <div class="circle circle-filled circle-3"></div>
            <div class="circle circle-filled circle-4"></div>

            <h1>Go-Invoice</h1>
            <p>"Log in to the MPA Group app to manage invoices effortlessly and monitor financial graphs with a smart and interactive interface."</p>
            <a href="#" data-bs-toggle="modal" data-bs-target="#readMoreModal">Read More</a>
        </div>

        <!-- Right Section -->
        <div class="right-section">
            <h2>Hello Team MPA Group!</h2>
            <p>Welcome Back</p>
            <form action="{{ route('login.authenticate') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <input type="text" name="username" placeholder="Username" class="form-control" required>
                </div>
                
                <div class="input-group mb-3">
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input type="password" name="password" placeholder="Password" class="form-control" required>
                </div>

                @error('message')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            
            <div class="additional-info">
                <p>
                    <a href="#">Forget Password ?</a>
                    <a> & </a>
                    <a href="#">More Info ? Contact Developer</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Modal for Read More -->
    <div class="modal fade" id="readMoreModal" tabindex="-1" aria-labelledby="readMoreModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="readMoreModalLabel">About Go-Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Go-Invoice is your smart solution for managing invoices and tracking financial insights. With an interactive interface, you can access graphs, monitor trends, and simplify your workflow in just a few clicks. Explore the power of automation with GoInvoice today!</h6>
                    
                    <hr>

                    <h5>Project Information</h5>
                    <p><strong>Created by:</strong> Students of Politeknik Negeri Jember, Year 2025</p>
                    {{-- <p><strong>Contact:</strong> <a href="mailto:desainmpro@gmail.com">desainmpro@gmail.com</a></p> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
</body>
</html>
