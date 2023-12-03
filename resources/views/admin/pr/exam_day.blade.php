@extends('admin.header')
@push('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <style>
        .pagination {
            height: 36px;
            margin: 0;
            padding: 0;
        }

        .pager, .pagination ul {
            margin-left: 0;
            *zoom: 1
        }

        .pagination ul {
            padding: 0;
            display: inline-block;
            *display: inline;
            margin-bottom: 0;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
            -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
            box-shadow: 0 1px 2px rgba(0, 0, 0, .05)
        }

        .pagination li {
            display: inline
        }

        .pagination a {
            float: left;
            padding: 0 12px;
            line-height: 30px;
            text-decoration: none;
            border: 1px solid #ddd;
            border-left-width: 0
        }

        .pagination .active a, .pagination a:hover {
            background-color: #f5f5f5;
            color: #94999E
        }

        .pagination .active a {
            color: #94999E;
            cursor: default
        }

        .pagination .disabled a, .pagination .disabled a:hover, .pagination .disabled span {
            color: #94999E;
            background-color: transparent;
            cursor: default
        }

        .pagination li:first-child a, .pagination li:first-child span {
            border-left-width: 1px;
            -webkit-border-radius: 3px 0 0 3px;
            -moz-border-radius: 3px 0 0 3px;
            border-radius: 3px 0 0 3px
        }

        .pagination li:last-child a {
            -webkit-border-radius: 0 3px 3px 0;
            -moz-border-radius: 0 3px 3px 0;
            border-radius: 0 3px 3px 0
        }

        .pagination-centered {
            text-align: center
        }

        .pagination-right {
            text-align: right
        }

        .pager {
            margin-bottom: 18px;
            text-align: center
        }

        .pager:after, .pager:before {
            display: table;
            content: ""
        }

        .pager li {
            display: inline
        }

        .pager a {
            display: inline-block;
            padding: 5px 12px;
            background-color: #fff;
            border: 1px solid #ddd;
            -webkit-border-radius: 15px;
            -moz-border-radius: 15px;
            border-radius: 15px
        }

        .pager a:hover {
            text-decoration: none;
            background-color: #f5f5f5
        }

        .pager .next a {
            float: right
        }

        .pager .previous a {
            float: left
        }

        .pager .disabled a, .pager .disabled a:hover {
            color: #999;
            background-color: #fff;
            cursor: default
        }

        .pagination .prev.disabled span {
            float: left;
            padding: 0 12px;
            line-height: 30px;
            text-decoration: none;
            border: 1px solid #ddd;
            border-left-width: 0
        }

        .pagination .next.disabled span {
            float: left;
            padding: 0 12px;
            line-height: 30px;
            text-decoration: none;
            border: 1px solid #ddd;
            border-left-width: 0
        }

        .pagination li.active, .pagination li.disabled {
            float: left;
            padding: 0 12px;
            line-height: 30px;
            text-decoration: none;
            border: 1px solid #ddd;
            border-left-width: 0
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

@section('exam_days')
    active
@endsection
@section('section')
    <div class="container-fluid ps-5 pt-4 pe-5">
        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3><strong>Savollar</strong> bo'limlari</h3>
            </div>
            <div class="col-auto ms-auto text-end mt-n1">
                <a href="#" class="btn btn-primary add-section">+ Yangi bo'lim</a>
            </div>
        </div>
        <div class="col-md-8 col-xl-9 new-section" style="display:none;">
            <div class="">
                <div class="card">
                    <div class="card-body h-100">
                        <form action="{{ route('admin.new.pr.section') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nomi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <input type="hidden" name="exam_day_id" value="{{ $day->id }}">
                            <div class="mb-3">
                                <label class="form-label">Rasm </label>
                                <input class="form-control" name="photo" type="file" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Matn</label>
                                <textarea class="form-control" name="a_answer"></textarea>
                            </div>
                            <div class=" text-end">
                                <button type="button" class="btn btn-danger section-cancel">Bekor qilish</button>
                                <button type="submit" class="btn btn-success">Qo'shish</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="content forma" style="padding-bottom: 0; display: none">
        <div class="container-fluid p-0">
            <div class="col-md-8 col-xl-9">
                <div class="">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Yangi savol qo'shish</h5>
                        </div>
                        <div class="card-body h-100">
                            <form action="{{ route('admin.new.pr.quiz') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Savol <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="quiz"></textarea>
                                </div>
                                <input type="hidden" id="section_id" name="section_id" value="">
                                <input type="hidden" id="section_id" name="exam_day_id" value="{{ $day->id }}">
                                <div class="mb-3">
                                    <label class="form-label">Rasm </label>
                                    <input class="form-control" name="photo" type="file" accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">A javob <span
                                            class="text-danger">tog'ri javob *</span></label>
                                    <textarea class="form-control" name="a_answer"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">A Rasm </label>
                                    <input class="form-control" name="a_photo" type="file" accept="image/*">
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="form-label">B javob <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="b_answer"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">B Rasm </label>
                                    <input class="form-control" name="b_photo" type="file" accept="image/*">
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="form-label">C javob <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="c_answer"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">C Rasm </label>
                                    <input class="form-control" name="c_photo" type="file" accept="image/*">
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="form-label">D javob <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="d_answer"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">D Rasm </label>
                                    <input class="form-control" name="d_photo" type="file" accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ball <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="ball" id="summa">
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

    @foreach($day->quizSections as $section)
        <main class="content quizzes">
            <div class="container-fluid p-0">
                <div class="col-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="card-title mb-0"><span class="text-danger">{{ $section->name }}</span>
                                        bo'limi savollari
                                    </h5>
                                </div>
                                <div class="col-6 text-end">
                                    <form action="{{ route('admin.pr.section.delete') }}" method="post"
                                          class="d-inline">
                                        @csrf
                                        <input type="hidden" name="section_id" value="{{ $section->id }}">
                                        <button type="submit" class="btn btn-danger">Bo'limni o'chirish</button>
                                    </form>
                                    <button class="btn btn-info add" id="{{ $section->id }}">+ Savol qo'shish</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-hover" id="tbl_exporttable_to_xls">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Sana</th>
                                <th>Togri javob</th>
                                <th>B javob</th>
                                <th>C javob</th>
                                <th>D javob</th>
                                <th>Ball</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody id="old-data">
                            @foreach($section->quizzes as $id => $quiz)
                                <tr>
                                    <td>{{ $id+1 }}</td>
                                    <td>
                                        {{ $quiz->quiz }}
                                    </td>
                                    <td class="text-danger">{{ $quiz->answers[0]->answer }}</td>
                                    <td>{{ $quiz->answers[1]->answer }}</td>
                                    <td>{{ $quiz->answers[2]->answer }}</td>
                                    <td>{{ $quiz->answers[3]->answer }}</td>
                                    <td>{{ $quiz->ball }}</td>
                                    <td><a href="{{ route('admin.pr.quiz.delete', ['id' => $quiz->id]) }}"
                                           class="btn mb-1 btn-bitbucket">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-edit-3 align-middle ">
                                                <path d="M12 20h9"></path>
                                                <path
                                                    d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                            </svg>
                                        </a></td>
                                    <td>
                                        <form action="{{ route('admin.pr.quiz.delete') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                                            <input type="hidden" name="exam_day_id" value="{{ $day->id }}">
                                            <button type="submit" class="btn mb-1 btn-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2"
                                                     stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-trash align-middle ">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    @endforeach

@endsection

@section('js')
    <script>
        $(".add-section").on("click", function () {
            $('.new-section').show();
            $('.quizzes').hide();
        });

        $(".section-cancel").on("click", function () {
            event.stopPropagation();
            $('.new-section').hide();
            $('.quizzes').show();
        });

        $(".add").on("click", function () {
            let sectionID = $(this).attr('id');
            $('#section_id').val(sectionID);
            $('.forma').show();
            $('.quizzes').hide();
        });

        $(".cancel").on("click", function () {
            event.stopPropagation();
            $('.forma').hide();
            $('.quizzes').show();
        });

        $(".cancel1").on("click", function () {
            event.stopPropagation();
            $('.edit-forma').hide();
            $('.quizzes').show();
        });

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
            dismissible: true,
            position: {
                x: 'right',
                y: 'bottom'
            },
        });
        @endif

        @if(session('new-section') == 1)
        const notyf = new Notyf();

        notyf.success({
            message: 'Savollar bo\'limi qo\'shildi!',
            duration: 5000,
            dismissible: true,
            position: {
                x: 'right',
                y: 'bottom'
            },
        });
        @endif

        @if(session('section_delete') == 1)
        const notyf = new Notyf();

        notyf.success({
            message: 'Savollar bo\'limi o\'chirildi!',
            duration: 5000,
            dismissible: true,
            position: {
                x: 'right',
                y: 'bottom'
            },
        });
        @endif

        @if(session('quiz_save') == 1)
        const notyf = new Notyf();

        notyf.success({
            message: 'Savol  qo\'shildi!',
            duration: 5000,
            dismissible: true,
            position: {
                x: 'right',
                y: 'bottom'
            },
        });
        @endif


        @if(session('error') == 1)
        const notyf = new Notyf();

        notyf.error({
            message: 'Xatolik! Savol q\'shilmadi',
            duration: 5000,
            dismissible: true,
            position: {
                x: 'right',
                y: 'bottom'
            },
        });
        @endif

    </script>
@endsection
