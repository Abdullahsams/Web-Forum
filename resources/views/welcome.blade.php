<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset ('css.css')}}">

    <title>Flow OverStack - Forum Programmer</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
          <a class="navbar-brand" href="#">Flow <b>OverStack</b></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link text-center" href="/posts">Beranda <span class="sr-only">(current)</span></a>
              </li>
              </ul>
              <div class="d-flex justify-content-center searchbar">
            <form class="form-inline my-2 my-lg-0 text-center" action="" method="">
              <div class="d-inline-flex justify-content-center">
                <i class="fa fa-search my-auto text-secondary position-relative"></i><input class="form-control mr-sm-2 px-5" type="search" placeholder="Search" aria-label="Search.....">
              </div> 
            </form>
            </div>
            <div class="d-flex justify-content-center buttons">
            <a class="btn btn-outline-primary mr-2" href="{{ route('login') }}">Login</a>
            <a class="btn btn-primary text-white" href="{{ route('register') }}"> Join us </a>
            </div>
          </div>
      </div>
    </nav>

    <div class="d-flex flex-column justify-content-center h-100 align-items-center w-100">
        <h1 class="title"><b>Kesulitan Saat Ngoding ?</b></h1>
        <p class="text-center deks">
          Tanyakan disini<br />
          Kami menyediakan platform forum<br />
          tanya jawab bagi kalian yang mengalami<br />
          kesulitan saat ngoding
        </p>
        <div class="d-flex">
          <a href="{{ route('register') }}" class="btn joinus text-white px-5 py-2 mt-2"><b>Join Us</b></a>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
