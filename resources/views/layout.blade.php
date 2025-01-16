<!doctype html>
<html lang="lv">
    <head>
        <meta charset="utf-8">
        <title>Project 2 - {{ $title }}</title>
        <meta name="description" content="Web Technologies Project 2">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-
        QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous">
    </head>
    <body>
    <style>
@import url('https://fonts.googleapis.com/css2?family=Quintessential&family=Tangerine:wght@400;700&display=swap');
</style>
    <nav style="background-color: #1a202c; padding: 15px;">
    <div style="display: flex; justify-content: space-between; align-items: center; max-width: 1200px; margin: 0 auto; color: white;">
        <span style="font-size: 24px; font-family: 'Quintessential', sans-serif; font-weight: bold;">Architects Project</span>
        <ul style="list-style: none; display: flex; gap: 15px; margin: 0; padding: 0;">
            <li><a href="/" style="text-decoration: none; color: white;">Home</a></li>
            @if(Auth::check())
                <li><a href="/architects" style="text-decoration: none; color: white;">Architects</a></li>
                <li><a href="/styles" style="text-decoration: none; color: white;">Styles</a></li>
                <li><a href="/buildings" style="text-decoration: none; color: white;">Buildings</a></li>
                <li><a href="/logout" style="text-decoration: none; color: white;">Log out</a></li>
            @else
                <li><a href="/login" style="text-decoration: none; color: white;">Authenticate</a></li>
            @endif
        </ul>
    </div>
</nav>
        <main class="container">
            <div class="row">
                <div class="col">
                    @yield('content')
                </div>
            </div>
        </main>
        <footer style="background-color: #1a202c; color: white; font-family: 'Quintessential', sans-serif; text-align: center; padding: 20px; margin-top: 20px;">
    <div>
        Veronika Kofanova, 2024
    </div>
</footer>
        <script src="/js/admin.js"></script>

    </body>
</html>
