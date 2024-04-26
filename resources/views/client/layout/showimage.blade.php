<form class="form-horizontal style-form"action="{{ route('postUpload') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label">Image</label>
        <div class="col-sm-10">
            <input name="image"  type="file" multiple >
            <span class="help-block">s3</span>
        </div>
    </div>
      <hr>
      <button type="submit" class="btn btn-success">Save</button>
</form>

