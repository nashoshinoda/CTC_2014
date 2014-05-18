<div id="main">
    <div class="content">
    <?php
    
      //Creación de formulario
      //Apertura de formulario
      echo form_open('nodos/userSearch');  //form_open(controlador/metodo, atributos);
      
      //Creación de los campos
      $campoNodo = array(
              'name'  =>  'numNodos',
              'id'    =>  'numNodos',
              'value' =>  ''
              );
      $campoColonia = array(
              'name'  =>  'nomColonias',
              'id'    =>  'nomColonias',
              'value' =>  ''
              );
      $campoDireccion = array(
              'name'  =>  'direccion',
              'id'    =>  'direccion',
              'value' =>  ''
              );
      $botonBusqueda = array(
              'name'  =>  'submit',
              'id'    =>  'botonBuscar',
              'value' =>  'Buscar'
              );
      echo form_label('Nodo:');
      echo form_input($campoNodo);
      echo form_label('Colonia:');
      echo form_input($campoColonia);
      echo form_label('Dirección:');
      echo form_input($campoDireccion);
      echo form_submit($botonBusqueda);

      //Cierre de formulario
      echo form_close();

    ?>
    <table>
      <thead>
          <tr>
              <th>NODO</th>
              <th>UBICACIÓN</th>
              <th>NIVEL</th>
              <th>TIPO</th>
              <th>DIRECCIÓN</th>
              <th>LATITUD</th>
              <th>LONGITUD</th>
              <th>COLONIA</th>
          </tr>
      </thead>
      <tbody>
          <?php

            //for($i=0; $i<count($rBusqueda); $i++){
            if(isset($rBusqueda)){     
              if(count($rBusqueda) > 0){                  
                for($i=0; $i<count($rBusqueda); $i++){
                  //var_dump($rBusqueda); //Imprime todo el array completo con sus detalles
          ?>
          <tr>
            <td><?php echo $rBusqueda[$i]['numNodo']; ?></td>
            <td><?php echo $rBusqueda[$i]['ubiCTC']; ?></td>
            <td><?php echo $rBusqueda[$i]['nivelNodo']; ?></td>
            <td><?php echo $rBusqueda[$i]['tipoNodo']; ?></td>
            <td><?php echo $rBusqueda[$i]['direccionNodo']; ?></td>
            <td><?php echo $rBusqueda[$i]['latNodo']; ?></td>
            <td><?php echo $rBusqueda[$i]['lngNodo']; ?></td>
            <td><?php echo $rBusqueda[$i]['nombreColonia']; ?></td>
          </tr>
          <?php
              }
            }else{
              ?>
              <tr>
                <td>NO HAY INFORMACIÓN, ¿DESEA INCLUIRLA?</td>
              </tr>
              <?php
            }
          }

          ?>   
      </tbody>
    </table>
    </div><!-- Fin div content -->
</div><!-- Fin div main -->