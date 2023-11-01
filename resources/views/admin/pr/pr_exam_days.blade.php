@extends('admin.header')
@push('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <style>
        .pagination{height:36px;margin:0;padding: 0;}
        .pager,.pagination ul{margin-left:0;*zoom:1}
        .pagination ul{padding:0;display:inline-block;*display:inline;margin-bottom:0;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 2px rgba(0,0,0,.05);-moz-box-shadow:0 1px 2px rgba(0,0,0,.05);box-shadow:0 1px 2px rgba(0,0,0,.05)}
        .pagination li{display:inline}
        .pagination a{float:left;padding:0 12px;line-height:30px;text-decoration:none;border:1px solid #ddd;border-left-width:0}
        .pagination .active a,.pagination a:hover{background-color:#f5f5f5;color:#94999E}
        .pagination .active a{color:#94999E;cursor:default}
        .pagination .disabled a,.pagination .disabled a:hover,.pagination .disabled span{color:#94999E;background-color:transparent;cursor:default}
        .pagination li:first-child a,.pagination li:first-child span{border-left-width:1px;-webkit-border-radius:3px 0 0 3px;-moz-border-radius:3px 0 0 3px;border-radius:3px 0 0 3px}
        .pagination li:last-child a{-webkit-border-radius:0 3px 3px 0;-moz-border-radius:0 3px 3px 0;border-radius:0 3px 3px 0}
        .pagination-centered{text-align:center}
        .pagination-right{text-align:right}
        .pager{margin-bottom:18px;text-align:center}
        .pager:after,.pager:before{display:table;content:""}
        .pager li{display:inline}
        .pager a{display:inline-block;padding:5px 12px;background-color:#fff;border:1px solid #ddd;-webkit-border-radius:15px;-moz-border-radius:15px;border-radius:15px}
        .pager a:hover{text-decoration:none;background-color:#f5f5f5}
        .pager .next a{float:right}
        .pager .previous a{float:left}
        .pager .disabled a,.pager .disabled a:hover{color:#999;background-color:#fff;cursor:default}
        .pagination .prev.disabled span{float:left;padding:0 12px;line-height:30px;text-decoration:none;border:1px solid #ddd;border-left-width:0}
        .pagination .next.disabled span{float:left;padding:0 12px;line-height:30px;text-decoration:none;border:1px solid #ddd;border-left-width:0}
        .pagination li.active, .pagination li.disabled {
            float:left;padding:0 12px;line-height:30px;text-decoration:none;border:1px solid #ddd;border-left-width:0
        }
        .pagination li.active {
            background: #3b7ddd;
            color: #fff;
        }
        .pagination li:first-child {
            border-left-width: 1px;
        }
    </style>
@endpush

@section('outlays')
    active
@endsection
@section('section')
    <main class="content forma" style="padding-bottom: 0; display: none">
        <div class="container-fluid p-0">
            <div class="col-md-8 col-xl-9">
                <div class="">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Yangi xarajat qo'shish</h5>
                        </div>
                        <div class="card-body h-100">
                            <form action="{{ route('admin.new.pr.exam') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Sana <span class="text-danger">*</span></label>
                                    <input name="date" required type="date" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" class="form-control" placeholder="">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Summa <span class="text-danger">*</span></label>
                                    <input type="text" oninput="formatPaymentAmount(this)" class="form-control" name="amount" id="summa">
                                </div>

                                <div class=" text-end">
                                    <button type="button" class="btn btn-danger cancel">Bekor qilish</button>
                                    <button type="submit" class="btn btn-success">Qo'shish</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <main class="content teachers">
        <div class="container-fluid p-0">
            <div class="col-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title mb-0">Imtixon kunlari ro'yhati</h5>
                            </div>
                            <div class="col-6 text-end">
                                <button class="btn btn-primary add">+ Qo'shish</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover" id="tbl_exporttable_to_xls">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Sana</th>
                            <th>Narxi</th>
                            <th>Sotuv summasi</th>
                            <th>Holati</th>
                            <th>Savollar soni</th>
                            <th>Savollar</th>
                            <th>Natijalar</th>
                            <th>Yakunlash</th>
                        </tr>
                        </thead>
                        <tbody id="old-data">
                        @foreach($days as $id => $day)
                            <tr>
                                <td>{{ $id+1 }}</td>
                                <td>
                                    {{ $day->date }}
                                </td>
                                <td>{{ $day->amount }}</td>
                                <td>{{ $day->sales_amount }}</td>
                                <td>{{ $day->status }}</td>
                                <td>{{ $day->quiz_count }}</td>
                                <td><a href="{{ route('admin.pr.exam', ['id' => $day->id]) }}" class="btn mb-1 btn-bitbucket"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye align-middle"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a></td>
                                <td><a class="btn mb-1 btn-vimeo"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers align-middle"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg></a></td>
                                <td><a class="btn mb-1 btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock align-middle"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tbody id="new-data" style="display: none"></tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
@endsection

@section('js')
    <script>
        $(".add").on("click", function() {
            $('.forma').show();
            $('.teachers').hide();
        });

        $(".cancel").on("click", function() {
            event.stopPropagation();
            $('.forma').hide();
            $('.teachers').show();
        });

        $(".cancel1").on("click", function() {
            event.stopPropagation();
            $('.edit-forma').hide();
            $('.teachers').show();
        });

        function formatPaymentAmount(input) {
            // Remove existing non-numeric characters
            const numericValue = input.value.replace(/\D/g, '');

            // Add thousand separators
            const formattedValue = numericValue.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');

            // Update the input field with the formatted value
            input.value = formattedValue;
        }

        @if($errors->any())
        const notyf = new Notyf();

        @foreach ($errors->all() as $error)
        notyf.error({
            message: '{{ $error }}',
            duration: 5000,
            dismissible: true,
            position: {
                x: 'center',
                y: 'top'
            },
        });
        @endforeach

        @endif


        @if(session('success') == 1)
        const notyf = new Notyf();

        notyf.success({
            message: 'Imtixon kuni qo\'shildi!',
            duration: 5000,
            dismissible : true,
            position: {
                x : 'right',
                y : 'bottom'
            },
        });
        @endif

        @if(session('day_error') == 1)
        const notyf = new Notyf();

        notyf.error({
            message: 'Xatolik! Imtixon yakunlanmagan',
            duration: 5000,
            dismissible : true,
            position: {
                x : 'right',
                y : 'bottom'
            },
        });
        @endif

    </script>
@endsection
