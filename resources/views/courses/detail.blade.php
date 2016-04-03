<div class="form-horizontal">

    <div class="form-group">
        <label for="course-name" class="col-sm-3 control-label">Nazwa</label>

        <div class="col-sm-6">
            <input type="text" name="name" id="curse-name" class="form-control" value="{{ $course->name }}" required="">
        </div>
    </div>

    <div class="form-group">
        <label for="course-category" class="col-sm-3 control-label">Kategoria</label>

        <div class="col-sm-6">
            <select name="category_id" id="course-category" class="form-control" required="">
                <option value="" ></option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if( $category->id  == $course->category_id ) selected @endif >{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <legend>Pliki Kursu</legend>

        @foreach ($files as $file)
            <div class="entry">

                <div class="form-group">
                    <label for="course-name" class="col-sm-3 control-label">Nazwa</label>

                    <div class="input-group col-sm-6">
                        <input type="text" name="images[name][{{$file->id}}]" id="course-name" class="form-control" value="{{$file->name}}" required="">
                        <span class="input-group-btn">
                            <button class="btn btn-danger btn-remove" type="button">
                                <span class="glyphicon glyphicon-minus"></span>
                            </button>
                        </span>
                    </div>
                </div>

            </div>
        @endforeach
    <div class="entry">

        
        <div class="form-group">
            <label for="course-name" class="col-sm-3 control-label">Plik</label>

            <input type="file" name="new_images[file][]"  accept="image/*">
        </div>

        <div class="form-group">
            <label for="course-name" class="col-sm-3 control-label">Nazwa</label>

            <div class="input-group col-sm-6">
                <input type="text" name="new_images[name][]" id="course-name" class="form-control" value="{{ old('name') }}" >
                <span class="input-group-btn">
                    <button class="btn btn-success btn-add" type="button">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </span>
            </div>
        </div>

    </div>
</div>