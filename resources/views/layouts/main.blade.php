<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ToDo List App - UTP PWL KEL 7</title>

  {{-- Tailwind CSS --}}
  <script src="https://cdn.tailwindcss.com"></script>

  {{-- Animate.css --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  {{-- Custom Style --}}
  <style>
    body {
      background: linear-gradient(145deg, #e0f2fe, #f0f9ff, #dbeafe);
      background-size: 400% 400%;
      animation: gradientMove 15s ease infinite;
      font-family: 'Inter', sans-serif;
    }
    @keyframes gradientMove {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
    .nav-link {
      @apply text-white hover:text-blue-200 transition duration-300;
    }
  </style>
</head>

<body class="min-h-screen flex flex-col text-gray-800">

  {{-- 🌊 Navbar --}}
  <nav class="bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-700 text-white px-6 py-4 shadow-md animate__animated animate__fadeInDown relative z-50">
    <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-2xl font-bold tracking-wide">📝 ToDo List App</h1>
      <ul class="flex items-center space-x-6">
        <li><a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a></li>
        <li><a href="{{ route('tasks.index') }}" class="nav-link">Tugas</a></li>
        <li><a href="{{ route('categories.index') }}" class="nav-link">Kategori</a></li>
        <li><a href="{{ route('priorities.index') }}" class="nav-link">Prioritas</a></li>
        <li><a href="{{ route('statuses.index') }}" class="nav-link">Status</a></li>   

        {{-- 🔽 Profile Dropdown --}}
        <li class="relative">
          <button id="profileBtn" 
                  class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-lg shadow transition duration-300 flex items-center gap-2 focus:outline-none">
            <span>👤 {{ session('user_name') ?? 'Profile' }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>

          {{-- ✅ Dropdown Menu --}}
          <div id="dropdownMenu" 
               class="hidden absolute right-0 mt-2 bg-white text-gray-800 rounded-lg shadow-lg w-44 py-2 border border-gray-100 animate__animated animate__fadeIn z-50">
            <a href="{{ route('profile.show') }}" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-600 transition">
              👤 Profile
            </a>
            <hr class="my-1 border-gray-200">
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" 
                      class="w-full text-left px-4 py-2 hover:bg-red-50 hover:text-red-600 transition">
                🚪 Logout
              </button>
            </form>
          </div>
        </li>
      </ul>
    </div>
  </nav>

  {{-- ✨ Main Content --}}
  <main class="flex-grow container mx-auto px-6 py-10 animate__animated animate__fadeInUp relative z-10">

    {{-- Flash Messages --}}
    @if(session('success'))
      <div class="bg-green-50 border border-green-300 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-sm animate__animated animate__fadeInDown">
        {{ session('success') }}
      </div>
    @endif

    @if(session('error'))
      <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-6 shadow-sm animate__animated animate__shakeX">
        {{ session('error') }}
      </div>
    @endif

    {{-- Card Container --}}
    <div class="bg-white/70 backdrop-blur-md shadow-xl rounded-2xl p-8 border border-blue-100">
      @yield('content')
    </div>
  </main>

  {{-- 🌌 Footer --}}
  <footer class="bg-gradient-to-r from-indigo-700 to-blue-700 text-white text-center py-4 mt-auto shadow-inner animate__animated animate__fadeInUp">
    <p class="text-sm">
      © {{ date('Y') }} <b>UTP PWL KEL 7</b> — <span class="text-blue-200">ToDo List System</span> |
      Dibuat dengan 💙 menggunakan <span class="text-yellow-300">Laravel</span> & <span class="text-sky-300">PostgreSQL</span>
    </p>
  </footer>

  {{-- JS untuk Dropdown Toggle --}}
  <script>
    const btn = document.getElementById('profileBtn');
    const menu = document.getElementById('dropdownMenu');

    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      menu.classList.toggle('hidden');
    });

    window.addEventListener('click', (e) => {
      if (!btn.contains(e.target) && !menu.contains(e.target)) {
        menu.classList.add('hidden');
      }
    });
  </script>

</body>
</html>
