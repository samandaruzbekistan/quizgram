@extends('admin.header')

@section('home')
    active
@endsection
@section('section')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Bosh menu</h1>

            </div>


        </div>
    </main>
@endsection


@section('js')
    <script>
        @if(session('password_error') == 1)
        const notyf = new Notyf();

        notyf.error({
            message: 'Parollar bir xil emas!',
            duration: 5000,
            dismissible : true,
            position: {
                x : 'center',
                y : 'top'
            },
        });
        @endif

        @if(session('success') == 1)
        const notyf = new Notyf();

        notyf.success({
            message: 'Parol muvaffaqiyatli yangilandi!',
            duration: 5000,
            dismissible : true,
            position: {
                x : 'center',
                y : 'top'
            },
        });
        @endif

        @if(session('success_photo') == 1)
        const notyf = new Notyf();

        notyf.success({
            message: 'Profil rasmi muvaffaqiyatli yangilandi!',
            duration: 5000,
            dismissible : true,
            position: {
                x : 'center',
                y : 'top'
            },
        });
        @endif
    </script>
@endsection
