<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Shop</title>

    </head>
    <body>
        <header>
           <nav>
            <ul>

                <li>
                    <a href="/">home</a>
                </li>

                <li>
                    <a href="/cart">cart</a>
                </li>

                <li>
                    <a href="/admin">admin</a>
                </li>
            </ul>
           </nav>
        </header>

        <main>
            @yield('content')
        </main>

        <footer>
            footer
        </footer>
    </body>
</html>
