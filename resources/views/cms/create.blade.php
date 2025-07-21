<form action="{{ route('cms-pages.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Title</label>
    <input type="text" name="title" required>

    <label>Alias</label>
    <input type="text" name="alias" required>

    <label>Status</label>
    <select name="status">
        <option value="1">Active</option>
        <option value="0">Inactive</option>
    </select>

    <label>Banner</label>
    <input type="file" name="banner">

    <label>Content</label>
    <textarea name="content"></textarea>

    <label>Meta Title</label>
    <input type="text" name="meta_title">

    <label>Meta Description</label>
    <textarea name="meta_description"></textarea>

    <label>Meta Keyword</label>
    <input type="text" name="meta_keyword">

    <button type="submit">Save</button>
</form>
