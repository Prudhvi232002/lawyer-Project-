<footer class="main-footer">
    @php
     $application_current_version = App\Models\GeneralSetting::where('name', 'application_current_version')->first();
@endphp
    <strong>Copyright &copy; {{ date('Y') }} <a href="#">Lawyers</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> {{ $application_current_version->value ?? "2.0.3" }}
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
