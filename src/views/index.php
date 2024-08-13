<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js" defer></script>
  <script src="../js/index.js" defer></script>
  <title>Chequear Dólar BCV</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet" />
<link rel="icon" href="../img/favicon.ico" type="image/x-icon">
</head>

<body>
  <div class="min-h-screen bg-gradient-to-r from-[#999393] to-[#1f63ac] text-white">
    <nav class="mx-auto flex w-full max-w-4xl items-center justify-between space-x-6 px-4 pt-3">
      <div class="flex space-x-2">
        <img class="hidden w-32 md:block" src="../img/lla-logo-removebg-preview.png" alt="" />
        <img class="hidden w-24 md:block" src="../img/logo_venilac-removebg-preview.png" alt="" />
      </div>
      <div class="flex justify-end space-x-7">
        <a class="hover:underline" href="#">Inicio</a>
        <a class="hover:underline" href="./logs.php">Registros</a>
      </div>
    </nav>

    <h1 class="pt-28 text-center text-3xl font-bold md:text-5xl mt-10">
      Conoce el precio del dólar
    </h1>

    <div class="mx-auto mt-24 flex w-72 flex-col space-y-2">
      <h2 class="flex justify-center font-bold text-xl">Fecha:</h2>
      <span id="date" class="z-50 rounded bg-slate-300 px-4 py-1 font-medium text-black focus:outline focus:outline-1 focus:outline-blue-500 text-center">Fecha y Hora</span>

      <h2 class="flex justify-center font-bold text-xl">Valor:</h2>
      <span id="value" class="z-50 rounded bg-slate-300 px-4 py-1 font-medium text-black focus:outline focus:outline-1 focus:outline-blue-500 text-center">Valor</span>
    </div>

    <svg class="absolute bottom-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
      <path fill="#ffffff" fill-opacity="1" d="M0,224L48,224C96,224,192,224,288,224C384,224,480,224,576,213.3C672,203,768,181,864,160C960,139,1056,117,1152,117.3C1248,117,1344,139,1392,149.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
    </svg>
  </div>

  <div class="bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
      <div class="mx-auto max-w-2xl lg:text-center">
        <p class="mt-1 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
          Nuestros servicios
        </p>
        <p class="mt-6 text-lg leading-8 text-gray-600">
        Brindamos una rápida, fácil y actualizada verificación del precio del dólar (USD) en bolívares (Bs.) con un solo click.
        </p>
      </div>
      <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-4xl">
        <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-2 lg:gap-y-16">
          <div class="relative pl-16">
            <dt class="text-base font-semibold leading-7 text-gray-900">
              <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-blue-500">
                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <a>Consulta</a>
            </dt>
            <dd class="mt-2 text-base leading-7 text-gray-600">
              Descubre el precio del dólar en tiempo real, según el Banco Central de
              Venezuela (BCV).
            </dd>
          </div>
          <div class="relative pl-16">
            <dt class="text-base font-semibold leading-7 text-gray-900">
              <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-blue-500">
                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
              </div>
              <a>Registros</a>
            </dt>
            <dd class="mt-2 text-base leading-7 text-gray-600">
              Echa un vistazo al historial de consultas que se han llevado a
              cabo en la aplicación.
            </dd>
          </div>
        </dl>
      </div>
    </div>
  </div>
</body>

<footer class="text-center mb-5">Venilac &copy | 2023</footer>

</html>