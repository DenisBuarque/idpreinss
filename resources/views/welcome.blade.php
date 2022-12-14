<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Id Prev</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        h1,
        h3 {
            font-family: 'Bebas Neue', cursive !important;
        }
    </style>
</head>

<body>
    <header class="" style="background-image: url('/images/banner-principal-2.jpg'); background-size: cover;">
        <div class="p-3 md:container md:m-auto">

            <div class="flex w-full justify-between">
                <div class="w-48 h-16 pt-3">
                    <a href=""><img src="{{ asset('images/logotipo.png') }}" alt="Logotipo Id Preve" /></a>
                </div>
                <div class="flex h-16 items-center justify-center">
                    <img src="{{ asset('images/icons/whatsapp.png') }}" alt="Whatsapp" class="w-6 mr-1" />
                    <h3 class="text-xl text-white">82 9 8811-2009</h3>
                </div>
            </div>

            <div class="flex my-10 md:my-48">

                <div class="w-full text-center mb-10 md:mb-0 md:flex-1">
                    <h1 class="text-white text-5xl leading-none">Problemas com <span class="text-blue-800">INSS</span>
                    </h1>
                    <p class="text-white mt-4 text-xl font-bold md:ml-5">Lorem ipsum dolor sit amet consectetur,
                        adipisicing elit. Optio inventore exercitationem.</p>
                    <br />
                    <a href="https://wa.me/5582988112009" target="blank"
                        class="text-white px-5 py-3 shadow-sm mt-4 m-auto text-center rounded-md bg-green-700 md:ml-5 md:w-48">Fale
                        pelo Whatsapp</a>
                </div>

            </div>
            <div class="flex justify-center">
                <a href="#" target="_blank" class="m-3">
                    <img src="{{ asset('images/icons/instagram.png') }}" alt="Instagram" class="w-8" />
                </a>
            </div>
        </div>
    </header>

    <!-- sess??o de franqueados -->
    <section class="bg-gray-100">
        <div class="flex flex-col px-5 py-10 md:flex-row md:py-20 md:justify-between md:container md:m-auto">

            <div class="flex flex-col mb-10 md:mb-0 md:flex-1">

                <img src="{{ asset('images/logotipo.png') }}" alt="Logotipo" class="w-56 mb-5 m-auto md:m-0 md:mb-10" />
                <h1
                    class="text-5xl leading-tight mb-10 text-center md:text-left md:border-l-8 md:border-blue-600 md:pl-5">
                    Seja nosso franqueado e <span class="text-blue-700">tenha seus processos e clientes</span> a um
                    click.
                </h1>
                <p class="text-gray-500 mb-10 text-xl text-center md:text-left md:ml-6">Lorem ipsum dolor sit amet
                    consectetur adipisicing elit.
                    Necessitatibus quos ad, quis quia debitis enim ullam.</p>
                <p class="mb-10 text-center md:text-left md:ml-6">Lorem ipsum dolor sit amet consectetur adipisicing
                    elit.
                    Necessitatibus quos ad,
                    quis quia debitis enim ullam. Eos placeat aperiam nemo temporibus suscipit quam. Unde ipsa enim
                    explicabo accusantium delectus sequi.</p>
                <a href="#"
                    class="w-full py-3 border border-blue-700 text-blue-700 font-bold shadow-sm rounded-md text-center md:w-64 md:ml-5">Quero
                    ser Franqueado</a>

            </div>

            <div class="hidden md:flex md:flex-1 md:justify-end">
                <div class="grid grid-rows-4 grid-flow-col gap-4">
                    <div class="row-span-4 col-span-1 w-64"
                        style="background-image: url('/images/image-1.jpg'); background-size: cover;"></div>
                    <div class="row-span-2 col-span-1 w-64"
                        style="background-image: url('/images/image-2.jpg'); background-size: cover;"></div>
                    <div
                        class="row-span-2 col-span-1 bg-blue-500 w-64 bg-blue-800 shadow-sm rounded-md flex justify-center items-center p-10">
                        <p class="text-xl text-white text-center">Conhe??a as vantagens de ser nosso franqueado, entre em
                            contato conosco.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- end -->

    <!-- testemunhais -->
    <section class="py-12 md:container md:m-auto">

        @foreach ($testimonials as $value)    
            <div class="flex mb-4">
                @if (isset($value->image))
                <img src="{{asset('storage/'.$value->image)}}" alt="Photo" class="bg-gray-500 rounded-full w-48 h-48 mr-8 border" />
                @else
                    <img src="https://dummyimage.com/28x28/b6b7ba/fff" alt="Photo" class="bg-gray-500 rounded-full w-48 h-48 mr-8 border" />
                @endif
                <div class="flex flex-col items-start justify-center">
                    <strong class="text-2xl">{{$value->name}}</strong>
                    <p>{{$value->description}}</p>
                </div>
            </div>
        @endforeach
        
    </section>
    <!-- end -->

    <footer class="bg-blue-900 w-full p-5 md:py-10">

        <div class="md:container md:m-auto">
    
            <div class="grid grid-cols-1 gap-2 md:grid-cols-4 md:gap-4">
                <div class="flex justify-center md:justify-start">
                    <a href="" target="_blank" class="m-3">
                        <img src="{{ asset('images/icons/instagram.png') }}" alt="Instagram" class="w-6 h-6" />
                    </a>
                </div>
                <div class="">
                    <h3 class="text-white text-2xl mb-3 md:mb-5 border-l-8 border-blue-800 pl-5">Contato</h3>
                    <p class="flex text-gray-400 mb-3">
                        <img src="{{ asset('images/icons/address.png') }}" alt="endere??o" class="w-5 h-5 mr-3" /> Av. rua endere??o, n?? 00, Bairro, 57000-030, Macei??/AL
                    </p>
                    <p class="flex text-gray-400 mb-3 md:mb-5">
                        <img src="{{ asset('images/icons/e-mail.png') }}" alt="email" class="w-5 h-5 mr-3" />
                        nome@e-mail.com.br
                    </p>
                    <p class="flex text-gray-400 mb-3 md:mb-5">
                        <img src="{{ asset('images/icons/whatsapp.png') }}" alt="whatsapp" class="w-5 h-5 mr-3" /> +55 82
                        9 8811-2009
                    </p>
                </div>
                <div class="">
                    <h3 class="text-white text-2xl mb-3 md:mb-5 border-l-8 border-blue-800 pl-5">Suporte</h3>
                    <a href="/login" class="text-gray-400 block hover:text-white">??rea do franqueado</a>
                    <a href="/login" class="text-gray-400 block hover:text-white">Login</a>
                </div>
                <div class="">
                    <h3 class="text-white text-2xl mb-3 md:mb-5 border-l-8 border-blue-800 pl-5">Developed By</h3>
                    <a href="" class="text-gray-400 block hover:text-white">Desenvolvedor</a>
                </div>
            </div>
    
        </div>
    
    </footer>
    <!-- end rodape -->


</body>

</html>
