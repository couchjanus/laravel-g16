<form method="POST">{{ csrf_field() }}
  <div class="form-group">
    <label for="title">Title:</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title"></div>
  <div class="form-group">
    <label for="content">Content:</label>
    <textarea  id="content" class="form-control" name="content"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Save</button>
</form>
