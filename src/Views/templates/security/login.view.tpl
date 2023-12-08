<<<<<<< HEAD
<section class="container vh-100 d-flex align-items-center justify-content-center" style="width: 100% !important;">
  <div class="card my-5 w-100">
    <div class="card-header">
      <h3 class="text-center">Iniciar sesión</h3>
    </div>
    <div class="card-body"> 
      <form class="form" method="post" action="index.php?page=Sec_Login{{if redirto}}&redirto={{redirto}}{{endif redirto}}">
        <div class="form-group">
          <label for="txtEmail">Correo Electrónico</label>
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

        {{if generalError}}
        <div class="my-3 text-danger">
          {{generalError}}
        </div>
        {{endif generalError}}

        <button type="submit" id="btnLogin" class="btn btn-primary">Iniciar Sesión</button>
      </form>
    </div>
  </div>
</section>
=======
<section class="fullCenter">
  <form class="grid" method="post" action="index.php?page=sec_login{{if redirto}}&redirto={{redirto}}{{endif redirto}}">
    <section class="depth-1 row col-12 col-m-8 offset-m-2 col-xl-6 offset-xl-3">
      <h1 class="col-12">Iniciar Sesión</h1>
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
    {{if generalError}}
      <div class="row">
        {{generalError}}
      </div>
    {{endif generalError}}
    <div class="row right flex-end px-4">
      <button class="primary" id="btnLogin" type="submit">Iniciar Sesión</button>
    </div>
    </section>
  </form>
</section>
>>>>>>> c683039474f8ccfd4d0b6db41ed7907aa48490eb
