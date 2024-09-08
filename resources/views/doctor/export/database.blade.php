@extends('doctor.layout.app')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col-md-6">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    وحدة التحكم
                </div>
                <h2 class="page-title">
                    تصدير [SQL]

                </h2>
                
            </div>
            <!-- Page title actions -->
        
        </div>
        <div class="col-auto ms-auto d-print-none">
          <div class="col-md-6-auto ms-auto d-print-none">
            <div class="btn-list">
    
                
            <a href="{{route('doctor.export.all')}}" class=" btn btn-primary ">
                تصدير قاعدة البيانات
            </a>

          
    
            </div>
        </div>
      </div>
    </div>
</div>

<div class="page-body my-3">
    <div class="container-xl">
        <div class="container">


<div class="row">
<div class="col-12">
<div class="card">
<div class="card-body">
    <h3> استيراد قاعدة البيانات [SQL]</h3>
    <form action="{{route('doctor.import')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-10">
                <input type="file" name="sql_file" class="form-control">
            </div>
            <div class="col">
                <input type="submit" value="استيراد" class="btn btn-danger">
            </div>
        </div>
    </form>
</div>
</div>
</div>

</div>
</div>
    </div>
</div>
@endsection