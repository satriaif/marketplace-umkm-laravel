<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Marketplace UMKM</title>

   @vite(['resources/css/app.css', 'resources/js/app.js'])

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

   <div class="container">

      <div class="row justify-content-center align-items-center vh-100">

         <div class="col-md-5">

            <div class="text-center mb-4">

               <h2 class="fw-bold">
                  Marketplace UMKM
               </h2>

               <p class="text-muted">
                  Temukan produk UMKM terbaik
               </p>

            </div>

            <div class="card shadow border-0">

               <div class="card-body p-4">

                  @yield('content')

               </div>

            </div>

         </div>

      </div>

   </div>

</body>

</html>