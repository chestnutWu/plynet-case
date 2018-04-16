<!--Master Modal -->
<div class="modal fade" id="{{$modal_id}}" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <center><h2 class="modal-title">@yield('modal_title')</h2></center>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
            @yield('modal_content')
          </div>
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>