<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Auth • Login & Sign Up</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          colors: {
            primary: '#6366f1',
          },
          keyframes: {
            slideUp: { '0%': { opacity: 0, transform: 'translateY(8px)' }, '100%': { opacity: 1, transform: 'translateY(0)' } },
            slideDown: { '0%': { opacity: 0, transform: 'translateY(-8px)' }, '100%': { opacity: 1, transform: 'translateY(0)' } },
            glow: { '0%,100%': { boxShadow: '0 0 0 0 rgba(99,102,241,0.4)' }, '50%': { boxShadow: '0 0 0 8px rgba(99,102,241,0.0)' } }
          },
          animation: {
            slideUp: 'slideUp .35s ease-out',
            slideDown: 'slideDown .35s ease-out',
            glow: 'glow 2s infinite',
          },
        },
      },
    };
  </script>
  <style>
    body { font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Inter, 'Helvetica Neue', Arial, 'Noto Sans', 'Apple Color Emoji', 'Segoe UI Emoji'; }
  </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 dark:from-slate-900 dark:via-slate-900 dark:to-slate-900 text-slate-800 dark:text-slate-100 selection:bg-indigo-200 selection:text-indigo-900">
  <!-- Theme toggle -->
  <button id="themeToggle" class="fixed top-4 right-4 p-2 rounded-full bg-white/80 dark:bg-slate-800/70 border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition">
    <svg id="sun" class="h-5 w-5 text-yellow-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3v2m0 14v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M3 12H1m22 0h-2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/><circle cx="12" cy="12" r="4"/></svg>
    <svg id="moon" class="hidden h-5 w-5 text-slate-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/></svg>
  </button>

  <div class="flex items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
    <div class="w-full max-w-lg">
      <!-- Card -->
      <div class="relative rounded-2xl border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-900/70 shadow-xl backdrop-blur-md">
        <!-- Brand -->
        <div class="px-6 pt-6 pb-3 text-center">
            @if ($errors->any())
                <div class="bg-red-100 text-red-600 p-3 rounded-lg text-sm mb-3">
                    {{ $errors->first() }}
                </div>
            @endif
            @if (session('status'))
                <div class="bg-green-100 text-green-600 p-3 rounded-lg text-sm mb-3">
                    {{ session('status') }}
                </div>
            @endif

            <div class="flex items-center justify-center gap-2">
                <img src="{{ asset('picon.png') }}" alt="Project Icon" class="h-10 w-10 rounded-lg shadow-sm animate-glow">
            </div>
          <h1 class="mt-3 font-semibold text-lg">Welcome To Pitor</h1>
          <p class="text-sm text-slate-500 dark:text-slate-400">Login or create an account to continue</p>
        </div>

        <!-- Tabs -->
        <div class="px-4 pt-4">
          <div class="relative grid grid-cols-2 rounded-xl bg-slate-100 dark:bg-slate-800 p-1">
            <button id="tabLogin" class="tab-btn relative z-10 py-2.5 text-center text-sm font-medium rounded-lg focus:outline-none focus-visible:ring-2 focus-visible:ring-primary">Login</button>
            <button id="tabSignup" class="tab-btn relative z-10 py-2.5 text-center text-sm font-medium rounded-lg focus:outline-none focus-visible:ring-2 focus-visible:ring-primary">Sign Up</button>
            <!-- Active pill -->
            <span id="tabPill" class="absolute inset-y-1 left-1 w-[calc(50%-4px)] rounded-lg bg-white dark:bg-slate-900 shadow ring-1 ring-black/5 transition-transform duration-300 ease-out"></span>
          </div>
        </div>

        <!-- Panels -->
        <div class="px-6 pb-6">
          <!-- Login -->
            <form id="panelLogin" class="space-y-4 pt-6" method="POST" action="{{ route('login') }}">
                @csrf
            <div class="relative">
              <input id="loginEmail" name="email" type="email" required class="peer w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-transparent px-4 pt-5 pb-2 outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary/50" placeholder=" " />
              <label for="loginEmail" class="pointer-events-none absolute left-4 top-2 text-xs text-slate-500 dark:text-slate-400 transition-all peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-sm">Email</label>
            </div>
            <div class="relative">
              <input id="loginPassword" name="password" type="password" required class="peer w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-transparent px-4 pt-5 pb-2 pr-10 outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary/50" placeholder=" " />
              <label for="loginPassword" class="pointer-events-none absolute left-4 top-2 text-xs text-slate-500 dark:text-slate-400 transition-all peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-sm">Password</label>
              <button type="button" data-toggle="loginPassword" class="toggle-pass absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">👁️</button>
            </div>
            <div class="flex items-center justify-between text-sm">
              <label class="inline-flex items-center gap-2 select-none"><input type="checkbox" class="rounded border-slate-300 text-primary focus:ring-primary/30"/> Remember me</label>
              <a href="#" class="text-primary hover:underline">Forgot password?</a>
            </div>
            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-primary text-white py-2.5 font-medium shadow-sm hover:shadow-md transition active:scale-[.99]">
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg>
              Sign in
            </button>
            <div class="relative py-2 text-center">
              <span class="bg-white dark:bg-slate-900 px-3 text-xs text-slate-500">or continue with</span>
              <div class="absolute left-0 right-0 top-1/2 -z-10 h-px bg-gradient-to-r from-transparent via-slate-200 dark:via-slate-700 to-transparent"></div>
            </div>
            <div class="grid grid-cols-3 gap-3">
                <a href="{{ route('google.login') }}"
                   class="rounded-xl border border-slate-200 dark:border-slate-700 py-2 hover:bg-slate-50 dark:hover:bg-slate-800 text-center">
                    <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google" class="inline w-4 h-4 mr-2">
                    Continue with Google
                </a>
              <button type="button" class="rounded-xl border border-slate-200 dark:border-slate-700 py-2 hover:bg-slate-50 dark:hover:bg-slate-800">GitHub</button>
              <button type="button" class="rounded-xl border border-slate-200 dark:border-slate-700 py-2 hover:bg-slate-50 dark:hover:bg-slate-800">Twitter</button>
            </div>
          </form>

          <!-- Signup -->
            <form id="panelSignup" class="hidden space-y-4 pt-6" method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block font-medium mb-1">Full Name *</label>
                    <input type="text" name="name" class="w-full border rounded p-2 focus:ring focus:ring-blue-200" required>
                </div>

                <!-- Email -->
                <div>
                    <label class="block font-medium mb-1">Email Address *</label>
                    <input type="email" name="email" class="w-full border rounded p-2 focus:ring focus:ring-blue-200" required>
                </div>

                <!-- Phone -->
                <div>
                    <label class="block font-medium mb-1">Phone Number *</label>
                    <input type="text" name="phone" class="w-full border rounded p-2 focus:ring focus:ring-blue-200">
                </div>

                <!-- Address Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium mb-1">Company Name (Optional)</label>
                        <input type="text" name="company_name" class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Street Address *</label>
                        <input type="text" name="address1" class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Street Address 2</label>
                        <input type="text" name="address2" class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label class="block font-medium mb-1">City *</label>
                        <input type="text" name="city" class="w-full border rounded p-2">
                    </div>
                </div>

                <!-- Country / State / Postcode -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="mb-3">
                        <label for="country_id" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                        <select name="country_id" id="country_id"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Select Country</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}"
                                    {{ old('country_id', $userInfo->country_id ?? '') == $country->id ? 'selected' : '' }}>
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">State</label>
                        <input type="text" name="state_region" class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Postcode</label>
                        <input type="text" name="postcode" class="w-full border rounded p-2">
                    </div>
                </div>

                <!-- Currency -->
                <div>
                    <label class="block font-medium mb-1">Choose Currency</label>
                    <select name="currency" class="w-full border rounded p-2">
                        <option value="USD">USD</option>
                        <option value="EUR">EUR</option>
                        <option value="BDT">BDT</option>
                    </select>
                </div>

                <!-- Password -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium mb-1">Password *</label>
                        <input type="password" name="password" class="w-full border rounded p-2" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Confirm Password *</label>
                        <input type="password" name="password_confirmation" class="w-full border rounded p-2" required>
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                    Register
                </button>

                <p class="text-center text-sm mt-4">
                    Already registered? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Sign In</a>
                </p>
          </form>
        </div>
      </div>

      <!-- Tiny footer -->
      <p class="mt-6 text-center text-xs text-slate-500 dark:text-slate-400">© <span id="year"></span> crm UI. All rights reserved.</p>
    </div>
  </div>

  <script>
    const $ = (s, r=document) => r.querySelector(s);
    const $$ = (s, r=document) => Array.from(r.querySelectorAll(s));

    // Theme
    const themeToggle = $('#themeToggle');
    const sun = $('#sun');
    const moon = $('#moon');
    const userPref = localStorage.getItem('theme');
    if (userPref === 'dark' || (!userPref && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      document.documentElement.classList.add('dark');
      sun.classList.add('hidden');
      moon.classList.remove('hidden');
    }
    themeToggle.addEventListener('click', () => {
      const isDark = document.documentElement.classList.toggle('dark');
      sun.classList.toggle('hidden', isDark);
      moon.classList.toggle('hidden', !isDark);
      localStorage.setItem('theme', isDark ? 'dark' : 'light');
    });

    // Tabs
    const tabLogin = $('#tabLogin');
    const tabSignup = $('#tabSignup');
    const pill = $('#tabPill');
    const panelLogin = $('#panelLogin');
    const panelSignup = $('#panelSignup');

    function setTab(which) {
      const loginActive = which === 'login';
      // Move pill
      pill.style.transform = loginActive ? 'translateX(0)' : 'translateX(100%)';
      // Panels with subtle animation
      if (loginActive) {
        panelSignup.classList.add('hidden');
        panelLogin.classList.remove('hidden');
        panelLogin.classList.remove('animate-slideDown');
        panelLogin.classList.add('animate-slideUp');
      } else {
        panelLogin.classList.add('hidden');
        panelSignup.classList.remove('hidden');
        panelSignup.classList.remove('animate-slideUp');
        panelSignup.classList.add('animate-slideDown');
      }
      // Focus first field
      (loginActive ? $('#loginEmail') : $('#name')).focus({ preventScroll: true });
    }

    tabLogin.addEventListener('click', () => setTab('login'));
    tabSignup.addEventListener('click', () => setTab('signup'));

    // Password toggles
    $$('.toggle-pass').forEach(btn => {
      btn.addEventListener('click', () => {
        const input = document.getElementById(btn.dataset.toggle);
        const isPwd = input.getAttribute('type') === 'password';
        input.setAttribute('type', isPwd ? 'text' : 'password');
        btn.textContent = isPwd ? '🙈' : '👁️';
      });
    });

    // Strength meter
    const strengthBar = $('#strengthBar');
    const strengthText = $('#strengthText');
    const signupPassword = $('#signupPassword');
    function score(pwd) {
      let s = 0;
      if (!pwd) return 0;
      if (pwd.length >= 8) s++;
      if (/[A-Z]/.test(pwd)) s++;
      if (/[a-z]/.test(pwd)) s++;
      if (/[0-9]/.test(pwd)) s++;
      if (/[^A-Za-z0-9]/.test(pwd)) s++;
      return Math.min(s, 5);
    }
    function renderStrength(n){
      const widths = ['20%','40%','60%','80%','100%'];
      const colors = ['#ef4444','#f59e0b','#fbbf24','#22c55e','#16a34a'];
      const labels = ['Weak','Okay','Good','Strong','Great'];
      const idx = Math.max(0, n-1);
      strengthBar.style.width = widths[idx];
      strengthBar.style.backgroundColor = colors[idx];
      strengthText.textContent = labels[idx];
    }
    signupPassword.addEventListener('input', e => renderStrength(score(e.target.value)));

    // Demo submit handlers
    // function toast(msg){
    //   const t = document.createElement('div');
    //   t.textContent = msg;
    //   t.className = 'fixed bottom-6 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-sm px-4 py-2 rounded-lg shadow-lg animate-slideUp';
    //   document.body.appendChild(t);
    //   setTimeout(()=>{ t.classList.add('opacity-0','translate-y-2'); }, 1600);
    //   setTimeout(()=> t.remove(), 2000);
    // }
    // panelLogin.addEventListener('submit', (e)=>{ e.preventDefault(); toast('Logged in (demo)'); });
    // panelSignup.addEventListener('submit', (e)=>{ e.preventDefault(); toast('Account created (demo)'); });

    // Init
    document.getElementById('year').textContent = new Date().getFullYear();
    setTab('login');

        document.addEventListener("DOMContentLoaded", function() {
        new TomSelect("#country_id", {
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            },
            placeholder: "Search or select a country...",
        });
    });
  </script>
</body>
</html>
