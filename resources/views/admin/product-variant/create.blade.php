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
                                Product variant Create

                            </div>

                        </div>
                        <x-validationError></x-validationError>


                    </div>

                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <form action="{{ url('product-variant/store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body py-4 row">
                            <div class="col">
                                <input type="hidden" name="product_id" value="{{ Crypt::encrypt($product_id) }}">
                                <div class="form-group mb-3 col">
                                    <label for="" class="form-label">Product Variant Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="product name">
                                </div>
                                <div class="form-group mb-3 col">
                                    
                                    {{ Form::label('Product Attribute', null, ['class' => 'form-label']) }}

                                    {{ Form::select('product_attribute_id[]', $product_attributes, null, ['class' =>
                                    'form-control', 'data-control' => 'select2', 'multiple' => true]) }}


                                </div>
                                <div class="form-group mb-3 col">
                                    
                                   <label for="" class="form-label">Product Variant Image</label>
                                   <input type="file" name="image" class="form-control">



                                </div>
                                


                                <div class="form-group mb-3 mt-5 col">
                                    <button class="btn btn-primary">Submit</button>
                                </div>


                            </div>
                            <div class="col">
                                <div class="form-group mb-3 ">
                                    <label for="" class="form-label">Product Variant Price</label>
                                    <input type="text" name="price" class="form-control" placeholder="product variant price">


                                </div>
                                <div class="form-group mb-3 ">

                                    <label for="" class="form-label">Product Variant Quantity</label>
                                    <input type="text" name="quantity" class="form-control" placeholder="product variant quantity">

                                </div>

                            </div>








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
