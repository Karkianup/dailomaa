<!--   Core JS Files   -->
<script src="{{ asset('Asset/Dashboard/js/core/jquery.min.js') }}"></script>
<script src="{{ asset('Asset/Dashboard/js/core/popper.min.js') }}"></script>
<script src="{{ asset('Asset/Dashboard/js/core/bootstrap-material-design.min.js') }}"></script>
{{-- <script
    src="{{ asset('Asset/Dashboard/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
--}}
<script src="{{ asset('Asset/Dashboard/js/plugins/jquery.bootstrap-wizard.js') }}"></script>
<script src="{{ asset('Asset/Dashboard/js/Actions/actions.js') }}"></script>

{{-- <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script>
--}}
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!--  Notifications Plugin    -->
<script src="{{ asset('Asset/Dashboard/js/plugins/bootstrap-notify.js') }}"></script>
<script src="{{ asset('Asset/Dashboard/js/plugins/jquery.dataTable.min.js') }}"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{ asset('Asset/Dashboard/js/plugins/jasny-bootstrap.min.js') }}"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('Asset/Dashboard/js/material-dashboard.min.js') }}" type="text/javascript"></script>

{{-- Additional js --}}

<script>
    $(function() {
        // Multiple images preview with JavaScript
        var multiImgPreview = function(input, imgPreviewPlaceholder) {

            if (input.files) {
                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(
                            imgPreviewPlaceholder);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

        $('#images').on('change', function() {
            multiImgPreview(this, 'div.imgPreview');
        });
    });

</script>

{{-- End additional js --}}

<script>
    $(document).ready(function() {
        $("#type-select").change(function() {
            $(this).find("option:selected").each(function() {
                var optionValue = $(this).attr("value");
                if (optionValue) {
                    $(".selected-data").not("." + optionValue).hide();
                    $("." + optionValue).show();
                } else {
                    $(".selected-data").hide();
                }
            });
        }).change();
    });

</script>

<script>
    $(document).ready(function() {
        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }
        });

        var table = $('#datatable').DataTable();

        // Edit record
        table.on('click', '.edit', function() {
            $tr = $(this).closest('tr');
            var data = table.row($tr).data();
            alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
        });

        // Delete a record
        table.on('click', '.remove', function(e) {
            $tr = $(this).closest('tr');
            table.row($tr).remove().draw();
            e.preventDefault();
        });

        //Like record
        table.on('click', '.like', function() {
            alert('You clicked on Like button');
        });
    });

</script>
