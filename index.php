<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body>

   <div class="container-fluid">
    <div class="row h-100">
        
        <nav class="col-sm-2 d-none d-md-block bg-light sidebar ">
    <div class="sidebar-sticky" style="margin-top: 30px">

      <h4 style="text-align: center;">PASEO TRAVEL</h4>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom " ></div>

      <ul class="nav flex-column ml-3 hover">
        <li class="nav-item border">

          <a class="nav-link active" href="#">
            Dashboard
          </a>

        </li>

        <li class="nav-item border ">
          <a class="nav-link" href="#">
            Usuarios
          </a>
        </li>

      </ul>
    </div>
  </nav>

  <div class="col-sm-10 ">        
<div class="container">
        

      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Hoteles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Vuelos</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent" style="margin-left: -15px;">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

          <div class="container ">
            <form name="campos" method="post" id="frmHotel">
              <div class="container-fluid mt-3">
                <div class="row">
                  <div class="col-md">
                    <label>DESTINO</label> 
                    <input class="form-control" name="txtDestino" id="txtDestino" onkeyup="buscarCiudad(this.value)">                 
                  </div>
                </div>
                <div class="row">
                  <div class="col-md">
                    <label>CHECK-IN</label>
                    <input type="date" class="form-control" name="dateDheckin">
                  </div>
                  <div class="col-md">
                    <label>CHECK-OUT</label>
                    <input type="date" class="form-control" name="dateCheckout">
                  </div>

                </div>
                <div class="row">
                  <div class="col-md">
                    <label>HABITACIONES</label>
                    <select class="form-control" name="cmbHabitaciones">
                      <?php 
                      for ($i=1; $i <= 10; $i++) { 
                        echo "<option>".$i."</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-md">
                    <label>ADULTOS</label>
                    <select class="form-control" name="cmbAdultos">
                      <?php 
                      for ($i=1; $i <= 10; $i++) { 
                        echo "<option>".$i."</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-md">
                    <label>MENORES</label>
                    <select class="form-control" name="cmboMenores">
                      <?php 
                      for ($i=0; $i < 10; $i++) { 
                        echo "<option>".$i."</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="row  mt-3">
                  <div class="col-md">

                    <div class="mx-auto" style="width: 200px;"><input type="button" name="btnEnviar" onclick="buscarHotel()" class="btn  btn-light mx-auto" value="Buscar"> 
                    </div>                  
                  </div>
                </div>
              </div>


            </form>
          </div>

          <div class="container" id="resultados">

          </div>



        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        
        </div>
      </div>

      </div>

      </div>
    </div>  
  </div>

</body>
</html>
<script>
    function buscarHotel(valor){
      console.log(valor);
      $.ajax({
        data:$('#frmHotel').serialize(),
        type: 'post',
        url: 'search.php',
        success:function(res){
          console.log(res);
          document.getElementById('resultados').innerHTML = res;

        }
      });
    }

    function buscarCiudad(valor){
      console.log(valor);
      $.ajax({
        data:"valor="+valor+"&accion=buscarCiudad",
        type: 'post',
        url: 'search.php',
        success:function(res){
          console.log("res ");
          console.log(res);
          document.getElementById('resultados').innerHTML = res;
        }
      });
    }

  </script>
