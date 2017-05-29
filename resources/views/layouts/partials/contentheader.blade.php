<!-- Content Header (Page header) -->
<section class="content-header">
        <h1>
            @if (isset($contentheader_title))
                {{$contentheader_title}}
            @else
                Araucana Salud
            @endif

            <small>
                @if(isset($contentheader_description))
                    {{$contentheader_description}}
                @endif
            </small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i>Inicio
                </a>
            </li>
            <li class="active">
                Segundo
            </li>
        </ol>

    <div class="row">
        <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>

</section>