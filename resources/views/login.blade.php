<html>

<head>
    <title>Global Agility Solutions ID - System</title>
    @include('components.scripts')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

</head>

<body>
<section class="vh-100 bg-dark">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5">
            <div class="text-center">
                <img src="https://image-service-cdn.seek.com.au/c22be574896a3d2ca00b91265b43ec79236a0e5d/ee4dce1061f3f616224767ad58cb2fc751b8d2dc" class="img-fluid rounded-top" alt="">
            </div>

            <div class="form-outline mb-4">
              <label class="form-label">Email</label>
              <input type="email" id="typeEmailX-2" class="form-control form-control-lg" />
            </div>

            <div class="form-outline mb-4">
              <label class="form-label">Password</label>
              <input type="password" id="typePasswordX-2" class="form-control form-control-lg" />
            </div>

            <!-- Checkbox -->
            <div class="form-check d-flex justify-content-start mb-4">
              <input class="form-check-input" type="checkbox" value="" id="form1Example3" />
              <label class="form-check-label" for="form1Example3">&nbspRemember password</label>
            </div>

            <button class="btn btn-primary btn-lg btn-block w-100" type="submit">Login</button>

            <hr class="my-4">


          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>

<script>

</script>

</html>
