@extends('layout.site')

@section('titulo','SIGOM : Login')

@section('conteudo')


<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Bem-Vindo ao SIGOM</h1>
                    <h5 class="h5 text-gray-750 mb-6">Sistema de Gerenciamento de Oficinas Mecânicas</h4>
                  </div>
                  <form method="post" action="{{route('site.login.entrar')}}" method="POST">
                      {{ csrf_field()}}
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" name="email_login" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Digite o seu e-mail" required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="senha_login" id="exampleInputPassword" placeholder="Sua senha" required>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Manter a senha</label>
                      </div>
                    </div>
                    <button  class="btn btn-primary btn-user btn-block">
                      Entrar
                    </button>

                  </form>
                  <hr>
                  @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

@endsection
