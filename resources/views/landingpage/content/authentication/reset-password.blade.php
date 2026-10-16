@extends('landingpage.layouts.default.main')

@section('content')

    <style>
        :root {
            --primary-blue: #0194F3;
            --primary-dark-blue: #0064D2;
            --primary-light-blue: #33ADFF;
        }

        /* Full Page */
        .forgot-password-page {
            position: fixed;
            inset: 0;
            width: 100vw;
            height: 100vh;
            background-image: url('{{ asset('landingpage/login.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            overflow: hidden;
        }

        /* Gradient Overlay */
        .forgot-password-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg,
                    rgba(1, 148, 243, 0.40) 0%,
                    rgba(0, 100, 210, 0.30) 50%,
                    rgba(15, 41, 77, 0.20) 100%);
            z-index: 1;
        }

        /* Content */
        .forgot-password-content {
            position: relative;
            z-index: 2;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1.5rem;
            overflow-y: auto;
        }

        /* Logo */
        .forgot-password-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            color: white;
            text-decoration: none;
        }

        /* Card */
        .forgot-password-card {
            width: 100%;
            max-width: 28rem;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.96);
            border-radius: 1.5rem;
            border: 1px solid #B3E0FF;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(8px);
            animation: forgotPasswordSlideUp 0.7s ease-out forwards;
        }

        /* Input */
        .forgot-password-input {
            width: 100%;
            padding: 0.75rem;
            border-radius: 0.75rem;
            background-color: #E6F4FF;
            border: 2px solid #B3E0FF;
            color: #0F294D;
            transition: all 0.3s ease;
            outline: none;
            box-sizing: border-box;
        }

        .forgot-password-input:focus {
            border-color: #0194F3;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(1, 148, 243, 0.10);
        }

        /* Button */
        .forgot-password-button {
            width: 100%;
            padding: 0.875rem 1.25rem;
            border-radius: 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: white !important;
            background: linear-gradient(135deg,
                    #0194F3 0%,
                    #0064D2 100%) !important;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(1, 148, 243, 0.20);
        }

        .forgot-password-button:hover {
            background: linear-gradient(135deg,
                    #33ADFF 0%,
                    #0194F3 100%) !important;
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(1, 148, 243, 0.35);
        }

        /* Link */
        .forgot-password-link {
            color: #0194F3;
            font-size: 0.875rem;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .forgot-password-link:hover {
            color: #33ADFF;
            text-decoration: underline;
        }

        /* Animation */
        @keyframes forgotPasswordSlideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Mobile */
        @media (max-width: 480px) {
            .forgot-password-content {
                padding: 1.25rem;
            }

            .forgot-password-card {
                padding: 1.5rem;
            }
        }
    </style>


    {{-- Full Page Background --}}
    <div class="forgot-password-page">

        {{-- Gradient Overlay --}}
        <div class="forgot-password-overlay"></div>


        {{-- Content --}}
        <div class="forgot-password-content">

            {{-- Logo --}}
            <a href="{{ route('login') }}" class="forgot-password-logo">

                <img src="{{ asset('landingpage/home.png') }}" class="mr-4 h-11" alt="adakamar.id Logo">

                <span class="text-2xl font-bold">
                    adakamar.id
                </span>

            </a>


            {{-- Ubah Password Card --}}
            <div class="forgot-password-card">

                {{-- Title --}}
                <div>

                    <h2 class="text-2xl font-bold text-[#0194F3]">
                        Ubah Password
                    </h2>

                    <p class="mt-2 text-sm text-gray-500">
                        Silakan masukkan password baru untuk akun Anda.
                    </p>

                </div>


                {{-- Error Message --}}
                @if ($errors->any())

                    <div class="p-4 mt-5 text-sm text-red-800 rounded-lg bg-red-50">

                        <ul class="list-disc list-inside">

                            @foreach ($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                {{-- Success Message --}}
                @if (session('success'))

                    <div class="p-4 mt-5 text-sm text-green-800 rounded-lg bg-green-50">

                        {{ session('success') }}

                    </div>

                @endif


                {{-- Reset Password Form --}}
                <form class="mt-6 space-y-5" method="POST" action="{{ route('password.update') }}">

                    @csrf


                    {{-- Reset Token --}}
                    <input type="hidden" name="token" value="{{ $token }}">


                    {{-- Email --}}
                    <div>

                        <label for="email" class="block mb-2 text-sm font-medium text-gray-700">
                            Email
                        </label>

                        <input type="email" name="email" id="email" value="{{ old('email', $email) }}"
                            class="forgot-password-input" placeholder="name@company.com" readonly required>

                    </div>


                    {{-- New Password --}}
                    <div>

                        <label for="password" class="block mb-2 mt-2 text-sm font-medium text-gray-700">
                            Password Baru
                        </label>

                        <input type="password" name="password" id="password" placeholder="Masukkan password baru"
                            class="forgot-password-input" required>

                        <p class="mt-2 text-xs text-gray-500">
                            Password minimal 8 karakter.
                        </p>

                    </div>


                    {{-- Confirm Password --}}
                    <div>

                        <label for="password_confirmation" class="block mb-2 mt-2 text-sm font-medium text-gray-700">
                            Konfirmasi Password Baru
                        </label>

                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="Masukkan kembali password baru" class="forgot-password-input" required>

                    </div>


                    {{-- Button --}}
                    <button type="submit" class="forgot-password-button mt-3 mb-2">
                        Reset Password
                    </button>

                </form>




            </div>


            {{-- Footer --}}
            <p class="mt-6 text-xs text-center text-white/80">
                &copy; {{ date('Y') }} adakamar.id. All rights reserved.
            </p>

        </div>

    </div>

@endsection