<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
<body>
       <header class="bg-white shadow-sm">
      <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" aria-label="Top">
        <div class="w-full py-6 flex items-center justify-between border-b border-indigo-500 lg:border-none">
          <div class="flex items-center">
            <a href="/">
              <span class="sr-only">VCardPro</span>
              <span class="text-2xl font-bold text-indigo-600">Mulucard</span>
            </a>
            <div class="hidden ml-10 space-x-8 lg:block">
              <a href="#" class="text-base font-medium text-gray-500 hover:text-gray-900">
                Home
              </a>
              <a href="#features" class="text-base font-medium text-gray-500 hover:text-gray-900">
                Features
              </a>
              <a href="#pricing" class="text-base font-medium text-gray-500 hover:text-gray-900">
                Pricing
              </a>
            </div>
          </div>
          <div class="ml-10 space-x-4">
            <a
              href="/login"
              class="inline-block bg-indigo-500 py-2 px-4 border border-transparent rounded-md text-base font-medium text-white hover:bg-opacity-75"
            >
              Login
            </a>
            <a
              href="/register"
              class="inline-block bg-white py-2 px-4 border border-transparent rounded-md text-base font-medium text-indigo-600 hover:bg-indigo-50"
            >
              Sign up
            </a>
          </div>
        </div>
      </nav>
    </header>
    <section class="py-20 bg-gradient-to-r from-purple-500 to-indigo-600 text-white">
      <div class="container mx-auto px-4 flex flex-col md:flex-row items-center justify-between">
        <div class="md:w-1/2 mb-10 md:mb-0">
          <h1 class="text-4xl md:text-5xl font-bold mb-4">Create and Manage Digital Business Cards with Ease</h1>
          <p class="text-xl mb-8">Find and connect with professionals easily using our digital business cards</p>
          <div class="w-full max-w-md">
            <input
              type="search"
              placeholder="Search for digital cards..."
              class="w-full px-4 py-3 rounded-md text-gray-900 placeholder-gray-500 bg-white focus:outline-none focus:ring-2 focus:ring-purple-300"
            />
          </div>
        </div>
        <div class="hidden md:block md:w-1/2">
          <Image
            src="{{asset('images/nfc-card-removebg-preview.png')}}"
            alt="Digital Business Card"
            width={500}
            height={300}
            class="rounded-sm shadow-none"
          />
        </div>
      </div>
    </section>

        <section id="features" class="py-20 bg-gray-50">
      <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Powerful Features</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

          @foreach ($features as $feature )
           <div class="bg-white p-6 rounded-lg shadow-md">

              <x-dynamic-component :component="'lucide-' . $feature['icon']" class="w-10 h-10 text-purple-600 mb-4" />
              <h3 class="text-xl font-semibold mb-2">{{$feature['title']}}</h3>
              <p class="text-gray-600">{{$feature['description']}}</p>
            </div>

          @endforeach

        </div>
      </div>
    </section>


    <section id="pricing" class="py-20 bg-gray-50 mt-20">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Choose Your Plan</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 place-items-center">
            @foreach ($plans as $index => $plan)
                <div
                    class="bg-white p-8 rounded-lg shadow-md {{ $index === 1 ? 'border-2 border-purple-500' : '' }}"
                >
                    <h3 class="text-2xl font-bold mb-2">{{ $plan['name'] }}</h3>
                    <p class="text-gray-600 mb-4">{{ $plan['description'] }}</p>
                    <p class="text-4xl font-bold mb-6">{{ $plan['price'] }}</p>
                    <ul class="space-y-2 mb-8">
                        @foreach ($plan['features'] as $feature)
                            <li class="flex items-center">
                                <svg
                                    class="w-4 h-4 mr-2 text-green-500"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 13l4 4L19 7"
                                    ></path>
                                </svg>
                                {{ $feature }}
                            </li>
                        @endforeach
                    </ul>
                    <button
                        class="w-full py-2 px-4 rounded {{ $index === 1 ? 'bg-purple-600 text-white' : 'bg-white text-purple-600 border border-purple-600' }} hover:bg-purple-700 hover:text-white transition-colors"
                    >
                        {{ $index === 2 ? 'Contact Sales' : 'Get Started' }}
                    </button>
                </div>
            @endforeach
        </div>
    </div>
</section>


    <section class="py-20 bg-gradient-to-r from-purple-600 to-indigo-600 text-white">
      <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to Revolutionize Your Networking?</h2>
        <p class="text-xl mb-8 max-w-2xl mx-auto">
          Join thousands of professionals who are already using MuluCard to make lasting impressions and grow their
          network.
        </p>
        <a
          href="/register"
          class="inline-block bg-white text-purple-600 hover:bg-gray-100 px-8 py-3 rounded-full font-semibold text-lg transition-colors duration-300"
        >
          Sign Up Now
        </a>
      </div>
    </section>



<footer class="bg-gray-800 text-white py-8">
    <div class="container mx-auto px-6">
        <div class="flex flex-wrap justify-between">
            <!-- DigiCard Description -->
            <div class="w-full md:w-1/4 mb-6 md:mb-0">
                <h3 class="text-lg font-semibold mb-2">MuluCard</h3>
                <p class="text-sm">Create and manage digital business cards with ease.</p>
            </div>

            <!-- Quick Links -->
            <div class="w-full md:w-1/4 mb-6 md:mb-0">
                <h4 class="text-lg font-semibold mb-2">Quick Links</h4>
                <ul class="text-sm">
                    <li>
                        <a href="#features" class="hover:text-gray-300">Features</a>
                    </li>
                    <li>
                        <a href="#pricing" class="hover:text-gray-300">Pricing</a>
                    </li>
                    <li>
                        <a href="#contact" class="hover:text-gray-300">Contact</a>
                    </li>
                </ul>
            </div>

            <!-- Legal Links -->
            <div class="w-full md:w-1/4 mb-6 md:mb-0">
                <h4 class="text-lg font-semibold mb-2">Legal</h4>
                <ul class="text-sm">
                    <li>
                        <a href="{{ url('/privacy') }}" class="hover:text-gray-300">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="{{ url('/terms') }}" class="hover:text-gray-300">Terms of Service</a>
                    </li>
                </ul>
            </div>

            <!-- Follow Us -->
            <div class="w-full md:w-1/4">
                <h4 class="text-lg font-semibold mb-2">Follow Us</h4>
                <div class="flex space-x-4">
                    <a href="#" class="text-white hover:text-gray-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <a href="#" class="text-white hover:text-gray-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <a href="#" class="text-white hover:text-gray-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="mt-8 border-t border-gray-700 pt-8 text-sm text-center">
            <p>&copy; {{ date('Y') }} DigiCard. All rights reserved.</p>
        </div>
    </div>
</footer>


</body>
</html>

