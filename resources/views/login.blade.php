<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @vite('resources/css/app.css')
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
        <script
            defer
            src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
        ></script>
        <title>Login</title>
    </head>
    <body>
        <div
            class="min-h-screen bg-gray-100 flex flex-col justify-center sm:py-12"
        >
            <div class="p-10 xs:p-0 mx-auto md:w-full md:max-w-md">
                <h1 class="font-bold text-center text-2xl mb-5">
                    Welcome To Admin Page
                </h1>
                @if (session()->has('pesan'))
                <div
                    class="p-4 text-red-900 bg-red-100 border border-red-200 rounded-md mb-4"
                >
                    <div class="flex justify-between">
                        <div class="flex items-center">
                            <svg
                                width="26"
                                height="26"
                                viewBox="0 0 24 24"
                                fill="currentColor"
                            >
                                <path
                                    d="M13.6086 3.247l8.1916 15.8c.0999.2.1998.5.1998.8 0 1-.7992 1.8-1.7982 1.8H3.7188c-.2997 0-.4995-.1-.7992-.2-.7992-.5-1.1988-1.5-.6993-2.4 5.3067-10.1184 8.0706-15.385 8.2915-15.8.3314-.6222.8681-.8886 1.4817-.897.6135-.008 1.273.2807 1.6151.897zM12 18.95c.718 0 1.3-.582 1.3-1.3 0-.718-.582-1.3-1.3-1.3-.718 0-1.3.582-1.3 1.3 0 .718.582 1.3 1.3 1.3zm-.8895-10.203v5.4c0 .5.4.9.9.9s.9-.4.9-.9v-5.3c0-.5-.4-.9-.9-.9s-.9.4-.9.8z"
                                ></path>
                            </svg>
                            <span class="ml-2">{{ session("pesan") }}</span>
                        </div>
                        <button
                            onclick="this.parentElement.parentElement.remove();"
                            class="text-red-500 hover:text-red-700"
                        >
                            <svg
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="currentColor"
                            >
                                <path
                                    d="M17.6555 6.3331a.9.9 0 0 1 .001 1.2728l-4.1032 4.1085a.4.4 0 0 0 0 .5653l4.1031 4.1088a.9002.9002 0 0 1 .0797 1.1807l-.0806.092a.9.9 0 0 1-1.2728-.0009l-4.1006-4.1068a.4.4 0 0 0-.5662 0l-4.099 4.1068a.9.9 0 1 1-1.2738-1.2718l4.1027-4.1089a.4.4 0 0 0 0-.5652L6.343 7.6059a.9002.9002 0 0 1-.0796-1.1807l.0806-.092a.9.9 0 0 1 1.2728.0009l4.099 4.1055a.4.4 0 0 0 .5662 0l4.1006-4.1055a.9.9 0 0 1 1.2728-.001z"
                                ></path>
                            </svg>
                        </button>
                    </div>
                </div>
                @endif

                <div
                    class="bg-white shadow w-full rounded-lg divide-y divide-gray-200"
                >
                    <form
                        method="POST"
                        action="{{ route('verify') }}"
                        class="px-5 py-7"
                    >
                        @csrf

                        <label
                            class="font-semibold text-sm text-gray-600 pb-1 block"
                        >
                            E-mail
                        </label>
                        <input
                            type="email"
                            name="email"
                            class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full"
                            required
                        />

                        <label
                            class="font-semibold text-sm text-gray-600 pb-1 block"
                        >
                            Password
                        </label>
                        <input
                            type="password"
                            name="password"
                            class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full"
                            required
                        />

                        <div class="mb-4">
                            <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                            @error('g-recaptcha-response')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button
                            type="submit"
                            class="transition duration-200 bg-blue-500 hover:bg-blue-600 focus:bg-blue-700 focus:shadow-sm focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 text-white w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block"
                        >
                            <span class="inline-block mr-2">Login</span>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                class="w-4 h-4 inline-block"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"
                                />
                            </svg>
                        </button>
                    </form>

                    <!-- <div class="p-5">
                        <a href="{{ route('login.google') }}">
                            <button
                                type="button"
                                class="transition duration-200 border border-gray-200 text-gray-500 w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-normal text-center inline-block"
                            >
                                Google
                            </button>
                        </a>
                    </div> -->

                    <div class="py-5">
                        <div class="text-center whitespace-nowrap">
                        <a href="{{ route('admin.resetPassword') }}"
                                class="transition duration-200 mx-5 px-5 py-4 cursor-pointer font-normal text-sm rounded-lg text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-200 focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 ring-inset inline-block text-center">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    class="w-4 h-4 inline-block align-text-top"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"
                                    />
                                </svg>
                                <span class="inline-block ml-1">Forgot Password</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    </body>
</html>
