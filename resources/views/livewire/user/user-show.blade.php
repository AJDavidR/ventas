<div>
    <x-card cardTitle="Detalles de usuario">
        <x-slot:cardTools>
            <a href="{{ route('users') }}" class="btn btn-primary">
                <i class="fas fa-arrow-circle-left"></i> Regresar
            </a>

        </x-slot:cardTools>

        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-5">
                        <div class="col-12  d-flex justify-content-center align-items-center">
                            <img src="{{ $user->image ? asset('storage/' . $user->image->url) : asset('no-image.png') }}"
                                class="img-fluid" style="max-height: 500px; max-width: 400px;">
                        </div>

                    </div>
                    <div class="col-12 col-sm-7">
                        <h3 class="my-3">{{ $user->name }}</h3>
                        <p>{{ $user->email }}</p>

                        <hr>

                        <div class="row">


                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

    </x-card>
</div>
