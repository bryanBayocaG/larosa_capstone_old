@include('admin.partials.header');
@include('admin.partials.sidenav');
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Set Category list</h4>
                <h6>View/Search Set Category</h6>
            </div>
            <div class="page-btn">
                <a href="addcategory.php" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#addCategory">
                    <img src="{{ asset('assets/img/icons/plus.svg') }}" class="me-1" alt="img" />
                    Set Category
                </a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-path">
                        </div>
                        <div class="search-input">
                            <a class="btn btn-searchset"><img src="{{ asset('assets/img/icons/search-white.svg') }}"
                                    alt="img" /></a>
                        </div>
                    </div>
                </div>
                <div class="card" id="filter_inputs">
                    <div class="card-body pb-0"></div>
                </div>

                @livewire('categtable')

            </div>
        </div>
    </div>
</div>
</div>

{{-- asdfasdf --}}
<script type="text/javascript">
    window.addEventListener('closeModal', event => {
        $('#addCategory').modal('hide');
    });
    window.addEventListener('closeModal', event => {
        $('#addItemCateg').modal('hide');
    });
    window.addEventListener('closeModal1', event => {
        $('#addColor').modal('hide');
    });
    window.addEventListener('closeModal2', event => {
        $('#addSize').modal('hide');
    });

    window.addEventListener('message', event => {
        Swal.fire({
            position: "top-end",
            type: "success",
            title: "Category Added!",
            showConfirmButton: !1,
            timer: 1500,
            confirmButtonClass: "btn btn-primary",
            buttonsStyling: !1,
        });
    });
    window.addEventListener('message1', event => {
        Swal.fire({
            position: "top-end",
            type: "success",
            title: "Color Added!",
            showConfirmButton: !1,
            timer: 1500,
            confirmButtonClass: "btn btn-primary",
            buttonsStyling: !1,
        });
    });
    window.addEventListener('message2', event => {
        Swal.fire({
            position: "top-end",
            type: "success",
            title: "Size Added!",
            showConfirmButton: !1,
            timer: 1500,
            confirmButtonClass: "btn btn-primary",
            buttonsStyling: !1,
        });
    });
</script>


<script type="text/javascript">
    function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');
        console.log(urlToRedirect);
        Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            })
            .then(function(t) {
                t.value ?
                    window.location.href = urlToRedirect

                    :
                    t.dismiss === Swal.DismissReason.cancel &&
                    Swal.fire({
                        title: "Cancelled",
                        text: "Action has been Cancelled",
                        type: "error",
                        confirmButtonClass: "btn btn-success",
                    });
            });
    }
</script>






<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/plugins/toastr/toastr.js') }}"></script>

<script src="{{ asset('assets/js/feather.min.js') }}"></script>

<script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>

<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

<script src="{{ asset('assets/js/script.js') }}"></script>

<script src="{{ asset('assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert/sweetalerts.min.js') }}"></script>

<script src="{{ asset('assets/plugins/owlcarousel/owl.carousel.min.js') }}"></script>

@livewireScripts
</body>

</html>
