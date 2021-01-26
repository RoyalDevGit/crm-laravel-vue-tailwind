@extends('layouts.app')

@section('content')
    <div class="flex flex-col justify-center min-h-screen py-12 bg-gray-50 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900 leading-9">
                {{ __('Kayıt Olun') }}
            </h2>
            <p class="mt-2 text-sm text-center text-gray-600 leading-5 max-w">
                {{__('veya')}}
                <a href="{{route('login')}}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                    {{ __('hesabınız mı var giriş yapınız.') }}
                </a>
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mt-5">
                        <label for="name" class="block text-sm font-medium text-gray-700 leading-5">
                            {{ __('Ad Soyad') }}
                        </label>

                        <div class="mt-1 rounded-md shadow-sm">
                            <input id="name" type="text" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                            @error('name')
                            <span class="text-red-500 sm:text-sm sm:leading-5" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                            @enderror
                        </div>

                    </div>

                    <div class="mt-5">
                        <label for="email" class="block text-sm font-medium text-gray-700 leading-5">
                            {{ __('Email adresi') }}
                        </label>

                        <div class="mt-1 rounded-md shadow-sm">
                            <input id="email" type="email" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                            @error('email')
                            <span class="text-red-500 sm:text-sm sm:leading-5" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                            @enderror
                        </div>

                    </div>

                    <div class="mt-5">
                        <label for="password" class="block text-sm font-medium text-gray-700 leading-5">
                            {{ __('Şifre') }}
                        </label>

                        <div class="mt-1 rounded-md shadow-sm">
                            <input id="password" type="password" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                            @error('password')
                            <span class="text-red-500 sm:text-sm sm:leading-5" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-5">
                        <label for="password-confirm" class="block text-sm font-medium text-gray-700 leading-5">
                            {{ __('Şifre Tekrar') }}
                        </label>

                        <div class="mt-1 rounded-md shadow-sm">
                            <input id="password-confirm" type="password" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" name="password_confirmation" autocomplete="new-password">
                        </div>
                    </div>


                    <div class="mt-6">
                      <span class="block w-full rounded-md shadow-sm">
                        <button type="submit" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                            {{ __('Kayıt Ol') }}
                        </button>
                      </span>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
