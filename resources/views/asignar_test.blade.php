<div class="table-responsive">
    <div class="form-group pull-right col-md-4">
        <input type="text" class="search form-control" placeholder="¿Qué estas buscando?">
    </div>
    <span class="counter pull-right"></span>
    <table id="mytableTest" class="table table-bordered table-hover table-striped results">
        <thead>
        <tr>

            <th>Codigo Test</th>
            <th class="col-md-9">Tipo Test</th>
            <th class="col-md-8">Descripción</th>
            <th class="col-md-8">IDs Preguntas</th>
            <!--<th class="col-md-7">Resultado</th>
            <th class="col-md-6">Diagnostico</th>-->
            <th><input type="checkbox" id="checkall"></th>
        </tr>
        <tr class="warning no-result">
            <td colspan="6"><i class="fa fa-warning"></i> No result</td>
        </tr>
        </thead>
        <tbody>
        @foreach($tests as $test)
            <tr>
                <td scope="row">{{$test->codigoTest}}</td>
                <td>
                    @if($test->tipoTest_codigoTipoTest == 0)
                        <span class="label label-default">Test de Kolb</span>
                    @else
                        <span class="label label-default">Ventana de Johari</span>
                    @endif
                </td>
                <td>{{$test->descripcion}}</td>

                <?php
                if(empty($test_has_preguntas[$test->codigoTest])) {
                    $preguntas= "";
                }
                else {
                    $preguntas = $test_has_preguntas[$test->codigoTest];
                }

                $preguntas = [];
                foreach($test_has_preguntas as $has_pregunta) {
                    if ($has_pregunta->test_codigoTest == $test->codigoTest) {
                        $preguntas[count($preguntas)] = $has_pregunta->preguntasTest_codigoPregunta;
                    }
                }

                $string_preguntas = implode(",", $preguntas);

                ?>

                <td>{{$string_preguntas}}</td>
                <td><input id="asignar_tests" type="checkbox" class="checkthis" name="asignar_test[]" value="{{$test->codigoTest}}"> </td><!--class="checkbox" id="EditUser" value=""></td>-->
            </tr>
        @endforeach
        </tbody>
    </table>
</div>