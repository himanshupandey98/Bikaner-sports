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
                <div class="card w-50 ">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                Sports Category Edit

                            </div>
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->

                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <form action="{{ url('sports-category/update/'.Crypt::encrypt($sports_category->id)) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body py-4">
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Sports Category Name</label>
                                <input type="text" name="name" class="form-control" placeholder="category Name" value="{{ $sports_category->name }}">
                            </div>
                            
                            <div class="form-group mb-3">
                                <button class="btn btn-primary">Submit</button>
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

