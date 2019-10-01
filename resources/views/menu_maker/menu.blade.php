@extends('admin.layouts.app')
@section('sidebar_title','مدیریت تگ ها')
@section('header')

@endsection

@section('content')

        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Nestable1</h4>
                            <div class="myadmin-dd dd" id="nestable">
                                <ol class="dd-list">
                                    <li class="dd-item" data-id="1">
                                        <div class="dd-handle"> Item 1 </div>
                                    </li>
                                    <li class="dd-item" data-id="2">
                                        <div class="dd-handle"> Item 2 </div>
                                        <ol class="dd-list">
                                            <li class="dd-item" data-id="3">
                                                <div class="dd-handle"> Item 3 </div>
                                            </li>
                                            <li class="dd-item" data-id="4">
                                                <div class="dd-handle"> Item 4 </div>
                                            </li>
                                            <li class="dd-item" data-id="5">
                                                <div class="dd-handle"> Item 5 </div>
                                                <ol class="dd-list">
                                                    <li class="dd-item" data-id="6">
                                                        <div class="dd-handle"> Item 6 </div>
                                                    </li>
                                                    <li class="dd-item" data-id="7">
                                                        <div class="dd-handle"> Item 7 </div>
                                                    </li>
                                                    <li class="dd-item" data-id="8">
                                                        <div class="dd-handle"> Item 8 </div>
                                                    </li>
                                                </ol>
                                            </li>
                                            <li class="dd-item" data-id="9">
                                                <div class="dd-handle"> Item 9 </div>
                                            </li>
                                            <li class="dd-item" data-id="10">
                                                <div class="dd-handle"> Item 10 </div>
                                            </li>
                                        </ol>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Nestable2</h4>
                            <div class="myadmin-dd-empty dd" id="nestable2">
                                <ol class="dd-list">
                                    <li class="dd-item dd3-item" data-id="13">
                                        <div class="dd-handle dd3-handle"></div>
                                        <div class="dd3-content"> Item 13 </div>
                                    </li>
                                    <li class="dd-item dd3-item" data-id="14">
                                        <div class="dd-handle dd3-handle"></div>
                                        <div class="dd3-content"> Item 14 </div>
                                    </li>
                                    <li class="dd-item dd3-item" data-id="14">
                                        <div class="dd-handle dd3-handle"></div>
                                        <div class="dd3-content"> Item 16 </div>
                                    </li>
                                    <li class="dd-item dd3-item" data-id="14">
                                        <div class="dd-handle dd3-handle"></div>
                                        <div class="dd3-content"> Item 17 </div>
                                    </li>
                                    <li class="dd-item dd3-item" data-id="14">
                                        <div class="dd-handle dd3-handle"></div>
                                        <div class="dd3-content"> Item 18 </div>
                                    </li>
                                    <li class="dd-item dd3-item" data-id="14">
                                        <div class="dd-handle dd3-handle"></div>
                                        <div class="dd3-content"> Item 19 </div>
                                    </li>
                                    <li class="dd-item dd3-item" data-id="15">
                                        <div class="dd-handle dd3-handle"></div>
                                        <div class="dd3-content"> Item 15 </div>
                                        <ol class="dd-list">
                                            <li class="dd-item dd3-item" data-id="16">
                                                <div class="dd-handle dd3-handle"></div>
                                                <div class="dd3-content"> Item 16 </div>
                                            </li>
                                            <li class="dd-item dd3-item" data-id="17">
                                                <div class="dd-handle dd3-handle"></div>
                                                <div class="dd3-content"> Item 17 </div>
                                            </li>
                                            <li class="dd-item dd3-item" data-id="18">
                                                <div class="dd-handle dd3-handle"></div>
                                                <div class="dd3-content"> Item 18 </div>
                                            </li>
                                        </ol>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Nestable3</h4>
                            <div class="dd myadmin-dd" id="nestable-menu">
                                <ol class="dd-list">
                                    <li class="dd-item" data-id="13">
                                        <div class="dd-handle">Item 13</div>
                                    </li>
                                    <li class="dd-item" data-id="13">
                                        <div class="dd-handle">Item 13</div>
                                    </li>
                                    <li class="dd-item" data-id="14">
                                        <div class="dd-handle">Item 14</div>
                                    </li>
                                    <li class="dd-item" data-id="15">
                                        <div class="dd-handle">Item 15</div>
                                        <ol class="dd-list">
                                            <li class="dd-item" data-id="16">
                                                <div class="dd-handle">Item 16</div>
                                            </li>
                                            <li class="dd-item" data-id="17">
                                                <div class="dd-handle">Item 17</div>
                                            </li>
                                            <li class="dd-item" data-id="18">
                                                <div class="dd-handle">Item 18</div>
                                            </li>
                                            <li class="dd-item" data-id="16">
                                                <div class="dd-handle">Item 19</div>
                                            </li>
                                            <li class="dd-item" data-id="17">
                                                <div class="dd-handle">Item 20</div>
                                            </li>
                                            <li class="dd-item" data-id="18">
                                                <div class="dd-handle">Item 21</div>
                                            </li>
                                        </ol>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection
@section('script')
    <script src="/admin_template/assets/libs/nestable/jquery.nestable.js"></script>
    <script>
        $(function() {
            // Nestable
            var updateOutput = function(e) {
                var list = e.length ? e : $(e.target),
                    output = list.data('output');
                if (window.JSON) {
                    console.log(window.JSON.stringify(list.nestable('serialize')));
                    output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
                } else {
                    output.val('JSON browser support required for this demo.');
                }
            };

            $('#nestable').nestable({
                group: 1
            }).on('change', updateOutput);

            $('#nestable2').nestable({
                group: 1
            }).on('change', updateOutput);

            updateOutput($('#nestable').data('output', $('#nestable-output')));
            updateOutput($('#nestable2').data('output', $('#nestable2-output')));

            $('#nestable-menu').on('click', function(e) {
                var target = $(e.target),
                    action = target.data('action');
                if (action === 'expand-all') {
                    $('.dd').nestable('expandAll');
                }
                if (action === 'collapse-all') {
                    $('.dd').nestable('collapseAll');
                }
            });

            $('#nestable-menu').nestable();
        });
    </script>

@endsection
