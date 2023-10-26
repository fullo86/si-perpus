<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
  <div class="main d-flex flex-column justify-content-between">
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Sistem Informasi Perpustakaan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>

    <div class="body-content h-100">
      <div class="row g-0 h-100">
        <div class="sidebar col-lg-2 p-10 collapse d-lg-block" id="navbarNavAltMarkup">
            <nav class="mt-3">
              @if (Auth::user())
                  @if (Auth::user()->role_id == 1)
                  <a href="/dashboard" @if (request()->route()->uri == 'dashboard') class='active' @endif>Dashboard</a>
                  <a href="/members" @if (request()->route()->uri == 'users') class='active' @endif>Anggota</a>
                  <a href="/logs" @if (request()->route()->uri == 'logs') class='active' @endif>Riwayat Peminjaman</a>
                  <a href="/books" @if (request()->route()->uri == 'books') class='active' @endif>Buku</a>
                  <a href="/category" @if (request()->route()->uri == 'category') class='active' @endif>Kategori</a>
                @else
                  <a href="/dashboards" @if (request()->route()->uri == 'dashboards') class='active' @endif>Dashboard</a>
                  <a href="/books/list" @if (request()->route()->uri == 'books') class='active' @endif>Daftar Buku</a>
                  <a href="/activity" @if (request()->route()->uri == 'activity') class='active' @endif>Peminjaman</a>
                  <a href="/return" @if (request()->route()->uri == 'return') class='active' @endif>Pengembalian</a>
                @endif
                  {{-- <a href="#" @if (request()->route()->uri == 'profile') class='active' @endif>Profil</a> --}}
                  <a href="/logout">Keluar</a>                  
                @endif
          </nav>
        </div>
        <div class="content p-5 col-lg-10">
          <!-- Activity -->
          @yield('activity')
          @yield('return')
          
          <!-- Admin -->
          @yield('dashboard')

          <!-- User -->
          @yield('dashboardUser')

          <!-- Members -->
          @yield('members')
          @yield('show-member')
          @yield('edit-member')

          <!-- Books -->
          @yield('books-list')          
          @yield('books')          
          @yield('show-book')
          @yield('add-book')
          @yield('edit-book')

          <!-- Categories -->
          @yield('categories')          
          @yield('add-category')
          @yield('edit-category')
          
          <!-- Logs -->
          @yield('logs')

          @yield('profile')
        </div>
      </div>
    </div>
  </div>
  <script src="/js/bootstrap.js"></script>
</body>
</html>
