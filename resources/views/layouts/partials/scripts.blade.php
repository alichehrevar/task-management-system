<!-- jQuery (required for Persian Datepicker) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/persian-date/dist/persian-date.js"></script>
<script src="https://cdn.jsdelivr.net/npm/persian-datepicker/dist/js/persian-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/persian-datepicker/dist/css/persian-datepicker.min.css">
<script>
    $(document).ready(function() {
        $("#due_date").persianDatepicker({
            format: 'YYYY/MM/DD',
            initialValueType: 'persian',
            autoClose: true,
        });
    });
</script>
<script src="{{ mix('js/app.js') }}"></script>
@livewireScripts
