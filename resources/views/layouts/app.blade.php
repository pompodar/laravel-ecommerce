<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        <meta charset="utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Shop</title>

        <script src="https://kit.fontawesome.com/9f3a632633.js" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="./../app.css">
        <!-- @routes
        @viteReactRefresh
        @vite(['resources/js/app.jsx']) -->
    
    </head>
    
    <body>
        
        <div class="wrapper">
           
            <header>

                <a class="logo" href="/">

                    <svg class="icon-logo" width="50px" height="50px" viewBox="0 0 42 30" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <title>blobs and trees</title>
                        <defs></defs>
                        <path d="M21.54 1.017c1.629 1.070 3.052 2.372 4.255 3.925 0.061 0.078 0.2 0.117 0.307 0.128 0.452 0.044 0.911 0.036 1.358 0.108 4.474 0.718 7.528 4.324 7.555 8.948 0.021 3.641 0.005 7.282 0.006 10.923 0 1.476-0.019 2.954 0.011 4.43 0.035 1.755 1.624 2.906 3.243 2.384 1.075-0.347 1.725-1.339 1.725-2.655 0.001-4.713-0.009-9.426-0-14.139 0.003-1.623-0.078-3.227-0.523-4.802-2.381-8.439-10.504-11.479-16.622-9.839-0.472 0.126-0.933 0.293-1.435 0.453 0.070 0.081 0.090 0.117 0.121 0.137zM0.032 13.264c0.092-3.736 1.572-6.845 4.187-9.402 2.003-1.959 4.379-3.216 7.13-3.649 7.349-1.155 14.007 3.242 15.771 10.677 0.342 1.443 0.341 2.906 0.342 4.372 0.001 3.015-0.024 6.030 0.007 9.044 0.041 3.953-2.755 6.897-6.2 7.562-4.213 0.813-8.262-2.236-8.691-6.593-0.138-1.404-0.109-2.828-0.117-4.243-0.015-2.357 0.004-4.714 0.004-7.071 0-2.668 0.732-5.12 2.072-7.395 0.105-0.179 0.235-0.229 0.419-0.188 1.529 0.338 2.898 0.994 4.057 2.087 0.197 0.186 0.119 0.327 0.003 0.495-0.596 0.856-1.086 1.772-1.292 2.805-0.146 0.729-0.259 1.478-0.265 2.219-0.027 3.409-0.016 6.818-0.009 10.227 0.002 1.324 0.75 2.333 1.901 2.648 1.239 0.339 3.131-0.556 3.121-2.397-0.019-3.641-0.008-7.283-0.035-10.924-0.019-2.568-1.074-4.666-2.983-6.285-5.123-4.345-11.981-1.793-13.972 3.641-0.416 1.133-0.548 2.311-0.549 3.513-0.002 4.866 0.090 9.732 0.075 14.598-0.001 0.409-0.036 0.836-0.15 1.225-0.346 1.174-1.37 1.861-2.534 1.755-1.187-0.109-2.125-0.995-2.24-2.215-0.078-0.833-0.115-13.936-0.051-16.504z"></path>
                    </svg>

                    blobs and trees
                </a>

                <i class="fa-solid fa-magnifying-glass search-sign"></i>

            
                <nav>

                    <ul>

                        <li>
                            <a href="/cart">
                            
                                <i class="fa-solid fa-cart-shopping"></i>
                            
                            </a>
                        </li>

                        @if(auth()->check() && auth()->user()->isAdmin())
                            
                            <li>
                                
                                <a href="/admin">
                                   
                                    <i class="fa-solid fa-lock"></i>
                                
                                </a>
                    
                            </li>
                
                        @endif

                        @if(!auth()->check())

                            <li>
                                
                                <a href="/login">
                                   
                                    <i class="fa-solid fa-right-to-bracket"></i>
                                
                                </a>
                    
                            </li>

                        @else

                        
                            <li>
                                
                                <a href="/dashboard">
                                   
                                    <i class="fa-regular fa-user"></i>
                                
                                </a>
                    
                            </li>

                            <li>

                                <form action="{{ route('logout') }}" method="post">
                                    
                                    @csrf
                                    
                                    <button type="submit">

                                        <i class="fa-solid fa-right-from-bracket"></i>
                                    
                                    </button>
                                
                                </form>                               
                                                    
                            </li>
                                    
                        @endif

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
