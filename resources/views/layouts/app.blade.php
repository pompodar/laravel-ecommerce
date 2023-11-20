<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        <meta charset="utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Shop</title>

        @routes
        @viteReactRefresh
        @vite(['resources/js/app.jsx', "resources/js/Pages/Welcome.jsx"])
    
    </head>
    
    <body>
        
        <div class="wrapper">
           
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

        </div>

    </body>

</html>
