@extends('client.app')


@section ('content')

<section id="main-content">
    <section class="wrapper">
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#a1">
    Launch demo modal
  </button>

  <!-- Modal -->
  <div class="modal fade" id="a1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <img src="https://phunugioi.com/wp-content/uploads/2020/10/anh-thien-nhien-buon.jpg" alt="Italian Trulli" width= 500px>
            <img src="https://phunugioi.com/wp-content/uploads/2020/10/anh-thien-nhien-buon.jpg" alt="Italian Trulli" width= 500px>
            <img src="https://phunugioi.com/wp-content/uploads/2020/10/anh-thien-nhien-buon.jpg" alt="Italian Trulli" width= 500px>
            <img src="https://phunugioi.com/wp-content/uploads/2020/10/anh-thien-nhien-buon.jpg" alt="Italian Trulli" width= 500px>
            <img src="https://phunugioi.com/wp-content/uploads/2020/10/anh-thien-nhien-buon.jpg" alt="Italian Trulli" width= 500px>
            <img src="https://phunugioi.com/wp-content/uploads/2020/10/anh-thien-nhien-buon.jpg" alt="Italian Trulli" width= 500px>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

</section><!-- --/wrapper ---->
</section>
@endsection
