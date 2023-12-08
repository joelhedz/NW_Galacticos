<<<<<<< HEAD
<section class="container vh-100 d-flex align-items-center justify-content-center">
  <div class="card my-5 w-100">
    <div class="card-header">
      <h3 class="text-center">Regístrate</h3>
    </div>
    <div class="card-body"> 
      <form class="form" method="post" action="index.php?page=sec_register">

        {{if errorGeneral}}
          <div class="my-3 text-danger">{{errorGeneral}}</div>
        {{endif errorGeneral}}

        <div class="form-group">
          <label for="txtNombre">Nombre completo</label>
          <input type="text" class="form-control" id="txtNombre" name="txtNombre" value="{{txtNombre}}" placeholder="Ingrese su nombre completo">
        </div>

        {{if errorNombre}}
          <div class="my-3 text-danger">{{errorNombre}}</div>
        {{endif errorNombre}}

        <div class="form-group">
          <label for="txtEmail">Correo electrónico</label>
          <input type="email" class="form-control" id="txtEmail" name="txtEmail" value="{{txtEmail}}" placeholder="Ingrese su correo">
        </div>

        {{if errorEmail}}
          <div class="my-3 text-danger">{{errorEmail}}</div>
        {{endif errorEmail}}

        <div class="form-group">
          <label for="txtPswd">Contraseña</label>
          <input type="password" class="form-control" id="txtPswd" name="txtPswd" value="{{txtPswd}}" placeholder="Ingrese su contraseña">
        </div>

        {{if errorPswd}}
          <div class="my-3 text-danger">{{errorPswd}}</div>
        {{endif errorPswd}}

        <button type="submit" id="btnSignin" class="btn btn-primary">Crear cuenta</button>
      </form>
    </div>
  </div>
</section>

=======
<section class="fullCenter">
  <form class="grid" method="post" action="index.php?page=sec_register">
    <section class="depth-1 row col-12 col-m-8 offset-m-2 col-xl-6 offset-xl-3">
      <h1 class="col-12">Crea tu cuenta</h1>
    </section>
    <section class="depth-1 py-5 row col-12 col-m-8 offset-m-2 col-xl-6 offset-xl-3">
      <div class="row">
        <label class="col-12 col-m-4 flex align-center" for="txtEmail">Correo Electrónico</label>
        <div class="col-12 col-m-8">
          <input class="width-full" type="email" id="txtEmail" name="txtEmail" value="{{txtEmail}}" />
        </div>
        {{if errorEmail}}
        <div class="error col-12 py-2 col-m-8 offset-m-4">{{errorEmail}}</div>
        {{endif errorEmail}}
      </div>
      <div class="row">
        <label class="col-12 col-m-4 flex align-center" for="txtPswd">Contraseña</label>
        <div class="col-12 col-m-8">
          <input class="width-full" type="password" id="txtPswd" name="txtPswd" value="{{txtPswd}}" />
        </div>
        {{if errorPswd}}
        <div class="error col-12 py-2 col-m-8 offset-m-4">{{errorPswd}}</div>
        {{endif errorPswd}}
      </div>
      <div class="row right flex-end px-4">
        <button class="primary" id="btnSignin" type="submit">Crear Cuenta</button>
      </div>
    </section>
  </form>
</section>
>>>>>>> c683039474f8ccfd4d0b6db41ed7907aa48490eb
