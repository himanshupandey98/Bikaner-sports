<x-AdminLayout>
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">

        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl d-flex justify-content-center">
                <!--begin::Card-->
                <div class="card w-100 p-5">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6 d-block">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                Product Create

                            </div>

                        </div>
                        <x-validationError></x-validationError>


                    </div>

                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <form action="{{ url('product/store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body py-4 row">
                            <div class="col">
                                <div class="form-group mb-3 col">
                                    <label for="" class="form-label">Product Name</label>
                                    <input type="text" name="name" class="form-control"
                                        placeholder="product name">
                                </div>
                                <div class="form-group mb-3 col">
                                    <label for="" class="form-label">Product Thumbnail</label>
                                    <input type="file" name="thumbnail" class="form-control">
                                </div>
                                <div class="form-group mb-3 col">
                                    <label for="" class="form-label">Brand</label>

                                    <select class="form-select" data-control="select2"
                                        data-placeholder="Select an option" name="brand_id">
                                        <option></option>
                                        @foreach ($brands as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach

                                    </select>

                                </div>
                                <div class="form-group mb-3 col">
                                    <label for="" class="form-label">Sports Category</label>

                                    <select class="form-select" data-control="select2"
                                        data-placeholder="Select an option" name="sports_category_id">
                                        <option></option>
                                        @foreach ($sports_categories as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach

                                    </select>

                                </div>
                                <div class="form-group mb-3 col">
                                    <label for="" class="form-label">Category</label>

                                    <select class="form-select" data-control="select2"
                                        data-placeholder="Select an option" name="category_id">
                                        <option></option>
                                        @foreach ($categories as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach

                                    </select>

                                </div>

                                <div class="form-group mb-3 mt-5 col">
                                    <button class="btn btn-primary">Submit</button>
                                </div>


                            </div>

                            <div class="col">
                                <label for="" class="form-label">Product Description</label>
                                <textarea type="textarea" name="description" class="form-control" rows="16"></textarea>
                            </div>
                            {{-- <div class="col">
                                <input type="hidden" name="product_description" value=""
                                    id="product_description">
                                <label for="" class="form-label mb-3">Product Description</label>


                                <div id="kt_docs_quill_basic" class="mt-3" style="height:300px">

                                    <h1>Quick and Simple Quill Integration</h1>
                                    <p>Here goes the&nbsp;<a href="#">Minitial content of the editor</a>. Lorem
                                        Ipsum is simply dummy text of the&nbsp;<em>printing and
                                            typesetting</em>&nbsp;industry.</p>
                                    <blockquote>Lorem Ipsum has been the industry's standard dummy text ever since the
                                        1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum
                                        is simply dummy text of the printing and typesetting industry.</blockquote>
                                    <h3 style="text-align: right;">Flexible &amp; Powerful</h3>
                                    <p style="text-align: right;"><strong>Lorem Ipsum has been the
                                            industry's</strong>&nbsp;standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and scrambled.</p>
                                    <ul>
                                        <li>List item 1</li>
                                        <li>List item 2</li>
                                        <li>List item 3</li>
                                        <li>List item 4</li>
                                    </ul>

                                </div>


                            </div> --}}





                        </div>

                    </form>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>

</x-AdminLayout>

<script>
    // var quill = new Quill('#kt_docs_quill_basic', {
    //     modules: {
    //         toolbar: true
    //     },
    //     placeholder: 'Type your text here...',
    //     theme: 'snow' // or 'bubble'
    // });

    // var val = $('.ql-editor').html();
    // $('#product_description').val(val);

    // $('.ql-editor').on('change', function() {
    //     console.log('change');
    //     val = $('.ql-editor').html();
    //     var p = $('#product_description').val(val);
    //     console.log(p);
    // })
    // $(document).ready(function() {

    //     const targetElement = document.getElementsByClassName("ql-editor")[0];



    //     const observer = new MutationObserver(function(mutationsList) {
    //         $('#product_description').val(targetElement[0].innerHTML);

    //     });

    //     const observerConfig = {
    //         childList: true,
    //         subtree: true
    //     };

    //     observer.observe(targetElement, observerConfig);
    // });






</script>
