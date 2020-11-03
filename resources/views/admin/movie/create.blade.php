@extends('admin.master')

@section('title')
    Add Movie
@endsection

@section('content')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Please Enter The Movie Data</h5>
        </div>
        <div class="card-body">
            <form class="needs-validation" novalidate method="post" action="{{ asset('/admin/movie/store') }}" enctype="multipart/form-data" class="needs-validation"  novalidate>
                
                {{ csrf_field() }}
                
                <div class="form-group">
                    <label for="exampleInputtTitle1">Title</label>
                    <input type="text" required name="title" class="form-control" id="exampleInputtTitle1" placeholder="Enter a movie title">
                    <div class="valid-feedback">
                        great!
                    </div>
                    <div class="invalid-feedback">
                        Please enter title
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputtTitle1">Duration</label>
                            <input type="text" required name="duration" class="form-control" id="exampleInputtTitle1" placeholder="Enter a movie duration">
                            <div class="valid-feedback">
                                great!
                            </div>
                            <div class="invalid-feedback">
                                Please enter duration
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputtTitle1">Release Date</label>
                            <input type="date" required name="release_date" class="form-control" id="exampleInputtTitle1" placeholder="Enter a movie release date">
                        </div>
                        <div class="valid-feedback">
                            great!
                        </div>
                        <div class="invalid-feedback">
                            Please enter release date
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputtTitle1">Actors</label>
                            <div class="input-group control-group after-add-more">
                                <input type="text" name="actor[]" id="ContactNo" required class="form-control" placeholder="Enter a movie actor">
                                <div class="input-group-btn"> 
                                    <button class="btn btn-success add-more" style="border-radius: 0 0.35rem 0.35rem 0; width:40px;" type="button"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="copy">
                                <div class="control-group input-group" style="margin-top:10px">
                                    <input type="text" name="actor[]" class="form-control" placeholder="Enter other movie actor">
                                    <div class="input-group-btn"> 
                                        <button class="btn btn-danger remove" style="border-radius: 0 0.35rem 0.35rem 0; width:40px;" type="button"><i class="fas fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="valid-feedback">
                                great!
                            </div>
                            <div class="invalid-feedback">
                                Please enter duration
                            </div>
                        </div>
                    </div>
                    <div class="col">
                         <div class="form-group">
                            <label for="exampleInputtTitle1">Directors</label>
                            <div class="input-group control-group after-add-more-dir">
                                <input type="text" name="director[]" id="ContactNo" required class="form-control" placeholder="Enter a movie director">
                                <div class="input-group-btn"> 
                                    <button class="btn btn-success add-more-dir" style="border-radius: 0 0.35rem 0.35rem 0; width:40px;" type="button"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="copy-dir">
                                <div class="control-group input-group" style="margin-top:10px">
                                    <input type="text" name="director[]" class="form-control" placeholder="Enter other movie director">
                                    <div class="input-group-btn"> 
                                        <button class="btn btn-danger remove-dir" style="border-radius: 0 0.35rem 0.35rem 0; width:40px;" type="button"><i class="fas fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="valid-feedback">
                                great!
                            </div>
                            <div class="invalid-feedback">
                                Please enter duration
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputtTitle1">Genre</label><br/>
                    <select class="selectpicker" name="genre[]" required multiple>
                        @foreach($genre as $g)
                            <option value="{{$g->id}}">{{$g->name}}</option>
                        @endforeach
                    </select>

                    <div class="valid-feedback">
                        great!
                    </div>
                    <div class="invalid-feedback">
                        Please enter duration
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputtTitle1">Description</label>
                    <textarea class="form-control" required name="description" id="exampleFormControlTextarea1" rows="10" placeholder="Enter a movie description"></textarea>
                    <div class="valid-feedback">
                        great!
                    </div>
                    <div class="invalid-feedback">
                        Please enter description
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputtTitle1">Story Line</label>
                    <textarea class="form-control" required name="story_line" id="exampleFormControlTextarea1" rows="10" placeholder="Enter a movie story line"></textarea>
                    <div class="valid-feedback">
                        great!
                    </div>
                    <div class="invalid-feedback">
                        Please enter story line
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Video</label>
                    <input type="file" required name="video" class="form-control-file" id="video" accept="video/mp4,video/x-m4v,video/*" onchange="document.getElementById('previewVideo').src = window.URL.createObjectURL(this.files[0])">
                    <div class="row mt-3">
                        <div class="col-xl-4 col-md-6 col-sm-12">
                            <img src="" alt="" style="width:100%;" id="previewVideo">
                        </div>
                    </div>
                    <div class="valid-feedback">
                        great!
                    </div>
                    <div class="invalid-feedback">
                        Please enter video
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
        $('.copy').hide()
        $('.copy-dir').hide()
        $(document).ready(function() {
            $(".add-more").click(function(){
                var html = $(".copy").html();
                $(".after-add-more").after(html);
            });
            $("body").on("click",".remove",function(){ 
                $(this).parents(".control-group").remove();
            });

            $(".add-more-dir").click(function(){
                var html = $(".copy-dir").html();
                $(".after-add-more-dir").after(html);
            });
            $("body").on("click",".remove-dir",function(){ 
                $(this).parents(".control-group").remove();
            });
        });
    </script>

@endsection